<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view account')->only('index');
        $this->middleware('permission:create account')->only(['create', 'store']);
        $this->middleware('permission:edit account')->only(['edit', 'update']);
        $this->middleware('permission:delete account')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::latest()->get();
        return view('admin.account.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|phone|unique:users,phone',
            'password' => 'required|min:6|confirmed',
        ]);


        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : '';

        $data = $request->all();

        if ($image) {
            $data['image'] = $image;
        }
        User::create($data);
        return redirect()->route('admin.accounts.index')->with('success', 'Data Store Successfully');
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
        $data = User::findOrFail($id);
        return view('admin.account.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|phone|unique:phone',
            'password' => 'required|min:6|confirmed',
        ]);


        $data = User::findOrFail($id);
        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : '';

        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $input = $request->all();

        if ($image) {
            $input['image'] = $image;
        }

        $data->update($input);
        return redirect()->route('admin.accounts.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);

        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();
    }
}
