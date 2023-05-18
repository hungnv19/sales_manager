<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends BaseController
{
    public News $new;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(News $new)
    {
        $this->new = $new;
    }

    public function index()
    {
        $news = $this->new->join('categories', 'categories.id', '=', 'news.category_id')
            ->select('news.*', 'categories.category_name as categories_name')
            ->get();
        return view('admin.new.index', [
            'news' => $news,
            'title' => 'Tin tức'
        ]);
    }
    public function blog()
    {
        $news = $this->new->join('categories', 'categories.id', '=', 'news.category_id')
            ->select('news.*', 'categories.category_name as categories_name')
            ->get();
        return view('client.pages.blog', [
            'news' => $news,
            'title' => 'Tin tức'
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

        return view('admin.new.create', [
            'categories' => $category,
            'title' => 'Thêm tin'
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
        $new = new News();
        $new->category_id = $request->category_id;
        $new->title = $request->title;
        $new->describe = $request->describe;

        if ($request->hasFile('image')) {
            $new->image = $request->image->storeAs('public/images', $request->image->hashName());
        }
        $new->save();

        if ($new) {
            $this->setFlash(__('Thêm tin thành công'));
            return redirect()->route('news.index');
        }
        $this->setFlash(__('Thêm tin thất bại'));
        return redirect()->route('news.index');
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
        $new = News::where('id', $id)->first();
        $category = Category::select('id', 'category_name as label')->get();
        return view('admin.new.edit', [
            'new' => $new,
            'title' => 'Sua tin',
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

            $new =  $this->new->where('id', $id)->first();
            $new->category_id = $request->category_id;
            $new->title = $request->title;
            $new->describe = $request->describe;

            if ($request->hasFile('image')) {
                $new->image = $request->image->storeAs('public/images', $request->image->hashName());
            }

            $new->save();
            $this->setFlash(__('Cập nhật  thành công'));
            return redirect()->route('news.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('news.index');
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
        if (News::destroy($id)) {
            session()->flash('comment', 'Xóa  thành công!');
            return redirect()->back();
        }
    }
}
