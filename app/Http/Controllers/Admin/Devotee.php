<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang, Str, File, Request as RequestDefault, Carbon\Carbon, Excel;
use App\Models\Devotee as DevoteeModel;
use App\Models\Right;
use App\Models\Country;
use App\Models\States;
use App\Models\City;
use App\Exports\DevoteeExport;
use App\Imports\DevoteeImport;
use App\Models\DevoteeRelation;
use App\Models\DevoteeOccupation;
use App\Models\DevoteeAddress;
use App\Models\Category;

class Devotee extends Controller
{
    protected $section;
    protected $singleSection;
    protected $viewPath;
    protected $actionURL;

    public function __construct(){
        $this->section = 'Devotee';
        $this->singleSection = 'Devotee';
        $this->viewPath = 'admin/devotee';
        $this->actionURL = 'admin/devotees';
    }

    public function index(){
        $data = RequestDefault::all();
        //dd($data);
        $devotee = DevoteeModel::query();
        if(isset($data['category']) && !empty($data['category']) && count($data['category']) > 0):
            $devotee->whereIn('category_id',$data['category']);
        endif;
        if(isset($data['name']) && !empty($data['name'])):
            $devotee->WhereRaw('LOWER(CONCAT(surname," ",first_name," ",last_name)) LIKE ?', strtolower("%{$data['name']}%"));
        endif;
        if(isset($data['mobile_no']) && !empty($data['mobile_no'])):
            $devotee->where('mobile_no',$data['mobile_no']);
            $devotee->orWhere('mobile_no_2',$data['mobile_no']);
        endif;
        if(isset($data['email']) && !empty($data['email'])):
            $devotee->WhereRaw('LOWER(email) LIKE ?', strtolower("%{$data['email']}%"));
        endif;
        if(isset($data['dob']) && !empty($data['dob'])):
            $explode_date = explode("to",$data['dob']);
            if(isset($explode_date[0]) && isset($explode_date[1])):
                $start_date = Carbon::parse($explode_date[0])->format('Y-m-d');
                $end_date = Carbon::parse($explode_date[1])->format('Y-m-d');
                $devotee->whereBetween('dob', [$start_date, $end_date]);
            else:
                $devotee->whereDate('dob','>=',$data['dob']);
            endif;
        endif;
        if(isset($data['gender']) && !empty($data['gender'])):
            $devotee->where('gender',$data['gender']);
        endif;
        if(isset($data['area']) && !empty($data['area']) && count($data['area']) > 1):
            $devotee->whereIn('area',$data['area']);
        endif;
        $state = [];
        if(isset($data['country_id']) && !empty($data['country_id'])):
            $devotee->whereIn('country_id',$data['country_id']);
            $state = States::select('id','title')->where('status',1)->whereIn('country_id',$data['country_id'])->pluck('title','id');
        endif;
        $city = [];
        if(isset($data['state_id']) && !empty($data['state_id'])):
            $devotee->whereIn('state_id',$data['state_id']);
            $city = City::select('id','title')->where('status',1)->whereIn('state_id',$data['state_id'])->pluck('title','id');
        endif;
        if(isset($data['city_id']) && !empty($data['city_id'])):
            $devotee->whereIn('city_id',$data['city_id']);
        endif;
        if(isset($data['marital_status']) && !empty($data['marital_status'])):
            $devotee->where('marital_status',$data['marital_status']);
        endif;
        if(isset($data['marriage_date']) && !empty($data['marriage_date'])):
            $explode_date = explode("to",$data['marriage_date']);
            if(isset($explode_date[0]) && isset($explode_date[1])):
                $start_date = Carbon::parse($explode_date[0])->format('Y-m-d');
                $end_date = Carbon::parse($explode_date[1])->format('Y-m-d');
                $devotee->whereBetween('marriage_date', [$start_date, $end_date]);
            else:
                $devotee->whereDate('marriage_date','>=',$data['marriage_date']);
            endif;
        endif;
        if(isset($data['native_place']) && !empty($data['native_place'])):
            $devotee->WhereRaw('LOWER(native_place) LIKE ?', strtolower("%{$data['native_place']}%"));
        endif;
        if(isset($data['industry_id']) && !empty($data['industry_id']) && count($data['industry_id']) > 0):
            $industry_id = $data['industry_id'];
            $devotee->whereHas('occupation', function($q) use ($industry_id) {
                $q->whereIn('industry_type', $industry_id);
            });
        endif;

        $pa_state = [];
        if(isset($data['pa_country_id']) && !empty($data['pa_country_id'])):
            $pa_country_id = $data['pa_country_id'];
            $devotee->whereHas('permanentAddress', function($q) use ($pa_country_id) {
                $q->whereIn('country_id', $pa_country_id);
            });
            $pa_state = States::select('id','title')->where('status',1)->whereIn('country_id',$data['pa_country_id'])->pluck('title','id');
        endif;
        $pa_city = [];
        if(isset($data['pa_state_id']) && !empty($data['pa_state_id'])):
            $pa_state_id = $data['pa_state_id'];
            $devotee->whereHas('permanentAddress', function($q) use ($pa_state_id) {
                $q->whereIn('state_id', $pa_state_id);
            });
            $pa_city = City::select('id','title')->where('status',1)->whereIn('state_id',$data['pa_state_id'])->pluck('title','id');
        endif;
        if(isset($data['pa_city_id']) && !empty($data['pa_city_id'])):
            $pa_city_id = $data['pa_city_id'];
            $devotee->whereHas('permanentAddress', function($q) use ($pa_city_id) {
                $q->whereIn('city_id', $pa_city_id);
            });
        endif;

        $ca_state = [];
        if(isset($data['ca_country_id']) && !empty($data['ca_country_id'])):
            $ca_country_id = $data['ca_country_id'];
            $devotee->whereHas('communicationAddress', function($q) use ($ca_country_id) {
                $q->whereIn('country_id', $ca_country_id);
            });
            $ca_state = States::select('id','title')->where('status',1)->whereIn('country_id',$data['ca_country_id'])->pluck('title','id');
        endif;
        $ca_city = [];
        if(isset($data['ca_state_id']) && !empty($data['ca_state_id'])):
            $ca_state_id = $data['ca_state_id'];
            $devotee->whereHas('communicationAddress', function($q) use ($ca_state_id) {
                $q->whereIn('state_id', $ca_state_id);
            });
            $ca_city = City::select('id','title')->where('status',1)->whereIn('state_id',$data['ca_state_id'])->pluck('title','id');
        endif;
        if(isset($data['ca_city_id']) && !empty($data['ca_city_id'])):
            $ca_city_id = $data['ca_city_id'];
            $devotee->whereHas('communicationAddress', function($q) use ($ca_city_id) {
                $q->whereIn('city_id', $ca_city_id);
            });
        endif;

        $ma_state_id = [];
        if(isset($data['ma_country_id']) && !empty($data['ma_country_id'])):
            $ma_country_arr = $data['ma_country_id'];
            $devotee->whereHas('magazineAddress', function($q) use ($ma_country_arr) {
                $q->whereIn('country_id', $ma_country_arr);
            });
            $ma_state_id = States::select('id','title')->where('status',1)->whereIn('country_id',$data['ma_country_id'])->pluck('title','id');
        endif;
        $ma_city_id = [];
        if(isset($data['ma_state_id']) && !empty($data['ma_state_id'])):
            $ma_state_arr = $data['ma_state_id'];
            $devotee->whereHas('magazineAddress', function($q) use ($ma_state_arr) {
                $q->whereIn('state_id', $ma_state_arr);
            });
            $ma_city_id = City::select('id','title')->where('status',1)->whereIn('state_id',$data['ma_state_id'])->pluck('title','id');
        endif;
        if(isset($data['ma_city_id']) && !empty($data['ma_city_id'])):
            $ma_city_id = $data['ma_city_id'];
            $devotee->whereHas('magazineAddress', function($q) use ($ma_city_id) {
                $q->whereIn('city_id', $ma_city_id);
            });
        endif;

        $devotee = $devotee->orderBy('first_name','ASC')->paginate(25)->onEachSide(0);

        $category = Category::where('status',1)->select('id','name')->pluck('name','id');
        $mobileNo = DevoteeModel::where('status',1)->get();
        $area = DevoteeModel::select('area')->distinct()->where('status',1)->pluck('area','area');
        $country = Country::where('status',1)->select('id','title')->pluck('title','id');
        $industry = config('constants.industry');
        $_data=array(
            'section'=>$this->section,
            'singleSection'=>$this->singleSection,
            'actionURL'=>$this->actionURL,
            'view'=>"list",
            'devotee'=>$devotee,
            'mobileNo'=>$mobileNo,
            'area'=>$area,
            'country'=>$country,
            'state'=>$state,
            'city'=>$city,
            'category'=>$category,
            'industry'=>$industry,
            'filter'=>$data,
            'totalDevotee'=>DevoteeModel::count()
        );
        return view($this->viewPath.'/index', $_data);
    }

    public function Add(){
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
    }

    public function Edit($id="") {
        $relationship = config('constants.relationships');
        $industry = config('constants.industry');
        $address_types = config('constants.address_types');
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
                'relationship'=> $relationship,
                'industry'=> $industry,
                'address_types'=> $address_types,
            );
            return view($this->viewPath.'/create', $_data);
        else:
            return redirect($this->actionURL)->with('error', 'No data found.');
        endif;
    }


    public function View($id="") {
        $relationship = config('constants.relationships');
        $industry = config('constants.industry');
        $address_types = config('constants.address_types');
        $data = DevoteeModel::where("id", $id)->first();
        $country = Country::where('status',1)->select('id','title')->pluck('title','id');
        if(isset($data) && !empty($data)):
            $state = States::where('country_id',$data->country_id)->select('id','title')->pluck('title','id');
            $city = City::where('country_id',$data->country_id)->where('state_id',$data->state_id)->select('id','title')->pluck('title','id');
            $_data=array(
                'section'=>$this->section,
                'singleSection'=>$this->singleSection,
                'actionURL'=>$this->actionURL,
                'view'=>"edit",
                'data'=>$data,
                'country'=>$country,
                'state'=>$state,
                'city'=>$city,
                'relationship'=> $relationship,
                'industry'=> $industry,
                'address_types'=> $address_types,
            );
            return view($this->viewPath.'/view', $_data);
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
                // dd($post_data);
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

            return redirect($this->actionURL)->with( 'success', Lang::get('message.detailAdded', [ 'section' => $this->singleSection ]));
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
                if ($request->file('aadhar_card')) :
                    File::delete(public_path('uploads/devotee_documents') . '/' . $data->aadhar_card);
                    $aadhar_card = $request->file('aadhar_card');
                    if ($aadhar_card) :
                        $file = time() . '-' . $aadhar_card->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_documents');
                        $aadhar_card->move($path, $file);
                        $aadhar_card = $file;
                    endif;
                else :
                    if(isset($post_data['is_adharcard']) && $post_data['is_adharcard'] == "1"){
                        File::delete(public_path('uploads/devotee_documents') . '/' . $data->aadhar_card);
                        $aadhar_card = null;
                    }else{
                        $aadhar_card = $data->aadhar_card;
                    }
                endif;
                if ($request->file('pan_card')) :
                    File::delete(public_path('uploads/devotee_documents') . '/' . $data->pan_card);
                    $pan_card = $request->file('pan_card');
                    if ($pan_card) :
                        $file = time() . '-' . $pan_card->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_documents');
                        $pan_card->move($path, $file);
                        $pan_card = $file;
                    endif;
                else :
                    if(isset($post_data['is_pancard']) && $post_data['is_pancard'] == "1"){
                        File::delete(public_path('uploads/devotee_documents') . '/' . $data->pan_card);
                        $pan_card = null;
                    }else{
                        $pan_card = $data->pan_card;
                    }
                endif;
                if ($request->file('passport')) :
                    File::delete(public_path('uploads/devotee_documents') . '/' . $data->passport);
                    $passport = $request->file('passport');
                    if ($passport) :
                        $file = time() . '-' . $passport->getClientOriginalName();
                        $file = str_replace(' ', '_', $file);
                        $path = public_path('uploads/devotee_documents');
                        $passport->move($path, $file);
                        $passport = $file;
                    endif;
                else :
                    if(isset($post_data['is_passport']) && $post_data['is_passport'] == "1"){
                        File::delete(public_path('uploads/devotee_documents') . '/' . $data->passport);
                        $passport = null;
                    }else{
                        $passport = $data->passport;
                    }
                endif;

                if(!empty($post_data['dob'])):
                    $dob = Carbon::parse($post_data['dob'])->format('Y-m-d');
                endif;
                if(!empty($post_data['marriage_date'])):
                    $marriage_date = Carbon::parse($post_data['marriage_date'])->format('Y-m-d');
                endif;

                // dd($post_data);

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
                $user->marriage_date =  (isset($post_data['marital_status']) && isset($post_data['marriage_date']) && $post_data['marital_status'] == 2) ? $marriage_date : NULl;
                $user->aadhar_card = $aadhar_card ?? '';
                $user->pan_card = $pan_card ?? '';
                $user->passport = $passport ?? '';
                $user->save();

                //ocuupation detail
                $occupation = $user->occupation;
                if($occupation == null){
                    $occupation = new DevoteeOccupation();
                    $occupation->devotee_id = $user->id;
                }
                $occupation->type = $post_data['occupatoin_type'] ?? NULL;
                $occupation->industry_type = $post_data['industry_id'] ?? NULL;
                $occupation->title = $post_data['title'] ?? NULL;
                $occupation->address = $post_data['industry_id'] ?? NULL;
                $occupation->country_id = $post_data['od_country_id'] ?? NULL;
                $occupation->state_id = $post_data['od_state_id'] ?? NULL;
                $occupation->city_id = $post_data['od_city_id'] ?? NULL;
                $occupation->save();

                //permamnent address
                $pa_address = $user->permanentAddress;
                if($pa_address == null){
                    $pa_address = new DevoteeAddress();
                    $pa_address->type = 1;
                    $pa_address->devotee_id = $user->id;
                }
                $pa_address->address = $post_data['pa_address'] ?? NULL;
                $pa_address->pincode = $post_data['pa_pincode'] ?? NULL;
                $pa_address->area = $post_data['pa_area'] ?? NULL;
                $pa_address->country_id = $post_data['pa_country_id'] ?? NULL;
                $pa_address->state_id = $post_data['pa_state_id'] ?? NULL;
                $pa_address->city_id = $post_data['pa_city_id'] ?? NULL;
                $pa_address->save();

                //communication address
                $ca_address = $user->communicationAddress;
                if($ca_address == null){
                    $ca_address = new DevoteeAddress();
                    $ca_address->type = 2;
                    $ca_address->devotee_id = $user->id;
                }
                $ca_address->address = $post_data['ca_address'] ?? NULL;
                $ca_address->pincode = $post_data['ca_pincode'] ?? NULL;
                $ca_address->area = $post_data['ca_area'] ?? NULL;
                $ca_address->country_id = $post_data['ca_country_id'] ?? NULL;
                $ca_address->state_id = $post_data['ca_state_id'] ?? NULL;
                $ca_address->city_id = $post_data['ca_city_id'] ?? NULL;
                $ca_address->save();

                //magazine address
                $ma_address = $user->magazineAddress;
                if($ma_address == null){
                    $ma_address = new DevoteeAddress();
                    $ma_address->type = 3;
                    $ma_address->devotee_id = $user->id;
                }
                $ma_address->address = $post_data['ma_address'] ?? NULL;
                $ma_address->pincode = $post_data['ma_pincode'] ?? NULL;
                $ma_address->area = $post_data['ma_area'] ?? NULL;
                $ma_address->country_id = $post_data['ma_country_id'] ?? NULL;
                $ma_address->state_id = $post_data['ma_state_id'] ?? NULL;
                $ma_address->city_id = $post_data['ma_city_id'] ?? NULL;
                $ma_address->save();

                //relationship details

                $getDbrelation = isset($user->relationships) ? $user->relationships->pluck('id')->toArray() : [];
                $deleteRelation = array_diff($getDbrelation,$post_data['oldRelationIds']);
                DevoteeRelation::whereIn('id', $deleteRelation)->delete();

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

                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailUpdated', [ 'section' => $this->singleSection ]));
            endif;
        elseif($action=="delete"):
            $_data = DevoteeModel::where("id", $id)->first();
            if(isset($_data)):
                $_data->delete();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailDeleted', [ 'section' => $this->singleSection ]));
            else:
                return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.');
            endif;
        endif;
    }

     public function multiple_delete(Request $request){
         $_data = DevoteeModel::whereIn("id", explode(',',$request->deleteuser))->delete();
         if(isset($_data)):
            return redirect($this->actionURL)->with( 'success', 'Devotee deleted successfully,');
        else:
            return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.');
        endif;
    }

    public function multiple_assign_category(Request $request){
        $cat = $request->cat_id == "remove" ? NULL : $request->cat_id;
        $_data = DevoteeModel::whereIn("id", explode(',',$request->assignuser))->update(['category_id'=>$cat]);
        if(isset($_data)):
           return redirect($this->actionURL)->with( 'success', 'Category assign successfully,');
       else:
           return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.');
       endif;
   }

    public function Export(Request $request){
        $post_data = $request->all();
        $columns = [];
        foreach($post_data["column"] as $k => $v):
            if($v):
                $columns[] = $k;
            endif;
        endforeach;
        if($post_data['export'] == "excel"):
            return Excel::download(new DevoteeExport($columns,$post_data), 'devotees.xlsx');
        elseif($post_data['export'] == "pdf"):
            // dd($post_data);
            return Excel::download(new DevoteeExport($columns,$post_data), 'devotees.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        endif;
    }

    public function Import(Request $request){
        $import = new DevoteeImport();
        $import->import($request->file('file')->store('temp'));
        $failures = $import->failures();
        $rows = [];
        foreach ($failures as $failure) {
            $rows[] = $failure->row();
            // $failure->row(); // row that went wrong
            // $failure->attribute(); // either heading key (if using heading row concern) or column index
            // $failure->errors(); // Actual error messages from Laravel validator
            // $failure->values(); // The values of the row that has failed.
        }
        return response()->json(['success' => true, 'message' => 'File imported successfully!','statusMsg' => implode(",",$rows)." number row(s) have errors!","rows" => count($rows)]);
    }

    public function downloadSample(){
        $file= public_path(). "/uploads/sample_devotees.xlsx";
        return response()->download($file, 'sample_devotees.xlsx',['Cache-Control' => 'no-cache, must-revalidate']);
    }

    public function delete_devotee_image(Request $request){
        $post_data = $request->all();
        $data = DevoteeModel::find($post_data['id']);
        if(!empty($data)):
            $data->image = NULL;
            $data->save();
        endif;
    }
}
