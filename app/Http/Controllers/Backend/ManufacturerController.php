<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ManufacturerController extends Controller
{
    //
    public function index(){
        $fact = DB::table('manufacturer')->paginate(10);
        return view('backend.contents.manufacturer.index',['fact'=>$fact]);
    }
    //
    public function createpage(){
        return view('backend.contents.manufacturer.create');
    }
    //
    public function editpage($manufacturer_id){
        $fact = DB::table('manufacturer')->where('manufacturer_id',$manufacturer_id)->first();
        return view('backend.contents.manufacturer.edit',['fact'=>$fact]);
    }

    //
    public function create(Request $request){
        $validate_fact = [
            "manufacturer_name" => "required|unique:manufacturer,manufacturer_name",
            "manufacturer_desc" => "required",
            "manufacturer_image" => "required"
        ];
        $error_message = [
            'required' => ':attribute required',
            'unique' => ':attribute already exist'
        ];
        $this->validate($request,$validate_fact,$error_message);

        $arr = [];
        if ($request->hasFile('manufacturer_image')){
            $filename = $request->manufacturer_image->getClientOriginalName();
            $path = $request->manufacturer_image->storeAs('public/files',$filename);
            $arr['manufacturer_image'] = $path;
        }
        $arr['manufacturer_name'] = $request->manufacturer_name;
        $arr['manufacturer_desc'] = $request->manufacturer_desc;

        DB::table('manufacturer')->insert($arr);
        return redirect('/admin/manufacturer')->with('success','Successfully add new brand');
    }
    //
    public function edit(Request $request, $manufacturer_id){
        $validate_fact = [
            "manufacturer_name" => ["required",Rule::unique('manufacturer')->ignore($manufacturer_id,'manufacturer_id')],
            "manufacturer_desc" => "required"
        ];
        $error_message = [
            "required" => ":attribute required",
            'unique' => ':attribute already exist'
        ];
        $this->validate($request,$validate_fact,$error_message);

        $arr = [];
        $arr['manufacturer_name'] = $request->manufacturer_name;
        $arr['manufacturer_desc'] = $request->manufacturer_desc;
        if ($request->hasFile('manufacturer_image')){
            $filename = $request->manufacturer_image->getClientOriginalName();
            $path = $request->manufacturer_image->storeAs('public/files',$filename);
            $arr['manufacturer_image'] = $path;
        }
        DB::table("manufacturer")->where("manufacturer_id",$manufacturer_id)->update($arr);
        return redirect('/admin/manufacturer')->with('success','Successfully update brand');
    }
    //
    public function delete($manufacturer_id){
        $fact = DB::table('product')->where('product_manufacturer',$manufacturer_id)->get();
        if ($fact->isNotEmpty()){
            return redirect('/admin/manufacturer')->with('error','Can not remove this brand at the moment \'cause it still have some products');
        }else{
            DB::table('manufacturer')->where('manufacturer_id',$manufacturer_id)->delete();
            return redirect('/admin/manufacturer')->with('success','Successfully remove brand');
        }
    }
}
