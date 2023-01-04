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
            //dd(request('search'));
            $subjects = Subject::all();
            if(request('search')==0){
            $datas = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')->join('users', 'users.id', '=', 'enrolments.user_id')->join('results', 'results.id', '=', 'enrolments.result_id')-> get(['subjects.subject_code', 'subjects.sub_name', 'subjects.credit_hour', 'results.grade', 'results.status', 'enrolments.sem','enrolments.user_id', 'enrolments.id']);
            }
            else if(request('search')) {
                $datas = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')->join('users', 'users.id', '=', 'enrolments.user_id')->join('results', 'results.id', '=', 'enrolments.result_id')-> where('enrolments.sem', '=', request('search'))-> get(['subjects.subject_code', 'subjects.sub_name', 'subjects.credit_hour', 'results.grade', 'results.status', 'enrolments.sem','enrolments.user_id', 'enrolments.id']);
            }

            //if(request('search')){
               //$datas->where('enrolments.sem', '=', request('search'));
            //}
            return view('enrolment.create', compact ('enrolments', 'subjects', 'users','results','datas'));

    
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

    public function destroy($id)
    {
        //$enrolment->delete();
        Enrolment::where('id', $id)->firstorfail()->delete();
        return redirect()->route('enrolment.create')
        ->with('success','Data deleted successfully');
    }

}
