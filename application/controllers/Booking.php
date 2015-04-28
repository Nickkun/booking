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
	 | booking DB에 정보를 저장합니다
	 |------------------------------------------------------
	 */
	 public function apply($url) {
	 	$data['item_no'] = $this->uri->segment(3);
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
		$data = array('item_no' => $item_no, 'member_no' => $member_no, 'applicant' => $applicant);
		
		$result = $this->booking_model->insert($data);

		$data['result'] = '예약 신청';
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