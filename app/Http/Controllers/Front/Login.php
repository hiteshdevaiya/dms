<?php

namespace App\Http\Controllers\Front;
use App\Models\EmailTemplate as EmailTemplateModel;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Devotee;
use Request, Lang, Auth, Session;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
	//private $redirect_after_login = "admin/board";
	private $redirect_after_login = "sgvp";

    protected function frontLogin() {
        if (session('devotee_id')) {
			return redirect($this->redirect_after_login);
		}

		$_data=array(
			'_meta_title' => "Login",
			'_meta_keyword' => "Login",
			'_meta_desc' => "Login",
		);
		return view('front/login',$_data);
	}

	protected function frontPostLogin(Request $request) {
        $post_data = Request::All();
        $mobile = $post_data['mobile'];
        $password = isset($post_data['password']) ? $post_data['password'] : '';

        $devotee = Devotee::where('mobile_no',$mobile)->first();
        if(!empty($devotee)){
            if($password != ""){
                if(!Hash::check($password, $devotee->password)){
                    return redirect()->route('front.login')->withInput()->with( 'error', "Wrong mobile and password" );
                } else {
                    Session::put('devotee_id', $devotee->id);
                    return redirect('sgvp');
                }
            }else{
                if($devotee->password != null){
                    return redirect()->route('front.login')->withInput();
                }else{
                    $devotee->otp = "123456";
                    $devotee->save();
                    return redirect()->route('front.verify.otp');
                }
            }
        }else{
            return redirect()->route('front.login')->with( 'error', "Wrong mobile number" );
        }
	}

	protected function frontLogout() {
		return redirect()->route('front.login')->with(['success' => 'Logged Out']);
	}

    protected function verifyOtp(){
        if (session('devotee_id')) {
			return redirect($this->redirect_after_login);
		}
        $_data=array(
			'_meta_title' => "Verify OTP",
			'_meta_keyword' => "Verify OTP",
			'_meta_desc' => "Verify OTP",
		);
		return view('front/verify-otp',$_data);
    }

    protected function verifyOtpCheck(Request $request) {
        $post_data = Request::All();
        $otp = $post_data['otp'];
        $devotee = Devotee::where('otp',$otp)->first();

        if(!empty($devotee)){
            $devotee->otp = null;
            $devotee->save();
            return redirect()->route('front.new.password', base64_encode($devotee->id));
        }else{
            return redirect()->route('front.verify.otp')->with( 'error', "Wrong otp entered" );
        }
    }

	protected function getForgotPassword() {
		if (session('devotee_id')) {
			return redirect($this->redirect_after_login);
		}
		$_data=array(
			'_meta_title' => "Forgot Password",
			'_meta_keyword' => "Forgot Password",
			'_meta_desc' => "Forgot Password",
		);
		return view('front/forgotpassword',$_data);
	}

	protected function postForgotPassword(Request $request) {
		if (auth()->guard('admin')->check()):
			return redirect($this->redirect_after_login);
		endif;

        $post_data = Request::all();
        $mobile = $post_data['mobile'];
        $devotee = Devotee::where('mobile_no',$mobile)->first();
        if(!empty($devotee)){
            $devotee->otp = "123456";
            $devotee->save();
            return redirect()->route('front.verify.otp');
        }else{
            return redirect()->back()->with( 'error', "Wrong mobile number" );
        }

	}

	protected function newPassword($id="") {
        if (session('devotee_id')) {
			return redirect($this->redirect_after_login);
		}
        $id = base64_decode($id);
		$data = Devotee::find($id);
		if(empty($data)){
            return redirect()->back()->with( 'error', "Something Went Wrong!" );
        }else{
            $_data=array(
                '_meta_title' => "New Passwords",
                '_meta_keyword' => "New Passwords",
                '_meta_desc' => "New Passwords",
            );
            return view('front/new-password',$_data);
        }
	}

	protected function postConfirmNewPassword(Request $request) {
		$post_data = Request::all();
        $id = base64_decode($post_data['id']);
		$data = Devotee::find($id);
		if(!empty($data)){
            $data->password = Hash::make($post_data['password']);
			$data->save();
			return redirect('login')->with('success','Password has been successfully update.');
        }else{
            return redirect()->route('front.new.password', $post_data['id']);
        }
	}
}
