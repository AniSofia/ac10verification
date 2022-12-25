<?php

namespace App\Http\Controllers;

use App\Repository\ISubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public $subject;

    public function __construct(ISubjectRepository $subject) {
        $this->subject = $subject;
    }



    public function index()
    {
        // return all subjects

        $subjects =  $this->subject->getAllSubjects();

        return view('subject.index')->with('subjects', $subjects);

    }

    public function show($id)
    {
        // get single subject

        $subject = $this->subject->getSingleSubject($id);
        return view('subject.show')->with('subject', $subject);
    }


    public function create()
    {

        // create page
        return view('subject.create');
    }


    public function store(Request $request)
    {

        // validate and store data
        $request->validate([
            'subject_code' => 'required',
            'sub_name' => 'required',
            'category' => 'required',
            'credit_hour' => 'required',
        ]);

        $data = $request->all();

        $this->subject->createSubject($data);

        return redirect('/subjects');

    }





    public function edit($id)
    {
        $subject = $this->subject->editSubject($id);
        return view('subject.edit')->with('subject', $subject);
    }


    public function update(Request $request, $id)
    {

        // validate and store data
        $request->validate([
            'subject_code' => 'required',
            'sub_name' => 'required',
            'category' => 'required',
            'credit_hour' => 'required',
        ]);

        $data = $request->all();


        $this->subject->updateSubject($id, $data);

        return redirect('/subjects');

    }

}
