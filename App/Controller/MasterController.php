<?php

namespace Damin\Controller;

class MasterContorller {
	public function render($page, $data = []){
		extract($data);
		require __ROOT . "/views/header.php";
		require __ROOT . "/veiws/" . $page . ".php";
		require __ROOT . "/views/footer.php";
	}
}