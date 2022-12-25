<?php
namespace App\Repository;

interface ISubjectRepository {

    public function getAllSubjects();

    public function getSingleSubject($id);

    public function createSubject(array $data);

    public function editSubject($id);

    public function updateSubject($id, array $data);


}




?>