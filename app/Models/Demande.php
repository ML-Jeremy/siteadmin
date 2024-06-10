<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable =[
        'userId',
        'type_demande',
        'fichier',
        'statut',
        'commentaire',
        'created_at',
        'updated_at'
    ];
}
