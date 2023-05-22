<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorsController extends BaseController
{
    public Color $color;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Color $color)
    {
        $this->color = $color;
    }
    public function index()
    {
        $colors = Color::get();
        return view('admin.color.index', [
            'colors' => $colors,
            'title' => 'Mau sac'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create', [

            'title' => 'Thêm mau sac'
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
        $color = new Color;
        $color->name = $request->name;

        $color->save();
        if ($color) {
            $this->setFlash(__('Thêm mau sac thành công'));
            return redirect()->route('colors.index');
        }
        $this->setFlash(__('Thêm mau sac thất bại'));
        return redirect()->route('colors.index');
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
        $color = Color::where('id', $id)->first();
        return view('admin.color.edit', [
            'color' => $color,
            'title' => 'Sua mau sac'
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
            $color =  $this->color->where('id', $id)->first();
            $color->name = $request->name;

            $color->save();
            $this->setFlash(__('Cập nhật tin tuyển dụng thành công'));
            return redirect()->route('colors.index');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->setFlash(__('Đã có một lỗi không mong muốn xảy ra'), 'error');
            return redirect()->route('colors.index');
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
        if (Color::destroy($id)) {
            session()->flash('comment', 'Xóa  thành công!');
            return redirect()->back();
        }
    }
}
