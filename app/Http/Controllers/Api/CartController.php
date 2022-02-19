<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function AddToCart(Request $request,$id){
        $product = DB::table('products')->where('id', $id)->first();
        $check =  DB::table('pos')->where('pro_id', $id)->first();
        if($check){
            DB::table('pos')->where('pro_id',$id)->increment('pro_qty');
            $product=DB::table('pos')->where('pro_id', $id)->first();
        $subtotal =$product->pro_qty * $product->product_price; 
        DB::table('pos')->where('pro_id', $id)->update(['sub_total'=>$subtotal]);
        }else{
            $data=array();
            $data['pro_id']=$id;
            $data['pro_name']=$product->product_name;
            $data['pro_qty']=1;
            $data['product_price']=$product->selling_price;
            $data['sub_total']=$product->selling_price;
            DB::table('pos')->insert($data);
        }
       
    }

    public function cartProduct(){
        $cart=DB::table('pos')->get();
        return response()->json($cart);
    }

    public function removeCart($id){
        DB::table('pos')->where('id', $id)->delete();
        return response('Done');
    }

    public function incrementProduct($id){
        $qty = DB::table('pos')->where('id', $id)->increment('pro_qty');
        $product=DB::table('pos')->where('id', $id)->first();
        $subtotal =$product->pro_qty * $product->product_price; 
        DB::table('pos')->where('id', $id)->update(['sub_total'=>$subtotal]);
        return response('Done');

    }
    public function decrementProduct($id){
        $qty = DB::table('pos')->where('id', $id)->decrement('pro_qty');
        $product=DB::table('pos')->where('id', $id)->first();
        $subtotal =$product->pro_qty * $product->product_price; 
        DB::table('pos')->where('id', $id)->update(['sub_total'=>$subtotal]);
        return response('Done');
    }

    public function vats(){
        $vats=DB::table('extra')->first();
        return response()->json($vats);
    }

}
