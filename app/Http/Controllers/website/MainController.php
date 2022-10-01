<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{


    public function getPerson(Request $request)
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        $person = $request->person;
        return view('person', compact('person', 'categories', 'subcategories'));
    }


    public function getTeachers()
    {
        $categories = DB::table("categories")->paginate(10);
        $subcategories = subcategory::all();
        $teacherList = "Here query for teacherList";
        // return $categories;
        return view('teachers', compact('teacherList', 'categories', 'subcategories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        return view('frontend', compact('categories', 'subcategories'));
    }
    public function getSubCat(Request $request)
    {
        $data = subcategory::select('subcat_name', 'subcat_link', 'id')->where('cat_id', $request->id)->take(100)->get();
        return response()->json($data);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
