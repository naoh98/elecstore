<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    //
    public function saveRating(Request $request, $product_id){
        if ($request->ajax()){
            $array=[];
            $array2=[];
            $array['product_id']= $product_id;
            $array['user_id']= $request->user_id;
            $array['rate_point']= $request->rate_point;
            $array['post']= $request->review;
            $array['created_at'] = Carbon::now('GMT+7');

            $total_point = DB::table('product')->where('product_id',$product_id)->select('product.product_total_point')->first();
            $total_post = DB::table('product')->where('product_id',$product_id)->select('product.product_total_post')->first();
            $array2['product_total_point'] = $request->rate_point+$total_point->product_total_point;
            $array2['product_total_post'] = $total_post->product_total_post+1;

            DB::table('product')->where('product_id',$product_id)->update($array2);
            DB::table('product_rating')->insert($array);

            return response()->json(['code'=>200]);
        }
    }
    //
    public function editRating(Request $request, $product_id){
        if ($request->ajax()){
            $array=[];
            $array2=[];
            $array['rate_point']= $request->rate_point;
            $array['post']= $request->review;
            $array['updated_at'] = Carbon::now('GMT+7');

            $total_point = DB::table('product')
                ->where('product_id',$product_id)
                ->select('product.product_total_point')
                ->first();

            $new_total_point = $total_point->product_total_point - $request->old_rate_point + $request->rate_point;
            $array2['product_total_point'] = $new_total_point;

            DB::table('product_rating')
                ->where('product_id',$product_id)
                ->where('user_id',auth()->user()->id)
                ->update($array);
            DB::table('product')->where('product_id',$product_id)->update($array2);

            return response()->json(['code'=>200]);
        }
    }
    //
    public function loadmore(Request $request, $product_id){
        if ($request->ajax()){
            $rate_list = DB::table('product_rating')
                ->where('product_rating.product_id',$product_id)
                ->join('users','product_rating.user_id','users.id')
                ->select('product_rating.*','users.name')
                ->offset($request->start)
                ->limit($request->limit)
                ->get();

            $result ='';
            if (count($rate_list)>0){
                foreach ($rate_list as $post){
                    $result.='
                            <div class="additional_info_sub_grids">
                                <div class="col-xs-2 additional_info_sub_grid_left">';
                    for ($i=1;$i<=5;$i++){
                        $result.=' <i class="fa fa-star '.($i <= $post->rate_point ? 'star_active':'').'"></i>';
                    }
                    $result.='</div>
                                <div class="col-xs-10 additional_info_sub_grid_right">
                                    <div class="additional_info_sub_grid_rightl">
                                        <h5>'.$post->name.'</h5>
                                        <p>'.$post->post.'</p>
                                    </div>
                                    <div class="additional_info_sub_grid_rightr">
                                        <h5>'.($post->updated_at ? $post->updated_at.' (đã sửa)' : $post->created_at).'</h5>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <hr style="border: 1px solid darkgrey;">
                    ';
                }
                return response()->json(['code'=>200,'html'=>$result]);
            }else{
                return response()->json(['code'=>500]);
            }
        }
    }
}
