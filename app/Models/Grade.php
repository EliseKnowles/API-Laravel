<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    /**
     * The attribute that are mass assignable
     * 
     * @var array
     */
    protected $fillable = ['name', 'promotion_year'];

    /**
     * Indicates if the model should be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relationship
     */
    public function students(){
        return $this->hasMany(Student::class);
    }
}

