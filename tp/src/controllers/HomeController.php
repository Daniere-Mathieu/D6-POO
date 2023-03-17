<?php

namespace controllers;


use interfaces\IController;
use utils\View;
use utils\{Logger};

class HomeController implements IController
{



    public function index()
    {
        try {
            View::render('index');
            Logger::logAction('get home page');
        } catch (\Throwable $th) {
            Logger::logError($th->getMessage());
            View::render('error/error', ['error' => $th->getMessage()]);
            throw $th;
        }
    }
}
