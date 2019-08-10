<?php

namespace Damin\Controller;

use Damin\DB;

class MainController extends MasterController {

	public function index(){
		$sql = "SELECT count(*) AS cnt FROM fundlist";
		$cnt = DB::fetch($sql)->cnt;
		if($cnt == 0){
			$this->loadData();
		}

		$sql2 = "SELECT fundlist.*, users.email AS cnt, users.nickname AS nick FROM fundlist, users WHERE fundlist.endDate > now() AND fundlist.owner = users.nickname ORDER BY fundlist.current / fundlist.total DESC LIMIT 0,4 ";
		$list = DB::fetchAll($sql2);
		$sql3 = "SELECT fundlist.*, investors.*, users.email AS cnt FROM fundlist, investors, users WHERE fundlist.endDate > now() AND fundlist.number = investors.fundnumber AND fundlist.owner = users.nickname ORDER BY fundlist.current / fundlist.total DESC LIMIT 0,4";
		$list2 = DB::fetchAll($sql3);

		$this->render("main", ['fund' => $list, 'investor' => $list2]);
	}

	private function loadData(){
		$json = file_get_contents(__ROOT . "/public/js/fund.json");
		$json = json_decode($json);

		$sql = "INSERT INTO fundlist ( `number`, `name`, `total`, `current`, `endDate`) VALUES (?,  ?, ?, ?, ?)";

		foreach($json as $fund) {
			// 펀드리스트 집어넣기
			$data = [$fund->number, $fund->name, $fund->total, $fund->current, $fund->endDate];
			DB::query($sql, $data);

			// 투자자목록
			$sql2 ="INSERT INTO `investors`(`fundnumber`, `email`, `pay`, `datetime`) VALUES (?, ?, ?, ?)";
			$sql3 = "SELECT * FROM investors WHERE fundnumber = ? AND email = ?";
			$sql4 = "UPDATE investors SET `pay`=?, `datetime`=? WHERE `fundnumber` =? AND `email` = ?";

			foreach($fund->investorList as $inv){
				$value = DB::fetch($sql3, [$fund->number, $inv->email]);

				if($value){
					$value->pay += $inv->pay;
					$vdate = new \Datetime($value->datetime);
					$idate = new \Datetime($inv->datetime);
					if($vdate < $idate) {
						$value->datetime = $inv->datetime;
					}

					$data3 = [$value->pay, $value->datetime, $fund->number, $inv->email];
					DB::query($sql4, $data3);
				}else {
					$data2 = [$fund->number, $inv->email, $inv->pay, $inv->datetime];
					DB::query($sql2, $data2);
				}
			}
		}
	}
}