<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Host extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('host_model');
    }
	public function _remap($method) {
		$view = '/host/'.$method;
		$data['view'] = $view;

		if ($this->session->has_userdata('logged_in'))
			$data['logged_in'] = $this->session->logged_in;

		$member_no = $this->session->member_no;
		
		if($method === 'list') {
			// 차후에 세션 데이터를 기반으로 하는 멤버번호를 매개변수로 추가하여야 함
			// 이 주석은 위의 내용이 추가되면 삭제
			$data['list'] = $this->host_model->get_list($member_no);	
		}

		$this->load->view('header', $data);
		/*
		 |------------------------------------------------------
		 | DESCRIPTION : 
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
	 | 선택 아이템의 데이터를 수정하기 위해
	 | 필요한 데이터를 조회한 후 편집화면으로 전달합니다.
	 |------------------------------------------------------
	 */
	public function edit($url) {
		$item_no = $this->uri->segment(3);
		$data['item'] = $this->host_model->get($item_no);
		$this->load->view($url, $data);

	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 작성한 데이터를 기준으로 새로운 아이템을 저장합니다.
	 |------------------------------------------------------
	 */
	public function insert() {
		$member_no = $this->session->member_no;
		$title     = $this->input->post('title');
		$content   = $this->input->post('content');

		$data = array('member_no' => $member_no, 'title' => $title, 'content' => $content);

		$result = $this->host_model->insert($data);

		$data['result'] = '아이템 개설 ';
		
		if ($result) {
			$data['msg'] = '아이템 개설에 성공했습니다.';
			$data['redirect'] = '/host';
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '아이템 개설에 실패했습니다';
			$data['redirect'] = '/host/add';
			$this->load->view('/fail', $data);
		}
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 선택한 아이템의 정보를 작성한 데이터로 수정합니다
	 |------------------------------------------------------
	 */
	public function update() {
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
			$data['redirect'] = '/host/edit/'.$item_no;
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '아이템 수정에 실패했습니다';
			$data['redirect'] = '/host/edit/'.$item_no;
			$this->load->view('/fail', $data);
		}
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 선택한 아이템을 삭제합니다.
	 |------------------------------------------------------
	 */
	public function delete() {
		$item_no = $this->uri->segment(3);
		$condition = array('item_no' => $item_no);
		$result = $this->host_model->delete($condition);

		$data['result'] = '아이템 삭제';

		if ($result) {
			$data['msg'] = '아이템 삭제에 성공했습니다.';
			$data['redirect'] = '/host';
			$this->load->view('/success', $data);
		} else {
			$data['msg'] = '아이템 삭제에 실패했습니다.';
			$data['redirect'] = '/host/edit/'.$item_no;
			$this->load->view('/fail', $data);
		}
	}
}