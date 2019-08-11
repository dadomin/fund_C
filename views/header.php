<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KICK STARTER</title>
	<link rel="stylesheet" href="/js/fontawesome/css/all.css">
	<link rel="stylesheet" href="/style.css">
	<script src="/js/jquery-3.4.1.js"></script>
	<script src="/js/Fund.js"></script>
	<script src="/js/Investor.js"></script>
	<script src="/js/script.js"></script>
</head>
<body>

	<div id="toast-back"></div>
	
	<header>
		<div class="size">
			<a href="/index">
				<img src="/images/logo.png" alt="logo">
			</a>
			<img src="/images/logo-2.png" alt="logo-2">
			<ul id="login-menu">
				<?php if(isset($_SESSION['user'])) : ?>
					<li><a href="/logout" data-target="login" class="button">로그아웃</a></li>
				<?php else :?>
					<li><a href="/login" data-target="login">로그인</a></li>
					<li><i class="fas fa-caret-right"></i></li>
					<li><a href="/register" data-target="register">회원가입</a></li>
					<li><i class="fas fa-caret-right"></i></li>
					<li><a href="/master" data-target="master">관리자</a></li>
				<?php endif; ?>
			</ul>
			<?php if(isset($_SESSION['user']) && $_SESSION['user']->email == "admin") : ?>
				<p class="des"><a href="/admin" class="a"><?= $_SESSION['user']->nickname ?></a>님, 행복한 하루 되세요.</p>	
			<?php elseif(isset($_SESSION['user'])) : ?>
				<p class="des"><a href="/profile?email=<?=$_SESSION['user']->email ?>" class="a"><?= $_SESSION['user']->nickname ?></a>님의 보유금액은 <?= number_format($_SESSION['user']->money) ?>원입니다.</p>
			<?php else : ?>	
				<p class="des">안녕하세요, 킥스타터에 오신것을 환영합니다!</p>
			<?php endif; ?>
		</div>
	</header>

	<ul id="menu-bar">
		<li><a href="/index" data-target="main">메인페이지</a></li>
		<li><a href="/adapt" data-target="adapt">펀드등록</a></li>
		<li><a href="/fund" data-target="fund">펀드보기</a></li>
		<li><a href="/investor" data-target="investor">투자자목록</a></li>
	</ul>