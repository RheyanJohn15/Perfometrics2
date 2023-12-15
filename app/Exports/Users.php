<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; 
use Maatwebsite\Excel\Concerns\WithColumnFormatting; 
class Users implements FromCollection, ShouldAutoSize, WithColumnFormatting
{
    protected $userData;

    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = $this->userData;

        // Add the headings as the first row.
        $data->prepend(['Fullname', 'Username', 'Password']);

        return $data;
    }

    /**
    * @return string
    */
    public function title(): string
    {
        return 'User Data'; // Set your desired title here.
    }
    public function columnFormats(): array
    {
        return [
            'A' => '@', // Format column A as text
            'B' => '@', // Format column B as text
            'C' => '@', // Format column C as text
        ];
    }
}
