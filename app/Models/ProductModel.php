<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    //
    protected $table ='product';
    protected $primaryKey = 'product_id';
    public $timestamps = true;

    public function owncat(){
        return $this->belongsTo('App\Models\CategoryProductModel','product_type','category_id');
    }
    public function ownmanu(){
        return $this->belongsTo('App\Models\ManufacturerModel','product_manufacturer','manufacturer_id');
    }
}
