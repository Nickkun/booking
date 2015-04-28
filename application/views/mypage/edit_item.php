<h2>아이템 수정</h2>
<? echo form_open('mypage/update_item/'.$item['item_no']); ?>
	<label for="title">제목</label>
	<input type="text" name="title" value="<? echo html_escape($item['title']) ?>">
	<label for="content">내용</label>
	<textarea name="content"><? echo html_escape($item['content']) ?></textarea>
	<input type="submit" value="수정">
</form>
<ul>
	<li><a href="/mypage/item_list">돌아가기</a></li>
</ul>