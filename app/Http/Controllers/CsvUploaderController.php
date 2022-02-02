<?php

namespace App\Http\Controllers;

use App\Http\Traits\CsvUploader;
use App\Services\CsvFileService;
use Illuminate\Http\Request;

class CsvUploaderController extends Controller
{

   // Create CSV Uploader Form
   public function show() {
    return view('csv-form');
  }

  // Process and return CSV Data
  public function store(Request $request) {

    if(!isset($request->excel))
       return view('csv-form', ['csv_data' =>[]]);

    // Get the request data and convert it into Array
    $path = $request->file('excel')->getRealPath();
    $csvData = array_map('str_getcsv', file($path));

    // Specify Column
    $columns = ["Date","TransactionNumber","CustomerNumber","Reference","Amount","Verified"];

    // Call CsvFileService to initialize the Column
    $csvFileService = new CsvFileService($columns);

    // Get Processed Data
    $processedData = $csvFileService->getProcessedData($csvData);


    if(count($processedData) > 0) {

        $orderedData = collect($processedData)->sortBy([
            ['Date', 'asc'],
        ]);

        return view('csv-form', ['csv_data' => $orderedData]);
    }

    return view('csv-form', ['csv_data' =>[]]);
  }
}
