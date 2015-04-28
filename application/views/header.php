<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>예약모듈</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="/static/img/apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="/static/css/normalize.css">
        <link rel="stylesheet" href="/static/css/main.css">
        <link rel="stylesheet" href="/static/css/style.css">

        <script src="/static/js/vendor/modernizr-2.8.3.min.js"></script>
	</head>
	<body>
		<ul>
			<li><a href="/">메인으로 돌아가기</a></li>
			<? if (!empty($logged_in) && $logged_in) : ?>
				<li><a href="/member/do_logout">로그아웃</a></li>
				<li><a href="/mypage">마이페이지</a></li>
			<? else : ?> 
				<li><a href="/member/login">로그인</a></li> 
				<li><a href="/member/signup">회원가입</a></li>
			<? endif; ?>
			<li><a href="/member/do_logout">세션제거</a></li>
		</ul>