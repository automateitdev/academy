<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  User::all();
        return view('layouts.admin.institute.index', compact('users'));
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
        $request->validate([
            'institute_id' => 'required',
            'institute_name' => 'required',
            'EIIN_number' => 'required',
            'institute_type' => 'required',
            'edu_board' => 'required',
            'address' => 'required',
            'post_office' => 'required',
            'police_station' => 'required',
            'district' => 'required',
            'division' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $input = new User();
        $input->institute_id = $request->institute_id;
        $input->institute_name = $request->institute_name;
        $input->EIIN_number = $request->EIIN_number;
        $input->institute_type = $request->institute_type;
        $input->edu_board = $request->edu_board;
        $input->address = $request->address;
        $input->post_office = $request->post_office;
        $input->police_station = $request->police_station;
        $input->district = $request->district;
        $input->division = $request->division;
        $input->contact_no = $request->contact_no;
        $input->email = $request->email;
        $input->password = $request->password;
        $input->save();
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
