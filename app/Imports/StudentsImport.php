<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Scholarship;
use App\Models\TypePay;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class StudentsImport implements ToCollection, WithHeadingRow

{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.firstname' => 'required|min:2',
            '*.lastname' => 'required|min:2',
            '*.gender' => 'required',
            '*.address' => 'required|min:2',
            '*.phone' => 'required|unique:student|min:8|max:15',
            '*.dob' => 'required',
            '*.grade' => 'required',
            '*.scholarship' => 'required',
            '*.typepay' => 'required',
            '*.email' => 'unique:student|email'
         ])->validate();
        
        foreach ($rows as $row) {
            $idGrade = Grade::select('id')->where('name',$row['grade'])->first();
        $idScholarship = Scholarship::select('id')->where('money',$row['scholarship'])->first();
        $idTypePay = TypePay::select('id')->where('typeofpay',$row['typepay'])->first();
            Student::create([
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'gender' => $row['gender'] == "Male" ? 1:0,
                'email' => $row['email'],
                'phone' => $row['phone'],
                'password' => Hash::make($row['phone']),
                'address' => $row['address'],
                'dob' => $row['dob'],
                'idGrade' => $idGrade->id,
                'idScholarship' => $idScholarship->id,
                'idTypePay' => $idTypePay->id,
            ]);
        }
    }
}