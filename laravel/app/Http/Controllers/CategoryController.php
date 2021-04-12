<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * getValidator
     *
     */
    protected function getValidator($data)
    {   
        return Validator::make($data, [
            'name'   => ['required'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('category')
        ->select('category.id', 'category.name', 'category.info')
        ->whereNull('deleted_at')
        ->get();          
        return response()->json( compact('category') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        
        $category = DB::table('category')
        ->select('category.id', 'category.name', 'category.info')
        ->where('category.id', '=', $id)
        ->first();
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $category = null;
        if($id != ''){
            $category = DB::table('category')
            ->select('category.id', 'category.name', 'category.info')
            ->where('category.id', '=', $id)
            ->first();
        }
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            return response()->json( [
                'status' => 'error',
                'errors' => $validator->getMessageBag()->toArray()]
            );
        } else {  
            $id = $request->input('id');
            $category = Category::find($id);
            $category->name            = $request->input('name');
            $category->info            = $request->input('info');
            $category->save();
            return response()->json( ['status' => 'success'] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');

        $category = Category::find($id);
        if($category){
            $category->delete();
        }
        return response()->json( ['status' => 'success'] );
    }

    /**
     * [store]
     * @param  Request $request
     * @return
     */
    public function store(Request $request){
        $data = $request->all();
        $validator = $this->getValidator($data);
        if ($validator->fails()) {
            return response()->json( [
                'status' => 'error',
                'errors' => $validator->getMessageBag()->toArray()]
            );
        } else {
            $category = new Category();
            $category->name            = $request->input('name');
            $category->info            = $request->input('info'); 
            $category->save();
            return response()->json( ['status' => 'success'] );
        }
    }
}