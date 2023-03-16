<?php

namespace controllers;

use interfaces\IController;

use utils\View;
use models\Teacher;
use Utils\Database;

class TeacherController implements IController
{


    public Teacher $model;

    public function __construct()
    {
        $this->model = new Teacher();
    }

    public function get(int $id)
    {
        $pdo = Database::getPDO();

        $teacher = $this->model->get($pdo, $id);
        View::render('teacher', ['teacher' => $teacher]);
    }

    public function getAll()
    {
        $pdo = Database::getPDO();
        $teachers = $this->model->getAll($pdo);
        print_r($teachers);
        View::render(
            'teachers'
            /** , ['teachers' => $teachers] */
        );
    }

    public function create($data)
    {
        $pdo = Database::getPDO();
        $this->model->insert($pdo, $data);
        View::redirect('/teachers');
    }

    public function update(int $id, $data)
    {
        $pdo = Database::getPDO();
        //$this->model->update($id,$data);
        View::redirect('/teachers');
    }

    public function delete(int $id)
    {
        $pdo = Database::getPDO();

        $this->model->delete($pdo, $id);
        View::redirect('/teachers');
    }
}
