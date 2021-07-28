<?php

namespace App\Models\Restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';
    protected $primaryKey = 'offer_id';
    protected $fillable = [
        'restaurent_id',
        'item_id',
        'offer_title',
        'offer_description',
        'offer_startdate',
        'offer_enddate',
        'status',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
