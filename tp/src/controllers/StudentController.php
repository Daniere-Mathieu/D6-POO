<?php

namespace controllers;


use interfaces\IController;
use models\Student;
use utils\View;
use utils\{Logger, Verification};

class StudentController implements IController
{


    public Student $model;

    public function __construct()
    {
        $this->model = new Student();
    }

    public function get(int $id)
    {
        try {
            $student = $this->model->get($id);
            View::render('student/card', ['student' => $student]);
            Logger::logAction('Teacher ' . $student->getFirstname() . ' ' . $student->getName() . ' has been consulted with id: ' . $student->getId());
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            View::render('error/error', ['error' => $th->getMessage()]);
            throw $th;
        }
    }

    public function getAll()
    {
        try {
            $students = $this->model->getAll();
            View::render(
                'student/index',
                ['students' => $students]
            );
            Logger::logAction('All students have been consulted');
        } catch (\Throwable $th) {
            logger::logError($th->getMessage());
            View::render('error/error', ['error' => $th->getMessage()]);
            throw $th;
        }
    }

    public function create($data)
    {
        try {
            $this->model->insert($data);
            View::redirect('/students');
            Logger::logAction('Teacher ' . $data['firstname'] . ' ' . $data['name'] . ' has been created');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());;
            throw $th;
        }
    }

    public function update(int $id, $data)
    {
        try {
            $keys = ['name', 'firstname', 'email'];
            $this->model->update($id, $data, $keys);
            View::redirect('/students');
            Logger::logAction('Teacher ' . $data['firstname'] . ' ' . $data['name'] . ' has been updated with id: ' . $id);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function delete(int $id)
    {
        try {
            $this->model->delete($id);
            View::redirect('/students');
            Logger::logAction('Teacher with id: ' . $id . ' has been deleted');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function login($data)
    {
        try {
            $student = $this->model->getByEmail($data['email']);
            if ($student) {
                if (password_verify($data['password'], $student->getPassword())) {
                    $_SESSION['logged'] = true;
                    View::redirect('/students');
                }
            } else {
                View::redirect('/student/log');
            }
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function log()
    {
        try {

            if (Verification::isLogged()) {
                View::redirect('/students');
            } else {
                View::render('student/login');
            }
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function logout()
    {
        try {
            session_destroy();
            View::redirect('/students');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function getAllTeachersJson()
    {
        try {
            $students = $this->model->getAll();
            $openTeacher = [];
            foreach ($students as $student) {
                $student->destroyPrivateProperties();
                $openTeacher[] = $student->getJSONEncode();
            }
            echo json_encode($openTeacher);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }
}
