<?php

namespace App\Http\Controllers\Web;

use App\Exports\Kwitansi1Export;
use App\Exports\Kwitansi2Export;
use App\Exports\SpdBelakangExport;
use App\Http\Controllers\Controller;
use App\Exports\SpdExport;
use App\Exports\SptExport;

class ExportController extends Controller
{
    public function exportToExcelSpd($id)
    {
        $templatePath = public_path('assets/templates/spd.xlsx');
        $export = new SpdExport($id, $templatePath);

        return response()->download($export->view()->getData()['filePath'], 'spd-depan.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function exportToExcelSpdBelakang($id)
    {
        $templatePath = public_path('assets/templates/spd-belakang.xlsx');
        $export = new SpdBelakangExport($id, $templatePath);

        return response()->download($export->view()->getData()['filePath'], 'spd-belakang.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function exportToExcelSpt($id)
    {
        $templatePath = public_path('assets/templates/spt.xlsx');
        $export = new SptExport($id, $templatePath);

        return response()->download($export->view()->getData()['filePath'], 'spt.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function exportToExcelKwitansi1($id)
    {
        $templatePath = public_path('assets/templates/kwitansi1.xlsx');
        $export = new Kwitansi1Export($id, $templatePath);

        return response()->download($export->view()->getData()['filePath'], 'kwitansi-satu.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function exportToExcelKwitansi2($id)
    {
        $templatePath = public_path('assets/templates/kwitansi2.xlsx');
        $export = new Kwitansi2Export($id, $templatePath);

        return response()->download($export->view()->getData()['filePath'], 'kwitansi-dua.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
