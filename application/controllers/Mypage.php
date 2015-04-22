<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends CI_Controller {
	public function __construct() {
        parent::__construct();
        
    }
	public function _remap($method) {
		$view = '/mypage/'.$method;
		$data['view'] = $view;

		$this->load->view('header');

		/*
		 |------------------------------------------------------
		 | View 와 같은 이름의 Method 가 존재하면
		 | Method 를 우선 호출 하도록 함 
		 |------------------------------------------------------
		 */
		if(method_exists($this, $method)) {
			$this->$method($view, $data);
		} else {
			$this->load->view($view, $data);
		}
	}
	public function view($page = 'home') {
		
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 작성한 데이터로 신청한 아이템의 데이터를 수정합니다.
	 |------------------------------------------------------
	 */
	public function update() {
		echo '신청한 아이템이 수정되었습니다';
		echo '<p><a href="/mypage/list">돌아가기</a></p>';
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 선택한 신청 아이템을 취소합니다.
	 |------------------------------------------------------
	 */
	public function delete() {
		echo '신청아이템을 취소 하였습니다';
		echo '<p><a href="/mypage/list">돌아가기</a></p>';
	}
}