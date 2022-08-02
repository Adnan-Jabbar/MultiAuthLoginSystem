<?php
namespace App\Traits;
use App\Models\Permission;
use App\Models\Role;

/**
 * The trait for roles and permission
 *      
 * @var string
 */
trait HasPermissionsTrait
{
    // Get permissions
    public function getAllPermissions($permission)
    {
        return Permission::whereIn('slug', $permission)->get();
    }

    // Check has permission
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    // Check has role
    public function hasRole(...$roles)
    {
        foreach($roles as $role)
        {
            if($this->roles->contains('slug', $role))
            {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionThroughRole($permissions)
    {
        foreach($permissions->roles as $role)
        {
            if($this->roles->contains($role))
            {
                return true;
            }
        }
        return false;
    }

    // Give permission
    public function givePermissionTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions == null)
        {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }


}
