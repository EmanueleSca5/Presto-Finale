<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function destroy(Product $product){
        abort_unless($product->user_id === auth()->id(), 403);

        Storage::disk("public")->delete($product->image);
        $product->delete();

        return redirect()->route("my-annunci")->with("success" , "Annuncio eliminato");
    }
}
