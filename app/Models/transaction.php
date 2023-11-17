<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $fillable 
     =
        ['Amount','VAT','Payer','Due_on','Vat_inclusive' , 'status','paid']
     ;
}
