<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductRequest;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public Product $product;
    public Color $color;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Product $product, Color $color)
    {
        $this->product = $product;
        $this->color = $color;
    }
    public function index(Request $request)
    {

        $search =  $request->input('search_input');
        if ($search != "") {
            $product = Product::where(function ($query) use ($search) {
                $query->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('product_code', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('buying_price', 'like', '%' . $search . '%')
                    ->orWhere('selling_price', 'like', '%' . $search . '%')
                    ->orWhere('product_quantity', 'like', '%' . $search . '%')
                    ->orWhere('root', 'like', '%' . $search . '%');
            })
                ->paginate(5);
            $product->appends(['search_input' => $search]);
        } else {
            $product = $this->product->join('categories', 'categories.id', '=', 'products.category_id')

                ->select(
                    'products.*',
                    'categories.category_name as categories_name',

                )
                ->paginate(5);
        }
        return view('admin.product.index', [
            'products' => $product,

            'title' => 'Sản phẩm'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::select('id', 'category_name as label')->get();
        $colors = Color::select('id', 'name as label')->get();
        $sizes = Size::select('id', 'name as label')->get();

        return view('admin.product.create', [
            'categories' => $category,
            'colors' => $colors,
            'sizes' => $sizes,

            'title' => 'Thêm san pham'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->describe = $request->describe;
        $product->buying_date = $request->buying_date;
        $product->buying_price = strval(intval($request->buying_price));
        $product->selling_price = strval(intval($request->selling_price));
        $product->product_quantity = strval(intval($request->product_quantity));
        if ($request->hasFile('image')) {
            $product->image = $request->image->storeAs('public/images', $request->image->hashName());
        }
        $product->color_id = json_encode($request->color);
        $product->size_id = json_encode($request->size);
        // dd(json_decode( $product->color_id));

        $product->save();

        if ($product) {
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công!');
        } else {
            return redirect()->route('product.index')->with('failed', 'Thêm san pham thất bại!');
        }
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
        $product = Product::where('id', $id)->first();
        $category = Category::select('id', 'category_name as label')->get();
        $colors = Color::select('id', 'name as label')->get();
        $sizes = Size::select('id', 'name as label')->get();
        return view('admin.product.edit', [
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'title' => 'Sua san pham',
            'categories' => $category,
        ]);
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
        try {

            $product =  $this->product->where('id', $id)->first();
            $product->category_id = $request->category_id;
            $product->color_id = $request->color_id;
            $product->size_id = $request->size_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->describe = $request->describe;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            if ($request->hasFile('image')) {
                $product->image = $request->image->storeAs('public/images', $request->image->hashName());
            }

            $product->save();
            return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('product.index')->with('failed', 'Cập nhật sản phẩm thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Product::destroy($id)) {

            return redirect()->back()->with('success', 'Xóa sản phẩm thành công!');
        } else {
            return redirect()->back()->with('failed', 'Xóa sản phẩm thất bại !');
        }
    }
    public function checkProductCode(Request $request)
    {
        $data = $request->all();
        $data['id'] = $request->id;
        return response()->json([
            'valid' => $this->checkCode($data),
        ], 200);
    }
    protected function checkCode($request)
    {
        if ($request['value'] != '') {
            return !$this->product->where(function ($query) use ($request) {
                if (isset($request['id'])) {
                    $query->where('id', '!=', $request['id']);
                }
                $query->where(['product_code' => $request['value']]);
            })->exists();
        }

        return true;
    }
    public function generateCode()
    {
        $firstLetters = Str::of('S P')->explode(' ')->map(fn ($word) => Str::substr($word, 0, 1))->implode('');
        $randomCode = $firstLetters . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $randomCode = Str::upper($randomCode);
        return response()->json($randomCode);
    }
}
