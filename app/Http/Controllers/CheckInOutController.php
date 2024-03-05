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
        $employee_result=Employees::where('qr',$id)->get();
        $student_result=Students::where('qr',$id)->get();
        if(!empty($student_result)){
            foreach($student_result as $info){
                $student_id=$info->student_id;
                $grade=$info->level;
                $section=$info->section;
            }
            StudentLogs::create([
                'student_id'=>$student_id,
                'grade'=>$grade,
                'section'=>$section,
                'checked_in'=>date('H:i'),
                'date_created'=>date('Y-d-m'),
            ]);
            return response()->json(['success'=>true,'content'=>$student_result,'clocked'=>date('H:i')]);           
        }
        if(!empty($employee_result)){
            return response()->json(['success'=>true,'content'=>$employee_result]);
        }
        else{
            return response()->json(['success'=>false]);
        }
    }
}
