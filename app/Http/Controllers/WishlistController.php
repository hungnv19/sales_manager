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
    public function index(Request $request)
    {
        $search =  $request->input('search_input');
        if ($search != "") {
            $wishlists = Wishlist::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
                ->paginate(10);
            $wishlists->appends(['search_input' => $search]);
        } else {
            $wishlists = Wishlist::where("user_id", "=", Auth::user()->id)->with('product')->orderby('id', 'desc')->paginate(10);
        }
        
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
        if (Wishlist::destroy($id)) {
            return redirect()->back()->with('success', 'Xóa  thành công!');
        } else {
            return redirect()->back()->with('failed', 'Xóa  thất bại!');
        }
    }
    public function addWishList(Request $request, $id)
    {
        $status = Wishlist::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();
        if (isset($status->user_id) && isset($id)) {
            return redirect()->back()->with('success', 'Sản phẩm này đã có trong danh sách yêu thích của bạn!');
        } else {
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::user()->id;
            $wishlist->product_id = $id;

            $wishlist->save();
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào mục yêu thích!');
        }
    }
}
