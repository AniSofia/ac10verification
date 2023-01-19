<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    public function index()
{
    try{
        $subjects = Subject::get();
        if(request('search_code')){
            $subjects = Subject::where('subject_code', '=', request('search_code'))-> orWhere('sub_name', 'like','%'. request('search_code').'%')-> get();
            }
        return view('subject.index', compact ('subjects')); //Routing Model Binding
    } catch (\Exception $e){
       
        Log::info('show the Subject: '. $e->getMessage());
        echo 'Error, call admin';
    }

}
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required',
            'sub_name' => 'required',
            'category' => 'required',
            'credit_hour' => 'required',
        ]);

        try{

            $subject = new Subject();
            $subject->subject_code = $request->subject_code;
            $subject->sub_name = $request->sub_name;
            $subject->category = $request->category;
            $subject->credit_hour = $request->credit_hour;
            $subject->save();

        return redirect()->route('subject.index')
            ->with('success','Data created successfully.');

            //code
        } catch (\Exception $e){
            Log::info('Store the Subject: '. $e->getMessage());
            echo 'Error, call admin';
        }
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.index')
        ->with('success','Data deleted successfully');
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_code' => 'required',
            'sub_name' => 'required',
            'category' => 'required',
            'credit_hour' => 'required',
        ]);

        $example = Subject::find($subject->id);
        $example->subject_code = $request->subject_code;
        $example->sub_name = $request->sub_name;
        $example->category = $request->category;
        $example->credit_hour = $request->credit_hour;
        $example->save();

        return redirect()->route('subject.index')
            ->with('success','Data updated successfully.');
    }


}
