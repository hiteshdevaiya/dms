<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang, Str, File, Session, Request as RequestDefault, Carbon\Carbon;
use App\Models\Devotee as DevoteeModel;
use App\Models\Right;
use App\Models\Country;
use App\Models\States;
use App\Models\City;
use App\Models\DevoteeRelation;
use App\Models\DevoteeOccupation;
use App\Models\DevoteeAddress;

class Devotee extends Controller
{
    protected $section;
    protected $singleSection;
    protected $viewPath;
    protected $actionURL;

    public function __construct(){
        $this->section = 'Devotee';
        $this->singleSection = 'Devotee';
        $this->viewPath = 'front/devotee';
        $this->actionURL = 'front/devotee';
    }

    public function index(){

        $data = RequestDefault::all();

        $country = Country::where('status',1)->select('id','title')->pluck('title','id');
        $devotee = DevoteeModel::query();
        if(isset($data['name']) && !empty($data['name'])):
            $devotee->WhereRaw('LOWER(CONCAT(surname," ",first_name," ",last_name)) LIKE ?', strtolower("%{$data['name']}%"));
        endif;
        if(isset($data['dob']) && $data['dob'] != ''):
            $devotee->where('dob',$data['dob']);
        endif;
        if(isset($data['gender']) && $data['gender'] != ''):
            $devotee->where('gender',$data['gender']);
        endif;
        $devotee = $devotee->paginate(10);
        $_data=array(
            'section'=>$this->section,
            'singleSection'=>$this->singleSection,
            'actionURL'=>$this->actionURL,
            'view'=>"list",
            'devotee'=>$devotee,
            'country'=>$country,
            'filter'=>$data
        );
        return view($this->viewPath.'/index', $_data);

    }

    public function Add(){
        $devotee_id = Session::get('devotee_id');
        if($devotee_id != null){

            $relationship = config('constants.relationships');
            $industry = config('constants.industry');
            $address_types = config('constants.address_types');
            $country = Country::where('status',1)->select('id','title')->pluck('title','id');
            $_data=array(
                'section'=>$this->section,
                'singleSection'=>$this->singleSection,
                'actionURL'=>$this->actionURL,
                'view'=>"add",
                'country'=>$country,
                'relationship'=> $relationship,
                'industry'=> $industry,
                'address_types'=> $address_types,
            );
            return view($this->viewPath.'/create', $_data);
        }else{
            return redirect()->route('front.login')->with( 'error', "Something Went Wrong!" );
        }
    }

    public function Edit($id="") {
        $data = DevoteeModel::where("id", $id)->first();
        $country = Country::where('status',1)->select('id','title')->pluck('title','id');
        if(isset($data) && !empty($data)):
            $state = States::where('status',1)->where('country_id',$data->country_id)->select('id','title')->pluck('title','id');
            $city = City::where('status',1)->where('country_id',$data->country_id)->where('state_id',$data->state_id)->select('id','title')->pluck('title','id');
            $_data=array(
                'section'=>$this->section,
                'singleSection'=>$this->singleSection,
                'actionURL'=>$this->actionURL,
                'view'=>"edit",
                'data'=>$data,
                'country'=>$country,
                'state'=>$state,
                'city'=>$city,
            );
            return view($this->viewPath.'/create', $_data);
        else:
            return redirect($this->actionURL)->with('error', 'No data found.');
        endif;
    }

    public function Action(Request $request,$action="",$id="") {
        $post_data = $request->all();
        unset($post_data['_token']);

        if($action=="add"):
             #update
                if ($request->file('cover_image')) :
                    $cover_img = $request->file('cover_image');
                    if ($cover_img) :
                        $file = time() . '-' . $cover_img->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_profile');
                        $cover_img->move($path, $file);
                        $cover_img = $file;
                    endif;
                endif;
                if ($request->file('aadhar_card')) :
                    $aadhar_card = $request->file('aadhar_card');
                    if ($aadhar_card) :
                        $file = time() . '-' . $aadhar_card->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_documents');
                        $aadhar_card->move($path, $file);
                        $aadhar_card = $file;
                    endif;
                endif;
                if ($request->file('pan_card')) :
                    $pan_card = $request->file('pan_card');
                    if ($pan_card) :
                        $file = time() . '-' . $pan_card->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_documents');
                        $pan_card->move($path, $file);
                        $pan_card = $file;
                    endif;
                endif;
                if ($request->file('passport')) :
                    $passport = $request->file('passport');
                    if ($passport) :
                        $file = time() . '-' . $passport->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_documents');
                        $passport->move($path, $file);
                        $passport = $file;
                    endif;
                endif;


                if(!empty($post_data['dob'])):
                    $dob = Carbon::parse($post_data['dob'])->format('Y-m-d');
                endif;
                if(!empty($post_data['marriage_date'])):
                    $marriage_date = Carbon::parse($post_data['marriage_date'])->format('Y-m-d');
                endif;
                //dd($post_data);

                    $user = new DevoteeModel();
                    $user->surname = $post_data['surname'];
                    $user->first_name = $post_data['first_name'];
                    $user->last_name = $post_data['last_name'];
                    $user->country_code = $post_data['con_code'] ?? NULL;
                    $user->email = $post_data['email'] ?? NULL;
                    // $user->country_flag = $post_data['con_flag'];
                    $user->mobile_no = $post_data['mobile_no'];
                    $user->whatsapp_no = $post_data['whatsapp_no'] ?? NULL;
                    // $user->wh_country_code = $post_data['whatsapp_con_code'];
                    // $user->wh_country_flag = $post_data['whatsapp_con_flag'];
                    $user->dob = $dob ?? NULL;
                    $user->gender = $post_data['gender'] ?? NULL;
                    $user->address = $post_data['address'] ?? NULL;
                    $user->area = $post_data['area'] ?? NULL;
                    $user->country_id = $post_data['country_id'] ?? NULL;
                    $user->state_id = $post_data['state_id'] ?? NULL;
                    $user->city_id = $post_data['city_id'] ?? NULL;
                    $user->image = $cover_img ?? '';
                    $user->mobile_no_2 = $post_data['mobile_no_2'] ?? NULl;
                    $user->native_place = $post_data['native_place'] ?? NULl;
                    $user->marital_status = $post_data['marital_status'] ?? NULl;
                    $user->marriage_date = (isset($post_data['marital_status']) && isset($post_data['marriage_date']) && $post_data['marital_status'] == 2) ? $marriage_date : NULl;
                    $user->aadhar_card = $aadhar_card ?? NULL;
                    $user->pan_card = $pan_card ?? NULL;
                    $user->passport = $passport ?? NULL;
                    $user->save();

                    //ocuupation detail
                    $occupation = new DevoteeOccupation();
                    $occupation->devotee_id = $user->id;
                    $occupation->type = $post_data['occupatoin_type'] ?? NULL;
                    $occupation->industry_type = $post_data['industry_id'] ?? NULL;
                    $occupation->title = $post_data['title'] ?? NULL;
                    $occupation->address = $post_data['industry_id'] ?? NULL;
                    $occupation->country_id = $post_data['od_country_id'] ?? NULL;
                    $occupation->state_id = $post_data['od_state_id'] ?? NULL;
                    $occupation->city_id = $post_data['od_city_id'] ?? NULL;
                    $occupation->save();

                    //permamnent address
                    $pa_address = new DevoteeAddress();
                    $pa_address->type = 1;
                    $pa_address->devotee_id = $user->id;
                    $pa_address->address = $post_data['pa_address'] ?? NULL;
                    $pa_address->pincode = $post_data['pa_pincode'] ?? NULL;
                    $pa_address->area = $post_data['pa_area'] ?? NULL;
                    $pa_address->country_id = $post_data['pa_country_id'] ?? NULL;
                    $pa_address->state_id = $post_data['pa_state_id'] ?? NULL;
                    $pa_address->city_id = $post_data['pa_city_id'] ?? NULL;
                    $pa_address->save();

                    //communication address
                    $ca_address = new DevoteeAddress();
                    $ca_address->type = 2;
                    $ca_address->devotee_id = $user->id;
                    $ca_address->address = $post_data['ca_address'] ?? NULL;
                    $ca_address->pincode = $post_data['ca_pincode'] ?? NULL;
                    $ca_address->area = $post_data['ca_area'] ?? NULL;
                    $ca_address->country_id = $post_data['ca_country_id'] ?? NULL;
                    $ca_address->state_id = $post_data['ca_state_id'] ?? NULL;
                    $ca_address->city_id = $post_data['ca_city_id'] ?? NULL;
                    $ca_address->save();

                    //magazine address
                    $ma_address = new DevoteeAddress();
                    $ma_address->type = 3;
                    $ma_address->devotee_id = $user->id;
                    $ma_address->address = $post_data['ma_address'] ?? NULL;
                    $ma_address->pincode = $post_data['ma_pincode'] ?? NULL;
                    $ma_address->area = $post_data['ma_area'] ?? NULL;
                    $ma_address->country_id = $post_data['ma_country_id'] ?? NULL;
                    $ma_address->state_id = $post_data['ma_state_id'] ?? NULL;
                    $ma_address->city_id = $post_data['ma_city_id'] ?? NULL;
                    $ma_address->save();

                    //relationship details
                    if(isset($post_data['rd_first_name']) && count($post_data['rd_first_name'])>0){
                        foreach ($post_data['rd_first_name'] as $key => $value) {
                            $old_id = isset($post_data['oldRelationIds'][$key]) ? $post_data['oldRelationIds'][$key] : '';
                            $relation = DevoteeRelation::find($old_id);
                            if(empty($relation)){
                                $relation = new DevoteeRelation();
                                $relation->devotee_id = $user->id;
                            }

                            $relation->first_name = $value ?? NULL;
                            $relation->middle_name = $post_data['rd_middle_name'][$key] ?? NULL;
                            $relation->last_name = $post_data['rd_last_name'][$key] ?? NULL;
                            $relation->relation = $post_data['rd_relationship_id'][$key] ?? NULL;
                            $relation->mobile = $post_data['rd_mobile'][$key] ?? NULL;
                            $relation->save();
                        }
                    }

            return redirect(route('front.devotee.add'))->with( 'success', Lang::get('message.detailAdded', [ 'section' => $this->singleSection ]));
        elseif($action=="edit"):
            unset($post_data['token']);
            $user = DevoteeModel::where('id',$id)->first();
            if(isset($user) && !empty($user)):
                $data = DevoteeModel::where('id', $user->id)->first();
                if ($request->file('cover_image')) :
                    File::delete(public_path('uploads/devotee_profile') . '/' . $data->image);
                    $cover_img = $request->file('cover_image');
                    if ($cover_img) :
                        $file = time() . '-' . $cover_img->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_profile');
                        $cover_img->move($path, $file);
                        $cover_img = $file;
                    endif;
                else :
                    $cover_img = $data->image;
                endif;

                $user->surname = $post_data['surname'];
                $user->first_name = $post_data['first_name'];
                $user->last_name = $post_data['last_name'];
                $user->country_code = $post_data['con_code'];
                $user->country_flag = $post_data['con_flag'];
                $user->mobile_no = $post_data['mobile_no'];
                $user->whatsapp_no = $post_data['whatsapp_no'];
                $user->wh_country_code = $post_data['whatsapp_con_code'];
                $user->wh_country_flag = $post_data['whatsapp_con_flag'];
                $user->dob = Carbon::parse($post_data['dob'])->format('Y-m-d');
                $user->gender = $post_data['gender'];
                $user->address = $post_data['address'];
                $user->area = $post_data['area'];
                $user->country_id = $post_data['country_id'];
                $user->state_id = $post_data['state_id'];
                $user->city_id = $post_data['city_id'];
                $user->image = $cover_img ?? '';
                $user->save();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailUpdated', [ 'section' => $this->singleSection ]));
            endif;
        elseif($action=="delete"):
            $_data = DevoteeModel::where("id", $id)->first();
            if(isset($_data)):
                $_data->faqs()->delete();
                $_data->delete();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailDeleted', [ 'section' => $this->singleSection ]));
            else:
                return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.');
            endif;
        endif;
    }
}
