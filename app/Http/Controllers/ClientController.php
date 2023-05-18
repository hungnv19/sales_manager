<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use App\Mail\ContactMail;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientController extends BaseController
{
    public User $user;
    public Product $product;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Product $product, User $user)
    {
        $this->user = $user;
        $this->product = $product;
    }
    public function index()
    {

        $products = $this->product->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.category_name as categories_name')
            ->get();

        return view('client.layouts.main', [
            'products' => $products,
        ]);
    }
    public function productDetail($id)
    {
        $product = Product::find($id)->with('category')->first();

        $comments = Comment::select('id', 'content', 'user_id', 'product_id', 'created_at')->orderBy('id', 'desc')->with('user')->with('product')->get();
        // dd($comment);
        return view('client.pages.product-detail', [
            'product' => $product,
            'comments' => $comments,
            'title' => 'Chi tiet san pham'
        ]);
    }

    public function shop()
    {
        $products = Product::select('products.*')
            ->orderBy('product_name')->with('categories')->paginate(12);
        $categories = Category::select('id', 'category_name')->get();
        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function searchProduct(Request $requests)
    {
        $products = Product::where('product_name', 'like', '%' . $requests->name . '%')->paginate(12);
        $categories = Category::select('id', 'category_name')->get();

        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function categoryProducts($id)
    {
        $products = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*')
            ->where('products.category_id', '=', $id)
            ->paginate(12);
        $categories = Category::select('id', 'category_name')->get();


        return view('client.pages.shop', [
            'products' => $products,
            'categories' => $categories,

        ]);
    }
    public function profile()
    {
        $user = Auth::user();

        return view('client.profile.index', [
            'user' => $user,
        ]);
    }
    public function updateProfile(Request $request)
    {

        $user =  $this->user->where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        $this->setFlash(__('Cập nhật  thành công'));
        return redirect()->back();
    }

    public function postComment(Request $request, $id)
    {

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $id;

        $comment->save();
        return redirect()->back();
    }
    public function contact()
    {

        return view('client.pages.contact');
    }
    public function storeContact(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        $mailContents = $request->all();
        Mail::to($contact->email)->send(new ContactMail($mailContents));
        return redirect()->back()->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
    }
}
