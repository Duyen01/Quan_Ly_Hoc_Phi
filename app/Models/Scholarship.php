<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;
    protected $table = 'scholarship';
    public $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = [
        'money'
    ];
    public function student(){
        return $this->hasMany(Student::class,'idStudent', 'id');
    }
}
