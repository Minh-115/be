<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
  private $user;
  private $role;
  public function __construct(User $user)
  {
    $this->user=$user;
  }
  public function index(){
   $users =  $this->user->paginate(5);
    return view('admin.user.index',compact('users'));
  }
  public function create(){
   
    return view('admin.user.add');
    }
    public function store(UserAddRequest $request)
    {
      try{
        DB::beginTransaction();
       User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'role' => 'staff',
            'password'=>bcrypt($request->password),      
        ]); 
        DB::commit();
        return redirect()->route('users.index');

      }
      catch(Exception $excpt){
          DB::rollBack();
            Log::error('Message:' . $excpt->getMessage(). 'Line--' . $excpt->getLine());
      }

    }
}
