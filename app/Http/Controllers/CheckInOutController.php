<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeLogs;
use App\Models\StudentLogs;
use App\Models\Students;
use App\Models\Employees;

class CheckInOutController extends Controller
{
    public function checkIn($id){
        date_default_timezone_set('Asia/Manila');
        $employee_result=Employees::where('qr',$id)->first();
        $student_result=Students::where('qr',$id)->first();
        if(!empty($student_result)){
            $message=$this->handleStudentCheckEvent($student_result); 
            return response()->json([
                'success'=>true,
                'content'=>$student_result,
                'message'=>$message
            ]);      
        }
        if(!empty($employee_result)){
            $message=$this->handleEmployeeCheckEvent($employee_result);
            return response()->json([
                'success'=>true,
                'content'=>$employee_result,
                'message'=>$message
            ]);  
        }
        else{
            return response()->json(['success'=>false]);
        }
    }
    private function handleStudentCheckEvent($s_i){
        date_default_timezone_set('Asia/Manila');
        $student_log=StudentLogs::where('student_id',$s_i->student_id)
        ->where('date_created',date('Y-d-m'))
        ->first();
        $student_log_out=StudentLogs::where('student_id',$s_i->student_id)
        ->where('date_created',date('Y-d-m'))
        ->whereNotNull('checked_out')
        ->first();
        if($student_log_out){
            return "You have already clocked out";
        }
        if($student_log){
            StudentLogs::where('student_id',$s_i->student_id)
            ->update([
                'checked_out'=>date('H:i')
            ]);
            return ["Clocked-Out On ".date('H:i'),"Goodbye"];
        }
        StudentLogs::create([
            'student_id'=>$s_i->student_id,
            'grade'=>$s_i->level,
            'section'=>$s_i->section,
            'checked_in'=>date('H:i'),
            'date_created'=>date('Y-d-m')
        ]);
        return ["Clocked-In On ".date('H:i'),"Welcome Home"];
    }
    private function handleEmployeeCheckEvent($e_i){
        date_default_timezone_set('Asia/Manila');
        $employee_log=EmployeeLogs::where('employee_id',$e_i->employee_id)
        ->where('date_created',date('Y-d-m'))
        ->first();
        $employee_log_out=EmployeeLogs::where('employee_id',$e_i->employee_id)
        ->where('date_created',date('Y-d-m'))
        ->whereNotNull('checked_out')
        ->first();
        if($employee_log_out){
            return "You have already clocked out";
        }
        if($employee_log){
            EmployeeLogs::where('employee_id',$e_i->employee_id)
            ->update([
                'checked_out'=>date('H:i')
            ]);
            return "Clocked-Out On ".date('H:i');
        }
        EmployeeLogs::create([
            'employee_id'=>$e_i->employee_id,
            'role'=>$e_i->position,
            'checked_in'=>date('H:i'),
            'date_created'=>date('Y-d-m')
        ]);
        return ["Clocked-In On ".date('H:i'),"Welcome Home"];
    }
}
