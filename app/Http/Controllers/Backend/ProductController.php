<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\ProductModel;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    //
    public function index() {

        $product = DB::table('product')
            ->leftJoin('category', 'product.product_type', '=', 'category.category_id')
            ->join('manufacturer','product.product_manufacturer','=','manufacturer.manufacturer_id')
            ->select('product.*','category.category_name','manufacturer_name')
            ->paginate(10);
        return view("backend.contents.products.index",['product'=>$product]);
    }

    //code xóa
    public function delete($product_id){
        DB::table('product')->where('product_id',$product_id)->delete();
        return redirect('/admin/product')->with('success', 'Successfully remove product');
    }

    //lấy ra các danh mục con Cuối Cùng của danh mục cha
    public function lowest_cat(&$arr,$category_id){
        $data = DB::table('category')->where('parent_id',$category_id)->get();
        if ($data->isNotEmpty()){
            foreach ($data as $value){
                $id = $value->category_id;
                $this->lowest_cat($arr,$id);
            }
        }else{
            $arr[]=$category_id;
        }
    }

    //hiển thị trang edit
    public function editpage($product_id){
        $arr=[];
        //trả về toàn bộ csdl để đệ quy option category theo dạng array (mảng) - dùng " product[''] "
        //$category = CategoryProductModel::all();
        //trả về toàn bộ csdl để đệ quy option category theo dạng object - dùng " product-> "
        $category = DB::table('category')->get();
        foreach ($category as $value){
            $this->lowest_cat($arr,$value->category_id);
        }
        $categories = DB::table('category')->whereIn('category_id',$arr)->get();
        //trả về toàn bộ csdl bảng manufacturer để in ra option hãng sản xuất
        $manufacturer = DB::table('manufacturer')->get();
        //trả về 1 bản ghi cần chỉnh sửa
        $product = DB::table('product')->where('product_id',$product_id)->first();
        //trả về danh sách các attribute và giá trị của chúng của sản phẩm đang xét
        $att = DB::table('product_attributes')
        ->where('product_attributes.product_id',$product_id)
        ->join('attributes','product_attributes.attribute_id','=','attributes.attribute_id')
        ->select('product_attributes.*','attributes.attribute_name')
        ->get();
        //trả về danh sách các attribute
        $att_all = DB::table('attributes')->get();
        return view("backend.contents.products.edit",['category'=>$categories,'product'=>$product,'fact' => $manufacturer,'product_att'=>$att,'att_all'=>$att_all]);
    }

    //code edit
    public function edit(Request $request,$product_id){
        $validate_pro =[
            'product_title' => ["required",Rule::unique('product')->ignore($product_id,'product_id')],
            'product_desc' => 'required',
            'product_manufacturer' => 'required',
            'product_quantity' => 'required|numeric',
            'product_price_core' => 'required|numeric',
            'product_tax' => 'required|numeric'
        ];
        $error_messages = [
            'required' => ':attribute không được để trống',
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại'
        ];
        try {
            $this->validate($request, $validate_pro, $error_messages);
        } catch (ValidationException $e) {
        }
        $arr=[];
        if ($request->hasFile('product_main_image')) {
            $file_name1 = $request->product_main_image->getClientOriginalName();
            $path1 = $request->product_main_image->storeAs('public/files', $file_name1);
            $arr['product_main_image'] = $path1;
        }
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $mul_file){
                $file_name2 = $mul_file->getClientOriginalName();
                $path2 = $mul_file->storeAs('public/files',$file_name2);
                $data2[] = $path2;
                $arr['product_images'] = json_encode($data2);
            }
        }
        $arr['product_title'] = $request->product_title;
        $arr['product_desc'] = $request->product_desc;
        $arr['product_manufacturer'] = $request->product_manufacturer;
        $arr['product_quantity'] = $request->product_quantity;
        $arr['product_price_core'] = $request->product_price_core;
        $arr['product_tax'] = $request->product_tax;
        $arr['product_price_sell'] = $request->product_price_core + ($request->product_price_core*$request->product_tax)/100;
        $arr['product_type'] = $request->product_type;
        DB::table('product')->where('product_id', $product_id)->update($arr);

        if ($request->id){
            foreach($request->id as $key => $value){
                $arr1['value'] = $request->edit_value[$key];
                DB::table('product_attributes')->where('id',$request->id[$key])->update($arr1);
            }
        }
        if ($request->del_id){
            foreach($request->del_id as $value){
                DB::table('product_attributes')->where('id',$value)->delete();
            }
        }
        if ($request->add_id){
            foreach($request->add_id as $key => $value){
                    $arr2['attribute_id'] = $request->add_id[$key];
                    $arr2['product_id'] = $product_id;
                    $arr2['value'] = $request->add_value[$key];
                    if ($arr2['value'] != null){
                        DB::table('product_attributes')->insert($arr2);
                    }
                }
        }

        return redirect('/admin/product')->with('success','Successfully update product');
    }

    //hiển thị trang thêm thể loại
    public function createpage(){
        $arr=[];
        //trả về toàn bộ csdl để đệ quy option category theo dạng array (mảng) - dùng " product[''] "
        //$category = CategoryProductModel::all();
        //trả về toàn bộ csdl để đệ quy option category theo dạng object - dùng " product-> "
        $category = DB::table('category')->get();
        foreach ($category as $value){
            $this->lowest_cat($arr,$value->category_id);
        }
        $categories = DB::table('category')->whereIn('category_id',$arr)->get();

        //trả về toàn bộ csdl bảng manufacturer để in ra option hãng sản xuất
        $manufacturer = DB::table('manufacturer')->get();
        return view("backend.contents.products.create",['category'=>$categories,'fact' => $manufacturer]);
    }

    //code thêm sản phẩm
    public function create(Request $request){
        $validate_pro =[
            'product_title' => 'required|unique:product,product_title',
            'product_desc' => 'required',
            'product_main_image' => 'required',
            'product_images' => 'required',
            'product_manufacturer' => 'required',
            'product_quantity' => 'required|numeric',
            'product_price_core' => 'required|numeric',
            'product_tax' => 'required|numeric'
        ];
        $error_messages = [
            'required' => ':attribute required',
            'numeric' => ':attribute must be a number',
            'unique' => ':attribute already exist'
        ];
        $this->validate($request,$validate_pro,$error_messages);
        $arr=[];
        if ($request->hasFile('product_main_image')) {
            $file_name1 = $request->product_main_image->getClientOriginalName();
            $path1 = $request->product_main_image->storeAs('public/files', $file_name1);
            $arr['product_main_image'] = $path1;
        }
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $mul_file){
                $file_name2 = $mul_file->getClientOriginalName();
                $path2 = $mul_file->storeAs('public/files',$file_name2);
                $data2[] = $path2;
                $arr['product_images'] = json_encode($data2);
        }
        }
        $arr['product_title'] = $request->product_title;
        $arr['product_desc'] = $request->product_desc;
        $arr['product_manufacturer'] = $request->product_manufacturer;
        $arr['product_quantity'] = $request->product_quantity;
        $arr['product_price_core'] = $request->product_price_core;
        $arr['product_tax'] = $request->product_tax;
        $arr['product_price_sell'] = $request->product_price_core + ($request->product_price_core*$request->product_tax)/100;
        $arr['product_type'] = $request->product_type;
        DB::table('product')->insert($arr);

        return redirect('/admin/product')->with('success','Successfully add new product');
    }

}
