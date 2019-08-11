<?php

namespace Damin\Controller;

use Damin\DB;

class AdaptController extends MasterController {
	public function index(){
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

		if($user == null){
			DB::msgAndBack("사용권한이 없습니다.");
			exit;
		}

		$sql = "SELECT COUNT(*) AS cnt FROM fundlist";
		$cnt = DB::fetch($sql)->cnt;
		$this->render("adapt", ["cnt" => $cnt]);
	}

	public function ok() {
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

		if($user == null){
			DB::msgAndBack("사용권한이 없습니다.");
			exit;
		}
		$number = $_POST['fundnumber'];
		$name = $_POST['fundname'];
		$endDate = $_POST['endDate'];
		$total = $_POST['total'];
		$sub = $_POST['sub'];

		$sql = "INSERT INTO `fundlist`(`number`,`name`,`total`,`current`,`endDate`,`owner`,`sub`) VALUES (?,?,?,0,?,?,?)";

		$list = DB::query($sql, [$number, $name, $total, $endDate, $user->nickname, $sub]);

		if($list == true ){
			DB::msgAndGo("펀드등록이 완료되었습니다.", "/fund");
		}else {
			DB::msgAndBack("펀드등록에 실패하였습니다.");
		}
	}
}