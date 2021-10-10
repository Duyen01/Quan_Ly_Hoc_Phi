<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Major;
use App\Models\Course;
use Illuminate\Support\Facades\DB;


class Tuition extends Model
{
    use HasFactory;
    protected $table = 'tuition';
    public $primaryKey = ['idMajor','idCourse'];
    // public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'idMajor', 'idCourse', 'tuitionNorm'
    ];
    public function major(){
        return $this->belongsTo(Major::class,'id','idMajor');
    }
    public function course(){
        return $this->belongsTo(Course::class,'id', 'idCourse');
    }
    public static function getUnUpdatedCourse(){
        $updatedTuition = DB::table('tuition');
        // dd($updatedTuition);
        
        $unUpdatedTuition = DB::table('course')
        ->leftJoinSub($updatedTuition, 'updated_tuition', function($join) {
            $join->on('course.id', '=', 'updated_tuition.idCourse');
        })
        ->where('idCourse', null);       
        
        return $unUpdatedTuition->get();
    }

    public static function getUnUpdatedMajor(){
        $updatedTuition = DB::table('tuition');
        // dd($updatedTuition);
        $unUpdatedTuition = DB::table('major')
        ->leftJoinSub($updatedTuition, 'updated_tuition', function($join) {
            $join->on('major.id', '=', 'updated_tuition.idMajor');
        })
        ->where('idMajor', null);
        
        return $unUpdatedTuition->get();
    }
}
