<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\News;
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
    public function index(Request $request)
    {
        $product = Product::count();

        $search =  $request->input('search_input');
        if ($search != "") {
            $products = Product::where(function ($query) use ($search) {
                $query->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('product_code', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('buying_price', 'like', '%' . $search . '%')
                    ->orWhere('selling_price', 'like', '%' . $search . '%')
                    ->orWhere('product_quantity', 'like', '%' . $search . '%')
                    ->orWhere('root', 'like', '%' . $search . '%');
            })
                ->paginate(5);
            $products->appends(['search_input' => $search]);
        } else {
            $products = $this->product->join('categories', 'categories.id', '=', 'products.category_id')
                ->select('products.*', 'categories.category_name as categories_name')
                ->paginate(5);
        }
        $user = User::count();
        $category = Category::count();
        $new =  News::count();


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
            'new' => $new,
            'data' => $data,
            'labels' => $labels,

            'category' => $category,
        ]);
    }
}
