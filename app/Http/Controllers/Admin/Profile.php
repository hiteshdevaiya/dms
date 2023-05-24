<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Session, Auth, Hash,File; 
use App\Models\User as UserModel;
use Carbon\Carbon;
use App\Models\Right;

class Profile extends Controller
{

    protected $section;
	protected $singleSection;
    protected $viewPath;
    protected $actionURL;
    
    public function __construct()
    {
        $this->viewPath = 'admin/profile';
        $this->actionURL = 'profile';
    }

    public function getAccountSettings(){
        $user = UserModel::where('id',auth()->guard('admin')->user()->id)->first();
        $rights = Right::all();
        return view($this->viewPath,compact('user','rights'));
    }


    public function updateAccountSettings(Request $request){
        $post_data = $request->all();

        unset($post_data['token']);
        $user = UserModel::where('id',auth()->guard('admin')->user()->id)->first();
        if(isset($user) && !empty($user)):
            #update
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
            //$user->rights = $post_data['rights'];
            $user->cover_image = $cover_img;
            $user->save();
            return back()->with('success','Profile has been successfully updated');
        else:
            return back()->with('error','Something went wrong');
        endif;
    }

    public function getChangePassword(){
        return view($this->viewPath.'/change-password');
    }

    public function postChangePassword(Request $request){
        $post_data = $request->all();
        $user = UserModel::where('id', auth()->guard('admin')->user()->id)->first();
        if(isset($user) && !empty($user)):
            if(!Hash::check($post_data['password'], $user->password)):
                $update=array('password'=>Hash::make($post_data['password']));
                UserModel::find($user->id)->update($update);
                return back()->with('success','Your password has been successfully updated');
            else:
                return back()->with('error','Your new password must be different from your previously used password');
            endif;

        else:
            return back()->with('error','Something wrong please try again later');              
        endif;
    }
}