<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\User;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category_list = Category::all();

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('category_list', compact('new_requests_count'))->with(['category_list'=>$category_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('add_category', compact('new_requests_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'category_name' => 'required',
            'status' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->status = $request->status;
        $category->save();

        \Session::flash('message', 'Successfully Saved!');

        return redirect('/category_list');
    }

    public function editCategory($id){
        $category_info = Category::find($id);

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('edit_category', compact('new_requests_count'))->with(['category_info'=>$category_info]);
    }

    public function updateCategory(Request $request, $id){
        $this->validate(request(), [
            'category_name' => 'required',
            'status' => 'required',
        ]);

        $category_info = Category::find($id);
        $category_info->category_name = $request->category_name;
        $category_info->category_description = $request->category_description;
        $category_info->status = $request->status;
        $category_info->save();

        \Session::flash('message', 'Successfully Updated!');

        return redirect('/category_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
