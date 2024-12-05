<?php

namespace App\Http\Controllers\Admin\ProductManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductManagement\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $data['cats'] = Category::with(['creater'])->latest()->get();
        return view('admin.product_management.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.product_management.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $cat = new Category();
        $cat->name = $request->name;
        $cat->slug = $request->slug;
        $cat->description = $request->description;
        $cat->created_by = Auth::user()->id;
        $cat->save();
        session()->flash('success', 'Category created successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $data = Category::with(['creater', 'updater'])->findOrFail(decrypt($id));
        $data->getStatus = $data->getStatus();
        $data->getStatusClass = $data->getStatusClass();
        $data->getStatusTitle = $data->getStatusTitle();
        $data->created_time = date('d M, Y', strtotime($data->created_at));
        $data->updated_time = $data->created_at != $data->updated_at ? date('d M, Y', strtotime($data->updated_at)) : "NULL";
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data['cat'] = Category::findOrFail(decrypt($id));
        return view('admin.product_management.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $cat = Category::findOrFail(decrypt($id));
        $cat->name = $request->name;
        $cat->slug = $request->slug;
        $cat->description = $request->description;
        $cat->updated_by = Auth::user()->id;
        $cat->update();
        session()->flash('success', 'Category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat = Category::findOrFail(decrypt($id));
        $cat->deleted_by = Auth::user()->id;
        $cat->update();
        $cat->delete();
        session()->flash('success', 'Category deleted successfully');
        return redirect()->route('category.index');
    }
    /**
     * Change the specified resource status.
     */
    public function status(string $id)
    {
        $cat = Category::findOrFail(decrypt($id));
        $cat->status = !$cat->status;
        $cat->updated_by = Auth::user()->id;
        $cat->update();
        session()->flash('success', 'Category status changed successfully');
        return redirect()->route('category.index');
    }
}
