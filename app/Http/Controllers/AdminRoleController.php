<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminRoleController extends Controller
{
   private $role;
   private $permission;
   use DeleteModelTrait;
   public function __construct(Role $role, Permission $permission)
   {
        $this->role = $role;
        $this->permission = $permission;
   }

    public function index()
    {
        $roles = $this->role->all();
        return view('admins.roles.index',compact('roles'));
    }

    public function create()
    {
        $permissionParents = $this->permission->where('parent_id',0)->get();
        return view('admins.roles.add',compact('permissionParents'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $role->getPermissionRole()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roleEdit = $this->role->find($id);
        $permissionList = $this->permission->where('parent_id',0)->get();
        $permissionEdit = $roleEdit->getPermissionRole;
        return view('admins.roles.edit',compact('roleEdit','permissionList','permissionEdit'));
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
             $this->role->find($id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $roleUpdate = $this->role->find($id);
            $roleUpdate->getPermissionRole()->sync($request->permission_id);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Success'
            ], 200);
        }
        catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage().  '--- Line: ' . $exception->getLine());
            return  response()->json([
                'code' => 500,
                'message' => 'Failed'
            ],500);
        }
    }

    public function destroy($id)
    {
        return $this->deleteModelTrait($id,$this->role);
    }
}
