<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view withdraw')->only('index');
        $this->middleware('permission:create withdraw')->only(['create', 'store']);
        $this->middleware('permission:edit withdraw')->only(['edit', 'update']);
        $this->middleware('permission:delete withdraw')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $data = Withdraw::latest()->get();
        return view('admin.withdraw.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.withdraw.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $data = $request->all();
        Withdraw::create($data);
        return redirect()->route('admin.withdraw.index')->with('success', 'Data Store Successfully');
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
        $data = Withdraw::findOrFail($id);
        return view('admin.withdraw.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = Withdraw::findOrFail($id);
        $input = $request->all();

        $data->update($input);
        return redirect()->route('admin.withdraw.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Withdraw::findOrFail($id);
        $data->delete();
    }
}
