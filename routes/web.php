<?php

use App\Http\Controllers\Logout;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::livewire("/" , "homepage")->name("home");

Route::livewire("/annunci" , "annunci.index")->name("annunci.index");

Route::livewire("/annunci/create" , "annunci.create")->middleware("auth")->name("annunci.create");

Route::livewire("/login" , "auth.login")->name("auth.login");

Route::livewire("/register" , "auth.register")->name("auth.register");

Route::livewire("/annunci/miei-annunci" , "annunci.miei-annunci")->middleware("auth")->name("my-annunci");

Route::post("/logout" , Logout::class)->name("logout");

Route::delete("/annunci/elimina/{product}" , [ProductController::class , "destroy"])->middleware("auth")->name("delete");

Route::livewire("/annunci/{product}/edit" , "annunci.edit")->middleware("auth")->name("edit");

Route::livewire("/annunci/{product}/details" , "annunci.show")->name("show");

Route::livewire("/annunci/categories/{category}", "annunci.categories")->name("category");