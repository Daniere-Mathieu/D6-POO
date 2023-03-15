<?php 

namespace controllers;

use interfaces\IController;

use utils\View;
use models\Teacher;

class TeacherController implements IController {


    public Teacher $model;

    public function __construct() {
        $this->model = new Teacher();
    }

    public function get(int $id) {
        $teacher = $this->model->get($id);
        View::render('teacher', ['teacher' => $teacher]);
    }

    public function getAll() {
        echo 'getAll';
        // $teachers = $this->model->getAll();
        View::render('teachers'/** , ['teachers' => $teachers] */);
    }

    public function create($data) {
        $this->model->create($data);
        View::redirect('/teachers');
    }

    public function update(int $id,$data) {
        $this->model->update($id,$data);
        View::redirect('/teachers');
    }

    public function delete(int $id) {
        $this->model->delete($id);
        View::redirect('/teachers');
    }
}