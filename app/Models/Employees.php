<?php

namespace App\Models;

use App\Models\languages;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    public $table="Employees";
    //relation
    public function lang()
    {
        $this->belongsTo(Languages::class,"Languages.id","Employees.language_known");
    }
}
