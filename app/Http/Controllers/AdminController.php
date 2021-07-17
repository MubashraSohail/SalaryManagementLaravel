<?php

namespace App\Http\Controllers;
use App\Models\Userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
public function register(Request $req)
{
    $userprofile=new Userprofile;
    $userprofile->name=$req->name;
    $userprofile->email=$req->email;
    $userprofile->password=Hash::make($req->password);
    $reg_users=userprofile::where('email','=',$userprofile->email)->get();
    if(count($reg_users)>0)
    {
        return response()->json(['message'=>'User is already Registered','error'=>'true']);
    }
    else
    {
        $result=$userprofile->save();
        return response()->json(['message'=>'Registered successfully','error'=>'false']);
    }
}
Public function login(Request $req)
{
    $check=new Userprofile;
    $check->email=$req->email;
    $check->password=$req->password;
    $reg_users=Userprofile::where('email','=', $check->email)
    ->first();
    if($reg_users)
    {
        if(Hash::check($check->password, $reg_users->password))
        {
                return response()->json($reg_users);
        }
        else
        {
            return response()->json(['message'=>'Wrong password for this user','error'=>'true']);
        }
    }
    else
    {
        return response()->json(['message'=>'No user found kindly signup first','error'=>'true']);
    }
}
}
