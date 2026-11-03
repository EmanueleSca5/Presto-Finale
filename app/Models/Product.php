<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Override;

#[Fillable(['title', 'description', 'image', "price", "active"])]

class Product extends Model
{
   #[Override]
   protected function casts()
   {
    return [
        "prezzo" => "decimal:2",
        "attivo" => "boolean",
    ];
   }
}
