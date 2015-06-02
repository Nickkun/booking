<section class="row">
	<div class="col-sm-8">
		<h4>내 예약 수정</h4>
	</div>
	<div class="col-sm-4">
		<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>			
	</div>
</section>
<section class="row well well-lg">
	<?php echo form_open('mypage/update_booking/'.$booking['booking_no'], array('class' => 'form-horizontal')); ?>
		<section class="panel panel-success">
			<div class="panel-heading"><?php echo html_escape($booking['title']); ?></div>
			<div class="panel-body">
				<p><?php echo $booking['content'] ?></p>
			</div>
			<ul class="list-group">
				<li class="list-group-item">
					<div class="form-group">
						<label for="applicant" class="col-sm-4 control-label">신청인원</label>
						<div class="col-sm-8">
							<input type="text" name="applicant" class="form-control" value="<?php echo $booking['applicant']; ?>">	
						</div>	
					</div>
				</li>
			</ul>
			<div class="pull-right">
				<input type="submit" class="btn btn-success" value="수정">		
				<a href="/mypage/booking_list" class="btn btn-default" role="button">돌아가기</a>
			</div>
		</section>
	</form>
</section>