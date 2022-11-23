<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\StartupSubcategory;
use Barryvdh\DomPDF\Facade\Pdf;
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

        $path = $request->path;
        $data = $request->studentData;
        $pdfname = $request->pdfname.'.pdf';

        // $allData = '{
        //     "all":{
        //     "data" : "'.$data.'";
        //     "exam" : "'.$exam.'";
        //     }
        // }';
        //     $allData = [];
        //   foreach($request->studentData as $studentData){
        //       $allData[] = [
        //             'data' => $studentData,
        //       ];
        //   }
        //   return $allData;

        // $pdf = new PDF();

        $pdf = Pdf::setOption([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true
        ])->loadView($path, compact('data'));
        $savepath = storage_path('pdf/');
        $der = $pdf->save($savepath . '/' . $pdfname);
        $pdf_path = storage_path('pdf/'.$pdfname);
      
        return response()->download($pdf_path);
        // return $pdf->stream($pdf_path);
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
