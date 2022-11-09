<?php

namespace App\Http\Controllers\school\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\subcategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        $users = User::all();
        return view('layouts.dashboard.frontend.menu', compact('users','categories', 'subcategories'));
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
        $this->validate($request, [
            'name' => 'required',
            'link_name' => 'nullable',
        ]);
        $input = new category();
        $input->institute_id = $request->Auth::user()->institute_id;
        $input->name = $request->name;
        $input->link_name = $request->link_name;
        $input->save();
        // $categories = category::create($request->all());

        return redirect(route('menu'));
    }

    public function substore(Request $request)
    {
        $this->validate($request, [
            'subcat_name' => 'required',
            'subcat_link' => 'required',
            'cat_id' => 'required',
        ]);

        $input = new subcategory();
        $input->institute_id = Auth::user()->institute_id;
        $input->subcat_name = $request->subcat_name;
        $input->subcat_link = $request->subcat_link;
        $input->cat_id = $request->cat_id;
        $input->save();

        // $subcategories = subcategory::create($request->all());

        return redirect(route('menu'));
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
