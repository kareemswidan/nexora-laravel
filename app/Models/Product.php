<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model { protected $fillable=['name','name_ar','description','description_ar','category','category_ar','price','old_price','rating','badge','badge_ar','color','icon','is_active']; protected $casts=['price'=>'decimal:2','old_price'=>'decimal:2','rating'=>'decimal:1','is_active'=>'boolean']; }

