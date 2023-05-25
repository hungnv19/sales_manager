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
    public function index(Request $request)
    {
        $search =  $request->input('search_input');
        if ($search != "") {
            $colors = Color::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
                ->paginate(2);
            $colors->appends(['search_input' => $search]);
        } else {
            $colors = Color::paginate(5);
        }
        // $colors = Color::paginate(5);
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
            return redirect()->route('colors.index')->with('success', 'Thêm màu sắc thành công!');
        } else {
            return redirect()->route('colors.index')->with('failed', 'Thêm màu sắc thất bại!');
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
            return redirect()->route('colors.index')->with('success', 'Cập nhật màu sắc thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('colors.index')->with('failed', 'Cập nhật màu sắc thất bại!');
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
            
            return redirect()->back()->with('success', 'Xóa màu sắc thành công!');
        } else {
            return redirect()->back()->with('failed', 'Xóa màu sắc thất bại!');
        }
    }
}
