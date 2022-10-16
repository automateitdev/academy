<?php

namespace App\Http\Controllers\school\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administration;
use App\Models\subcategory;
use App\Models\User;
use App\Models\Blood;


class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrations = Administration::all();
        $subcategories = subcategory::all();
        $users = User::all();
        return view('layouts.dashboard.frontend.administration.index', compact('users','administrations','subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = subcategory::all();
        $users = User::all();
        $bloods = Blood::all();
        return view('layouts.dashboard.frontend.administration.create', compact('subcategories','users','bloods'));
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
            'subcat_id' => 'required',
            'id_no' => 'nullable',
            'nid' => 'required',
            'name' => 'required',
            'f_name' => 'required',
            'm_name' => 'required',
            'edu' => 'required',
            'sex' => 'required',
            'religion' => 'required',
            'designation' => 'required',
            'birth_date' => 'required',
            'blood' => 'nullable',
            'address' => 'nullable',
            'mobile' => 'required',
            'email' => 'required',
            'join_date' => 'nullable',
            'note' => 'nullable',
            'photo' => 'nullable',
        ]);

        $inputs = new Administration();

        $inputs->subcat_id = $request->subcat_id;
        $inputs->id_no = $request->id_no;
        $inputs->nid = $request->nid;
        $inputs->name = $request->name;
        $inputs->f_name = $request->f_name;
        $inputs->m_name = $request->m_name;
        $inputs->edu = $request->edu;
        $inputs->sex = $request->sex;
        $inputs->religion = $request->religion;
        $inputs->designation = $request->designation;
        $inputs->birth_date = $request->birth_date;
        $inputs->blood = $request->blood;
        $inputs->address = $request->address;
        $inputs->mobile = $request->mobile;
        $inputs->email = $request->email;
        $inputs->join_date = $request->join_date;
        $inputs->note = $request->note;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/admns/',$filename);
            $inputs->photo = $filename;
        }else{
            $inputs->photo = '';
        }
        
        $inputs->save();

    

        return redirect(route('admns.index'));
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
        $administrations = Administration::find($id);
        $subcategories = subcategory::all();
        $users = User::all();
        return view('layouts.dashboard.frontend.administration.edit',compact('administrations','users','subcategories'));
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
        $this->validate($request, [
            'subcat_id' => 'nullable',
            'id_no' => 'nullable',
            'nid' => 'nullable',
            'name' => 'nullable',
            'f_name' => 'nullable',
            'm_name' => 'nullable',
            'edu' => 'nullable',
            'sex' => 'nullable',
            'religion' => 'nullable',
            'designation' => 'nullable',
            'birth_date' => 'nullable',
            'blood' => 'nullable',
            'address' => 'nullable',
            'mobile' => 'nullable',
            'email' => 'nullable',
            'join_date' => 'nullable',
            'note' => 'nullable',
            'photo' => 'nullable',
        ]);

        $inputs = Administration::find($id);

        $inputs->subcat_id = $request->subcat_id;
        $inputs->id_no = $request->id_no;
        $inputs->nid = $request->nid;
        $inputs->name = $request->name;
        $inputs->f_name = $request->f_name;
        $inputs->m_name = $request->m_name;
        $inputs->edu = $request->edu;
        $inputs->sex = $request->sex;
        $inputs->religion = $request->religion;
        $inputs->designation = $request->designation;
        $inputs->birth_date = $request->birth_date;
        $inputs->blood = $request->blood;
        $inputs->address = $request->address;
        $inputs->mobile = $request->mobile;
        $inputs->email = $request->email;
        $inputs->join_date = $request->join_date;
        $inputs->note = $request->note;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/admns/',$filename);
            $inputs->photo = $filename;
        }else{
            $inputs->photo = '';
        }
        
        $inputs->save();

        return redirect(route('admns.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Administration::find($id)->delete();
        return redirect()->back();
    }
}
