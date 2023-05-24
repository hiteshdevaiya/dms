<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang, Str;
use App\Models\Category as CategoryModel;


class Category extends Controller
{
    protected $section;
    protected $singleSection;
    protected $viewPath;
    protected $actionURL;

    public function __construct(){
        $this->section = 'Category';
        $this->singleSection = 'Category';
        $this->viewPath = 'admin/category';
        $this->actionURL = 'admin/categories';
    }

    public function index(){

        $categories = CategoryModel::get();
        $_data=array(
            'section'=>$this->section,
            'singleSection'=>$this->singleSection,
            'actionURL'=>$this->actionURL,
            'view'=>"list",
            'categories'=>$categories,
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
        $data = CategoryModel::where("id", $id)->first();
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
            $data = new CategoryModel();
            $data->name = $post_data['name'];
            $data->save();
            return redirect($this->actionURL)->with( 'success', Lang::get('message.detailAdded', [ 'section' => $this->singleSection ]));
        elseif($action=="edit"):
            unset($post_data['token']);
            $data = CategoryModel::where('id',$id)->first();
            if(isset($data) && !empty($data)):
                $data->name = $post_data['name'];
                $data->save();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailUpdated', [ 'section' => $this->singleSection ]));
            endif;
        elseif($action=="delete"):
            $_data = CategoryModel::where("id", $id)->first();
            if(isset($_data)):
                $_data->delete();
                return redirect($this->actionURL)->with( 'success', Lang::get('message.detailDeleted', [ 'section' => $this->singleSection ]));
            else:
                return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.');
            endif;
        endif;
    }

     public function multiple_delete(Request $request){
        $_data = CategoryModel::whereIn("id", explode(',',$request->deleteuser))->delete();
        if(isset($_data)):
            return redirect($this->actionURL)->with( 'success', 'Country deleted successfully,');
        else:
            return redirect($this->actionURL)->with( 'error',  'Something Went Wrong.');
        endif;
    }

}
