<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attribute that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['name', 'start_date', 'end_date', 'teacher_id', 'grade_id'];

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relationship
     * 
     */
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
