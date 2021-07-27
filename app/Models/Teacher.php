<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attribute that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['name', 'firstname', 'arrival_year'];

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relationship
     */
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
}
