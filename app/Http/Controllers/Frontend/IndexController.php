<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

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

    //lấy ra toàn bộ id danh mục con của danh mục đang chọn
    public function cat(&$arr,$category_id){
        $data = DB::table('category')->where('parent_id',$category_id)->get();
        $arr[]=$category_id;
        foreach ($data as $key=> $value){
            if (isset($data)){
                $id =  $value->category_id;
                $arr[]= $id;
                $this->cat($arr,$id);
            }
        }
        return $arr;
    }
    //

    public function index(){
        $arr=[];
        $category = DB::table('category')->get();
        //lấy ra các danh mục cha
        foreach ($category as $value){
            if ($value->parent_id==0){
                $arr[]=$value->category_id;
            }
        }
        $categories = DB::table('category')->whereIn('category_id',$arr)->get();

        $arr2=[];
        $a=[];
        foreach ($arr as $parent){
            $this->cat($arr2,$parent);
            $top_pro=DB::table('product')
                ->whereIn('product_type',$arr2)
                ->join('category','product.product_type','category.category_id')
                ->select('product.*')
                ->get();
            $a[$parent]=$top_pro;
            unset($arr2);
        }

        $lastest_products = DB::table('product')
        ->orderBy('product_id','desc')
        ->take(4)
        ->get();

        $manufacturer = DB::table('manufacturer')->get();

        return view('frontend.contents.homepage',['top_cat'=>$categories,'product'=>$a,'lastest_product'=>$lastest_products,'manufacturer'=>$manufacturer]);
    }


}
