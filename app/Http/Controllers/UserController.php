<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public User $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $search =  $request->input('search_input');
        if ($search != "") {
            $user = User::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
            })
                ->paginate(5);
            $user->appends(['search_input' => $search]);
        } else {
            $user = User::paginate(5);
        }
        // $user = User::paginate(5);
        return view('admin.user.index', [
            'users' => $user,
            'title' => 'User'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', [

            'title' => 'Thêm user'
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        if ($user) {
            return redirect()->route('user.index')->with('success', 'Thêm người dùng thành công!');
        } else {
            return redirect()->route('user.index')->with('failed', 'Thêm người dùng thất bại!');
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
        $user = User::where('id', $id)->first();
        return view('admin.user.edit', [
            'user' => $user,
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
            $user =  $this->user->where('id', $id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('user.index')->with('success', 'Cập nhật  thành công!');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('user.index')->with('success', 'Cập nhật  thất bại!');
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
        if (User::destroy($id)) {
            return redirect()->back()->with('success', 'Xóa người dùng thành công!');
        } else {
            return redirect()->back()->with('failed', 'Xóa người dùng thất bại!');
        }
    }
}
