<?php

namespace App\Http\Controllers;

use App\Models\Enrolment;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnrolmentController extends Controller
{
    public function index()
    {
        try{
            $enrolments = Enrolment::get();
            return view('enrolment.index', compact ('enrolments'));
        } catch (\Exception $e){
           
            Log::info('show the Enrolment: '. $e->getMessage());
            echo 'Error, call admin';
        }
    
    }

    public function sub_code(Request $request, Subject $subject){

        $request->validate(['code_sub' => 'required']);

        $subject = Subject::where('subject_code', '=', 'subject_code')->get('id');
        //$example->subject_code = $request->subject_code;
        return $subject;

    }

    public function store(Request $request)
    {
        $request->validate([
            'code_sub' => 'required',
            'sem' => 'required',
            'grade' => 'required',
            'status' => 'required',
        ]);

        try{

            $enrolment = new Enrolment();
            $enrolment->user_id = Enrolment::where('user_id',Auth::id())->first();
            $enrolment->code_sub = $request->code_sub;
            $enrolment->sem = $request->sub_name;
            $enrolment->grade = $request->category;
            $enrolment->status = $request->credit_hour;
            $enrolment->save();

        return redirect()->route('subject.index')
            ->with('success','Data created successfully.');

            //code
        } catch (\Exception $e){
            Log::info('Store the Subject: '. $e->getMessage());
            echo 'Error, call admin';
        }
    }
}
