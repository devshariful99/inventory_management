<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data['admins'] = User::with(['creater'])->latest()->get();
        return view('admin.admin_management.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.admin_management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request): RedirectResponse
    {
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->created_by = Auth::user()->id;
        $admin->save();
        return redirect()->route('admin.index');
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
    public function edit(string $id): View
    {
        $data['admin'] = User::findOrFail(decrypt($id));
        return view('admin.admin_management.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin = User::findOrFail(decrypt($id));
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = $request->password;
        }
        $admin->updated_by = Auth::user()->id;
        $admin->update();
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail(decrypt($id));
        $admin->deleted_by = Auth::user()->id;
        $admin->update();
        $admin->delete();
        return redirect()->route('admin.index');
    }
    /**
     * Change the specified resource status.
     */
    public function status(string $id)
    {
        $admin = User::findOrFail(decrypt($id));
        $admin->status = !$admin->status;
        $admin->updated_by = Auth::user()->id;
        $admin->update();
        return redirect()->route('admin.index');
    }
}