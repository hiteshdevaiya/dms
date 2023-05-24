<?php



namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request, Hash, Auth, Mail, Session;

use Keygen\Keygen;

use Illuminate\Support\Str;

use App\Models\User as UsersModel;

use App\Models\States;

use App\Models\City;
use App\Models\Devotee;



class Validation extends Controller

{

    /**

     * Show the profile for the given user.

     *

     * @param  int  $id

     * @return Response

     */



    public function checkpassword(Request $request)

    {

        $post_data = Request::all();

        $user = UsersModel::find(auth()->guard('admin')->user()->id);

        if(!empty($post_data) && !empty($post_data['old_password'])):

            if(Hash::check($post_data['old_password'], $user->password)):

                echo 'true';

            else:

                echo 'false';

            endif;

        endif;

    }



    public function checkemailexist(Request $request)

    {

        $post_data = Request::all();

        if(!empty($post_data) && !empty($post_data['email'])):

            $user = UsersModel::where('email',$post_data['email'])->first();

            if($user):

                echo 'false';

            else:

                echo 'true';

            endif;

        endif;

    }



    public function checkuseremailexist(Request $request)

    {

        $post_data = Request::all();

        if(!empty($post_data) && !empty($post_data['query']['email'])):

            $user = UsersModel::where('email',$post_data['query']['email'])->first();

            if($user):

                echo 'false';

            else:

                echo 'true';

            endif;

        endif;

    }

    public function checkdevoteemobileexist(Request $request)

    {

        $post_data = Request::all();
        if(!empty($post_data) && !empty($post_data['query']['mobile_no'])):
            if($post_data['query']['edit_type'] == 'edit'):
                $user = Devotee::where('mobile_no',$post_data['query']['mobile_no'])->where('id','!=',$post_data['query']['devotee_hidden_id'])->first();
            else:
                $user = Devotee::where('mobile_no',$post_data['query']['mobile_no'])->first();
            endif;
            if(!empty($user)):

                echo 'false';

            else:

                echo 'true';

            endif;

        endif;

    }



    public function getstate(Request $request)

    {

        $post_data = Request::all();



        if(!empty($post_data) &&  !empty($post_data['country_id'])):

            $state_list = States::where("country_id",$post_data['country_id'])->get();



            if(isset($state_list) && count($state_list) > 0):

                $data = array();

                $data[] .= '<option value="">Select State</option>';

                foreach($state_list as $key => $val):

                if(!empty($post_data['state_id']) && $val->id == $post_data['state_id']):

                    $data[] .= '<option value="'.$val->id.'" selected="selected" >'.$val->title.'</option>';

                else:

                    $data[] .= '<option value="'.$val->id.'" >'.$val->title.'</option>';

                endif;

                endforeach;

                return $data;

            endif;

        endif;

        return false;



    }



    public function getmultiplestate(Request $request)

    {

        $post_data = Request::all();

        //dd($post_data);

        if(!empty($post_data) && !empty($post_data['country_id'])):

            $state_list = States::where("country_id",$post_data['country_id'])->get();



            if(isset($state_list) && count($state_list) > 0):

                $data = array();

                $data[] .= '<option value="">Select State</option>';

                foreach($state_list as $key => $val):

                if(!empty($post_data['state_id']) && $val->id == $post_data['state_id']):

                    $data[] .= '<option value="'.$val->id.'" selected="selected" >'.$val->title.'</option>';

                else:

                    $data[] .= '<option value="'.$val->id.'" >'.$val->title.'</option>';

                endif;

                endforeach;

                return $data;

            endif;

        endif;

        return false;



    }



    public function getcity(Request $request)

    {

        $post_data = Request::all();



        if(!empty($post_data) &&  !empty($post_data['country_id']) && !empty($post_data['state_id'])):

            $city_list = City::where("country_id",$post_data['country_id'])->where("state_id",$post_data['state_id'])->get();

            if(isset($city_list) && count($city_list) > 0):

                $data = array();

                $data[] .= '<option value="">Select City</option>';

                foreach($city_list as $key => $val):

                if(!empty($post_data['state_id']) && $val->id == $post_data['state_id']):

                    $data[] .= '<option value="'.$val->id.'" selected="selected" >'.$val->title.'</option>';

                else:

                    $data[] .= '<option value="'.$val->id.'" >'.$val->title.'</option>';

                endif;

                endforeach;

                return $data;

            endif;

        endif;

        return false;



    }

public function getStatesOptions(Request $request)
    {
        $data = Request::all();
        $country_id = json_decode($data['country']);
        $country_id_str = implode(",", $country_id);
        $states = States::with(['country'])
                    ->whereIn('country_id', $country_id)
                    ->where('status', 1);
        if(!empty($country_id_str)){
          $states =$states->orderByRaw("FIELD(country_id , ".$country_id_str.") ASC");
        }
        $states = $states->get()
                  ->groupBy('country.title')
                  ->all()
                  ;
        $html =' <option value="">Please Select</option>';
        foreach ($states as $country_title => $state) {
          //$html .= '<optgroup label="'.$country_title.'">';
          foreach ($state as $s) {
            $html .='<option value="'.$s->id.'">'.$s->title.'</option>';
          }
          //$html .= '</optgroup>';
        }
        return response()->json(['html' => $html]);
    }

    public function getCitiesOptions(Request $request)
    {
        $data = Request::all();
        $state_id = json_decode($data['state']);
        $state_id_str = implode(",", $state_id);
        $cities = City::with(['state'])
                    ->whereIn('state_id', $state_id)
                    ->where('status', 1);
        if(!empty($state_id_str)){
          $cities =$cities->orderByRaw("FIELD(state_id , ".$state_id_str.") ASC");
        }
        $cities = $cities->get()
                  ->groupBy('state.title')
                  ->all()
                  ;
        $html =' <option value="">Please Select</option>';
        foreach ($cities as $state_title => $city) {
          //$html .= '<optgroup label="'.$state_title.'">';
          foreach ($city as $c) {
            $html .='<option value="'.$c->id.'">'.$c->title.'</option>';
          }
          //$html .= '</optgroup>';
        }
        return response()->json(['html' => $html]);
    }

    public function copyotheraddress(Request $request)
    {
        $post_data = Request::all();

        $data = array();
        $state = "";
        $city = "";
        if(!empty($post_data) &&  !empty($post_data['country_id'])){

            $state_list = States::where("country_id",$post_data['country_id'])->get();
            $city_list = City::where("country_id",$post_data['country_id'])->where("state_id",$post_data['state_id'])->get();

            if(isset($state_list) && count($state_list) > 0){
                $state .= '<option value="">Select State</option>';

                foreach($state_list as $key => $val){
                    $selected = ($val->id == $post_data['state_id'])  ? 'selected="selected"' : '';
                    $state .= '<option value="'.$val->id.'" '.$selected.' >'.$val->title.'</option>';
                }
            }else{
                $state .= '<option value="" selected="selected">Select Country</option>';
            }

            if(isset($city_list) && count($city_list) > 0){
                $city .= '<option value="">Select City</option>';

                foreach($city_list as $key => $city1){
                    $selected1 = ($city1->id == $post_data['city_id'])  ? 'selected="selected"' : '';
                    $city .= '<option value="'.$city1->id.'" '.$selected1.' >'.$city1->title.'</option>';
                }
            }else{
                $city .= '<option value="" selected="selected">Select State</option>';
            }
        }

        $data['state'] =  $state;
        $data['city'] =  $city;
        return $data;

    }


}
