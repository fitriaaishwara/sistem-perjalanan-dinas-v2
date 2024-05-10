<?php

namespace App\Exports;

use App\Models\DataStaffPerjalanan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kwitansi1Export implements FromView
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
        $data = DataStaffPerjalanan::with(['staff', 'perjalanan.mak', 'tujuan_perjalanan.uangHarian', 'spd', 'kwitansi', 'transportasi_berangkat', 'transportasi_pulang', 'akomodasi_hotel'])->find($this->id);

        // dd($data);

        // Load template Excel
        $spreadsheet = IOFactory::load($this->templatePath);

        // Masukkan data ke dalam template Excel
        $spreadsheet->getActiveSheet()->setCellValue('E2', $data->perjalanan[0]->mak->kode_mak); // Cell 'H14'
        $spreadsheet->getActiveSheet()->setCellValue('E3', $data->kwitansi[0]->bukti_kas_nomor); // Cell 'H15'
        $spreadsheet->getActiveSheet()->setCellValue('E4', $data->kwitansi[0]->tahun_anggaran); // Cell 'H15'
        $spreadsheet->getActiveSheet()->setCellValue('E5', $data->kwitansi[0]->sudah_diterima_dari); // Cell 'H16'
        $spreadsheet->getActiveSheet()->setCellValue('E6', $data->perjalanan[0]->kegiatan[0]->kegiatan); // Cell 'H17'
        $spreadsheet->getActiveSheet()->setCellValue('E7', $data->tujuan_perjalanan[0]->tempatBerangkat->name); // Cell 'H19'
        $spreadsheet->getActiveSheet()->setCellValue('E8', $data->tujuan_perjalanan[0]->tempatTujuan->name); // Cell 'H20'
        $spreadsheet->getActiveSheet()->setCellValue('E9', $data->tujuan_perjalanan[0]->lama_perjalanan . ' hari'); // Cell 'H21'
        $spreadsheet->getActiveSheet()->setCellValue('E10',tgl_indo($data->tujuan_perjalanan[0]->tanggal_berangkat)); // Cell 'H22'
        $spreadsheet->getActiveSheet()->setCellValue('E11', tgl_indo($data->tujuan_perjalanan[0]->tanggal_tiba)); // Cell 'H23'
        $spreadsheet->getActiveSheet()->setCellValue('E12', $data->perjalanan[0]->mak->kode_mak); // Cell 'H24'
        $spreadsheet->getActiveSheet()->setCellValue('E13', tgl_indo($data->spd->pada_tanggal)); // Cell 'H25'
        // $spreadsheet->getActiveSheet()->setCellValue('H49', uppercase($data->penandatangan->name)); // Cell 'H26'
        // $spreadsheet->getActiveSheet()->setCellValue('H50', $data->staff->nip); // Cell 'H26'

        // ...

        // Create a temporary file to save the spreadsheet
        $tempFilePath = tempnam(sys_get_temp_dir(), 'kwitansi1_export');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Return the path to the temporary file
        return view('export')->with('filePath', $tempFilePath);
    }
}
