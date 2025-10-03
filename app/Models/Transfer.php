<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
     protected $guarded=[];

    public function transferItems(){
        return $this->hasMany(TransferItem::class,'transfer_id','id');
    }

    public function fromWarehouse(){
        return $this->belongsTo(WareHouse::class,'from_warehouse_id','id');
    }

    public function toWarehouse(){
        return $this->belongsTo(WareHouse::class,'to_warehouse_id','id');
    }
}