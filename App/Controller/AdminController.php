<?php

namespace Damin\Controller;

use Damin\Route;

class AdminController extends MasterController {
	public function index(){
		$this->render("admin",[]);
	}
}