<?php

namespace App\Exports;

use App\Models\Student;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Auth;

class StudentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
     public function __construct(int $id) {
        $this->id = $id;
    }

    public function collection()
    {
        $student = Student::select('student.id','firstname','lastname','GENDER.gender','email','phone','address','dob','grade.name','scholarship.money','typepay.typeofpay')
        ->join('GENDER','student.id','=','GENDER.id')
        ->join('grade','idGrade','=','grade.id')
        ->join('scholarship','idScholarship','=','scholarship.id')
        ->join('typepay','idTypepay','=','typepay.id')
        ->orderBy('lastname','ASC')->where('idGrade','=',$this->id)->get();
        $student = $student->push(new Student(['name' => 'Game1', 'color' => 'red']));
        dd($student);
        // die($student);
        // $student = Student::select('lastname')->where('idGrade','=',$this->id)->get();
        return $student;
    }
    public function headings(): array
    {

        return [
            'ID',
            'Firstname',
            'Lastnamee',
            'Gender',
            'Email',
            'Phone',
            'Address',
            'DOB',
            'Grade',
            'Scholarship',
            'TypeOfPay',
            'Status',
        ];
    }
}