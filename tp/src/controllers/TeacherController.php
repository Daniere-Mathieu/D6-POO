<?php

namespace controllers;

use interfaces\IController;

use utils\View;
use models\Teacher;
use utils\{Database, Logger, Verification};

class TeacherController implements IController
{


    public Teacher $model;

    public function __construct()
    {
        $this->model = new Teacher();
    }

    public function get(int $id)
    {
        try {
            $pdo = Database::getPDO();
            $teacher = $this->model->get($pdo, $id);
            View::render('teacher/card', ['teacher' => $teacher]);
            Logger::logAction('Teacher ' . $teacher->getFirstname() . ' ' . $teacher->getName() . ' has been consulted with id: ' . $teacher->getId());
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            View::render('error/error', ['error' => $th->getMessage()]);
            throw $th;
        }
    }

    public function getAll()
    {
        try {
            $pdo = Database::getPDO();
            $teachers = $this->model->getAll($pdo);
            View::render(
                'teacher/index',
                ['teachers' => $teachers]
            );
            Logger::logAction('All teachers have been consulted');
        } catch (\Throwable $th) {
            logger::logError($th->getMessage());
            View::render('error/error', ['error' => $th->getMessage()]);
            throw $th;
        }
    }

    public function create($data)
    {
        try {
            $pdo = Database::getPDO();
            print_r($data);
            $this->model->insert($pdo, $data);
            View::redirect('/teachers');
            Logger::logAction('Teacher ' . $data['firstname'] . ' ' . $data['name'] . ' has been created');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());;
            throw $th;
        }
    }

    public function update(int $id, $data)
    {
        try {
            $pdo = Database::getPDO();
            //$this->model->update($id,$data);
            View::redirect('/teachers');
            Logger::logAction('Teacher ' . $data['firstname'] . ' ' . $data['name'] . ' has been updated with id: ' . $id);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function delete(int $id)
    {
        try {
            $pdo = Database::getPDO();

            $this->model->delete($pdo, $id);
            View::redirect('/teachers');
            Logger::logAction('Teacher with id: ' . $id . ' has been deleted');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function login($data)
    {
        try {
            $teacher = $this->model->getByEmail($data['email']);
            if ($teacher) {
                if (password_verify($data['password'], $teacher->getPassword())) {
                    $_SESSION['logged'] = true;
                    View::redirect('/teachers');
                }
            } else {
                View::redirect('/teacher/log');
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
                View::redirect('/teachers');
            } else {
                View::render('teacher/login');
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
            View::redirect('/teachers');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function getAllTeachersJson()
    {
        try {
            $pdo = Database::getPDO();
            $teachers = $this->model->getAll($pdo);
            $openTeacher = [];
            foreach ($teachers as $teacher) {
                $teacher->destroyPrivateProperties();
                $openTeacher[] = $teacher->getJSONEncode();
            }
            echo json_encode($openTeacher);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }
}
