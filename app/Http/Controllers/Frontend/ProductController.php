<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index($product_id){
        $product = DB::table('product')
            ->where('product_id',$product_id)
            ->join('manufacturer','product.product_manufacturer','=','manufacturer.manufacturer_id')
            ->join('category','product.product_type','=','category.category_id')
            ->select('product.*','manufacturer.*','category.*')
            ->first();

        $related_pros = DB::table('product')
            ->where('product_type',$product->category_id)
            ->get();

        $rating=null;
        if (auth()->check()){
            $rating = DB::table('product_rating')
                ->where('product_id',$product_id)
                ->where('user_id',auth()->user()->id)
                ->first();
        }

        $rate_list = DB::table('product_rating')
            ->where('product_rating.product_id',$product_id)
            ->join('users','product_rating.user_id','users.id')
            ->select('product_rating.*','users.name')
            ->offset(0)
            ->limit(2)
            ->get();

        $attributes = DB::table('product_attributes')
        ->where('product_attributes.product_id',$product_id)
        ->join('attributes','product_attributes.attribute_id','=','attributes.attribute_id')
        ->select('attributes.attribute_name','product_attributes.value')
        ->get();

        return view('frontend.contents.product_detail',['product'=>$product,'attributes'=>$attributes,'rating'=>$rating,'rate_list'=>$rate_list,'related_pros'=>$related_pros]);
    }
}
