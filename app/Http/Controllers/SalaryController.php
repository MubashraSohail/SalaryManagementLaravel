<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Salary;
class SalaryController extends Controller
{

public function showasalary(Request $req)
{
    $sal= Salary::get();
    return $sal;
}

public function TransactionHistory(Request $req)
{
    $trans=Transaction::where("bank_id","=",$req->id)->get();
    if($trans)
    {
        return response()->json($trans);
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
