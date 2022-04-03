<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SalesCsvJob;

class SaleController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }

    public function upload(Request $request)
    {
        if (request()->has('mycsv')) {
            $data = file(request()->mycsv);
            $headerColumns = [];
            $chunckedData = array_chunk($data, 1000);
            foreach ($chunckedData as $key => $saleItem) {
                $data = array_map('str_getcsv', $saleItem);
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                SalesCsvJob::dispatch($data, $header);
            }
            return "Csv Successfully stored into database";
        }
    
        return 'Please upload a CSV file';
    }
}
