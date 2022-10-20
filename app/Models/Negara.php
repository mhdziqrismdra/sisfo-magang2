<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;
    protected $table = 'master_negara';
    protected $primaryKey = 'id';
    protected $fillable = ['kode_negara', 'nama_negara'];
}
