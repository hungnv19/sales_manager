<?php

namespace App\Http\Controllers;

use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public Order $order;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index(Request $request)
    {

        $search =  $request->input('search_input');
        if ($search != "") {
            $orders = Order::where(function ($query) use ($search) {
                $query->where('sub_total', 'like', '%' . $search . '%')
                    ->orWhere('due', 'like', '%' . $search . '%');
            })
                ->paginate(2);
            $orders->appends(['search_input' => $search]);
        } else {
            $orders = $this->order->join('users', 'users.id', '=', 'orders.user_id')
                ->select('orders.*', 'users.name as user_name')
                ->paginate(10);
        }
        return view('client.order.index', [
            'orders' => $orders,
            'title' => 'Order'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->where('order_details.order_id', $id)
            ->select('products.product_name', 'products.product_code', 'products.image', 'order_details.*')
            ->get();


        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', 'users.id')
            ->where('orders.id', $id)
            ->select('users.name', 'users.phone', 'users.address', 'orders.*')
            ->first();
        return view('client.order.detail', [
            'details' => $details,
            'orders' => $orders,
            'title' => 'Chi tiet don hang',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Order::destroy($id)) {
            return redirect()->back()->with('success', 'Xóa thành công!');
        } else {
            return redirect()->back()->with('failed', 'Xóa tin thất bại!');
        }
    }



    public function orderDetails($id)
    {
        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->where('order_details.order_id', $id)
            ->select('products.product_name', 'products.product_code', 'products.image', 'order_details.*')
            ->get();
        return response()->json($details);
    }
}
