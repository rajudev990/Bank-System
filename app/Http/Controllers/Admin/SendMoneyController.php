<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SendMoney;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view sendmoney')->only('index');
        $this->middleware('permission:create sendmoney')->only(['create', 'store']);
        $this->middleware('permission:edit sendmoney')->only(['edit', 'update']);
        $this->middleware('permission:delete sendmoney')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $data = SendMoney::latest()->get();
        return view('admin.send-money.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.send-money.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $data = $request->all();
        SendMoney::create($data);
        return redirect()->route('admin.send-money.index')->with('success', 'Data Store Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SendMoney::findOrFail($id);
        return view('admin.send-money.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = SendMoney::findOrFail($id);
        $input = $request->all();

        $data->update($input);
        return redirect()->route('admin.send-money.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SendMoney::findOrFail($id);
        $data->delete();
    }
}
