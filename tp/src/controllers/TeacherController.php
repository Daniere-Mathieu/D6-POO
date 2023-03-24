<?php

namespace controllers;

use interfaces\IController;

use utils\View;
use models\Teacher;
use utils\{Logger, Verification, Hash};
use generics\FlashCardType;

class TeacherController implements IController
{


    public Teacher $model;

    public function __construct()
    {
        $this->model = new Teacher();
    }

    /**
     * return the view of the teacher card
     * @param int $id
     * @return void
     */
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

    /**
     * return the view with all the teachers
     * @return void
     */
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

    /**
     * route to create a teacher
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        try {
            $arrayKeys = ['name', 'firstname', "email", "password"];
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) || !Verification::arrayKeysExistAndNotEmpty($arrayKeys, $data)) return false;

            if (!$this->model->notExistByValue('email', $data["email"])) {
                View::setFlashMessage('This email already exist', FlashCardType::isError);
                View::redirect('/teacher/log');
            };

            $data['password'] = Hash::hashPassword($data['password']);
            $isCreated = $this->model->insert($data, $arrayKeys);
            if (!$isCreated) {
                View::setFlashMessage('error to create the teacher', FlashCardType::isError);
                View::redirect('/teacher/log');
            }
            View::redirect('/teachers');
            Logger::logAction('Teacher ' . $data['firstname'] . ' ' . $data['name'] . ' has been created');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());;
            throw $th;
        }
    }

    /**
     * route to update a teacher
     * @param array $data
     * @return void
     */
    public function update(array $data)
    {
        try {
            $keys = ['name', 'firstname', 'email', 'id'];
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) && Verification::arrayKeysExistAndNotEmpty($keys, $data) && !Verification::isTeacher() && !Verification::isIdEquivalent($data['id'])) return false;

            $this->model->update($data["id"], $data, $keys);
            View::redirect('/teachers');
            Logger::logAction('Teacher ' . $data['firstname'] . ' ' . $data['name'] . ' has been updated with id: ' . $id);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    /**
     * route to display the view to update a teacher
     * @param int $id
     * @return void
     */
    public function updateView(int $id)
    {
        try {
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) && !Verification::isTeacher() && !Verification::isIdEquivalent($id)) return false;

            $teacher = $this->model->get($id);
            View::render('teacher/update', ['teacher' => $teacher]);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    /**
     * route to delete a teacher
     * @param array $data
     * @return void
     */
    public function delete(array $data)
    {
        try {
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) && Verification::arrayKeysExistAndNotEmpty(["id"], $data) && !Verification::isTeacher() && !Verification::isIdEquivalent($data['id'])) return false;

            $this->model->delete($data["id"]);
            unset($_SESSION['logged']);
            unset($_SESSION['role']);
            unset($_SESSION['id']);
            View::setFlashMessage('Teacher has been deleted', FlashCardType::isSuccess);
            Logger::logAction('Teacher with id: ' . $data["id"] . ' has been deleted');

            View::redirect('/teachers');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    /**
     * route to display the view to delete a teacher
     * @param int $id
     * @return void
     */
    public function deleteView(int $id)
    {
        try {
            if (!Verification::verifyIfAllExistAndNotIsEmpty(func_get_args()) &&  !Verification::isTeacher() && !Verification::isIdEquivalent($id)) return false;

            $teacher = $this->model->get($id);
            View::render('teacher/delete', ['teacher' => $teacher]);
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    /**
     * route to log as a teacher
     * @param array $data
     * @return void
     */
    public function login($data)
    {
        try {
            $teacher = $this->model->getByEmail($data['email']);
            if ($teacher && password_verify($data['password'], $teacher->getPassword())) {

                $_SESSION['logged'] = true;
                $_SESSION['role'] = 'teacher';
                $_SESSION['id'] = $teacher->getId();
                View::setFlashMessage('You are now logged in', FlashCardType::isSuccess);
                View::redirect('/teachers');
            } else {
                View::setFlashMessage('You failed to log in', FlashCardType::isError);
                View::redirect('/teacher/log');
            }
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            throw $th;
        }
    }

    /**
     * route to display the view to log as a teacher
     * @return void
     */
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

    /**
     * route to log out
     * @return void
     */
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

    /**
     * route to return all teachers in json format
     * @return void
     */
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
