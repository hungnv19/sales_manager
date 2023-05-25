<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizesController extends BaseController
{
    public Size $size;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Size $size)
    {
        $this->size = $size;
    }
    public function index(Request $request)
    {
        $search =  $request->input('search_input');
        if ($search != "") {
            $sizes = Size::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
                ->paginate(2);
            $sizes->appends(['search_input' => $search]);
        } else {
            $sizes = Size::paginate(5);
        }

        return view('admin.size.index', [
            'sizes' => $sizes,
            'title' => 'Kich thuoc'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create', [

            'title' => 'Thêm kich thuoc'
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
        $size = new Size();
        $size->name = $request->name;

        $size->save();
        if ($size) {
            return redirect()->route('sizes.index')->with('success', 'Thêm kích thước thành công!');
        } else {
            return redirect()->route('sizes.index')->with('failed', 'Thêm kích thước thất bại!');
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
        $size = Size::where('id', $id)->first();
        return view('admin.size.edit', [
            'size' => $size,
            'title' => 'Sua kich thuoc'
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
            $size =  $this->size->where('id', $id)->first();
            $size->name = $request->name;

            $size->save();
            return redirect()->route('sizes.index')->with('success', 'Cập nhật kích thước thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('sizes.index')->with('failed', 'Cập nhật kích thước thất bại!');
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
        if (Size::destroy($id)) {
            return redirect()->back()->with('success', 'Xóa sản phẩm thành công!');
        } else {
            return redirect()->back()->with('failed', 'Xóa sản phẩm thất bại!');
        }
    }
}
