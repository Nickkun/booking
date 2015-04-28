<h2>새로운 아이템 등록</h2>
<p>새로운 아이템을 등록합니다</p>
<? echo form_open('mypage/insert_item'); ?>
	<label for="title">제목</label>
	<input type="text" name="title">
	<label for="content">내용</label>
	<textarea name="content"></textarea>
	<input type="submit" value="등록">
</form>
<ul>
	<li><a href="/mypage/item_list">돌아가기</a></li>
</ul>
