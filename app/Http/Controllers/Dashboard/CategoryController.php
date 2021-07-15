<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::when($request->search,function ($q) use ($request){

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(5);
        return view('dashboard.categories.home',compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale){

            $rules += [$locale . '.*' => 'required'];
            $rules += [$locale . 'name' => [Rule::unique('category_translations')]];

        }
        $request->validate($rules);

        Category::create($request->all());
        session()->flash('success', __('site.add_successfully'));
        return redirect()->route('dashboard.categories.index');
    }



    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));

    }


    public function update(Request $request, Category $category)
    {

        $rules = [];
        foreach (config('translatable.locales') as $locale){

            $rules += [$locale . '.*' => 'required'];
            $rules += [$locale . '.name' => [Rule::unique('category_translations')->ignore($category->id,'category_id')]];

        }
        $request->validate($rules);


        $category->update($request->all());
        session()->flash('success', __('site.edit_successfully'));
        return redirect()->route('dashboard.categories.index');
    }


    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success',__('site.delete_successfully'));
        return redirect()->route('dashboard.categories.index');
    }
}
