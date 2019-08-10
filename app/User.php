<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'bio', 'email', 'password',
    ];

    protected $appends = ['name', 'gravatar', 'membersince', 'allpermissions', 'roleid', 'issuperadmin'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://www.gravatar.com/avatar/$hash";
    }

    public function getMembersinceAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getNameAttribute()
    {
        return sprintf('%s %s', $this->attributes['first_name'], $this->attributes['last_name']);
    }

    public function getRoleidAttribute()
    {
        return $this->roles()->count() ? $this->roles()->first()->id : '';
    }

    public function getAllpermissionsAttribute()
    {
        return $this->getAllPermissions()->pluck('name');
    }

    public function getIssuperadminAttribute()
    {
        return env('SUPER_ADMIN_ROLE_NAME') && $this->hasRole(env('SUPER_ADMIN_ROLE_NAME'));
    }
}
