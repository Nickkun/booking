
<section class="container">
	<section class="row">
		<div class="col-sm-8">
			<h4>회원가입</h4>
		</div>
		<div class="col-sm-4">
			<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>			
		</div>
	</section>
	<section class="row well well-lg">
		<? echo validation_errors(); ?>
		<? echo form_open('member/do_signup', array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">이메일</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control" value="<? echo set_value('email') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">이름</label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" value="<? echo set_value('name') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">비밀번호</label>
				<div class="col-sm-10">
					<input type="password" name="password" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="password_confirm" class="col-sm-2 control-label">비밀번호 확인</label>
				<div class="col-sm-10">
					<input type="password" name="password_confirm" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<label for="host_registration">
						<input type="checkbox" name="host_registration" class=""> 호스트 등록
						<p class="help-block">호스트로 등록하시려면 체크해주세요</p>
					</label>	
				</div>
			</div>
			<div class="pull-right">
				<input type="submit" class="btn btn-success" value="가입">
				<a href="/" class="btn btn-default" role="button">돌아가기</a>
			</div>
		</form>
	</section>
</section>