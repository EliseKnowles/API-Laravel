<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attribute that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['name', 'firstname', 'age', 'arrival_year', 'grade_id'];

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relationship
     */
    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function marks(){
        return $this->hasMany(Mark::class);
    }
}
