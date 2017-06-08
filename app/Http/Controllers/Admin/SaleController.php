<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use Cart;
use App\Sale;
use App\Sale_Detail;

class SaleController extends Controller
{
    public function sale()
    {
    	return view('admin.sale');
    }

    public function searchitem(Request $request)
    {
    	if($request->search_query != ""){
    		$stores = Item::where('name','like',$request->search_query.'%')->get();
    		return response()->json(['stores' => $stores]);
    	}
    	
    }

    public function completesale(Request $request)
    {

        $shoppingcart = Cart::content();
        $sales = new Sale();
        $sales->subtotal = intval(str_replace(",","",Cart::subtotal()));
        $sales->save();
         
        foreach ($shoppingcart as $key => $value) {
            $item = Item::find($value->id);
            if ($item) {
                if ($value->qty <= $item->quantity) {
                    $item->quantity = $item->quantity - $value->qty;
                    $item->update();

                    $sale_detail = new Sale_Detail();
                    $sale_detail->sale_id = $sales->id;
                    $sale_detail->item_id = $value->id;
                    $sale_detail->price   = $value->price;
                    $sale_detail->quantity = $value->qty;
                    $sale_detail->save();
                }
            }
        }
        $subtotal = intval(str_replace(",","",Cart::subtotal()));
        $customer = $request->customer;
        Cart::destroy();
        return view('admin.complete',compact('shoppingcart','subtotal','customer'));
    }

    public function searchitembyid($id)
    {
    	$item = Item::find($id);

        Cart::add(
            $item->id,
            $item->name,
            1,
            $item->price
            );
        $shoppingcart = Cart::content();
        $subtotal = Cart::subtotal();
    	return response()->json(['item' => $shoppingcart,'subtotal' => $subtotal]);
    }

    public function cartitem()
    {
        $shoppingcart = Cart::content();
        $subtotal = Cart::subtotal();
        return response()->json(['item' => $shoppingcart,'subtotal' => $subtotal]);
    }

    public function editqty($id,Request $request)
    {
        $rowId = 0;
        $shoppingcart = Cart::content();

        foreach ($shoppingcart as $key => $value) {
            
            if ($value->id == $id) {

                $rowId = $value->rowId;
            }
        }

        Cart::update($rowId, $request->qty);
        $subtotal = Cart::subtotal();
        return response()->json(['item' => $shoppingcart,'subtotal' => $subtotal]);
    }

    public function deletesalebyid($id)
    {
        $rowId = 0;
        $shoppingcart = Cart::content();

        foreach ($shoppingcart as $key => $value) {
            
            if ($value->id == $id) {

                $rowId = $value->rowId;
            }
        }
        Cart::remove($rowId);
        $subtotal = Cart::subtotal();
        return response()->json(['item' => $shoppingcart,'subtotal' => $subtotal]);

    }

    public function deletesale()
    {
        Cart::destroy();
        
        $shoppingcart = Cart::content();
        $subtotal = Cart::subtotal();
        return response()->json(['item' => $shoppingcart,'subtotal' => $subtotal]);
    }


}
