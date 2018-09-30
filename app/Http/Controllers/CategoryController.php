<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Categories
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);

        //Return collection
        return CategoryResource::collection($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        // GET CATEGORY
        $category = Category::findOrFail($id);

        // RETURN SINGLE CATEGORY AS A Resources
        return new CategoryResource($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $request->isMethod('Put') ? Category::findOrFail
        ($request->category_id) : new Category;

        $category->id = $request->input('category_id');
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        if ($category->save()) {
          return new CategoryResource($category);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // GET CATEGORY
      $category = Category::findOrFail($id);

      // DELETE
      if ($category->delete()) {
        return new CategoryResource($category);
      }
    }
}
