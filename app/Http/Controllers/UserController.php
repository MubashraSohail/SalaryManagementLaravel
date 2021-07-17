<?php

namespace App\Http\Controllers;
use App\Models\Userprofile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Salary;
class UserController extends Controller
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
public function addEmployee(Request $req)
{
    $employee=new Employee;
    $employee->first_name=$req->fname;
    $employee->last_name=$req->lname;
    $employee->address=$req->address;
    $employee->city=$req->city;
    $employee->position=$req->position;
    $employee->cnic=$req->cnic;

    $reg_users=employee::where('cnic','=',$employee->cnic)->get();
    if(count($reg_users)>0)
    {
        return response()->json(['message'=>'Employee already added','error'=>'true']);
    }
    else
    {
        $result=$employee->save();
        return response()->json(['message'=>'Employee added sucessfully','error'=>'false']);
    }
}
public function addbank(Request $req)
{
    $account=new Account;
    $account->bank_name=$req->bank_name;
    $account->account_no=$req->account_no;
    $account->bank_branch=$req->bank_branch;
    $account->total_balance=0;
    $bank=account::where('account_no','=',$account->account_no)->get();
    if(count($bank)>0)
    {
        return response()->json(['message'=>'Bank already added','error'=>'true']);
    }
    else
    {
        $result=$account->save();
        return response()->json(['message'=>'Bank added sucessfully','error'=>'false']);
    }
}
public function showaccount(Request $req)
{
    $account= Account::get();
    return $account;
}
public function showasalary(Request $req)
{
    $sal= Salary::get();
    return $sal;
}
public function showemployee(Request $req)
{
    $employee= Employee::get();
    return $employee;
}
function updatebank(Request $req)
{
    
    $update=Account::where('id','=',$req->id)->first(); 
    if($update) 
    {
       
            $status=0;
            if($req->bank_name!=null && $req->bank_name!=$update->bank_name)
            {
                $update->bank_name=$req->bank_name;
                $status++;
            }
            if($req->account_no!=null && $req->account_no!=$update->account_no)
            {
                $update->account_no=$req->account_no;
                $status++;
            }
            if($req->bank_branch!=null && $req->bank_branch!=$update->bank_branch)
            {
                $update->bank_branch=$req->bank_branch;
                $status++;
            }
            if($status!=0)
            {
                $update->save();
                return response()->json(['message'=>'Updated successfully','error'=>'false']);
            }
            else
            {
                return response()->json(['message'=>'Kindly enter updated fields','error'=>'true']);
            }
        }
        else
        {
            return response()->json(['message'=>'bank not found','error'=>'true']);
        }    
} 

function updateprofile(Request $req)
{
    
    $update=Employee::where('id','=',$req->id)->first(); 
    if($update) 
    {
       
            $status=0; //this is for checking that either one of the if statement runs or not == TO PREVENT already saved data stored again and again
            if($req->fname!=null && $req->fname!=$update->first_name)
            //Compare with null and with previously stored data
            {
                $update->first_name=$req->fname;
                $status++;
            }
            if($req->lname!=null && $req->lname!=$update->last_name)
            {
                $update->last_name=$req->lname;
                $status++;
            }
            if($req->cnic!=null && $req->cnic!=$update->cnic)
            {
                $update->cnic=$req->cnic;
                $status++;
            }
            if($req->position!=null && $req->position!=$update->position)
            {
                $update->position=$req->position;
                $status++;
            }
            if($req->city!=null && $req->city!=$update->city)
            {
                $update->city=$req->city;
                $status++;
            }
            if($req->address!=null && $req->address!=$update->address)
            {
                $update->address=$req->address;
                $status++;
            }
            if($status!=0)
            {
                $update->save();
                return response()->json(['message'=>'Updated successfully','error'=>'false']);
            }
            else
            {
                return response()->json(['message'=>'Kindly enter updated Name or Address','error'=>'true']);
            }
        }
        else
        {
            return response()->json(['message'=>'Nnot found','error'=>'true']);
        }    
} 

public function getEmployee(Request $req)
{
    $check=Employee::where("id","=",$req->id)->first();
    if($check)
    {
        return response()->json($check);
    }

}
public function addAmount(Request $req)
{
    $transaction=new Transaction;
   

    $check=Account::where("id","=",$req->id)->first();
    if($check)
    {
        $check->total_balance=$check->total_balance+$req->price;
        $check->save();
        $transaction->bank_name=$check->bank_name;
        $transaction->bank_id=$check->id;
        $transaction->account_no=$check->account_no;
        $transaction->bank_branch=$check->bank_branch;
        $transaction->amount=$req->price;
        $transaction->save();
        return response()->json(['message'=>'Added successfully','error'=>'false']);
    }

}
public function TransactionHistory(Request $req)
{
    $trans=Transaction::where("bank_id","=",$req->id)->get();
    if($trans)
    {
        return response()->json($trans);
    }
}
public function getbank(Request $req)
{
    $check=Account::where("id","=",$req->id)->first();
    if($check)
    {
        return response()->json($check);
    }

}
public function deleteEmployee(Request $req)
{
    $del=Employee::where("id","=",$req->id)->first();
    if($del)
    {
        $del->delete();
        return response()->json(['message'=>'Deleted Successfully','error'=>'false']);
    }

}
public function deletebank(Request $req)
{
    $del=Account::where("id","=",$req->id)->first();
    if($del)
    {
        $del->delete();
        return response()->json(['message'=>'Deleted Successfully','error'=>'false']);
    }

}
public function Salary(Request $req)
{
    $empl=Employee::where("id","=",$req->id)->first();
    $bank=Account::where("id","=",$req->accontid)->first();
    $sal=new Salary;
    $sal->e_name=$empl->first_name;
    $sal->b_name=$bank->bank_name;
    $sal->ac_no=$bank->account_no;
    $sal->salary=$req->salary;
    $bank->total_balance=$bank->total_balance-$req->salary;
    $bank->save();
    $sal->save();
        return response()->json(['message'=>'Salary Paid Sucessfully','error'=>'false']);
    

}
}
