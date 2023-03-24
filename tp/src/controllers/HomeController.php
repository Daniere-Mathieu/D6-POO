<?php

namespace controllers;


use interfaces\IController;
use utils\View;
use utils\{Logger};

class HomeController implements IController
{

    /**
     * return the view of the home page
     * @return void
     */
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
