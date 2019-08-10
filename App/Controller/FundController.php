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
}