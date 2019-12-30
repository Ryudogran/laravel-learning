<?php

namespace App\Exports;

use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelMaker implements FromCollection
{
    public function collection()
    {
        return Employee::all();
    }
}
