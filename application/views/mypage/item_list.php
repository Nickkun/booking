<h2>내 개설 현황</h2>
<ul>
	<? if(isset($list) && count($list) > 0) : ?>
		<? foreach($list as $key => $value) : ?>
			<li><span><? echo $value['title'] ?></span><a href="/mypage/edit_item/<? echo $value['item_no'] ?>">수정</a><a href="/mypage/delete_item/<? echo $value['item_no'] ?>">삭제</a></li>
		<? endforeach; ?>
	<? else: ?>
		<li>개설현황이 존재하지 않습니다</li>
	<? endif; ?>
</ul>
<ul>
	<li><a href="/mypage/add_item">새로 등록</a></li>
</ul>