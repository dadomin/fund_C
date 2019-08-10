<?php

namespace Damin\Controller;

use Damin\DB;

class LoginController extends MasterController {
	public function index()	{
		$this->render("login", []);
	}

	public function ok() {
		$email = $_POST['email'];
		$pass = $_POST['password'];

		$sql = "SELECT * FROM users WHERE email =? AND password = PASSWORD(?)";

		$user = DB::fetch($sql, [$email, $pass]);

		if(!$user){
			DB::msgAndBack("아이디나 비밀번호가 잘못되었습니다.");
			exit;
		}

		$_SESSION['user'] = $user;

		DB::msgAndGo("로그인되었습니다.", "/");
	}

	public function logout() {
		unset($_SESSION['user']);
		DB::msgAndGo("로그아웃되었습니다.", "/");
	}
}