<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Rules\MatchOldPassword;
use App\Traits\DeleteModelTrait;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    use DeleteModelTrait;

    private $user;
    private $role;
    private $permission;

    public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
        $this->middleware('auth');
    }

    public function index()
    {
        $users = $this->user->latest('id')->get();
        return view('admins.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admins.user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $roleIds = $request->role_id;
            $user->roles()->attach($roleIds);
            DB::commit();
            return redirect()->route('users.index');
            // foreach ($roleIds as $roleId){
            //     DB::table('role_user')->insert([
            //         'user_id' => $user->id,
            //         'role_id' => $roleId
            //     ]);
            // }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $userEdit = $this->user->find($id);
        $roles = $this->role->all();
        $roleUserEdit = $userEdit->roles;
        return view('admins.user.edit', compact('userEdit', 'roles', 'roleUserEdit'));
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $user = $this->user->find($id);
            $roleIds = $request->role_id;
            $user->roles()->sync($roleIds);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Success'
            ], 200);

            // foreach ($roleIds as $roleId){
            //     DB::table('role_user')->insert([
            //         'user_id' => $user->id,
            //         'role_id' => $roleId
            //     ]);
            // }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Failed'
            ], 500);
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->user);
    }

    public function showFormResetPassword(Request $request, $id)
    {
        $user = $this->user->find($id);
        return view('admins.user.reset-password', compact('request', 'user'));
    }

    //reset password for all users (only admin)
    public function resetPassword(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Auth::user()->id;
            $validator = Validator::make($request->all(), [
                'password' => 'required | min:6',
                'confirm_password' => 'required | same:password',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            else{
                $this->user->find($id)->update(['password' => Hash::make($request->password)]);
                DB::commit();
                return response()->json(['success' => 'Success']);
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--Line: ' . $exception->getLine());
        }
    }

    public function profile()
    {
        $userRole = Auth::user()->roles;

        return view('admins.user.profile', compact('userRole'));
    }

    //change your own password
    public function changePassword(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'current_password' => [
                            'required',
                            function ($attribute,$value,$fail){
                                if(!Hash::check($value, Auth::user()->password)){
                                    $fail('The current password is invalid');
                                }
                            },
                    ] ,
                'password' => 'required | min:6',
                'confirm_password' => 'required | same:password',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            else {
                $this->user->find(Auth::user()->id)->update(['password' => Hash::make($request->password)]);
                DB::commit();
                return response()->json(['success' => 'Success']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--Line: ' . $exception->getLine());
        }
    }
}

