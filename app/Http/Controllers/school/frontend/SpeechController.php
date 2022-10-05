<?php

namespace App\Http\Controllers\school\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Speech;


class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $speeches = Speech::all();
        $designations = Designation::all();
        return  view('layouts.dashboard.frontend.speech.index', compact('designations', 'speeches'));
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
        // dd($request->all());
        $this->validate($request, [
            'institute_id' => 'required',
            'name' => 'required',
            'designation_id' => 'required',
            'message' => 'required',
            'pro_img' => 'required',
        ]);

        $speeches = new Speech();
        
        $speeches->institute_id = $request->institute_id;
        $speeches->name = $request->name;
        $speeches->designation_id = $request->designation_id;
        $speeches->message = $request->message;

        if($request->hasFile('pro_img')){
            $file = $request->file('pro_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/speech/',$filename);
            $speeches->pro_img = $filename;
        }else{
            $speeches->pro_img = '';
        }
        
        $speeches->save();

        return redirect(route('speech.index'));
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
