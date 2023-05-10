<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
    public Category $category;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index', [
            'categories' => $categories,
            'title' => 'Danh mục'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', [

            'title' => 'Thêm danh mục'
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
        $category = new Category;
        $category->category_name = $request->category_name;

        $category->save();
        if ($category) {
            $this->setFlash(__('Thêm danh mục thành công'));
            return redirect()->route('category.index');
        }
        $this->setFlash(__('Thêm danh mục thất bại'));
        return redirect()->route('category.index');
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
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', [
            'category' => $category,
            'title' => 'Sua danh mục'
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
            $category =  $this->category->where('id', $id)->first();
            $category->category_name = $request->category_name;

            $category->save();
            $this->setFlash(__('Cập nhật tin tuyển dụng thành công'));
            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('category.index');
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
        if (Category::destroy($id)) {
            session()->flash('comment', 'Xóa comment thành công!');
            return redirect()->back();
        }
    }
}
