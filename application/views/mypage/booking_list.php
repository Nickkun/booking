<h2>내 예약 현황</h2>
<ul>
	<? if(isset($list) && count($list) > 0) : ?>
		<? foreach($list as $key => $value) : ?>
			<li><span><? echo $value['title'].'('.$value['applicant'].'명 신청)' ?></span><a href="/mypage/edit_booking/<? echo $value['booking_no'] ?>">수정</a><a href="/mypage/delete_booking/<? echo $value['booking_no'] ?>">삭제</a></li>
		<? endforeach; ?>
	<? else: ?>
		<li>예약현황이 존재하지 않습니다</li>
	<? endif; ?>
</ul>