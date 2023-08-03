<?php

namespace App\Models;

use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasPermissions;

    protected $fillable = ['name', 'guard_name'];

    // Relation avec les utilisateurs
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
