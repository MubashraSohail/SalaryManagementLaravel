<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
class EmployeeController extends Controller
{

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
public function showemployee(Request $req)
{
    $employee= Employee::get();
    return $employee;
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
public function deleteEmployee(Request $req)
{
    $del=Employee::where("id","=",$req->id)->first();
    if($del)
    {
        $del->delete();
        return response()->json(['message'=>'Deleted Successfully','error'=>'false']);
    }

}
}
