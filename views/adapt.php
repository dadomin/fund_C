	<form action="/adapt/ok" method="POST" id="fund-adapt">
		<div class="adapt">
			<div class="adapt-title">
				<h3>펀드등록</h3>
				<p>펀드를 쉽고 안전하게 등록하실 수 있습니다.</p>
			</div>
			<div class="adapt-notice">
				<h3>펀드번호</h3>
				<input type="text" readonly class="adapt-number" name="fundnumber">
			</div>
			<div class="adapt-notice">
				<h3>창업펀드명</h3>
				<input type="text" placeholder="창업펀드명을 입력해주세요." class="adapt-name" name="fundname">
			</div>
			<div class="adapt-notice">
				<h3>모집마감일</h3>
				<input type="datetime-local" step="1" class="adapt-endDate" name="endDate">
			</div>
			<div class="adapt-notice">
				<h3>모집금액</h3>
				<input type="number" placeholder="모집금액을 입력해주세요." class="adapt-total" name="total">
			</div>
			<div class="adapt-notice">
				<h3>상세설명</h3>
				<textarea cols="30" rows="10" placeholder="500자 이내로 상세설명을 입력해주세요." class="adapt-des" name="sub"></textarea>
			</div>
			<div class="adapt-notice">
				<h3>펀드이미지</h3>
				<input type="file" class="adapt-file">
			</div>
			<button type="button"class="ok adapt-done">펀드등록</button>
			<button type="submit" class="dn adapt-ok"></button>
		</div>
	</form>

	<script>
		let fund_cnt = JSON.parse(`<?= json_encode($cnt) ?>`);
		console.log(fund_cnt);
	</script>

	<script src="/js/adapt.js"></script>