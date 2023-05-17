<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    public Product $product;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function index()
    {
        $product = $this->product->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.category_name as categories_name')
            ->get();
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

        return view('admin.product.create', [
            'categories' => $category,
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
        $product->save();

        if ($product) {
            $this->setFlash(__('Thêm san pham thành công'));
            return redirect()->route('product.index');
        }
        $this->setFlash(__('Thêm san pham thất bại'));
        return redirect()->route('product.index');
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
        return view('admin.product.edit', [
            'product' => $product,
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
            $this->setFlash(__('Cập nhật  thành công'));
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('product.index');
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
            session()->flash('comment', 'Xóa  thành công!');
            return redirect()->back();
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
}
