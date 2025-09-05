<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class DeporitController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view deposit')->only('index');
        $this->middleware('permission:create deposit')->only(['create', 'store']);
        $this->middleware('permission:edit deposit')->only(['edit', 'update']);
        $this->middleware('permission:delete deposit')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $data = Deposit::latest()->get();
        return view('admin.deposit.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=User::where('status',1)->get();
        return view('admin.deposit.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $data = $request->all();
        Deposit::create($data);
        return redirect()->route('admin.deposit.index')->with('success', 'Data Store Successfully');
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
        $data = Deposit::findOrFail($id);
        $user=User::where('status',1)->get();
        return view('admin.deposit.edit', compact('data','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = Deposit::findOrFail($id);
        $input = $request->all();

        $data->update($input);
        return redirect()->route('admin.deposit.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Deposit::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data Delete Successfully');
    }
}
