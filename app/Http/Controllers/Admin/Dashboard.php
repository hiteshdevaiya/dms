<?php
namespace App\Http\Controllers\Admin;

use Request, Redirect, DB;
use App\Http\Controllers\Controller;
use App\Models\Devotee;
use App\Models\User;

class Dashboard extends Controller
{
	protected $viewPath;
    protected $actionURL;

	public function __construct()
    {
        $this->viewPath = 'admin/dashboard';
        $this->actionURL = 'admin/dashboard';
        $this->viewPath = 'admin/dashboard';
    }

    public function index() {
    	$current_date = date('Y-m-d');
    	$total_devotee = Devotee::count();
    	$total_male = Devotee::where('gender','male')->count();
    	$total_female = Devotee::where('gender','female')->count();
    	$today_birthday_count = Devotee::whereDate('dob','=',$current_date)->count();
    	$total_user = User::where('status','active')->count();
    	$pass_array = array(
			'_meta_title' => "Dashboard",
			'_meta_keyword' => "Dashboard",
			'_meta_desc' => "Dashboard",
			'total_devotee'=>$total_devotee,
			'total_user'=>$total_user,
			'total_male'=>$total_male,
			'total_female'=>$total_female,
			'today_birthday_count'=>$today_birthday_count,
            'current_date'=>$current_date
		);
		return view($this->viewPath, $pass_array );
	}

}
