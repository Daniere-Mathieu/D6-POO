<?php

namespace controllers;


use interfaces\IController;
use models\Student;
use utils\View;
use utils\{Logger, Verification, Hash};
use generics\FlashCardType;

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
            $arrayKeys = ['name', 'firstname', "email", "password"];
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) || !Verification::arrayKeysExistAndNotEmpty($arrayKeys, $data)) return false;

            if (!$this->model->notExistByValue('email', $data["email"])) {
                View::setFlashMessage('This email already exist', FlashCardType::isError);
                View::redirect('/student/log');
            };

            $data['password'] = Hash::hashPassword($data['password']);
            $isCreated = $this->model->insert($data, $arrayKeys);
            if (!$isCreated) {
                View::setFlashMessage('error to create the student', FlashCardType::isError);
                View::redirect('/student/log');
            }
            View::redirect('/students');
            Logger::logAction('student ' . $data['firstname'] . ' ' . $data['name'] . ' has been created');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());;
            throw $th;
        }
    }

    public function update(array $data)
    {
        try {
            $keys = ['name', 'firstname', 'email', 'id'];
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) && Verification::arrayKeysExistAndNotEmpty($keys, $data) && !Verification::isStudent() && !Verification::isIdEquivalent($data['id'])) return false;

            $this->model->update($data["id"], $data, $keys);
            View::redirect('/students');
            Logger::logAction('Student ' . $data['firstname'] . ' ' . $data['name'] . ' has been updated with id: ' . $data["id"]);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function updateView(int $id)
    {
        try {
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) && !Verification::isStudent() && !Verification::isIdEquivalent($id)) return false;

            $student = $this->model->get($id);
            View::render('student/update', ['student' => $student]);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function delete(array $data)
    {
        try {
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) && Verification::arrayKeysExistAndNotEmpty(["id"], $data) && !Verification::isStudent() && !Verification::isIdEquivalent($data['id'])) return false;

            $this->model->delete($data["id"]);
            unset($_SESSION['logged']);
            unset($_SESSION['role']);
            unset($_SESSION['id']);
            View::setFlashMessage('Student has been deleted', FlashCardType::isSuccess);
            Logger::logAction('Students with id: ' . $data["id"] . ' has been deleted');

            View::redirect('/students');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function deleteView(int $id)
    {
        try {
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) &&  !Verification::isTeacher() && !Verification::isIdEquivalent($id)) return false;

            $student = $this->model->get($id);
            View::render('student/delete', ['student' => $student]);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    public function login($data)
    {
        try {
            $student = $this->model->getByEmail($data['email']);
            if ($student && password_verify($data['password'], $student->getPassword())) {

                $_SESSION['logged'] = true;
                $_SESSION['role'] = 'student';
                $_SESSION['id'] = $student->getId();
                View::setFlashMessage('You are now logged in', FlashCardType::isSuccess);
                View::redirect('/students');
            } else {
                View::setFlashMessage('You failed to log in', FlashCardType::isError);
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
