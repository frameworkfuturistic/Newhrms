<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\LockableTrait;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use LockableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getDetailsById($id)
    {
        return DB::table('users')
            ->select(
                'users.*',
                'ol.office_name',
                'p.post_title'
            )
            ->leftJoin('master_office_lists as ol', 'ol.office_id', '=', 'users.office_id')
            ->leftJoin('master_posts as p', 'p.post_id', '=', 'users.position')
            ->where('id', $id)
            ->first();
    }

    /**
     * | Get Reporting Authorities
     */
    public function reportingAuthorities()
    {
        return User::select(
            'id',
            'name',
            'emp_id'
        )
            ->get();
    }
}
