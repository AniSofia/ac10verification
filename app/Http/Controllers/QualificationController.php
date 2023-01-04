<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Result;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class QualificationController extends Controller
{
    public function operation(){
        $users = Auth::id();
        $results = Result::get();
        $subjects = Subject::get('id');
        $enrolments = Enrolment::get();

        $university = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category', '=','university')
        ->where('results.pointer','>=', 1.00)
        ->sum('subjects.credit_hour');

        $core = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category', '=','core')
        ->where('results.pointer','>=', 1.00)
        ->sum('subjects.credit_hour');

        $core_important = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category', '=','core important')
        ->where('results.pointer','>=', 2.00)
        ->sum('subjects.credit_hour');

        $total_core = $core + $core_important;

        $elective = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category', '=','elective')
        ->where('results.pointer','>=', 1.00)
        ->sum('subjects.credit_hour');

        $curriculum = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        //->where('subjects.category', '=','curriculum')
        ->whereIn('subjects.subject_code',['KOKO1','KOKO2','KOKO3'])
        ->where('results.pointer','>=', 1.00)
        ->sum('subjects.credit_hour');

        $curriculum_uniform = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->whereIn('subjects.subject_code',[
            'PALAPES I',
            'PALAPES II',
            'PALAPES III',
            'PALAPES IV',
            'PALAPES V',
            'PALAPES VI',
            'SUKSIS I',
            'SUKSIS II',
            'SUKSIS III',
            'SUKSIS IV',
            'SUKSIS V',
            'SUKSIS VI',
            'SISPA I',
            'SISPA II',
            'SISPA III',
            'SISPA IV',
            'SISPA V',
            'SISPA VI'])
        ->where('results.pointer','>=', 1.00)
        ->sum('subjects.credit_hour');

        
        //$enrol_core =  Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        //->join('users', 'users.id', '=', 'enrolments.user_id')
        //->join('results', 'results.id', '=', 'enrolments.result_id')
        //->where('enrolments.user_id','=',$users)
        //->whereIn('subjects.category',['core important','core'])
        //->get('subjects.id');

        $enrol_core =  Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category','=','core')
        ->where('results.pointer','>=', 1.00)
        ->get('subjects.id');

        $enrol_core_important = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category', '=','core important')
        ->where('results.pointer','>=', 2.00)
        ->get('subjects.id');

        $list_core = Subject::whereIn('subjects.category',['core important','core'])
        ->whereNotIn('id',$enrol_core)
        ->whereNotIn('id',$enrol_core_important)
        ->get(['id','subject_code', 'sub_name','credit_hour']);

        $enrol_elective = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category', '=','elective')
        ->where('results.pointer','>=', 1.00)
        ->get('subjects.id');

        $list_elective = Subject::where('category', '=','elective')
        ->whereNotIn('id',$enrol_elective)
        ->get(['id','subject_code', 'sub_name','credit_hour']);

        $enrol_uni = Enrolment::join('subjects','subjects.id', '=', 'enrolments.subject_id')
        ->join('users', 'users.id', '=', 'enrolments.user_id')
        ->join('results', 'results.id', '=', 'enrolments.result_id')
        ->where('enrolments.user_id','=',$users)
        ->where('subjects.category', '=','university')
        ->get('subjects.id');

        $list_uni = Subject::where('category', '=','university')
        ->whereNotIn('id',$enrol_uni)
        ->get(['id','subject_code', 'sub_name','credit_hour']);
        
        
        return view('qualification.operation', compact ('enrolments', 'subjects','users','results', 'university', 'core', 'elective', 'curriculum','curriculum_uniform', 'core_important','total_core','list_core','list_uni', 'list_elective'));
    }
}
