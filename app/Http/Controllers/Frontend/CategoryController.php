<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;

class CategoryController extends Controller
{
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
    public function indexall(Request $request){
        $products = DB::table('product');
        $cat = DB::table('category')->get();
        $manu = DB::table('manufacturer')->get();
        if ($request->manu){
            $manu1 = $request->manu;
            $products->where('product_manufacturer',$manu1);

        }
        $products =
            $products->join('category','product.product_type','=','category.category_id')
                     ->select('product.*')
                     ->paginate(9);

        return view('frontend.contents.productall',['product' => $products,'manufacturer' => $manu,'categories' => $cat]);

    }
    //
    public function index(Request $request, $category_id){
        $manu = DB::table('manufacturer')->get();



        $cat = DB::table('category')->get();

        $this_cat = DB::table('category')->where('category_id',$category_id)->first();

        $arr=[];
        $this->cat($arr,$category_id);
        $cat_pro = DB::table('product')->whereIn('product_type',$arr);
        if ($request->manu){
            $manu1 = $request->manu;
            $cat_pro->where('product_manufacturer',$manu1);
        }
        $cat_pro = $cat_pro->paginate(9);


        return view('frontend.contents.product',['product'=>$cat_pro,'manufacturer'=>$manu,'categories'=>$cat,'this_cat'=>$this_cat]);
    }
    //
    public function filter(Request $request,$category_id){
        $this_cat = DB::table('category')->where('category_id',$category_id)->first();
        $manu = DB::table('manufacturer')->get();
        $cat = DB::table('category')->get();
       $arr=[];
       $this->cat($arr,$category_id);
        $echo = DB::table('product');
       switch ($request->sortby){
           case 'lastest':
               $echo->whereIn('product_type',$arr)->orderBy('product_id','DESC');
               break;
           case 'price_desc':
               $echo->whereIn('product_type',$arr)->orderBy('product_price_sell','DESC');
               break;
           case 'price_asc':
               $echo->whereIn('product_type',$arr)->orderBy('product_price_sell','ASC');
               break;
           default:
               $echo->whereIn('product_type',$arr);
       }

        if ($request->manu){
            $manu1 = $request->manu;
            $echo->where('product_manufacturer',$manu1);
        }
        $echo=$echo->paginate(9);

        //giữ kết quả phân trang sau khi filter
        if (isset($_POST['manu'])){
            $manu1 = $_POST['manu'];
            $echo->appends(['manu'=>$manu1,'sortby'=>$request->sortby])->links();
        }else{
            $echo->appends(['sortby'=>$request->sortby])->links();
        }

        return view('frontend.contents.product',['product'=>$echo,'manufacturer'=>$manu,'categories'=>$cat,'this_cat'=>$this_cat]);
    }

    //
    public function filterall(Request $request){
        $manu = DB::table('manufacturer')->get();
        $cat = DB::table('category')->get();

        switch ($request->sortby){
            case 'lastest':
                $echo= DB::table('product')->orderBy('product_id','DESC');
                break;
            case 'price_desc':
                $echo =DB::table('product')->orderBy('product_price_sell','DESC');
                break;
            case 'price_asc':
                $echo =DB::table('product')->orderBy('product_price_sell','ASC');
                break;
            default:
                $echo =DB::table('product');
        }

        if ($request->manu){
            $manu1 = $request->manu;
            $echo->where('product_manufacturer',$manu1);
        }
        $echo =
            $echo->join('category','product.product_type','=','category.category_id')
                 ->select('product.*')
                 ->paginate(9);

        //giữ kết quả phân trang sau khi filter
        if (isset($_POST['manu'])){
            $manu1 = $_POST['manu'];
            $echo->appends(['manu'=>$manu1,'sortby'=>$request->sortby])->links();
        }else{
            $echo->appends(['sortby'=>$request->sortby])->links();
        }

        return view('frontend.contents.productall',['product'=>$echo,'manufacturer'=>$manu,'categories'=>$cat]);
    }

}
