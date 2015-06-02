<section class="row">
	<div class="col-sm-8">
		<h4>새로운 아이템 등록</h4>
	</div>
	<div class="col-sm-4">
		<p class="pull-right text-danger"><?php echo SUB_PAGE_TITLE ?></p>			
	</div>
</section>
<section class="row well well-lg">
	<?php if (!empty($error)) : ?>
		<div class="error"><?php echo $error ?></div>
	<?php endif;?>
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('mypage/insert_item', array('class' => 'form-horizontal')); ?>
		<div class="form-group">
			<label for="start_year" class="col-sm-2 control-label">진행일시 - 시작</label>
			<div class="col-sm-4">
				<input type="text" name="start_date" id="start_date" class="form-control-static" value="<?php echo set_value('start_date', date('Y-m-d', strtotime('+2 day'))) ?>">
				<select name="start_time" class="form-control-static" id="start_time">
					<option value="06:00:00" <?php echo set_select('start_time', '06:00:00', TRUE); ?>>06:00</option>
					<option value="07:00:00" <?php echo set_select('start_time', '07:00:00'); ?>>07:00</option>
					<option value="08:00:00" <?php echo set_select('start_time', '08:00:00'); ?>>08:00</option>
					<option value="09:00:00" <?php echo set_select('start_time', '09:00:00'); ?>>09:00</option>
					<option value="10:00:00" <?php echo set_select('start_time', '10:00:00'); ?>>10:00</option>
					<option value="11:00:00" <?php echo set_select('start_time', '11:00:00'); ?>>11:00</option>
					<option value="12:00:00" <?php echo set_select('start_time', '12:00:00'); ?>>12:00</option>
					<option value="13:00:00" <?php echo set_select('start_time', '13:00:00'); ?>>13:00</option>
					<option value="14:00:00" <?php echo set_select('start_time', '14:00:00'); ?>>14:00</option>
					<option value="15:00:00" <?php echo set_select('start_time', '15:00:00'); ?>>15:00</option>
					<option value="16:00:00" <?php echo set_select('start_time', '16:00:00'); ?>>16:00</option>
					<option value="17:00:00" <?php echo set_select('start_time', '17:00:00'); ?>>17:00</option>
					<option value="18:00:00" <?php echo set_select('start_time', '18:00:00'); ?>>18:00</option>
					<option value="19:00:00" <?php echo set_select('start_time', '19:00:00'); ?>>19:00</option>
					<option value="20:00:00" <?php echo set_select('start_time', '20:00:00'); ?>>20:00</option>
					<option value="21:00:00" <?php echo set_select('start_time', '21:00:00'); ?>>21:00</option>
					<option value="22:00:00" <?php echo set_select('start_time', '22:00:00'); ?>>22:00</option>
				</select>
			</div>
			<label for="end_year" class="col-sm-2 control-label">진행일시 - 종료</label>
			<div class="col-sm-4">
				<input type="text" name="end_date" id="end_date" class="form-control-static" value="<?php echo set_value('end_date', date('Y-m-d', strtotime('+2 day'))) ?>">
				<select name="end_time" class="form-control-static" id="end_time">
					<option value="06:00:00" <?php echo set_select('end_time', '06:00:00'); ?>>06:00</option>
					<option value="07:00:00" <?php echo set_select('end_time', '07:00:00'); ?>>07:00</option>
					<option value="08:00:00" <?php echo set_select('end_time', '08:00:00'); ?>>08:00</option>
					<option value="09:00:00" <?php echo set_select('end_time', '09:00:00'); ?>>09:00</option>
					<option value="10:00:00" <?php echo set_select('end_time', '10:00:00'); ?>>10:00</option>
					<option value="11:00:00" <?php echo set_select('end_time', '11:00:00'); ?>>11:00</option>
					<option value="12:00:00" <?php echo set_select('end_time', '12:00:00'); ?>>12:00</option>
					<option value="13:00:00" <?php echo set_select('end_time', '13:00:00'); ?>>13:00</option>
					<option value="14:00:00" <?php echo set_select('end_time', '14:00:00'); ?>>14:00</option>
					<option value="15:00:00" <?php echo set_select('end_time', '15:00:00'); ?>>15:00</option>
					<option value="16:00:00" <?php echo set_select('end_time', '16:00:00'); ?>>16:00</option>
					<option value="17:00:00" <?php echo set_select('end_time', '17:00:00'); ?>>17:00</option>
					<option value="18:00:00" <?php echo set_select('end_time', '18:00:00'); ?>>18:00</option>
					<option value="19:00:00" <?php echo set_select('end_time', '19:00:00'); ?>>19:00</option>
					<option value="20:00:00" <?php echo set_select('end_time', '20:00:00'); ?>>20:00</option>
					<option value="21:00:00" <?php echo set_select('end_time', '21:00:00'); ?>>21:00</option>
					<option value="22:00:00" <?php echo set_select('end_time', '22:00:00', TRUE); ?>>22:00</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="deadline_year" class="col-sm-2 control-label">신청마감</label>
			<div class="col-sm-4">
				<input type="text" name="deadline_date" id="deadline_date" class="form-control-static" value="<?php echo set_value('deadline_date', date('Y-m-d', strtotime('+1 day'))) ?>">
				<select name="deadline_time" class="form-control-static" id="deadline_time">
					<option value="06:00:00" <?php echo set_select('deadline_time', '06:00:00'); ?>>06:00</option>
					<option value="07:00:00" <?php echo set_select('deadline_time', '07:00:00'); ?>>07:00</option>
					<option value="08:00:00" <?php echo set_select('deadline_time', '08:00:00'); ?>>08:00</option>
					<option value="09:00:00" <?php echo set_select('deadline_time', '09:00:00'); ?>>09:00</option>
					<option value="10:00:00" <?php echo set_select('deadline_time', '10:00:00'); ?>>10:00</option>
					<option value="11:00:00" <?php echo set_select('deadline_time', '11:00:00'); ?>>11:00</option>
					<option value="12:00:00" <?php echo set_select('deadline_time', '12:00:00'); ?>>12:00</option>
					<option value="13:00:00" <?php echo set_select('deadline_time', '13:00:00'); ?>>13:00</option>
					<option value="14:00:00" <?php echo set_select('deadline_time', '14:00:00'); ?>>14:00</option>
					<option value="15:00:00" <?php echo set_select('deadline_time', '15:00:00'); ?>>15:00</option>
					<option value="16:00:00" <?php echo set_select('deadline_time', '16:00:00'); ?>>16:00</option>
					<option value="17:00:00" <?php echo set_select('deadline_time', '17:00:00'); ?>>17:00</option>
					<option value="18:00:00" <?php echo set_select('deadline_time', '18:00:00'); ?>>18:00</option>
					<option value="19:00:00" <?php echo set_select('deadline_time', '19:00:00'); ?>>19:00</option>
					<option value="20:00:00" <?php echo set_select('deadline_time', '20:00:00'); ?>>20:00</option>
					<option value="21:00:00" <?php echo set_select('deadline_time', '21:00:00'); ?>>21:00</option>
					<option value="22:00:00" <?php echo set_select('deadline_time', '22:00:00', TRUE); ?>>22:00</option>
				</select>
			</div>
			<label for="applicant_limit" class="col-sm-2 control-label">모집인원</label>
			<div class="col-sm-4">
				<input type="text" name="applicant_limit" class="form-control-static" value="<?php echo set_value('applicant_limit', 10) ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">제목</label>
			<div class="col-sm-10">
				<input type="text" name="title" class="form-control" value="<?php echo set_value('title') ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="content" class="col-sm-2 control-label">내용</label>
			<div class="col-sm-10">
				<textarea name="content" class="form-control" id="content"><?php echo set_value('content') ?></textarea>
			</div>
		</div>
		<div class="pull-right">
			<input type="submit" class="btn btn-success" value="등록">
			<a href="/mypage/item_list" class="btn btn-default" role="button">돌아가기</a>
		</div>
	</form>
	<script src="/static/lib/ckeditor/ckeditor.js"></script>
	<script>CKEDITOR.replace('content', {'filebrowserUploadUrl' : '/file/editor_image_upload'});</script>
</section>