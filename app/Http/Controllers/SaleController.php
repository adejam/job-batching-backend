<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SalesCsvJob;
use Illuminate\Support\Facades\Bus;
use DB;

class SaleController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }
    
    public function upload(Request $request)
    {
        if ($request->has('mycsv')) {
            $data = file(request()->mycsv);
            $headerColumns = [];
            $chunckedData = array_chunk($data, 1000);
            $batch  = Bus::batch([])->dispatch();
            foreach ($chunckedData as $key => $saleItem) {
                $data = array_map('str_getcsv', $saleItem);
                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new SalesCsvJob($data, $header));
            }
            return $batch;
        }
    
        return 'Please upload a CSV file';
    }

    public function batch($id)
    {
        return Bus::findBatch($id);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }
}
