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
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientController extends BaseController
{
    public User $user;
    public Product $product;
    public News $new;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Product $product, User $user, News $new)
    {
        $this->user = $user;
        $this->new = $new;
        $this->product = $product;
    }
    public function index()
    {
        $news = $this->new->join('categories', 'categories.id', '=', 'news.category_id')
            ->select('news.*', 'categories.category_name as categories_name')
            ->get();
        $products = $this->product->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.category_name as categories_name')
            ->get();

        return view('client.layouts.main', [
            'products' => $products,
            'news' => $news,
        ]);
    }
    public function productDetail($id)
    {
        $product = Product::where('id', $id)->with('category')->with('size')->with('color')->first();

        $comments = Comment::select('id', 'content', 'user_id', 'product_id', 'created_at')->orderBy('id', 'desc')->with('user')->with('product')->get();

        // dd($product->size);
        return view('client.pages.product-detail', [
            'product' => $product,
            'comments' => $comments,
            'title' => 'Chi tiet san pham'
        ]);
    }

    public function shop()
    {
        $products = Product::select('products.*')
            ->paginate(12);
        // $products = Product::select('products.*')
        //     ->orderBy('product_name')->with('categories')->paginate(12);
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

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công !');
    }

    public function postComment(Request $request, $id)
    {

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $id;

        $comment->save();
        return redirect()->back()->with('success', 'Đăng bình luận thành công !');
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
        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ sớm liên lạc lại với bạn.');
    }
}
