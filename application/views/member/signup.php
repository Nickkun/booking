<h2>회원가입</h2>
<? echo form_open('member/do_signup'); ?>
	<label for="email">이메일</label>
	<input type="text" name="email">
	<label for="name">이름</label>
	<input type="text" name="name">
	<label for="password">비밀번호</label>
	<input type="password" name="password">
	<label for="password_confirm">비밀번호 확인</label>
	<input type="password" name="password_confirm">
	<input type="submit" value="가입">
</form>
<ul>
	<li><a href="/">돌아가기</a></li>
</ul>