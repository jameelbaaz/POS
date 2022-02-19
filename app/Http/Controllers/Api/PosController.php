<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function getProductByID($id){
        $products = DB::table('products')
                    ->where('category_id', $id)
                     ->when(request('search'),function($query){
                    $query->where('product_name', 'like', '%' .request('search') . '%'); })   
                    ->paginate(10);
                    return response()->json( $products);
    
    }
}
