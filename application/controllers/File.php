<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {
	public function __construct() {
        parent::__construct();        
    }

    public function index() {}

	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 웹에디터(CKEditor)에 이미지를 삽입할 경우
	 | 해당 이미지를 처리하여 저장한다
	 |------------------------------------------------------
	 */
    public function editor_image_upload() {
        $yearmonth = date('Ym');
        $upload_file_name = md5(date('YmdHis').$this->session->member_no);

        $this->ftp->connect();
        $path_dir = $this->ftp->list_files(UPLOAD_ROOT_PATH);
        $exist_dir = FALSE;
        
        if (!empty($path_dir) && count($path_dir) > 0) {
            foreach ($path_dir as $key => $val) {
                if (strpos($val, $yearmonth)) {
                    $exist_dir = TRUE;
                }
            }
            if (!$exist_dir) {
                $this->ftp->mkdir(UPLOAD_ROOT_PATH . $yearmonth, DIR_WRITE_MODE);
            }
        } else {
            $this->ftp->mkdir(UPLOAD_ROOT_PATH . $yearmonth, DIR_WRITE_MODE);
        }
        
        $config['upload_path']   = './static/uploads/'. $yearmonth .'/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '2000';
        $config['max_width']     = '1024';
        $config['max_height']    = '4000';
        $config['file_name']     = $upload_file_name;
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('upload')) {
            echo "<script>alert('업로드에 실패했습니다. ".$this->upload->display_errors('','')."');</script>";
        } else {
            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
            
            $data = $this->upload->data();
            $file_name = $data['file_name'];
            
            $url = '/static/uploads/' . $yearmonth . '/' . $file_name;
            
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('" . $CKEditorFuncNum . "', '" . $url . "', '전송에 성공하였습니다')</script>";
        }
        
        $this->ftp->close();
    }
}