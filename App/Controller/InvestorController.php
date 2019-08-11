<?php

namespace Damin\Controller;

use Damin\DB;

class InvestorController extends MasterController {
	public function index(){
		$sql = "SELECT COUNT(*) AS cnt FROM investors";
		$cnt = DB::fetch($sql)->cnt;

		$sql1 = "SELECT investors.* , fundlist.* FROM `investors`, `fundlist` WHERE investors.fundnumber = fundlist.number";
		$list1 = DB::fetchAll($sql1);
		$this->render("investor", ['cnt'=>$cnt, 'investors' => $list1]);
	}
}