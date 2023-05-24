<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang, Str;
use App\Models\Country as CountryModel;
use App\Models\States;
use App\Models\City;


class Country extends Controller
{
    protected $section;
    protected $singleSection;
    protected $viewPath;
    protected $actionURL;

    public function __construct(){
        $this->section = 'Country';
        $this->singleSection = 'Country';
        $this->viewPath = 'admin/country';
        $this->actionURL = 'admin/countries';
    }

    public function index(){

        $users = CountryModel::paginate(10)->onEachSide(0);
        $_data=array(
            'section'=>$this->section,
            'singleSection'=>$this->singleSection,
            'actionURL'=>$this->actionURL,
            'view'=>"list",
            'users'=>$users,
        );
        return view($this->viewPath.'/index', $_data);
    }

    public function Add(){
        $_data=array(
            'section'=>$this->section,
            'singleSection'=>$this->singleSection,
            'actionURL'=>$this->actionURL,
            'view'=>"add",
        );
        return view($this->viewPath.'/create', $_data);
    }

    public function Edit($id="") {
        $data = CountryModel::where("id", $id)->first();
        if(isset($data) && !empty($data)):
            $_data=array(
                'section'=>$this->section,
                'singleSection'=>$this->singleSection,
                'actionURL'=>$this->actionURL,
                'view'=>"edit",
                'data'=>$data,
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
            $data = new CountryModel();
            $data->title = $post_data['title'];
            $data->country_code = $post_data['country_code'];
            $data->save();
            return redirect($this->actionURL)->with( 'success', Lang::get('message.detailAdded', [ 'section' => $this->singleSection ])); 
        elseif($action=="edit"):
            unset($post_data['token']);
            $data = CountryModel::where('id',$id)->first();
            if(isset($data) && !empty($data)):
                $data->title = $post_data['title'];
                $data->country_code = $post_data['country_code'];
                $data->save();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailUpdated', [ 'section' => $this->singleSection ]));
            endif;
        elseif($action=="delete"):
            $_data = CountryModel::where("id", $id)->first();
            if(isset($_data)):
                $state_delete = States::where('country_id',$id)->delete();
                $city_delete = City::where('country_id',$id)->delete();
                $_data->delete();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailDeleted', [ 'section' => $this->singleSection ])); 
            else:
                return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 
            endif;   
        endif; 
    }

     public function multiple_delete(Request $request){
        $state_delete = States::whereIn("country_id", explode(',',$request->deleteuser))->delete();
        $city_delete = City::whereIn("country_id", explode(',',$request->deleteuser))->delete();
        $_data = CountryModel::whereIn("id", explode(',',$request->deleteuser))->delete();
        if(isset($_data)):
            return redirect($this->actionURL)->with( 'success', 'Country deleted successfully,'); 
        else:
            return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 
        endif;
    }

}