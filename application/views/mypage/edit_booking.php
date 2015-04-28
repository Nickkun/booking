<h2>내 예약 수정</h2>
<? echo form_open('mypage/update_booking/'.$booking['booking_no']); ?>
	<h3>제목</h3>
	<p><? echo html_escape($booking['title']); ?></p>
	<h3>내용</h3>
	<p><? echo html_escape($booking['content']); ?></p>
	<label for="applicant">신청인원</label>
	<input type="text" name="applicant" value="<? echo $booking['applicant']; ?>">
	<input type="submit" value="수정">
</form>
<ul>
	<li><a href="/mypage/booking_list">돌아가기</a></li>
</ul>