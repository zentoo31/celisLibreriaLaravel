<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/students", function () {
   return "students list";
});
