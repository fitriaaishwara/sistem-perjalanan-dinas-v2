<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataStaffPerjalanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SpdExport;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ExportSpdController extends Controller
{
    public function exportToExcel($id)
    {
        $templatePath = public_path('assets/templates/spd.xlsx');
        $export = new SpdExport($id, $templatePath);

        return response()->download($export->view()->getData()['filePath'], 'spd-depan.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
