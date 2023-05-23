<?php

namespace App\Http\Controllers;

use App\Models\ab_articlecategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index_api(){
        $query=ab_articlecategory::query()->select('ab_name')->orderBy('ab_name')->get();
        return response()->json($query);
    }
}
