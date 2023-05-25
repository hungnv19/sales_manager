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

    public function index(Request $request)
    {
        $search =  $request->input('search_input');
        if ($search != "") {
            $news = News::where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('describe', 'like', '%' . $search . '%');
            })
                ->paginate(2);
            $news->appends(['search_input' => $search]);
        } else {
            $news = $this->new->join('categories', 'categories.id', '=', 'news.category_id')
                ->select('news.*', 'categories.category_name as categories_name')
                ->paginate(5);
        }

        return view('admin.new.index', [
            'news' => $news,
            'title' => 'Tin tức'
        ]);
    }
    public function blog()
    {
        $news = $this->new->join('categories', 'categories.id', '=', 'news.category_id')
            ->select('news.*', 'categories.category_name as categories_name')
            ->paginate(6);
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

            return redirect()->route('news.index')->with('success', 'Thêm tin thành công!');
        } else {
            return redirect()->route('news.index')->with('failed', 'Thêm tin thất bại!');
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
            return redirect()->route('news.index')->with('success', 'Cập nhật tin thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('news.index')->with('failed', 'cập nhật tin thất bại!');
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
            return redirect()->back()->with('success', 'Xóa tin thành công!');
        } else {
            return redirect()->back()->with('failed', 'Xóa tin thất bại!');
        }
    }
}
