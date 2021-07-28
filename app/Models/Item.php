<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'item_type_id',
    // 	'store_id',
    //     'category_id',
    //     'item_code',
    //     'item_name',
    //     'item_short_desc',
    //     'item_description',
    //     'item_status',
    //     'image_path',
    // 	'item_price'
    // ];

protected $primaryKey = 'item_id';
    protected $fillable = [
        'item_type_id',
    	'store_id',
        'category_id',
        'item_code',
        'item_name',
        'item_short_desc',
        'item_description',
        'item_status',
        'image_path',
    	'item_price',
    	'restaurent_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
}
