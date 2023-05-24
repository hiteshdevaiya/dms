<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Lang, Str;

use App\Models\States as StateModel;

use App\Models\Country;





class State extends Controller

{

    protected $section;

    protected $singleSection;

    protected $viewPath;

    protected $actionURL;



    public function __construct(){

        $this->section = 'State';

        $this->singleSection = 'State';

        $this->viewPath = 'admin/state';

        $this->actionURL = 'admin/states';

    }



    public function index(){



        $users = StateModel::paginate(10)->onEachSide(0);

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

        $data = StateModel::where("id", $id)->first();

        if(isset($data) && !empty($data)):

            $_data=array(

                'section'=>$this->section,

                'singleSection'=>$this->singleSection,

                'actionURL'=>$this->actionURL,

                'view'=>"edit",

                'data'=>$data,

                'country'=>$country,

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

            $data = new StateModel();

            $data->title = $post_data['title'];

            $data->country_id = $post_data['country_id'];

            $data->save();

            return redirect($this->actionURL)->with( 'success', Lang::get('message.detailAdded', [ 'section' => $this->singleSection ])); 

        elseif($action=="edit"):

            unset($post_data['token']);

            $data = StateModel::where('id',$id)->first();

            if(isset($data) && !empty($data)):

                $data->title = $post_data['title'];

                $data->country_id = $post_data['country_id'];

                $data->save();

                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailUpdated', [ 'section' => $this->singleSection ]));

            endif;

        elseif($action=="delete"):

            $_data = StateModel::where("id", $id)->first();

            if(isset($_data)):

                $_data->delete();

                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailDeleted', [ 'section' => $this->singleSection ])); 

            else:

                return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 

            endif;   

        endif; 

    }



     public function multiple_delete(Request $request){

        $_data = StateModel::whereIn("id", explode(',',$request->deleteuser))->delete();

        if(isset($_data)):

            return redirect($this->actionURL)->with( 'success', 'State deleted successfully,'); 

        else:

            return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 

        endif;

    }



}