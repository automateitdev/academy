<?php

namespace App\Http\Controllers\dashboard\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\StartupCategory;
use App\Models\StartupSubcategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StartupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startups = Startup::all();
        $startupcats = StartupCategory::all();
        $startupsubcats = StartupSubcategory::all();
        $users = User::all();
        return view('layouts.dashboard.master_setting.startup.index', compact('startups', 'startupcats', 'startupsubcats','users'));
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
    public function store_cat(Request $request)
    {
        $this->validate($request, [
            'startup_category_name' => 'required',
        ]);
        $startupcats = StartupCategory::create($request->all());

        return redirect(route('startup.index'));
    }
    public function store_subcat(Request $request)
    {
        $this->validate($request, [
            'startup_category_id' => 'required',
            'startup_subcategory_name' => 'required',
        ]);
        $startupsubcats = StartupSubcategory::create($request->all());

        return redirect(route('startup.index'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        
        foreach((array)$request->startup_subcategory_id as $key => $startup_subcategory_id)
        {
            $input = new Startup();
            $input->institute_id = Auth::user()->institute_id;
            $input->startup_category_id = $request->startup_category_id;
            $input->startup_subcategory_id = $startup_subcategory_id;
            $input->save(); 
        }
        return redirect(route('startup.index'));
        
    }

    public function getStartupSubCat(Request $request)
    {
        $data = StartupSubcategory::select('startup_subcategory_name', 'id')->where('startup_category_id', $request->id)->get();
        return response()->json($data);
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
        Startup::find($id)->delete();
        return redirect()->back();
    }
}
