<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;


class RoleAndPermissionController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }



   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('roles.index');
    }

    public function  getJSonRolesData(){
        //
        $roles = Role::orderBy('name','ASC')->get();

        $iTotalRecords =count(Role::all());
        $sEcho   = intval(10);
        $records = array();
        $records['data'] = array();
        $count  = 1;
        foreach($roles as $role) {

            $records['data'][] = array(
                $count++,
                $role->name,
                $this->getNumberOfAssignedAdmin($role->id),
                '<span id="'.$role->id.'">
                    <a href="#" title="View Admins available in {$role->role}" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
                 </span>',
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //Find more description here https://github.com/Zizaco/entrust#user
        try {
            $validator = Validator::make($request->all(), [
                'role' => 'required',
                'permission' => 'required'

            ]);

            if (!$validator->fails()){

                    $ids   = array();
                    if ( Role::where('name', '=', $request->role)->count() > 0) {

                      return Response::json(array(
                          'success' => false,
                          'errors' => [
                            'message'=>'Role already registered'
                            ]
                      ), 200);

                    }else {
                      $ids  = [];
                      $role               = new Role();
                      $role->name         = strtolower($request->role);
                      $role->display_name = $request->display_name; // optional
                      $role->description  = $request->description; // optional
                      $role->save();

                      foreach($request->permission as $perm){

                           if ($perm == 'read') {
                            $request->display_name = 'Read Permission';
                            $request->description = 'User can only view';
                           }
                           if ($perm == 'write') {
                            $request->display_name = 'Write Permission';
                            $request->description  = 'User can only view and add data';
                           }
                           if ($perm == 'modify') {
                            $request->display_name = 'Modify Permission';
                            $request->description  = 'User can view, add, and edit data';
                           }
                           if ($perm == 'fullcontrol') {
                            $request->description   = 'User can view, add, edit and delete data';
                            $request->display_name  = 'Full Control Permission';
                           }

                         if (Permission::where('name', '=', $perm)->count() > 0) {

                            $permissionID = $this->getPermissionId($perm);
                            $ids[] = $permissionID;

                          }else{
                            $permission = new Permission();
                            $permission->name         = $perm;
                            $permission->display_name = $request->display_name; // optional
                            $permission->description  = $request->description; // optional
                            $permission->save();
                            $ids[] = $permission->id;
                        }
                    }
                    $role->attachPermissions($ids);
                    }
     return Response::json(array(
                  'success' => true,
                  'errors' => [
                    'message'=>'No Errors'
                    ]
              ), 200);


            } else {

                return Response::json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ), 400);                // 400 being the HTTP code for an invalid request.

            }
        }catch (\Exception $ex){

            return Response::json(array(
                'success' => false,
                'errors' => $ex->getMessage()
            ), 402); // 400 being the HTTP code for an invalid request.
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }

    public function getNumberOfAssignedAdmin($role_id){
        $count   = 0;
        $users = DB::table('role_user')->where('role_id','=',$role_id)->get();
        foreach($users as $user){
                  $count++;
        }
        return $count;
    }

    public function getRoleId($name){

      $roles = Role::where('name', '=', $name)->get();
      $role_id = 0;
      foreach ($roles as $key => $role){
        if($role->id){
          $role_id = $role->id;
          break;
        }
      }
     return $role_id;
    }
    public function getPermissionId($name){

      $permissions = Permission::where('name', '=', $name)->get();
      $permission_id = 0;
      foreach ($permissions as $key => $permission){
        if($permission->id){
          $permission_id = $permission->id;
          break;
        }
      }
     return $permission_id;
    }
}
