<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\RolePermission;
use Carbon\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware(RolePermission::class . ':admins view', only: ['create']),
            new Middleware(RolePermission::class . ':admins create', only: ['store']),
            new Middleware(RolePermission::class . ':admins update', only: ['update']),
            new Middleware(RolePermission::class . ':admins delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $update = null;
        $src = $request->src;
        $uid = $request->uid ? decrypt($request->uid) : null;

        $items = Permission::orderBy('id', 'desc');

        if (isset($src)) {
            $items = $items->where('name', 'like', "%$src%");
        }

        if (isset($uid)) {
            $update = Permission::where('id', $uid)->first();
        }
        $items = $items->get();

        return view('permission.permission', compact('items', 'update'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $permission = ['view', 'create', 'store', 'edit', 'update', 'delete'];
        foreach ($permission as $perm) {
            Permission::updateOrInsert(
                [
                    'name' => Str::lower($request->name) . ' ' . $perm,
                ],
                [
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                ],
            );
        }

        flash()->success('Permission inserted successfully..');
        return Redirect::route('permission.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $permission = Permission::findOrFail($request->id);
        $permission->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        flash()->success('Permission updated successfully..');
        return Redirect::route('permission.create');
    }

    /**
     * Destroy the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $permission = Permission::findOrFail($id);
        $permission->delete();

        flash()->success('Permission deleted successfully..');
        return Redirect::route('permission.create');
    }
}
