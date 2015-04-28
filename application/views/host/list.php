<h2>호스트</h2>
<ul>
	<? if(isset($list) && count($list) > 0) : ?>
		<? foreach($list as $key => $value) : ?>
			<li><span><? echo $value['title'] ?></span><a href="/host/edit/<? echo $value['item_no'] ?>">수정</a><a href="/host/delete/<? echo $value['item_no'] ?>">삭제</a></li>
		<? endforeach; ?>
	<? else: ?>
		<li>표시할 항목이 없습니다</li>
	<? endif; ?>
</ul>
<ul>
	<li><a href="/host/add">새로 등록</a></li>
</ul>