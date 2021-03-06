<?php


namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;

class PhoneImport implements ToModel
{

    public function model(array $row)
    {
        // TODO: Implement model() method.

        return [
            "msisdn" => $row[0]
        ];
    }
}
