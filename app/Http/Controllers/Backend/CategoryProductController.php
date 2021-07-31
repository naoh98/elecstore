<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryProductModel;
use Illuminate\Validation\Rule;

class CategoryProductController extends Controller
{
    //hiển thị trang quản lý danh mục
    public function index() {
        $category = DB::table('category')->get();
        /*echo "<pre>";
        print_r($category);
        echo "</pre>";*/
        return view('backend.contents.productcategories.index',['category'=>$category]);
    }

    //hiển thị trang thêm danh mục
    public function createpage(){
        $category = CategoryProductModel::all();
        $data = [];
        $data["category"] = $category;
        return view("backend.contents.productcategories.create",$data);
    }

    //code thêm danh mục
    public function create(Request $request){
        $validate_cat =[
            'category_name' => 'required|unique:category,category_name',
            'category_image' => 'required'
        ];
        $error_messages = [
            'required' => ':attribute required',
            'unique' => ':attribute already exist'
        ];
        $this->validate($request,$validate_cat,$error_messages);

        //tạo biến lấy ra mảng các sản phẩm trong danh mục
        $products = DB::table('product')->where('product_type',$request->parent_id)->get();
        if ($products->isNotEmpty()){
            return redirect('/admin/product_category/create')
                ->with('error','Your parent category selected still has some products.<br>Please remove those products or update their category to Unknown then try to add new category again.');
        }else{
            $cr_arr=[];
            if ($request->hasFile('category_image')) {
                $file_name = $request->category_image->getClientOriginalName();
                $path = $request->category_image->storeAs('public/files', $file_name);
                $cr_arr['category_image'] = $path;
            }
            $cr_arr['category_name'] = $request->category_name;
            $cr_arr['parent_id'] = $request->parent_id;
            DB::table('category')->insert($cr_arr);
        }

        return redirect('/admin/product_category')->with('success','Successfully add new category');
    }


    //hiển thị trang edit
    public function editpage($category_id){
        //trả về toàn bộ csdl để đệ quy option
        $category_all = CategoryProductModel::all();
        $data_all = [];
        $data_all["category_all"] = $category_all;

        //trả về 1 bản ghi cần chỉnh sửa
        $category_1 = DB::table('category')->where('category_id',$category_id)->first();
        $data_1 = [];
        $data_1["category_1"] = $category_1;

        return view("backend.contents.productcategories.edit",$data_all,$data_1);
    }

    //lấy ra toàn bộ phần tử con của phần tử đang chọn
    public function cat(&$arr,$category_id){
        $data = DB::table('category')->where('parent_id',$category_id)->get();
        foreach ($data as $key=> $value){
            $id =  $value->category_id;
            $arr[]= $id;
            unset($data[$key]);
            $this->cat($arr,$id);
        }
    }

    //code edit
    public function edit(Request $request,$category_id){

        $validate_cat =[
            'category_name' => ["required",Rule::unique('category')->ignore($category_id,'category_id')]
        ];
        $error_messages = [
            'required' => ':attribute required',
            'unique' => ':attribute already exist'
        ];
        $this->validate($request,$validate_cat,$error_messages);

        //khai báo mảng mới để truyền vào function cat()
        $arr=[];
        $test = $this->cat($arr,$category_id);
        //dump($arr);die;
        //tạo biến lấy ra mảng các sản phẩm trong danh mục
        $products = DB::table('product')->where('product_type',$request->parent_id)->get();
        if (in_array($request->parent_id,$arr)){
            return redirect('/admin/product_category/edit/'.$category_id)->with('error','A parent category can not be edited to a child category of its own children category !');
        }
        elseif ($products->isNotEmpty()){
            return redirect('/admin/product_category/edit/'.$category_id)
                ->with('error','Your parent category selected still has some products.<br>Please remove those products or update their category to Unknown then try to update category again.');
        }
        else{
            $ed_arr=[];
            if ($request->hasFile('category_image')) {
                $file_name1 = $request->category_image->getClientOriginalName();
                $path1 = $request->category_image->storeAs('public/files', $file_name1);
                $ed_arr['category_image'] = $path1;
            }
            $ed_arr['category_name'] = $request->category_name;
            $ed_arr['parent_id'] = $request->parent_id;
            DB::table('category')->where('category_id', $category_id)->update($ed_arr);
        }

        return redirect('/admin/product_category')->with('success','Successfully update category');
    }

    //code xóa
    public function delete($category_id){
        $array = [];
        $this->cat($array,$category_id);
        if (!empty($array)){
            return redirect('/admin/product_category')->with('error', 'Can not remove this category at the moment \'cause it still has some children category');
        }else{
            $products = DB::table('product')->where('product_type',$category_id)->get();
            if($products->isNotEmpty()){
                return redirect('/admin/product_category')->with('error', 'Can not remove this category at the moment \'cause it still has some products');
            }else{
                DB::table('category')->where('category_id',$category_id)->delete();
            }
        }
        //xóa danh mục cha thì xóa luôn cả danh mục con
        //$data = DB::table('category')->where('parent_id',$category_id)->get();
        //$data1=gettype($data);
        //dump($data);die;
        //foreach ($data as $value){
        //$id = $value->category_id;
        //$this->delete($id);
        //}

        return redirect('/admin/product_category')->with('success', 'Successfully remove category');

        //Xóa phần tử cha thì phần tử con sẽ lên làm phần tử cha
        /*$data = DB::table('category')->where('category_id',$category_id)->first();
        $arr = ['parent_id'=>$data->parent_id];
        DB::table('category')->where('parent_id',$category_id)->update($arr);
        DB::table('category')->where('category_id',$category_id)->delete();*/
    }
}
