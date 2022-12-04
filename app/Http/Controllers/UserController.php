<?php

namespace App\Http\Controllers;

use App\Mail\UserWelcomeEmail;
use App\Models\City;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        $users = User::with(['city'])->withCount('permissions')->get(); // to get them with city , before it make sure you have done realtions 
        return response()->view('cms.users.index', [
            'users' => $users
        ]);
    }

    public function editUserPermissions(Request $request, User $user)
    {
        $permissions = Permission::where('guard_name', '=', 'user')
            ->orWhere('guard_name', 'user-api')->get();
        $userPermissions = $user->permissions;
        if (count($userPermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('assigned', false);
                foreach ($userPermissions as $userPermission) {
                    if ($permission->id == $userPermission->id) {
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }
        return response()->view('cms.users.user_permission', [
            'permissions' => $permissions,
            'user' => $user
        ]);
    }

    public function updateUserPermissions(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',

        ]);
        if (!$validator->fails()) {
            // $permission = Permission::findById($request->input('permission_id', 'user')); // this is good but you must put guard name for permission
            $permission = Permission::findOrFail($request->input('permission_id')); // this is good but you must put guard name for permission
            if ($user->hasPermissionTo($permission)) {
                $user->revokePermissionTo($permission);
            } else {
                $user->givePermissionTo($permission);
            }
            return response()->json([
                'message' => 'User Permission Updated Successfully'
            ], Response::HTTP_OK);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where('active', '=', true)->get(['*']);
        return response()->view('cms.users.create', [
            'cities' => $cities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'city_id' => 'required|numeric|exists:cities,id'
        ]);
        $request['password'] = Hash::make('password');
        if (!$validator->fails()) {
            $user = User::create($request->all());
            if ($user) {
                Mail::to($user)->send(new UserWelcomeEmail($user));
            }
            return response()->json([
                'message' => $user ? 'Saved Successfully' : 'Save Failed'
            ], $user ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.users.edit', [
            'user' => $user,
            'cities' => $cities
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id, // you shuold give the user id to exclude his email in unique condition
            'city_id' => 'required|numeric|exists:cities,id'
        ]);

        if (!$validator->fails()) {
            $updated =    $user->update($request->all());
            return response()->json([
                'message' => $updated ? 'Updated Successfully' : 'Updated Failed'
            ], $user ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $deleted = $user->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted!' : 'Deleted Failed',
            'text' => $deleted ? 'user deleted successfully!' : 'user deleting failed',
            'icon' => $deleted ? 'success' : 'error'
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
