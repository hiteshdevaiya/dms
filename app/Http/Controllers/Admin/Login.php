<?php

namespace App\Http\Controllers\Admin;
use App\Models\EmailTemplate as EmailTemplateModel;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\LoginRequest;
use Request, Lang, Auth, Hash;

class Login extends Controller
{
	//private $redirect_after_login = "admin/board";
	private $redirect_after_login = "admin/dashboard";

    protected function getLogin() {
		if (auth()->guard('admin')->check()):
			return redirect($this->redirect_after_login);
		endif;
		$_data=array(
			'_meta_title' => "Login",
			'_meta_keyword' => "Login",
			'_meta_desc' => "Login",
		);
		return view('admin/login',$_data);
	}

	protected function postLogin(LoginRequest $request) {
		$remember_me = $request->only('remember') ? true : false;
		$auth = auth()->guard('admin');
		if ($auth->attempt($request->only('email', 'password'), $remember_me)):
			return redirect('admin/dashboard');
		else:
			return redirect('admin/login')->with( 'error', Lang::get('message.emailAndPassword') ); 
		endif;	
	}
	
	protected function getLogout() {
		$auth = auth()->guard('admin');
		$auth->logout();
		return redirect('admin/login')->with(['success' => 'Logged Out']);
	}

	protected function getForgotPassword() {
		if (auth()->guard('admin')->check()) {
			return redirect($this->redirect_after_login);
		}
		$_data=array(
			'_meta_title' => "Forgot Password",
			'_meta_keyword' => "Forgot Password",
			'_meta_desc' => "Forgot Password",
		);
		return view('admin/forgotpassword',$_data);
	}

	protected function postForgotPassword() {
		if (auth()->guard('admin')->check()):
			return redirect($this->redirect_after_login);
		endif;
		$post_data = Request::All();
		$email = $post_data['email'];
		$data = User::where('email',$email)->first();
		if(isset($data) && !empty($data)):
			$update=array('remember_token'=>md5($data->id));
			$link=url("admin/new-password").'/'.$update['remember_token'];
			try{
                if($data):
                    $toData=$data->email;
                    $subject="Reset Password Link";
                    $message = view('email.forgot_password',compact('data','link','subject'))->render();
                    $mail=send_email($toData, $subject, $message);

                    /* Mail send end */
					$update_detail = User::find($data->id);
					$update_detail->remember_token = md5($data->id);
					$update_detail->save();
                    return redirect()->back()->with('success',Lang::get('message.checkEmail'));
                endif;
                
            }catch (Exception $ex){
                return redirect('register')->with('error',Lang::get('message.something_wrong'));
            }

			
		else:
			return redirect('admin/forgotpassword')->with('error', Lang::get('message.emailNotExist'));
		endif;
	}

	protected function newPassword($id="") {
		$data = Request::all();
		if (auth()->guard('admin')->check()):
			return redirect($this->redirect_after_login);
		endif;
		$data = User::where("remember_token",$id)->first();
		if(isset($data) && !empty($data)):
			$_data=array('id'=>$id,'successlink'=>1);
	        return view( 'admin/new-password', $_data );
		else:
			$_data=array('id'=>$id,'successlink'=>0);
	        return view( 'admin/new-password', $_data);
		endif;
	}

	protected function postConfirmNewPassword(Request $request) {
		$post_data = Request::all();
		$data = User::where("remember_token",$post_data['id'])->first();
		if(isset($data) && !empty($data)):
			$update=array('remember_token'=>"",'password'=>Hash::make($post_data['password']));
			User::find($data->id)->update($update);
			return redirect('admin/login')->with('success','Password has been successfully update.');
		else:
			return redirect('admin/login/'.$post_data['id']);				
		endif;
	}
}
