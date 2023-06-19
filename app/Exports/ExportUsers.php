<?php

namespace App\Exports;

//Collection implementation
// use App\Models\User;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class ExportUsers implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return User::all();
//     }
// }


//Array implementation

use Maatwebsite\Excel\Concerns\FromArray;

class ExportUsers implements FromArray
{

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }
}
