<h2>목록</h2>
<ul>
	<? if(isset($list)) : ?>
		<? foreach($list as $key => $value) : ?>
			<li><a href="/booking/detail/<? echo $value['item_no'] ?>"><? echo $value['title'] ?></a></li>
		<? endforeach; ?>
	<? else: ?>
		<li>표시할 항목이 없습니다</li>
	<? endif; ?>
</ul>