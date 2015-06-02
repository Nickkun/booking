<section class="container">
	<section class="row">
		<div class="col-sm-8">
			<h4>호스트 등록</h4>
		</div>
		<div class="col-sm-4">
			<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>			
		</div>
	</section>
	<section class="row well well-lg">
		<?php echo validation_errors(); ?>
		<?php echo form_open('member/do_host_signup', array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="host_name" class="col-sm-2 control-label">호스트 이름</label>
				<div class="col-sm-10">
					<input type="text" name="host_name" class="form-control" value="<?php echo set_value('host_name') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="host_contact" class="col-sm-2 control-label">호스트 연락처</label>
				<div class="col-sm-10">
					<input type="text" name="host_contact" class="form-control" value="<?php echo set_value('host_contact') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="host_email" class="col-sm-2 control-label">호스트 이메일</label>
				<div class="col-sm-10">
					<input type="text" name="host_email" class="form-control" value="<?php echo set_value('host_email') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="host_homepage" class="col-sm-2 control-label">호스트 홈페이지</label>
				<div class="col-sm-10">
					<input type="text" name="host_homepage" class="form-control" value="<?php echo set_value('host_homepage') ?>">
				</div>
			</div>		
			<div class="pull-right">
				<input type="submit" class="btn btn-success" value="호스트로 회원가입">
				<a href="/" class="btn btn-default" role="button">돌아가기</a>
			</div>
			
			<?php if (isset($email)) : ?>
				<input type="hidden" name="email" value="<?php echo $email ?>">
				<input type="hidden" name="name" value="<?php echo $name ?>">
				<input type="hidden" name="password" value="<?php echo $password ?>">
			<?php else : ?>
				<input type="hidden" name="email" value="<?php echo set_value('email'); ?>">
				<input type="hidden" name="name" value="<?php echo set_value('name') ?>">
				<input type="hidden" name="password" value="<?php echo set_value('password') ?>">
			<?php endif; ?>
		</form>
	</section>
</section>