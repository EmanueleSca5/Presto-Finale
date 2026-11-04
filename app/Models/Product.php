<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

#[Fillable(['title', 'description', 'image', "price", "active", "category_id"])]

class Product extends Model
{
   use HasFactory;
   #[Override]
   protected function casts()
   {
    return [
        "price" => "decimal:2",
        "active" => "boolean",
    ];
   }

   public function user(){
      return $this->belongsTo(User::class);
   }

   public function category(){
      return $this->belongsTo(Category::class);
   }
}
