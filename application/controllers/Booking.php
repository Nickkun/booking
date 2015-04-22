<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function _remap($method) {
		$view = '/booking/'.$method;
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
	 | 작성한 데이터를 기준으로 새로운 아이템을 저장합니다.
	 |------------------------------------------------------
	 */
	public function insert() {
		echo '신청완료 되었습니다';
		echo '<p><a href="/booking/list">돌아가기</a></p>';
	}
}