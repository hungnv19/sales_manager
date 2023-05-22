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
    public function index()
    {
        $sizes = Size::get();
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
            $this->setFlash(__('Thêm kich thuoc thành công'));
            return redirect()->route('sizes.index');
        }
        $this->setFlash(__('Thêm kich thuoc thất bại'));
        return redirect()->route('sizes.index');
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
            $this->setFlash(__('Cập nhật tin tuyển dụng thành công'));
            return redirect()->route('sizes.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('sizes.index');
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
            session()->flash('comment', 'Xóa size thành công!');
            return redirect()->back();
        }
    }
}
