<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['chasis_nr', 'model', 'firm', 'motor_hours'];

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}

