<?php

namespace App\Http\Controllers\places;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\Places\Category as CategoryResource;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    public function index()
    {
        //
        $categories = Category::all();
        return $this->sendResponse(CategoryResource::collection($categories), 'categories retrieved successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:20|unique:categories',           
        ]);
        $request->merge(['admin_id' => Auth::user()->id]);
        $input = $request->all();
        $category= Category::create($input);
        return $this->sendResponse(new CategoryResource($category), 'Category created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        $check = Category::where('id',$category->id)->exists();
        if($check)
        {
         $category = Category::findOrFail($category->id);
        return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully.');

        }
        else
        return response(['success' => 'This category not found']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required|string|max:20|unique:categories',           
        ]);
        $input = $request->all();
        $category->name = $input['name'];
        $category->save();
        return $this->sendResponse(new CategoryResource($category), 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return $this->sendResponse([], 'Student deleted successfully.');

    }
}
