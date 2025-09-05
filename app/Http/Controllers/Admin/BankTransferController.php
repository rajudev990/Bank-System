<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use App\Models\User;
use Illuminate\Http\Request;

class BankTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view banktransfer')->only('index');
        $this->middleware('permission:create banktransfer')->only(['create', 'store']);
        $this->middleware('permission:edit banktransfer')->only(['edit', 'update']);
        $this->middleware('permission:delete banktransfer')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BankTransfer::latest()->get();
        return view('admin.bank-tranfer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=User::where('status',1)->get();
        return view('admin.bank-tranfer.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $data = $request->all();
        BankTransfer::create($data);
        return redirect()->route('admin.bank-transfer.index')->with('success', 'Data Store Successfully');
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
        $data = BankTransfer::findOrFail($id);
        $user=User::where('status',1)->get();
        return view('admin.bank-tranfer.edit', compact('data','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = BankTransfer::findOrFail($id);
        $input = $request->all();

        $data->update($input);
        return redirect()->route('admin.bank-transfer.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BankTransfer::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data Delete Successfully');
    }
}
