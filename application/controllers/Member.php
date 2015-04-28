<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('member_model');
    }
	public function _remap($method) {
		$view = '/member/'.$method;
		$data['view'] = $view;

		$data['logged_in'] = '';
		if ($this->session->has_userdata('logged_in')) {
			$data['logged_in'] = $this->session->logged_in;
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
	 | 로그인 한다
	 |------------------------------------------------------
	 */
	 public function do_login() {
	 	$email = $this->input->post('email');
	 	$password = $this->input->post('password');

	 	$condition = array('email' => $email, 'password' => md5($password));
	 	$member = $this->member_model->get_member($condition);

	 	$data['result'] = '로그인';
	 	
	 	if (count($member) > 0) {
	 		$data['msg'] = '로그인에 성공했습니다';
	 		$data['redirect'] = '/';
	 		$user_data = array('logged_in' => TRUE, 'member_no' => $member['member_no'], 'email' => $member['email'], 'name' => $member['name']);
	 		$this->session->set_userdata($user_data);

	 		$this->load->view('/success', $data);
	 	} else {
	 		$data['msg'] = '로그인에 실패했습니다';
	 		$data['redirect'] = '/member/login';

	 	}
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 세션을 제거하고, 로그아웃 한다
	 |------------------------------------------------------
	 */
	public function do_logout() {
		$this->session->sess_destroy();

		$data['loggen_in'] = FALSE;

		$data['result'] = '로그아웃';
		$data['msg'] = '로그아웃에 성공했습니다';
		$data['redirect'] = '/';
		$this->load->view('/success', $data);
	}
	/*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 작성된 데이터를 기준으로 멤버로 가입한다
	 |------------------------------------------------------
	 */
	 public function do_signup() {
	 	$email = $this->input->post('email');
	 	$name = $this->input->post('name');
	 	$password = $this->input->post('password');
	 	$password_confirm = $this->input->post('password_confirm');

	 	$new_member = array('email' => $email, 'name' => $name, 'password' => md5($password));

	 	$data['result'] = '회원가입';

	 	if ($password === $password_confirm) {
	 		$result = $this->member_model->insert($new_member);
	 		if ($result) {
	 			$data['msg'] = '회원가입에 성공했습니다';
	 			$data['redirect'] = '/';
	 			$this->load->view('/success', $data);
	 		} else {
	 			$data['msg'] = '회원가입에 실패했습니다';
	 			$data['redirect'] = '/member/signup';
	 			$this->load->view('/fail', $data);
	 		}
	 	} else {
	 		$data['msg'] = '비밀번호가 일치하지 않습니다';
	 			$data['redirect'] = '/member/signup';
	 			$this->load->view('/fail', $data);
	 	}
	 }
}