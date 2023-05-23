<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    // use HasFactory;
    use SoftDeletes;

    // declare table name
    public $table = 'appointment';

    // this field must type date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // declare fillable fields
    protected $fillable = [
        'doctor_id',
        'user_id',
        'consultation_id',
        'level',
        'date',
        'time',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    //Generate Automatic ID
    public static function pasienGenerateID()
    {
        $id = Appointment::selectRaw('RIGHT (id, 3) AS id')->orderBy('id', 'desc')->limit(1)->get();

        $count = count($id);

        if ($count != null) {
            $idn = $id[0]->id;

            $a = substr($idn, -3);

            $f = $a + 1;

            $final = "APP-00" . $f;
        } else {
            $final = "APP-001";
        }

        return $final;
    }

    public function getDokterFee()
    {
        $results = $this->join('appointment', 'appointment.dokter_id', '=', 'dokter.id_dokter')
            ->select('dokter.fee')
            ->get();

        return $results;
    }
}
