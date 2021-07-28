<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    protected $primaryKey = 'discount_id';
    protected $fillable = [
        'restaurent_id',
        'item_id',
        'discount_type',
        'discount',
        'discount_startdate',
        'discount_enddate',
        'status',
        'is_deleted',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
