<?php

namespace App\Models;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliah';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';
    public $guarded = ['_token'];
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function dosen()
    {
        return $this->belongsToMany('App\Models\Dosen', 'dosen_matakuliah', 'matakuliah_id', 'dosen_id');
    }

    public function mahasiswa()
    {
        return $this->belongsToMany('App\Models\Mahasiswa', 'kelas', 'kode_mk', 'nim');
    }
}
