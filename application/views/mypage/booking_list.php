<section class="row">
	<div class="col-sm-8">
		<h4>내 예약 현황</h4>
	</div>
	<div class="col-sm-4">
		<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>			
	</div>
</section>
<ul class="list-group">
	<? if(isset($list) && count($list) > 0) : ?>
		<? foreach($list as $key => $value) : ?>
			<li class="list-group-item row">
				<div class="col-sm-9">
					<h5><? echo $value['title'].'('.$value['applicant'].'명 신청)' ?></h5>
					<?php if (strtotime($value['end_date']) < time()) : ?>
						<span class="label label-primary">진행이 완료되었습니다</span>
					<?php else: ?>
						<?php if (strtotime($value['deadline_date']) < time()) : ?>
							<span class="label label-danger">신청기간이 종료되었습니다</span>
						<?php else: ?>
							<?php if (time() > strtotime('-3 day', strtotime($value['deadline_date']))) : ?>
								<span class="label label-warning">신청기간이 곧 종료됩니다</span>
							<?php endif; ?>								
						<?php endif; ?>
						<?php if ($value['possible_applicant'] == 0) : ?>
							<span class="label label-success">인원모집이 완료되었습니다</span>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-3 margin-top-10">
					<a href="/mypage/delete_booking/<? echo $value['booking_no'] ?>" class="btn btn-danger pull-right" role="button">삭제</a>
					<?php if (strtotime($value['end_date']) > time()) : ?>
						<a href="/mypage/edit_booking/<? echo $value['booking_no'] ?>" class="btn btn-success pull-right" role="button">수정</a>
					<?php endif; ?>
				</div>
			</li>
		<? endforeach; ?>
	<? else: ?>
		<li class="list-group-item">예약현황이 존재하지 않습니다</li>
	<? endif; ?>
</ul>