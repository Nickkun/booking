<section class="container col-sm-6 col-sm-offset-3">
	<section class="row">
		<div class="col-sm-8">
			<h4>비밀번호 변경</h4>
		</div>
		<div class="col-sm-4">
			<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>			
		</div>
	</section>
	<section class="row well well-lg">
		<?php echo validation_errors(); ?>
		<?php echo form_open('mypage/edit_password_change', array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="password" class="col-sm-4 control-label">현재 비밀번호</label>
				<div class="col-sm-8">
					<input type="password" name="password" class="form-control">	
				</div>
				
			</div>
			<div class="form-group">
				<label for="new_password" class="col-sm-4 control-label">새로운 비밀번호</label>
				<div class="col-sm-8">
					<input type="password" name="new_password" class="form-control">	
				</div>
			</div>
			<div class="form-group">
				<label for="new_password_confirm" class="col-sm-4 control-label">새로운 비밀번호 확인</label>
				<div class="col-sm-8">
					<input type="password" name="new_password_confirm" class="form-control">	
				</div>
			</div>
			<div class="pull-right">
				<input type="hidden" name="password_confirm" value="<?php echo $password ?>">
				<input type="submit" class="btn btn-success" value="수정">
				<a href="/mypage" class="btn btn-default" role="button">돌아가기</a>
			</div>
		</form>
	</section>
</section>