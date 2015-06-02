<?php 
	// 모집인원 진행율 계산
	$rate = floor((($item['applicant_limit'] - $item['possible_applicant']) / $item['applicant_limit']) * 100);
?>
<section class="container">
	<section class="row">
		<div class="col-sm-8">
			<h4>상세내역</h4>
		</div>
		<div class="col-sm-4">
			<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>
		</div>	
	</section>	
	<article class="panel panel-primary">
		<div class="panel-heading"><?php echo $item['title'] ?></div>
		<div class="panel-body">
			<?php if (strtotime($item['deadline_date']) < time() || $item['possible_applicant'] <= 0 ) : ?>
				<h4 class="text-danger text-center alert alert-danger">신청이 마감된 아이템입니다</h4>
			<?php endif; ?>
			<?php echo $item['content'] ?>
		</div>
		<ul class="list-group">
			<li class="list-group-item">
				<div class="row">
					<div class="col-sm-2">
						<p>진행시작</p>
					</div>
					<div class="col-sm-4">
						<p><?php echo $item['start_date'] ?></p>
					</div>
					<div class="col-sm-2">
						<p>진행종료</p>
					</div>
					<div class="col-sm-4">
						<p><?php echo $item['end_date'] ?></p>
					</div>
				</div>
			</li>
			<li class="list-group-item">
				<div class="row">
					<div class="col-sm-2">
						<p>신청마감</p>
					</div>
					<div class="col-sm-4">
						<p><?php echo $item['deadline_date'] ?></p>
					</div>
					<div class="col-sm-2">
						<p>신청현황</p>
					</div>
					<div class="col-sm-4 text-right">
						<div class="progress">
							<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $rate ?>" aria-valuemin="0" aria-valuemax="100" style="min-width: 1em; width: <?php echo $rate ?>%">
	    						<span class="sr-only"><?php echo $rate ?>% Complete</span>
	    					</div>
						</div>
						<p><?php echo '총 모집인원 '.$item['applicant_limit'].'명 중 '.$item['possible_applicant'].'명 신청가능'; ?></p>
					</div>
				</div>
			</li>
		</ul>
	</article>
	<div class="pull-right">
		<?php if (strtotime($item['deadline_date']) < time() || $item['possible_applicant'] <= 0) : ?>
			<button class="btn btn-danger disabled">신청마감</button>
		<?php else: ?>
			<a href="/booking/apply/<?php echo $item['item_no'] ?>" class="btn btn-success" role="button">신청</a>
		<?php endif; ?>
		<a href="/booking" class="btn btn-default" role="button">돌아가기</a>
	</div>
</section>