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
        $categories = Category::paginate(5);
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
            return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công !');
        } else {
            return redirect()->route('category.index')->with('failed', 'Thêm danh mục thất bại !');
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
            return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công !');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thất bại !');
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
            return redirect()->back()->with('success', 'Xóa danh mục thành công !');
        } else {
            return redirect()->back()->with('failed', 'Xóa danh mục thất bại !');
        }
    }
}
