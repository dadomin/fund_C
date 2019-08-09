<?php

namespace Damin\Controller;

use Damin\DB;

class MainController extends MasterController {

	public function index(){
		$sql = "SELECT COUNT(*) AS cnt FROM fundlist";
		$cnt = DB::fetch($sql)->cnt;
		if($cnt == 0){
			$this->loadData();
		}
		exit;
		$this->render("main", []);
	}

	private function loadData(){
		$json = file_get_contents(__ROOT . "/public/js/fund.json");
		$json = json_decode($json);

		$sql1 = "INSERT INTO fundlist (`number`, `name`, `total`, `current`, `endDate`) VALUES (?,?,?,?,?)";
		$sql2 = "INSERT INTO investors (`fundnumber`, `email`, `pay`, `datetime`) VALUES (?, ?, ?, ?)";
		$sql3 = "SELECT * FROM investors WHERE fundnumber = ? AND email = ?";
		$sql4 = "UPDATE investors SET `pay` = `pay` + ? , `datetime` = ?, WHERE fundnumber = ? email = ?";

		foreach($json as $f) {
			$data1 = [$f->number, $f->name, $f->total, $f->current, $f->endDate];
			$DB::query($sql1, $data1);

			foreach($f->investorList as $i){

			}
		}
	}
}