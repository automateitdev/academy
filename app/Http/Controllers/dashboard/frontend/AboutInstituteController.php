<?php

namespace App\Http\Controllers\dashboard\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AboutInstitute;
use Illuminate\Support\Facades\Auth;

class AboutInstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('institute_id', Auth::user()->institute_id)->get();
        $aboutinstitue = AboutInstitute::where('institute_id', Auth::user()->institute_id)->first();
        return view('layouts.dashboard.frontend.institute.index', compact('users', 'aboutinstitue'));
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
        $this->validate($request,[
            'description' => 'required',
            'image' => 'required'
        ]);

        $input = new AboutInstitute();

        $input->institute_id = Auth::user()->institute_id;
        $input->description = $request->description;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/about_institute/',$filename);
            $input->image = $filename;
        }else{
            $input->image = '';
        }
        $input->save();

        return redirect(route('aboutinstitute.index'));
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
        $users = User::where('institute_id', Auth::user()->institute_id)->get();
        $aboutinstitue = AboutInstitute::find($id);
        return view('layouts.dashboard.frontend.institute.edit', compact('users','aboutinstitue'));
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
        $this->validate($request,[
            'description' => 'nullable',
            'image' => 'nullable'
        ]);

        $input = AboutInstitute::find($id);

        $input->description = $request->description;

        if(!empty($request->file('image'))){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/about_institute/',$filename);
            $input->image = $filename;
        }
        $input->save();

        return redirect(route('aboutinstitute.index'));
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
