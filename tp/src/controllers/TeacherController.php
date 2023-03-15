<?php 

namespace controllers;

use interfaces\Controller;

class TeacherController extends Controller {
    public function index() {
        $this->view('teacher/index');
    }
}