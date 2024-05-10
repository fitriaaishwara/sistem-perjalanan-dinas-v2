<?php

namespace App\Exports;

use App\Models\DataStaffPerjalanan;
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
        $data = DataStaffPerjalanan::with(['perjalanan.mak', 'staff.instansis', 'penandatangan', 'tujuan_perjalanan.tempatBerangkat', 'spd', 'staff.jabatans', 'staff.golongans', 'perjalanan.kegiatan'])->find($this->id);

        // dd($data);

        // Load template Excel
        $spreadsheet = IOFactory::load($this->templatePath);

        // Masukkan data ke dalam template Excel
        $spreadsheet->getActiveSheet()->setCellValue('H14', $data->staff->name); // Cell 'H14'
        $spreadsheet->getActiveSheet()->setCellValue('H15', $data->staff->golongans->name); // Cell 'H15'
        $spreadsheet->getActiveSheet()->setCellValue('H16', $data->staff->jabatans->name); // Cell 'H15'
        $spreadsheet->getActiveSheet()->setCellValue('H17', $data->spd->tingkat_biaya_perjalanan_dinas); // Cell 'H16'
        $spreadsheet->getActiveSheet()->setCellValue('H19', $data->perjalanan[0]->kegiatan[0]->kegiatan); // Cell 'H17'
        $spreadsheet->getActiveSheet()->setCellValue('H20', $this->getTransportationType($data->spd->alat_angkutan)); // Cell 'H20'
        $spreadsheet->getActiveSheet()->setCellValue('H21', $data->tujuan_perjalanan[0]->tempatBerangkat->name); // Cell 'H19'
        $spreadsheet->getActiveSheet()->setCellValue('H22', $data->tujuan_perjalanan[0]->tempatTujuan->name); // Cell 'H20'
        $spreadsheet->getActiveSheet()->setCellValue('H24', $data->tujuan_perjalanan[0]->lama_perjalanan . ' hari'); // Cell 'H21'
        $spreadsheet->getActiveSheet()->setCellValue('H25',tgl_indo($data->tujuan_perjalanan[0]->tanggal_berangkat)); // Cell 'H22'
        $spreadsheet->getActiveSheet()->setCellValue('H26', tgl_indo($data->tujuan_perjalanan[0]->tanggal_tiba)); // Cell 'H23'
        $spreadsheet->getActiveSheet()->setCellValue('H34', $data->perjalanan[0]->mak->kode_mak); // Cell 'H24'
        $spreadsheet->getActiveSheet()->setCellValue('H42', tgl_indo($data->spd->pada_tanggal)); // Cell 'H25'
        // $spreadsheet->getActiveSheet()->setCellValue('H49', uppercase($data->penandatangan->name)); // Cell 'H26'
        // $spreadsheet->getActiveSheet()->setCellValue('H50', $data->staff->nip); // Cell 'H26'

        // ...

        // Create a temporary file to save the spreadsheet
        $tempFilePath = tempnam(sys_get_temp_dir(), 'spd_export');
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
