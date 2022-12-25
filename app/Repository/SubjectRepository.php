<?php

namespace App\Repository;

use App\Models\Subject;

class SubjectRepository implements ISubjectRepository {

    public function getAllSubjects()
    {
       return Subject::all();
    }

    public function getSingleSubject($id)
    {


        return  Subject::find($id);

        //return Subject::with('enrolments')->get();

        //return Subject::with('enrolments')->find($id);
    }

    public function createSubject(array $data)
    {


        $subject = new Subject();
        $subject->subject_code = $data['subject_code'];
        $subject->sub_name= $data['sub_name'];
        $subject->category = $data['category'];
        $subject->credit_hour = $data['credit_hour'];


        $subject->save();

    }

    public function editSubject($id)
    {
        return Subject::find($id);
    }

    public function updateSubject($id, array $data)
    {
       Subject::find($id)->update([
            'subject_code' => $data['subject_code'],
            'sub_name' => $data['sub_name'],
            'category' => $data['category'],
            'credit_hour' => $data['credit_hour']
        ]);
    }

}



?>