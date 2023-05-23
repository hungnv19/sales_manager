<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $wishlists = Wishlist::where("user_id", "=", Auth::user()->id)->with('product')->orderby('id', 'desc')->paginate(10);
        return view('client.wishlist.index', [
            'wishlists' => $wishlists,
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return redirect()->back();
    }
    public function addWishList(Request $request, $id)
    {
        $status = Wishlist::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();
        if (isset($status->user_id) && isset($id)) {
            return redirect()->back()->with('message', 'This item is already in your wishlist!');
        } else {
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::user()->id;
            $wishlist->product_id = $id;

            $wishlist->save();
            return redirect()->back();
        }
    }
}
