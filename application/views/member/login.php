<section class="container">
	<section class="row col-sm-6 col-sm-offset-3 well well-lg">
		<h4>로그인</h4>	
		<? echo form_open('member/do_login', array('class' => 'form-horizontal')); ?>
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">이메일</label>
				<div class="col-sm-10">
					<input type="text" name="email" class="form-control">	
				</div>			
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">비밀번호</label>
				<div class="col-sm-10">
					<input type="password" name="password" class="form-control">
				</div>
			</div>
			<div class="pull-right">
				<input type="submit" class="btn btn-success" value="로그인">
				<a href="/" class="btn btn-default" role="button">돌아가기</a>
			</div>
		</form>
	</section>
</section>
