
	<section id="fund-investor">
		<div class="size">
			
			<div class="investor-title">
				<h3>투자자목록</h3>
				<div class="line100"></div>
				<p>킥스타터에 등록된 펀드에 투자한 투자자분들을 확인하실 수 있습니다.</p>
			</div>

			<div class="investor-upper">
				<h3><span id="icnt"><?= $cnt ?></span>명의</h3>
				<p>투자자분들이 계십니다.</p>
				<select id="inv">
					<option value="fund" selected>펀드별</option>
					<option value="indi">개인별</option>
					<option value="recent">최근등록순</option>
				</select>
			</div>

			<div class="investor-form">

				<div class="investor-form-title">
					<div>펀드번호</div>
					<div>창업펀드명</div>
					<div>투자자명</div>
					<div>투자금액</div>
					<div>투자지분</div>
					<div>투자일자</div>
				</div>

				<div class="investors">
					<!-- 이곳에 투자자목록이 들어옵니다. -->
				</div>

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
		let cnt = `<?= $cnt ?>`;
		let investor_list = JSON.parse(`<?= json_encode($investors)?>`);
		console.log(investor_list);
	</script>

	<script src="/js/investors.js"></script>