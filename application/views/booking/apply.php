<h2>신청</h2>
<p>아이템을 신청합니다</p>
<? echo form_open('booking/insert/'.$item_no); ?>
	<label for="applicant">신청인원</label>
	<input type="text" name="applicant" placeholder="신청인원" value="">
	<input type="submit" value="신청">
	<? echo form_hidden('item_no', $item_no); ?>
</form> 
<ul>
	<li><a href="/booking/detail">돌아가기</a></li>
</ul>
