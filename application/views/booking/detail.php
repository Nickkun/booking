<h2>상세내역</h2>
<p>제목 : <? echo $item['title'] ?></p>
<p>내용 : <? echo $item['content'] ?></p>
<ul>
	<li><a href="/booking/apply/<? echo $item['item_no'] ?>">신청</a></li>
	<li><a href="/booking">돌아가기</a></li>
</ul>