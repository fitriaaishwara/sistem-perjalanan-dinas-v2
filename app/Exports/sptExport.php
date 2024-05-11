<?php

namespace App\Exports;

use App\Models\DataStaffPerjalanan;
use App\Models\Spt;
use App\Models\Tujuan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SptExport implements FromView
{
    protected $id;
    protected $templatePath;

    public function __construct($id, $templatePath)
    {
        $this->id = $id;
        $this->templatePath = $templatePath;
    }

    public function view(): View
    {
        // Ambil data berdasarkan ID
        $data = Tujuan::with(['perjalanan', 'spt', 'staff', 'staff.staff'])->find($this->id);
        $spt = Spt::where('id_tujuan', $this->id)->first();
        $dataStaff= DataStaffPerjalanan::with(['staff','perjalanan', 'tujuan_perjalanan'])->where('id_tujuan_perjalanan', $data->id)->get();

        // dd($data);

        // Load template Excel
        $spreadsheet = IOFactory::load($this->templatePath);

        // Masukkan data ke dalam template Excel
        $spreadsheet->getActiveSheet()->setCellValue('E8', $data->nomor_spt); // Cell 'H14'
        $spreadsheet->getActiveSheet()->setCellValue('E24', $data->perjalanan->kegiatan[0]->kegiatan); // Cell 'H15'
        $spreadsheet->getActiveSheet()->setCellValue('E27', $data->tempatTujuan->name); // Cell 'H15'
        $spreadsheet->getActiveSheet()->setCellValue('G29', tgl_indo($data->tanggal_berangkat)); // Cell 'H16'
        $spreadsheet->getActiveSheet()->setCellValue('G30', tgl_indo($data->tanggal_kembali)); // Cell 'H17'
        $spreadsheet->getActiveSheet()->setCellValue('I39', tgl_indo($spt->dikeluarkan_tanggal)); // Cell 'H20'
        $spreadsheet->getActiveSheet()->setCellValue('F47', $data->spt[0]->staff_penandatangan->name); // Cell 'H19'
        $spreadsheet->getActiveSheet()->setCellValue('F48', $data->spt[0]->staff_penandatangan->nip); // Cell 'H19'

        // ...

        // Create a temporary file to save the spreadsheet
        $tempFilePath = tempnam(sys_get_temp_dir(), 'spt_export');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Return the path to the temporary file
        return view('export')->with('filePath', $tempFilePath);
    }

    protected function getTransportationType($alatAngkutan)
    {
        switch ($alatAngkutan) {
            case 1:
                return 'Pesawat';
                break;
            case 2:
                return 'Kereta Api';
                break;
            case 3:
                return 'Kapal Laut';
                break;
            case 4:
                return 'Kendaraan Dinas';
                break;
            case 5:
                return 'Kendaraan Pribadi';
                break;
            case 6:
                return 'Angkutan Umum';
                break;
            default:
                return 'Lainnya';
        }
    }
}
