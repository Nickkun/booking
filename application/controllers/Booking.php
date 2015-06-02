<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('booking_model');
    }
	public function _remap($method) {
		$view = '/booking/'.$method;
		$data['view'] = $view;

		if ($this->session->has_userdata('logged_in'))
			$data['logged_in'] = $this->session->logged_in;

		if($method === 'list') {
			$data['list'] = $this->booking_model->get_list();
		}

		$this->load->view('header', $data);
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

		$this->load->view('footer');
	}

	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 선택한 아이템의 번호를 기준으로 정보를 조회합니다
	 |------------------------------------------------------
	 */
	 public function detail($url) {
	 	$item_no = $this->uri->segment(3);
	 	if ($item_no === NULL) {
	 		$this->load->view('/booking');
	 	} else {
		 	$data['item'] = $this->booking_model->get_item($item_no);
		 	$this->load->view($url, $data);
	 	}
	 }
	 /*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 선택한 아이템을 신청인원과 함께 신청하며,
	 | booking DB에 정보를 저장하기 위한 뷰 페이지
	 |------------------------------------------------------
	 */
	 public function apply($url) {
	 	if (!$this->session->has_userdata('logged_in'))
	 		redirect('/member/login');
	 	$item_no = $this->uri->segment(3);
	 	$data['item_no'] = $item_no;
	 	$item = $this->booking_model->get_item($item_no);
	 	$data['item'] = $item;

	 	// 선택한 아이템을 신청한 총 인원
	 	$data['present_applicants'] = $this->booking_model->get_item_applicants($item_no);

	 	$this->load->view($url, $data);
	 }
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 작성한 데이터를 기준으로 새로운 아이템을 저장합니다
	 |------------------------------------------------------
	 */
	public function insert() {
		$item_no = $this->uri->segment(3);
		$applicant = $this->input->post('applicant');
		$member_no = $this->session->member_no;
		$data['result'] = '예약 신청';

		$check_exists_item = $this->booking_model->check_member_item($item_no, $member_no);
		if ($check_exists_item != 0) {
			$data['msg'] = '이미 신청한 아이템입니다.';
			$data['redirect'] = '/booking/apply/'.$item_no;
			$this->load->view('/fail', $data);
		} else {
			$check_limit = $this->booking_model->check_applicant_limit($item_no, $applicant);
			if (!$check_limit) {
				$data['msg'] = '신청한 인원이 모집제한을 초과합니다. 신청가능 인원을 확인하세요.';
				$data['redirect'] = '/booking/apply/'.$item_no;
				$this->load->view('/fail', $data);
			} else {
				$new_data = array('item_no' => $item_no, 'member_no' => $member_no, 'applicant' => $applicant);
				$result = $this->booking_model->insert($new_data);

				if ($result) {
					$data['msg'] = '예약 신청에 성공했습니다';
					$data['redirect'] = '/booking/';
					$this->load->view('/success', $data);
				} else {
					$data['msg'] = '신청이 실패했습니다';
					$data['redirect'] = '/booking/apply/'.$item_no;
					$this->load->view('/fail', $data);
				}
			}
		}
	}
}