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
        
        <!-- Bootstrap -->
    	<link rel="stylesheet" href="/static/css/bootstrap.min.css">
    	<!-- jQuery UI -->
		<link rel="stylesheet" href="/static/js/vendor/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="/static/css/normalize.css">
        <link rel="stylesheet" href="/static/css/main.css">
        <link rel="stylesheet" href="/static/css/style.css">

        <script src="/static/js/vendor/modernizr-2.8.3.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="/">BOOKING</a>
			    </div>
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    	<ul class="nav navbar-nav navbar-right">
						<? if (!empty($logged_in) && $logged_in) : ?>
							<li><a href="/member/do_logout">로그아웃</a></li>
							<li><a href="/mypage">마이페이지</a></li>
						<? else : ?> 
							<li><a href="/member/login">로그인</a></li> 
							<li><a href="/member/signup">회원가입</a></li>
						<? endif; ?>
					</ul>
			    </div>
			</div>
		</nav>