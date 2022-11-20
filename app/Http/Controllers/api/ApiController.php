<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\StartupCategory;
use App\Models\Paymentupdate;
use App\Models\Payapply;
use App\Models\StartupSubcategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
// use Mpdf\Mpdf as PDF;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

class ApiController extends Controller
{
    public function dataupdate(Request $request)
     {
        $ipndata=
        '{
            "Tranid": "'.$request->data['trax_id'].'",
            "StatusCode": "'.$request->data['status'].'",
            "Message": "'.$request->data['msg'].'"
            }';
        return $ipndata;
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function generate_pdf(Request $request)
    {
        $startup_subcategory = Startup::select('startup_subcategory_id')->where('id', $request->exam_id)->first();

        $exam_name = StartupSubcategory::select('startup_subcategory_name')->where('id',$startup_subcategory->startup_subcategory_id)->first();
        $exam = $exam_name->startup_subcategory_name;
        $path = $request->path;
        $data = $request->studentData;
        $pdfname = $request->pdfname.'.pdf';

        $allData = '{
            data : "'.$data.'";
            exam : "'.$exam.'";
        }';

        // $pdf = new PDF();
        $pdf = PDF::loadView($path, compact('allData'));

        $savepath = storage_path('pdf/');
        $der = $pdf->save($savepath . '/' . $pdfname);
        $pdf_path = storage_path('pdf/'.$pdfname);
        
        return response()->download($pdf_path);
    }

    public function index()
    {
        //
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
