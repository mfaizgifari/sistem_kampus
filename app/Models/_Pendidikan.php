<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendidikan extends Model
{
    use HasFactory;
    protected $table = 'riwayatpendidikan';
    public $guarded = ['id', '_token'];
    protected $foreignKey = 'dosen_NIP';
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
