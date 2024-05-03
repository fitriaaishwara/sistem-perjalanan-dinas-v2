<?php

namespace App\Exports;

use App\Models\YourModel; // Replace YourModel with your model name
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class YourExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        // Customize headings according to your Excel template
        return [
            'Header 1',
            'Header 2',
            'Header 3',
            // Add more headings as necessary
        ];
    }
}
