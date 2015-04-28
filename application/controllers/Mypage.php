<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model(array('booking_model', 'host_model', 'member_model'));
        
    }
	public function _remap($method) {
		$view = '/mypage/'.$method;
		$data['view'] = $view;
		
		$logged_in = $this->session->has_userdata('logged_in');
		if ($logged_in) $data['logged_in'] = $this->session->logged_in;
		else redirect('/member/login');


		// 차후에 세션 데이터를 기반으로 하는 멤버번호를 매개변수로 추가하여야 함
		// 이 주석은 위의 내용이 추가되면 삭제
		$member_no = $this->session->member_no;
		switch ($method) {
			case 'booking_list':
				$data['list'] = $this->booking_model->get_apply_list($member_no);
				break;
			case 'item_list':
				$data['list'] = $this->host_model->get_list($member_no);
				break;
			default:
				$condition = array('member_no' => $member_no);
				$data['myinfo'] = $this->member_model->get_member($condition);
				break;
		}

		$this->load->view('header', $data);
		$this->load->view('/mypage/header');
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
	 | 내 예약 정보를 수정하거나,
	 | 예약을 취소한다
	 |------------------------------------------------------
	 */
	// VIEW
	public function edit_booking($url) {
		$booking_no = $this->uri->segment(3);
		$data['booking'] = $this->booking_model->get_booking($booking_no);
		$this->load->view($url, $data);
	}
	public function update_booking() {
		$booking_no = $this->uri->segment(3);
		$condition = array('booking_no' => $booking_no);

		$applicant = $this->input->post('applicant');
		$data = array('applicant' => $applicant);
		$result = $this->booking_model->update($data, $condition);

		$data['result'] = '내 예약 수정';
		if ($result) {
			$data['msg'] = '예약 정보 수정에 성공했습니다.';
			$data['redirect'] = '/mypage/edit_booking/'.$booking_no;
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '예약 정보 수정에 실패했습니다';
			$data['redirect'] = '/mypage/edit_booking/'.$booking_no;
			$this->load->view('/fail', $data);
		}

	}
	public function delete_booking() {
		$booking_no = $this->uri->segment(3);
		$condition = array('booking_no' => $booking_no);
		$result = $this->booking_model->delete($condition);

		$data['result'] = '예약 취소';

		if ($result) {
			$data['msg'] = '예약 취소에 성공했습니다.';
			$data['redirect'] = '/mypage/booking_list';
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '예약 취소에 실패했습니다.';
			$data['redirect'] = '/mypage/booking_list';
			$this->load->view('/fail', $data);
		}
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 내 아이템 정보를 수정하거나,
	 | 아이템을 삭제한다
	 |------------------------------------------------------
	 */
	// VIEW
	public function edit_item($url) {
		$item_no = $this->uri->segment(3);
		$data['item'] = $this->host_model->get_item($item_no);
		$this->load->view($url, $data);
	}
	public function insert_item() {
		$member_no = $this->session->member_no;
		$title     = $this->input->post('title');
		$content   = $this->input->post('content');

		$data = array('member_no' => $member_no, 'title' => $title, 'content' => $content);

		$result = $this->host_model->insert($data);

		$data['result'] = '아이템 개설 ';
		
		if ($result) {
			$data['msg'] = '아이템 개설에 성공했습니다.';
			$data['redirect'] = '/mypage/item_list';
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '아이템 개설에 실패했습니다';
			$data['redirect'] = '/mypage/add_item';
			$this->load->view('/fail', $data);
		}
	}
	public function update_item() {
		$item_no = $this->uri->segment(3);
		$condition = array('item_no' => $item_no);

		$member_no = $this->session->member_no;
		$title     = $this->input->post('title');
		$content   = $this->input->post('content');

		$data = array('member_no' => $member_no, 'title' => $title, 'content' => $content);
		
		$result = $this->host_model->update($data, $condition);
		
		$data['result'] = '아이템 수정';

		if ($result) {
			$data['msg'] = '아이템 수정에 성공했습니다.';
			$data['redirect'] = '/mypage/edit_item/'.$item_no;
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '아이템 수정에 실패했습니다';
			$data['redirect'] = '/mypage/edit_item/'.$item_no;
			$this->load->view('/fail', $data);
		}

	}
	public function delete_item() {
		$item_no = $this->uri->segment(3);
		$condition = array('item_no' => $item_no);
		$result = $this->host_model->delete($condition);

		$data['result'] = '아이템 삭제';

		if ($result) {
			$data['msg'] = '아이템 삭제에 성공했습니다.';
			$data['redirect'] = '/mypage/item_list';
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '아이템 삭제에 실패했습니다.';
			$data['redirect'] = '/mypage/edit_item/'.$item_no;
			$this->load->view('/fail', $data);
		}
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 작성한 데이터를 기준으로 개인정보를 수정한다
	 |------------------------------------------------------
	 */
	public function update() {
		$member_no = $this->session->member_no;
		$condition = array('member_no' => $member_no);

		$name     = $this->input->post('name');
		$password = $this->input->post('password');

		$data = array('member_no' => $member_no, 'name' => $name, 'password' => $password);
		
		$result = $this->mypage_model->update($data, $condition);
		
		$data['result'] = '개인정보 수정';

		if ($result) {
			$data['msg'] = '개인정보 수정에 성공했습니다.';
			$data['redirect'] = '/mypage';
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '개인정보 수정에 실패했습니다';
			$data['redirect'] = '/mypage/myinfo';
			$this->load->view('/fail', $data);
		}
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 현재 접속한 멤버를 탈퇴처리 한다
	 |------------------------------------------------------
	 */
	public function delete() {
		echo '멤버에서 탈퇴하였습니다';
		echo '<p><a href="/mypage/list">돌아가기</a></p>';
	}
}