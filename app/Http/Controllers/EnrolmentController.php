<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Result;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EnrolmentController extends Controller
{
    public function create()
    {
            $users = Auth::user();
            $enrolments = Enrolment::get();
            $results = Result::get();
            //$enrolments = Enrolment::get()->where('user_id',Auth::id())->first();
            $subjects = Subject::all();
            return view('enrolment.create', compact ('enrolments', 'subjects', 'users','results'));

    
    }

    public function getOneEnrolment($enrolment_id, $subject_id, $result_id)
    {


     
        $enrolment = Enrolment::where('subject_id', $subject_id)
                                ->where('result_id', $result_id)
                                ->where('id', $enrolment_id)
                                ->first();
        return view('enrolment.show')->with($enrolment)->with(['subject_id', $subject_id],['result_id', $result_id]);
    }


    public function show(Enrolment $enrolment){
        return view('enrolment.show', ['enrolment' => $enrolment]);
    }
    //{
    //    try{
           // $user_session_enrol = Enrolment::session()->get();
           //$user_session_enrol = Enrolment::auth()->user('id');
           //$user_session_enrol = Auth::user()->id;
    //       $user_session_enrol = Enrolment::where('user_id',Auth::id())->first();
    //       $code_sub_list = Subject::all();
    //        return view('enrolment.index', compact ('enrolments'));
    //    } catch (\Exception $e){
           
    //        Log::info('show the Enrolment: '. $e->getMessage());
    //        echo 'Error, call admin';
    //    }
    
    //}

    public function sub_code(Subject $subject){

       // $request->validate(['code_sub' => 'required']);

        $subject = Subject::where('subject_code', '=', 'subject_code')->get('id');
        //$example->subject_code = $request->subject_code;
        return $subject;

    }

    public function grade_value(){

        if (Enrolment::where('grade', '=', 'A')){
            $pointer = 4.00;
        }
        else if(Enrolment::where('grade', '=', 'A-')){
            $pointer = 3.75;
        }
        else if(Enrolment::where('grade', '=', 'B+')){
            $pointer = 3.50;
        }
        else if(Enrolment::where('grade', '=', 'B-')){
            $pointer = 2.75;
        }
        else if(Enrolment::where('grade', '=', 'C+')){
            $pointer = 2.50;
        }
        else if(Enrolment::where('grade', '=', 'C')){
            $pointer = 2.00;
        }
        else if(Enrolment::where('grade', '=', 'C-')){
            $pointer = 1.75;
        }
        else if(Enrolment::where('grade', '=', 'D+')){
            $pointer = 1.50;
        }
        else if(Enrolment::where('grade', '=', 'D')){
            $pointer = 1.00;
        }
        else if(Enrolment::where('grade', '=', 'F')){
            $pointer = 0.00;
        }

        return $pointer;

    }



    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'result_id' => 'required',
            'sem' => 'required',
        ]);


            //Auth::user()->id
            $enrolment = new Enrolment();
            //$enrolment->user_id = Enrolment::where('user_id',Auth::id())->first();
            //$enrolment->user_id = Auth::user()->id;
            $enrolment->user_id = Auth::user()->id;
            $enrolment->subject_id = $request->subject_id;
            $enrolment->result_id = $request->result_id;
            $enrolment->sem = $request->sem;
            $enrolment->save();

        return redirect()->route('enrolment.create')
            ->with('success','Data created successfully.');


    }

    public function destroy(Enrolment $enrolment)
    {
        $enrolment->delete();
        return redirect()->route('enrolment.create')
        ->with('success','Data deleted successfully');
    }
}
