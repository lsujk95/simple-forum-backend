<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $created_at
 * @property integer $updated_at
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const APP_CONTROLLERS_DIR = 'App\\Http\\Controllers\\';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function groups(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    /**
     * Returns the array of user roles
     * @return mixed
     */
    public function getRoles(): array
    {
        $roles = DB::table('roles')
            ->select('roles.id')
            ->distinct()
            ->join('group_role', 'group_role.role_id', '=','roles.id')
            ->join('group_user', 'group_user.group_id', '=','group_role.group_id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->where('users.id', $this->id)
            ->get();

        return $roles->map(function ($item) {
            return $item->id;
        })->toArray();
    }

    /**
     * Returns the array of user actions
     * @return mixed
     */
    public function getActions(): array
    {
        $actions = DB::table('actions')
            ->select('actions.id')
            ->distinct()
            ->join('action_role', 'action_role.action_id', '=','actions.id')
            ->join('group_role', 'group_role.role_id', '=','action_role.role_id')
            ->join('group_user', 'group_user.group_id', '=','group_role.group_id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->where('users.id', $this->id)
            ->get();

        return $actions->map(function ($item) {
            return $item->id;
        })->toArray();
    }


    /**
     * Checks if user has indicated role
     * @param $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        return DB::table('roles')
            ->distinct()
            ->join('group_role', 'group_role.role_id', '=','roles.id')
            ->join('group_user', 'group_user.group_id', '=','group_role.group_id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->where('roles.id', $role)
            ->where('users.id', $this->id)
            ->exists();
    }

    /**
     * Checks if user has indicated action
     * @param $action
     * @return bool
     */
    public function hasAction($action): bool
    {
        return DB::table('actions')
            ->distinct()
            ->join('action_role', 'action_role.action_id', '=','actions.id')
            ->join('group_role', 'group_role.role_id', '=','action_role.role_id')
            ->join('group_user', 'group_user.group_id', '=','group_role.group_id')
            ->join('users', 'users.id', '=', 'group_user.user_id')
            ->where('actions.id', $action)
            ->where('users.id', $this->id)
            ->exists();
    }
}
