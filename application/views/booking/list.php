<?php 
	// 현재는 사용보류
	// $breadcrumb = explode('/', $view);
	// $view_name = eval('return '.BREADCRUMBS.';');
?>
<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<h4>아이템 목록</h4>
		</div>
		<div class="col-sm-4">
			<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>		
			<!-- <ol class="breadcrumb pull-right">
				<li><a href="/">HOME</a></li>
				<li><a href="/<?php echo $breadcrumb[1] ?>"><?php echo element($breadcrumb[1], $view_name) ?></a></li>
				<li><a href="/<?php echo $breadcrumb[1].'/'.$breadcrumb[2] ?>"><?php echo element($breadcrumb[2], $view_name) ?></a></li>
			</ol> -->
		</div>	
	</div>	
	
	<ul class="list-group">
		<?php if(isset($list)) : ?>
			<?php foreach($list as $key => $value) : ?>
				<li class="list-group-item">
					<a href="/booking/detail/<?php echo $value['item_no'] ?>"><?php echo $value['title'] ?></a>
					<?php if (strtotime($value['registered']) > strtotime('-1 week')) : ?>
						<span class="label label-success">NEW</span>
					<?php endif; ?>
					<?php if (strtotime($value['deadline_date']) < time()) : ?>
						<span class="label label-danger">신청마감</span>
					<?php endif; ?>
					<?php if ($value['possible_applicant'] <= 0) : ?>
						<span class="label label-warning">인원모집 완료</span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		<?php else: ?>
			<li class="list-group-item">표시할 항목이 없습니다</li>
		<?php endif; ?>
	</ul>
</div>