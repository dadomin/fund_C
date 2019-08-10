<?php

namespace Damin\Controller;

use Damin\DB;

class ProfileController extends MasterController {
	public function index() {
		$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

		if(isset($_GET['email'])) {
			$sql = "SELECT * FROM users WHERE users.email = ?";
			$user = DB::fetch($sql, [$_GET['email']]);
		}

		$sql1 = "SELECT fundlist.* FROM fundlist WHERE fundlist.owner = ?";
		$list1 = DB::fetchAll($sql1, [$user->nickname]);

		$sql2 = "SELECT fundlist.*, investors.* FROM fundlist, investors WHERE investors.email = ? AND fundlist.number = investors.fundnumber";
		$list2 = DB::fetchAll($sql2, [$user->email]);

		$sql3 = "SELECT fundlist.* FROM fundlist WHERE fundlist.owner = ? AND fundlist.business = 1";
		$list3 = DB::fetchAll($sql3, [$user->nickname]);

		$this->render("profile", ['user' => $user, 'fund' => $list1, 'invest' => $list2, 'business' => $list3]);
	}
}