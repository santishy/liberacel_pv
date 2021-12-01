<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Category);
        if (request()->wantsJson()) {
            $categoryQuery = Category::query();
            return CategoryResource::collection($categoryQuery->applyFilters()->orderBy('name')->get());
        }
        return view('categories.index');
    }


    public function store(Request $request)
    {

        $this->validateCategory($request);

        $this->authorize('create', new Category);

        return Category::create([
            'name' => $request->name
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function edit(Category $category)
    {

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validateCategory($request);
        return response()->json([
            'updated' => $category->update(request()->except('_method'))
        ]);
    }

    public function validateCategory($request)
    {
        $request->validate(
            [
                'name' => [
                    "required",
                    Rule::unique('categories')->ignore(request()->id)
                ]
            ],
            [
                'name.required' => "El campo categoría es requerido.",
                'name.unique' => "La categoría ya existe en la base de datos."
            ]
        );
    }
    public function destroy(Category $category)
    {
        if ($category->products()->count()) {
            return response()->json([
                'deleted' => false,
                'message' => 'No se puede eliminar, existen productos asociados.'
            ]);
        }

        return response()->json([
            'deleted' => $category->delete()
        ]);
    }
}
