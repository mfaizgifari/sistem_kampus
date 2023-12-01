<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    public $guarded = ['_token'];
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function matakuliah()
    {
        return $this->belongsToMany('App\Models\Matakuliah', 'kelas', 'nim', 'kode_mk');
    }
}
