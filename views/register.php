	<section id="fund-register">
		<form action="/register/ok" method="POST" class="register">
			<div class="adapt-title">
				<h3>회원가입</h3>
				<p>킥스타터에서 안전하고 편리한 투자생활을 즐겨보세요.</p>
			</div>
			<div class="adapt-notice">
				<h3>이메일</h3>
				<input type="text" placeholder="이메일을 입력해주세요." class="register-email" name="email">
			</div>
			<div class="adapt-notice">
				<h3>이름</h3>
				<input type="text" placeholder="이름을 입력해주세요." class="register-nick" name="nickname">
			</div>
			<div class="adapt-notice">
				<h3>비밀번호</h3>
				<input type="password" placeholder="비밀번호를 입력해주세요." class="register-pass" name="password">
			</div>
			<div class="adapt-notice">
				<h3>비밀번호 확인</h3>
				<input type="password" placeholder="비밀번호를 한번 더 입력해주세요." class="register-repass" name="password2">
			</div>
			<button type="button" class="ok register-done">회원가입</button>
			<button type="submit" class="dn register-ok"></button>
		</form>
	</section>

	<script src="/js/register.js"></script>