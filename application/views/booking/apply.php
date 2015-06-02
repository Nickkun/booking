<section class="container">
	<section class="row">
		<div class="col-sm-8">
			<h4>신청</h4>
		</div>
		<div class="col-sm-4">
			<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>
		</div>	
	</section>
	<? echo form_open('booking/insert/'.$item_no, array('class' => 'form-horizontal')); ?>
		<article class="panel panel-primary">
			<div class="panel-heading">아이템을 신청합니다<span class="pull-right"><?php echo $item['applicant_limit'].'명 모집' ?></span></div>
			<div class="panel-body">
				<h4><?php echo $item['title'] ?></h4>
				<hr>
				<?php echo $item['content'] ?>

			</div> <!-- End .panel-body -->
			<ul class="list-group">
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-1 text-center bg-success">시작시간</div>
						<div class="col-sm-2"><?php echo $item['start_date'] ?></div>
						<div class="col-sm-1 text-center bg-success">종료시간</div>
						<div class="col-sm-2"><?php echo $item['end_date'] ?></div>
						<div class="col-sm-1 text-center bg-danger">신청마감</div>
						<div class="col-sm-2 text-danger"><?php echo $item['deadline_date'] ?></div>
						<div class="col-sm-1 text-center bg-danger">신청현황</div>
						<div class="col-sm-2 text-danger"><?php echo $item['possible_applicant'].'명 신청가능' ?></div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="form-group">
						<label for="applicant" class="col-sm-2 control-label">신청인원</label>
						<div class="col-sm-10">
							<input type="text" name="applicant" placeholder="신청인원" class="form-control" value="">
						</div>
						<div class="col-sm-10 col-sm-offset-2 pull-right">
							<div class="pull-right">
								<br>
								<?php if (strtotime($item['deadline_date']) < time() || $item['possible_applicant'] <= 0) : ?>
									<input type="submit" class="btn btn-danger disabled" value="신청마감" >
								<?php else: ?>
									<input type="submit" class="btn btn-success" value="신청">
								<?php endif; ?>
								<a href="/booking" class="btn btn-default" role="button">돌아가기</a>
							</div> <!-- End .pull-right -->						
						</div> <!-- End .col-sm-10 -->
					</div> <!-- End .form-group -->
				</li>
			</ul>
		</article>		
	</form> 
</section>
