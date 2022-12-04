<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    public function __construct()
    {

        $this->authorizeResource(Admin::class, 'admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('roles')->withCount('roles')->get();
        return response()->view('cms.admins.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name', '=', 'admin')->get();
        return response()->view('cms.admins.create', [
            'roles' => $roles
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
            'email' => 'required|email|unique:admins,email',
            'role_id' => 'required|numeric|exists:roles,id',


        ]);

        $request['password'] = Hash::make('password');
        if (!$validator->fails()) {
            // $admin = Admin::create($request->all());
            $admin =  Admin::create($request->except(['role_id']));

            // $admin = new Admin();
            // $admin->name = $request->input('name');
            // $admin->email = $request->input('email');
            // $admin->password = $request['password'];
            // $save =  $admin->save();
            if ($admin->saved($admin)) {
                $admin->assignRole(Role::findOrFail($request->input('role_id')));
            }
            return response()->json([
                'message' => $admin ? 'Saved Successfully' : 'Save Failed'
            ], $admin ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::where('guard_name', '=', 'admin')->get();
        return response()->view('cms.admins.edit', [
            'admin' => $admin,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'role_id' => 'required|numeric|exists:roles,id',

        ]);
        if (!$validator->fails()) {
            $admin->update($request->except(['role_id']));
            if ($admin->updated($admin)) {
                $admin->syncRoles(Role::findOrFail($request->input('role_id')));
            }
            return response()->json([
                'message' => $admin ? 'Saved Successfully' : 'Save Failed'
            ], $admin ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {

        $deleted = $admin->delete();
        return response()->json([
            'title' => $deleted ? 'Deleted!' : 'Deleted Failed',
            'text' => $deleted ? 'admin deleted successfully!' : 'admin deleting failed',
            'icon' => $deleted ? 'success' : 'error'
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
