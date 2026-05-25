<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi massal (mass assignment)
    protected $fillable = [
        'name',      // Nama partner
        'logo_url',  // URL logo partner
    ];
}
