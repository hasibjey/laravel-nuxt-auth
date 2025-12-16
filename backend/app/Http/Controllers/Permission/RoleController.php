<?php

namespace App\Http\Controllers\Permission;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\RolePermission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(RolePermission::class . ':roles view', only: ['create']),
            new Middleware(RolePermission::class . ':roles create', only: ['store']),
            new Middleware(RolePermission::class . ':roles update', only: ['update']),
            new Middleware(RolePermission::class . ':roles delete', only: ['destroy']),
        ];
    }

    /**
     * Display the list of roles and permissions.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $update = null;
        $updatePermissions = null;
        $src = $request->src;
        $uid = $request->uid ? decrypt($request->uid) : null;

        $permissions = Permission::orderBy('name', 'desc')->get();

        $items = Role::orderBy('name', 'desc');

        if ($src) {
            $items = $items->where('name', 'like', '%' . $src . '%');
        }

        if ($uid) {
            $update = Role::find($uid);
            $updatePermissions = $update->permissions->pluck('name')->toArray();
        }

        $items = $items->get();

        return view('permission.role', compact('items', 'update', 'permissions', 'updatePermissions'));
    }

    /**
     * Store the new role and assign permissions.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
        ]);

        $role = Role::create([
            'name' => Str::lower($request->name),
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
        ]);

        if (isset($request->permission)) {
            $role->syncPermissions($request->permission);
        }

        flash()->option('timeout', 1500)->success('Role added successfully..');
        return Redirect::route('role.create');
    }

    /**
     * Update the existing role and assign permissions.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        // Find the role
        $role = Role::findOrFail($request->id);

        // Validate the name
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $request->id . ',id'],
        ]);

        // Update role name
        $role->name = Str::lower($request->name);
        $role->save();

        // Sync permissions safely
        if (isset($request->permission) && is_array($request->permission)) {
            // Filter permissions that exist for 'admin' guard
            $validPermissions = Permission::whereIn('name', $request->permission)
                ->where('guard_name', 'web')
                ->pluck('name')
                ->toArray();

            $role->syncPermissions($validPermissions);
        } else {
            $role->syncPermissions([]);
        }

        flash()->option('timeout', 1500)->success('Role updated successfully.');
        return Redirect::route('role.create');
    }

    // Delete the specified role.
    public function destroy($id)
    {
        $id = decrypt($id);
        $role = Role::findOrFail($id);
        $role->delete();
        flash()->option('timeout', 1500)->success('Role deleted successfully');
        return Redirect::route('role.create');
    }
}
