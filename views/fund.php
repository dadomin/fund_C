	<section id="fund-view">

		<div class="size">
			
			<div class="fund-view-title">
				<h3>펀드보기</h3>
				<div class="line100"></div>
				<p>킥스타터에 등록된 펀드들을 확인하실 수 있습니다.</p>
			</div>

			<div class="fund-upper">
				<h3><span id="fcnt"><?= $cnt ?></span>개의</h3>
				<p>펀드들이 있습니다.</p>
			</div>

			<div class="fund-form">
				<!-- 이곳에 펀드목록이 들어옵니다. -->
				
			</div>
			
			<ul id="pagination-bar">
				<li><a href="#" class="page prev"><i class="fas fa-caret-left"></i></a></li>
				<li><a href="#" class="page">1</a></li>
				<li><a href="#" class="page">2</a></li>
				<li><a href="#" class="page">3</a></li>
				<li><a href="#" class="page next"><i class="fas fa-caret-right"></i></a></li>
			</ul>

		</div>
		
	</section>
	<script>
		let fund_list = JSON.parse(`<?= json_encode($fund) ?>`);
		let invest_list = JSON.parse(`<?= json_encode($invest) ?>`);
		let user = JSON.parse(`<?= json_encode($user) ?>`);
		console.log(user);
	</script>
	<script src="/js/funds.js"></script>