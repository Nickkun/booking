<h2>개인정보 관리</h2>
<? echo form_open('mypage/update'); ?>
	<h3>이메일</h3>
	<p><? echo $myinfo['email'] ?></p>
	<label for="name">이름</label>
	<input type="text" name="name" value="<? echo $myinfo['name'] ?>">
	<label for="password">비밀번호</label>
	<input type="text" name="password">
	<input type="submit" value="수정">
</form>
<ul>
	<li><a href="/mypage">돌아가기</a></li>
</ul>