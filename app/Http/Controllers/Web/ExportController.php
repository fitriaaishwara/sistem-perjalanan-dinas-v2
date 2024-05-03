<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\YourExport;
use App\Models\DataStaffPerjalanan;

class ExportController extends Controller
{
    public function exportToExcel()
    {
        // Retrieve data from the database
        $data = DataStaffPerjalanan::with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan', 'spd'])->get();

        // Export to Excel using the customized template
        return Excel::download(new YourExport($data), 'data.xlsx');
    }
}
