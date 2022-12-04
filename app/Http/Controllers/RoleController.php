<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;

// use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->withCount('permissions')->get();
        return response()->view('cms.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for update role permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function editRolePermissions(Request $request, Role $role)
    {
        $permissions = Permission::where('guard_name', '=', $role->guard_name)->get();
        $rolePermissions = $role->permissions;
        if (count($rolePermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('assigned', false);
                foreach ($rolePermissions as $rolePermission) {
                    if ($permission->id == $rolePermission->id) {
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }


        return response()->view('cms.roles.role_permission', [
            'permissions' => $permissions,
            'role' => $role
        ]);
    }

    /**
     * Update Role permission.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function updateRolePermissions(Request $request, Role $role)
    {


        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id'
        ]);


        if (!$validator->fails()) {
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            } else {
                $role->givePermissionTo($permission);
            }
            return response()->json([
                'message' => 'Role Updated Successfully'
            ], Response::HTTP_OK);
        } else {

            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'guard_name' => 'required|string|in:admin,user',
            'name' => 'required|string',
        ]);

        if (!$validator->fails()) {
            $role = new Role();
            $role->name = $request->input('name');
            $role->guard_name = $request->input('guard_name');
            $isSaved = $role->save();
            // $role = Role::create($request->all());
            return response()->json(
                ['message' => $isSaved ? 'Save Successfully' : 'Save failed'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {

            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return response()->view('cms.roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'guard_name' => 'required|string|in:user,admin',
        ]);

        if (!$validator->fails()) {
            $role->update($request->all());
            return response()->json(
                ['message' => $role ? 'Save Successfully' : 'Save failed'],
                $role ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $deleted = $role->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted Successfully' : 'Deleted failed'],
            $role ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
