<?php

namespace controllers;

use interfaces\IController;

use utils\View;
use models\Teacher;
use utils\{Database, Logger, Verification};
use generics\FlashCardType;

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
            $teacher = $this->model->get($id);
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
            $teachers = $this->model->getAll();
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

    public function create(array $data)
    {
        try {
            $arrayKeys = ['name', 'firstname', "email", "password"];
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) || !Verification::arrayKeysExistAndNotEmpty($arrayKeys, $data)) return false;

            if (!$this->model->notExistByValue('email', $data["email"])) {
                View::setFlashMessage( 'This email already exist',FlashCardType::isError);
                View::redirect('/teacher/log');
            };

            echo "test";
            $isCreated = $this->model->insert($data, $arrayKeys);
            if (!$isCreated) {
                View::setFlashMessage( 'error to create the teacher',FlashCardType::isError);
                View::redirect('/teacher/log');
            }
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
            $keys = ['name', 'firstname', 'email'];
            $this->model->update($id, $data, $keys);
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
            $this->model->delete($id);
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
                    View::setFlashMessage( 'You are now logged in',FlashCardType::isSuccess);
                    View::redirect('/teachers');
                }
            } else {
                View::setFlashMessage( 'You failed to log in',FlashCardType::isError);
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
            $teachers = $this->model->getAll();
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
