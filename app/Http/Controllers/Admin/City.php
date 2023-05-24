<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Lang, Str;

use App\Models\City as CityModel;

use App\Models\Country;

use App\Models\States;



class City extends Controller

{

    protected $section;

    protected $singleSection;

    protected $viewPath;

    protected $actionURL;



    public function __construct(){

        $this->section = 'City';

        $this->singleSection = 'City';

        $this->viewPath = 'admin/city';

        $this->actionURL = 'admin/cities';

    }



    public function index(){



        $users = CityModel::paginate(10)->onEachSide(0);

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

        $country = Country::where('status',1)->select('id','title')->pluck('title','id');

        $_data=array(

            'section'=>$this->section,

            'singleSection'=>$this->singleSection,

            'actionURL'=>$this->actionURL,

            'view'=>"add",

            'country'=>$country,

        );

        return view($this->viewPath.'/create', $_data);

    }



    public function Edit($id="") {

        $country = Country::where('status',1)->select('id','title')->pluck('title','id');

        $data = CityModel::where("id", $id)->first();

        if(isset($data) && !empty($data)):

            $state = States::where('status',1)->where('country_id',$data->country_id)->select('id','title')->pluck('title','id');

            $_data=array(

                'section'=>$this->section,

                'singleSection'=>$this->singleSection,

                'actionURL'=>$this->actionURL,

                'view'=>"edit",

                'data'=>$data,

                'country'=>$country,

                'state' => $state

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

            $data = new CityModel();

            $data->title = $post_data['title'];

            $data->country_id = $post_data['country_id'];

            $data->state_id = $post_data['state_id'];

            $data->save();

            return redirect($this->actionURL)->with( 'success', Lang::get('message.detailAdded', [ 'section' => $this->singleSection ])); 

        elseif($action=="edit"):

            unset($post_data['token']);

            $data = CityModel::where('id',$id)->first();

            if(isset($data) && !empty($data)):

                $data->title = $post_data['title'];

                $data->country_id = $post_data['country_id'];

                $data->state_id = $post_data['state_id'];

                $data->save();

                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailUpdated', [ 'section' => $this->singleSection ]));

            endif;

        elseif($action=="delete"):

            $_data = CityModel::where("id", $id)->first();

            if(isset($_data)):

                $_data->delete();

                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailDeleted', [ 'section' => $this->singleSection ])); 

            else:

                return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 

            endif;   

        endif; 

    }



     public function multiple_delete(Request $request){

        $_data = CityModel::whereIn("id", explode(',',$request->deleteuser))->delete();

        if(isset($_data)):

            return redirect($this->actionURL)->with( 'success', 'City deleted successfully,'); 

        else:

            return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 

        endif;

    }



}