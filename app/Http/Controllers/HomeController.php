<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public User $user;

    public Product $product;
    public Category $category;

    public function __construct(User $user, Product $product, Category $category)
    {

        $this->product = $product;
        $this->user = $user;
        $this->category = $category;
    }
    public function index()
    {
        $product = Product::count();
        $products = $this->product->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.category_name as categories_name')
            ->get();
        $user = User::count();
        $category = Category::count();
        $order =  Order::count();


        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $labels = $users->keys();
        $data = $users->values();

        return view('dashboard', [
            'title' => 'Trang quản trị',

            'products' => $products,
            'product' => $product,
            'user' => $user,
            'order' => $order,
            'data' => $data,
            'labels' => $labels,

            'category' => $category,
        ]);
    }
}
