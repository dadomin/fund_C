<?php

namespace Damin\Controller;

use Damin\DB;

class FundController extends MasterController {
	public function index() {
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

		$sql = "SELECT fundlist.*, users.email AS cnt, users.nickname AS nick FROM fundlist, users WHERE fundlist.owner = users.nickname AND fundlist.business is null";
		$list = DB::fetchAll($sql);

		$cql = "SELECT count(*) AS cnt FROM fundlist";
		$cnt = DB::fetch($cql)->cnt;

		$sql2 = "SELECT fundlist.*, investors.* FROM fundlist, investors WHERE fundlist.number = investors.fundnumber";
		$list2 = DB::fetchAll($sql2);

		$this->render("fund", ['user' => $user, 'fund' => $list, 'cnt' => $cnt, 'invest'=> $list2]);
	}

	public function business(){
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

		if($user == null){
			DB::msgAndBack("사용권한이 없습니다.");
			exit;
		}

		$number = $_GET['number'];
		$sql = "UPDATE `fundlist` SET `business` = 1 WHERE `number` = ?";
		$sql1 = "SELECT fundlist.current FROM fundlist WHERE fundlist.number =?";
		$sql2 = "UPDATE `users` SET `money` = `money` + ? WHERE email = ?";

		$cnt = DB::query($sql, [$number]);
		$cnt1 = DB::fetch($sql1, [$number]);
		$cnt2 = DB::query($sql2, [$cnt1->current, $user->email]);


		if($cnt) {
			DB::msgAndBack("해당 펀드가 진행사업에 추가되었습니다.");
		}else {
			DB::msgAndBack("해당펀드를 진행사업에 추가하는 데에 실패하였습니다.");
		}
	}

	public function remove() {
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

		if($user == null){
			DB::msgAndBack("사용권한이 없습니다.");
			exit;
		}

		$number = $_GET['number'];
		$sql1 = "SELECT investors.pay, investors.email FROM investors WHERE investors.fundnumber = ?";
		$sql2 = "UPDATE `users` SET `money` = `money` + ? WHERE `email` = ?";
		$sql3 = "DELETE FROM `fundlist` WHERE fundlist.number = ?";

		$list1 = DB::fetchAll($sql1, [$number]);
		foreach($list1 as $i){
			$list2 = DB::query($sql2, [$i->pay, $i->email]);
			if(!$list2){
				DB::msgAndBack("해당 펀드를 모집해제하는 데에 실패하였습니다.");
				exit;
			}
		}
		// $list3 = DB::fetch($sql3, [$number]);

		DB::msgAndBack("해당펀드가 성공적으로 모집해제 되었습니다.");	
	}

	public function invest(){
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

		if($user == null){
			DB::msgAndBack("사용권한이 없습니다.");
			exit;
		}
		$num = $_GET['num'];
		$pay = $_GET['pay'];

		$sql1 = "UPDATE `fundlist` SET `current` =`current` + ? WHERE `number` = ?";
		$sql2 = "SELECT * FROM `investors` WHERE `fundnumber` = ? AND `email` = ?";
		$sql3 = "UPDATE `investors` SET `pay` = `pay` + ?, `datetime` = ? WHERE `fundnumber` = ? AND `email` = ?";
		$sql4 = "INSERT INTO `investors`(`fundnumber`, `email`,`nickname`, `pay`, `datetime`) VALUES (?, ?, ?, ?, ?)";
		$sql5 = "UPDATE `users` SET `money` = `money` - ? WHERE `email` = ?";

		$list5 = DB::query($sql5,[$pay, $user->email]);

		$list1 = DB::query($sql1, [$pay, $num]);
		$list2 = DB::fetch($sql2, [$num, $user->email]);
		$now = date("Y-m-d H:i:s");
		if($list2){
			$list3 = DB::query($sql3, [$pay, $now, $num, $user->email]);
		}else {
			$list4 = DB::query($sql4, [$num, $user->email, $user->nickname, $pay, $now]);
		}
		DB::msgAndBack("해당펀드에 성공적으로 투자 되었습니다");
	}
}