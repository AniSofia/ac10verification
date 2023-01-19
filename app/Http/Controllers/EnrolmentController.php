<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Result;
use App\Models\Enrolment;
use App\Models\Muet;
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
            //dd(request('search_code'));
            $subjects = Subject::all();
            if(request('search_code')){
                $datas = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')->join('users', 'users.id', '=', 'enrolments.user_id')->join('results', 'results.id', '=', 'enrolments.result_id')-> where('subjects.subject_code', '=', request('search_code'))-> orWhere('subjects.sub_name', 'like','%'. request('search_code').'%')-> get(['subjects.subject_code', 'subjects.sub_name', 'subjects.credit_hour', 'results.grade', 'results.status', 'enrolments.sem','enrolments.user_id', 'enrolments.id']);
                }
            else if(request('search_sem')==0){
                $datas = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')->join('users', 'users.id', '=', 'enrolments.user_id')->join('results', 'results.id', '=', 'enrolments.result_id')-> get(['subjects.subject_code', 'subjects.sub_name', 'subjects.credit_hour', 'results.grade', 'results.status', 'enrolments.sem','enrolments.user_id', 'enrolments.id']);
            }
            else if(request('search_sem')) {
                $datas = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')->join('users', 'users.id', '=', 'enrolments.user_id')->join('results', 'results.id', '=', 'enrolments.result_id')-> where('enrolments.sem', '=', request('search_sem'))-> get(['subjects.subject_code', 'subjects.sub_name', 'subjects.credit_hour', 'results.grade', 'results.status', 'enrolments.sem','enrolments.user_id', 'enrolments.id']);
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

    public function addMuet(Request $request)
    {
        $request->validate([
            'band' => 'required',

        ]);

            $muet = new Muet();
            $muet->user_id = Auth::user()->id;
            $muet->band = $request->band;
            $muet->save();

        return redirect()->route('enrolment.create')
            ->with('success','MUET added successfully.');


    }

    public function update(Request $request,Enrolment $enrolment)
    {
        $request->validate([
            'sem' => 'required',
            'subject_id' => 'required',
            'result_id' => 'required',
        ]);

        //$subject_id = Subject::where('subject_code','=', request('subject_code'))->get('id');
        //$result_id = Result::where('grade','=', request('grade'))->get('id');

        //$example = Enrolment::find('id',$id);
        $example = Enrolment::find($enrolment->id);
        $example->user_id = Auth::user()->id;
        $example->subject_id = $request->subject_id;
        $example->result_id = $request->result_id;
        $example->sem = $request->sem;
        $example->save();

        return redirect()->route('enrolment.create')
            ->with('success','Data updated successfully.');
    }

    public function destroy($id)
    {
        //$enrolment->delete();
        Enrolment::where('id', $id)->firstorfail()->delete();
        return redirect()->route('enrolment.create')
        ->with('success','Data deleted successfully');
    }

    public function index()
    {
        return view('home');
    }

}
