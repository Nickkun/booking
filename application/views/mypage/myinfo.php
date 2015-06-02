<section class="row">
	<div class="col-sm-8">
		<h4>개인정보 관리</h4>
	</div>
	<div class="col-sm-4">
		<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>			
	</div>
</section>
<section class="row well well-lg">
	<?php echo validation_errors(); ?>
	<?php echo form_open('mypage/update', array('class' => 'form-horizontal')); ?>
		<h4>개인정보</h4>
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">이메일</label>
			<div class="col-sm-10">
				<p><?php if(set_value('email')) echo set_value('email'); else  echo $myinfo['email'] ?></p>
				<input type="hidden" name="name" class="form-control" value="<?php if(set_value('email')) echo set_value('email'); else  echo $myinfo['email'] ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">이름</label>
			<div class="col-sm-10">
				<input type="text" name="name" class="form-control" value="<?php if(set_value('name')) echo set_value('name'); else  echo $myinfo['name'] ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-2 control-label">비밀번호</label>
			<div class="col-sm-10">
				<input type="password" name="password" class="form-control">
				<input type="hidden" name="password_confirm" value="<?php echo $password ?>">
			</div>
		</div>
		<?php if (!is_null($host)) : ?>
			<h4>호스트정보</h4>
			<div class="form-group">
				<label for="host_name" class="col-sm-2 control-label">호스트명</label>
				<div class="col-sm-10">
					<input type="text" name="host_name" class="form-control" value="<?php if(set_value('host_name')) echo set_value('host_name'); else echo $myinfo['host_name'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="host_contact" class="col-sm-2 control-label">연락처</label>
				<div class="col-sm-10">
					<input type="text" name="host_contact" class="form-control" value="<?php if(set_value('host_contact')) echo set_value('host_contact'); else echo $myinfo['host_contact'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="host_email" class="col-sm-2 control-label">이메일</label>
				<div class="col-sm-10">
					<input type="text" name="host_email" class="form-control" value="<?php if(set_value('host_email')) echo set_value('host_email'); else echo $myinfo['host_email'] ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="host_homepage" class="col-sm-2 control-label">홈페이지</label>
				<div class="col-sm-10">
					<input type="text" name="host_homepage" class="form-control" value="<?php if(set_value('host_homepage')) echo set_value('host_homepage'); else echo $myinfo['host_homepage'] ?>">
				</div>
			</div>
		<?php endif; ?>
		<div class="form-group">
			<label for="registered" class="col-sm-2 control-label">가입일</label>
			<div class="col-sm-10">
				<input type="text" name="registered" class="form-control" value="<?php if(set_value('registered')) echo date('Y년 m월 d일 H시i분s초', strtotime(set_value('registered'))); else echo date('Y년 m월 d일 H시i분s초', strtotime($myinfo['registered'])); ?>" size="30" disabled>
			</div>
		</div>
		<div class="pull-right">
			<input type="submit" class="btn btn-success" value="수정">
			<a href="/mypage" class="btn btn-default" role="button">돌아가기</a>
		</div>			
		<?php if (is_null($host)): ?>
			<div class="pull-left">
				<a href="/member/host_signup" class="btn btn-primary" role="button">호스트로 가입하기</a>
			</div>
		<?php endif; ?>
	</form>
</section>