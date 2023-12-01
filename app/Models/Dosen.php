<?php

namespace App\Models;

use App\Models\Matakuliah;
use App\Models\Pendidikan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    protected $primaryKey = 'NIP';
    public $incrementing = false;
    public $guarded = ['_token'];
    const UPDATED_AT = null;
    const CREATED_AT = null;

    // public function pendidikan()
    // {
    //     return $this->hasMany(Pendidikan::class);
    // }

    public function matakuliah()
    {
        return $this->belongsToMany('App\Models\Matakuliah', 'dosen_matakuliah', 'dosen_id', 'matakuliah_id');
    }
}
