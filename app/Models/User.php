<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'no_tlp',
        'password',
        'alamat',
        'profile_pict',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }

    public function transactions()
    {
        return $this->hasManyThrough(transaksi::class, Appointment::class, 'user_id', 'appointment_id', 'id');
    }
    public static function generateID()
    {
        $latestUser = User::select('id')->orderBy('id', 'desc')->first();

        if ($latestUser) {
            $lastID = substr($latestUser->id, 3); // Mengambil angka di belakang "AK-"
            $newID = (int) $lastID + 1;
            $paddedID = str_pad($newID, 3, '0', STR_PAD_LEFT); // Menambahkan nol di depan jika angka kurang dari 3 digit
            $final = "AK-" . $paddedID;
        } else {
            $final = "AK-001";
        }

        return $final;
    }


    public static function deleteImage($id)
    {
        $id = User::where('id', $id)->get();

        $count = count($id);

        if ($count != null) {
            $img = (string) $id[0]->profile_pict;
            $filepath = public_path('/img/account/' . $img);
            //dd($id);
            if (file_exists($filepath) == 1) {
                unlink($filepath);
            }
        }
    }
}
