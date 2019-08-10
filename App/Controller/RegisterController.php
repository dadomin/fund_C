<?php

namespace Damin\Controller;

use Damin\DB;

class RegisterController extends MasterController {

	public function index(){
		
		if (isset($_SESSION['user'])) {
			DB::msgAndBack("로그아웃을 하고 회원가입을 해주세요.");
			exit;
		}
		$this->render("register", []);
	}

	public function ok() {
		$email = $_POST['email'];
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		if($password != $password2){
			DB::msgAndBack("비밀번호와 비밀번호 확인란의 값이 다릅니다.");
			exit;
		}

		$sql = "INSERT INTO users (`email`, `nickname`, `password`, `money`) VALUES (?,?,PASSWORD(?), 50000)";
		$cnt = DB::query($sql, [$email, $nickname, $password]);

		if($cnt == true){
			DB::msgAndGo("회원가입이 성공적으로 이루어졌습니다.", "/login");
		}else {
			DB::msgAndBack("회원가입에 실패하였습니다.");
			exit;
		}
	}
}