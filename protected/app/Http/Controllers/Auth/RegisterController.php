<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
    public function index(){
       return view('auth.index');
    }

    public function getJsonAdmins(){
        $users  = User::orderBy('first_name','ASC')->get();;

        $iTotalRecords =count(User::all());
        $sEcho = intval(10);
        $records = array();
        $records["data"] = array();
        $count   = 1;
        foreach($users as $user) {

            $records["data"][] = array(
                $count++,
                $user->first_name.' '.$user->last_name,
                $user->email,
                $this->getRoleName($user->id),
                Date('d M Y',strtotime($user->last_login)),
                '<span id="'.$user->id.'">
                    <a href="#" title="View more Admins details" class="btn btn-icon-only"> <i class="fa fa-eye text-primary" aria-hidden="true"></i> View more details</a>
                   </span>'
            );
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $roles  = Role::All();
       return view('auth.register', compact('roles'));
    }



    /*
     *Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'      => 'required|string|email|max:255|unique:users',
                'role'       => 'required',
                'password'   => 'required|string|min:6|confirmed',
            ]);
            if (!$validator->fails()){
                $user             =  new User();
                $dt               = Carbon::now();
                $user->first_name =  $request->first_name;
                $user->last_name  =  $request->last_name;
                $user->email      =  $request->email;
                $user->password   =  bcrypt($request->password);
                //$user->role       =  $request->role;
                $user->last_login =  $dt->toDateString();
                $user->save();

                // or eloquent's original technique
                $user->roles()->attach($request->role); // id only

             return Response::json(array(
                    'success' => true,
                    'data' => User::All()
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

  public function getRoleName($user_id){
      $role_id = 0;
      $users = DB::table('role_user')->where('user_id','=',$user_id)->get();
      foreach($users as $user){
            $role_id = $user->role_id;
      }
      $role = Role::find($role_id);
    return $role->name;
  }


}
