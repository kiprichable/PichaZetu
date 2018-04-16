<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = User::find(1);
		return view('photoManagement.cart')
			->withUser($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
			return $cartItem->id === $request->id;
		});
		if (!$duplicates->isEmpty()) {
			return redirect('cart')->withSuccessMessage('Item is already in your cart!');
		}
		Cart::add($request->id, $request->name, 1, $request->price)->associate('App\Models\Photo');
		return redirect('cart')->withSuccessMessage('Item was added to your cart!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		// Validation on max quantity
		$validator = Validator::make($request->all(), [
			'quantity' => 'required|numeric|between:1,5'
		]);
		if ($validator->fails()) {
			session()->flash('error_message', 'Quantity must be between 1 and 5.');
			return response()->json(['success' => false]);
		}
		Cart::update($id, $request->quantity);
		session()->flash('success_message', 'Quantity was updated successfully!');
		return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		Cart::destroy();
		return redirect('cart')->withSuccessMessage('Your cart has been cleared!');
    }
	/**
	 * Remove the resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function emptyCart()
	{
		Cart::destroy();
		return redirect('cart')->withSuccessMessage('Your cart has been cleared!');
	}
	
	/**
	 * Switch item from shopping cart to wishlist.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function switchToWishlist($id)
	{
		$item = Cart::get($id);
		Cart::remove($id);
		$duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($id) {
			return $cartItem->id === $id;
		});
		if (!$duplicates->isEmpty()) {
			return redirect('cart')->withSuccessMessage('Item is already in your Wishlist!');
		}
		Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)
			->associate('App\Product');
		return redirect('cart')->withSuccessMessage('Item has been moved to your Wishlist!');
	}
}
