<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Transaction;
class BankController extends Controller
{
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
public function getbank(Request $req)
{
    $check=Account::where("id","=",$req->id)->first();
    if($check)
    {
        return response()->json($check);
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
}
