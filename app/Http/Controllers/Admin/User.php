<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang, Str, File, Hash;
use App\Models\User as UserModel;
use App\Models\Right;


class User extends Controller
{
    protected $section;
    protected $singleSection;
    protected $viewPath;
    protected $actionURL;

    public function __construct(){
        $this->section = 'User';
        $this->singleSection = 'User';
        $this->viewPath = 'admin/user';
        $this->actionURL = 'admin/users';
    }

    public function index(){

        $users = UserModel::where('id','!=',1)->paginate(10)->onEachSide(0);
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
        $rights = Right::all();
        $_data=array(
            'section'=>$this->section,
            'singleSection'=>$this->singleSection,
            'actionURL'=>$this->actionURL,
            'view'=>"add",
            'rights'=>$rights,
        );
        return view($this->viewPath.'/create', $_data);
    }

    public function Edit($id="") {
        $data = UserModel::where("id", $id)->first();
        $rights = Right::all();
        if(isset($data) && !empty($data)):
            $_data=array(
                'section'=>$this->section,
                'singleSection'=>$this->singleSection,
                'actionURL'=>$this->actionURL,
                'view'=>"edit",
                'data'=>$data,
                'rights'=>$rights,
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
                        $path = public_path('uploads/user_profile');
                        $cover_img->move($path, $file);
                        $cover_img = $file;
                    endif;
                endif;
            $user = new UserModel();
            $user->name = $post_data['username'];
            $user->country_code = $post_data['con_code'];
            $user->country_flag = $post_data['con_flag'];
            $user->mobile_no = $post_data['mobile_no'];
            $user->email = $post_data['email'];
            $user->password = Hash::make($post_data['password']);
            $user->rights = $post_data['rights'];
            $user->status = $post_data['status_field'];
            $user->cover_image = $cover_img ?? '';
            $user->save();
            return redirect($this->actionURL)->with( 'success', Lang::get('message.detailAdded', [ 'section' => $this->singleSection ])); 
        elseif($action=="edit"):
            unset($post_data['token']);
            $user = UserModel::where('id',$id)->first();
            if(isset($user) && !empty($user)):
                $data = UserModel::where('id', $user->id)->first();
                if ($request->file('cover_image')) :
                    File::delete(public_path('uploads/user_profile') . '/' . $data->cover_image);
                    $cover_img = $request->file('cover_image');
                    if ($cover_img) :
                        $file = time() . '-' . $cover_img->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/user_profile');
                        $cover_img->move($path, $file);
                        $cover_img = $file;
                    endif;
                else :
                    $cover_img = $data->cover_image;
                endif;

                $user->name = $post_data['username'];
                $user->country_code = $post_data['con_code'];
                $user->country_flag = $post_data['con_flag'];
                $user->mobile_no = $post_data['mobile_no'];
                $user->email = $post_data['email'];
                $user->rights = $post_data['rights'];
                $user->status = $post_data['status_field'];
                $user->cover_image = $cover_img;
                $user->save();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailUpdated', [ 'section' => $this->singleSection ]));
            endif;
        elseif($action=="delete"):
            $_data = UserModel::where("id", $id)->first();
            if(isset($_data)):
                $_data->delete();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailDeleted', [ 'section' => $this->singleSection ])); 
            else:
                return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 
            endif;   
        endif; 
    }

    public function multiple_delete(Request $request){
        $_data = UserModel::whereIn("id", explode(',',$request->deleteuser))->delete();
        if(isset($_data)):
            return redirect($this->actionURL)->with( 'success', 'User deleted successfully.'); 
        else:
            return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.'); 
        endif;
    }


    public function delete_user_image(Request $request){
        $post_data = $request->all();
        $data = UserModel::find($post_data['id']);
        if(!empty($data)):
            $data->cover_image = NULL;
            $data->save();
        endif;
    }
}