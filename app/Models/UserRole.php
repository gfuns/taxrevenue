<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public function permissions()
    {
        return $this->hasMany('App\Models\UserPermission', 'role_id');
    }

    public function totalPermissions()
    {
        $totalPermissions = PlatformFeature::count();
        return $totalPermissions;
    }

    public function featurePermission($feature)
    {
        $permission = UserPermission::where("role_id", $this->id)->where("feature_id", $feature)->first();
        if (isset($permission)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function createPermission($feature)
    {
        $permission = UserPermission::where("role_id", $this->id)->where("feature_id", $feature)->first();
        return $permission->can_create;
    }

    public function EditPermission($feature)
    {
        $permission = UserPermission::where("role_id", $this->id)->where("feature_id", $feature)->first();
        return $permission->can_edit;
    }

    public function DeletePermission($feature)
    {
        $permission = UserPermission::where("role_id", $this->id)->where("feature_id", $feature)->first();
        return $permission->can_delete;
    }
}
