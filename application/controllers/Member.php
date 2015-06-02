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
			$data['email'] = $this->session->email;
			$data['name'] = $this->session->name;
			$data['password'] = $this->session->password;
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
	 		$user_data = array('logged_in' => TRUE, 'member_no' => $member['member_no'], 'email' => $member['email'], 'name' => $member['name'], 'password' => $member['password']);
	 		$this->session->set_userdata($user_data);
	 		$this->load->view('/success', $data);
	 	} else {
	 		$data['msg'] = '로그인에 실패했습니다';
	 		$data['redirect'] = '/member/login';
	 		$this->load->view('/fail', $data);

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
	 	if ($this->form_validation->run('signup') == FALSE) {
	 		$this->load->view('/member/signup');
	 	} else {
	 		/* HOST 등록 체크시 HOST 정보 입력 */
		 	$host_registration = $this->input->post('host_registration');
		 	if (!is_null($host_registration)) {
		 		$this->load->view('/member/host_signup');
		 	} else {
		 		/* DB Insert */
			 	$email = $this->input->post('email');
			 	$name = $this->input->post('name');
			 	$password = $this->input->post('password');

			 	$new_member = array('email' => $email, 'name' => $name, 'password' => $password);

			 	$data['result'] = '회원가입';

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
		 	}
		}	 	
	 }
	 /*
	 |------------------------------------------------------
	 | DESCRIPTION :
	 | 작성된 데이터를 기준으로 호스트 멤버로 가입한다
	 |------------------------------------------------------
	 */
	 public function do_host_signup() {
	 	if ($this->form_validation->run('host_signup') == FALSE) {
	 		$this->load->view('/member/host_signup');
	 	} else {

		 	/* DB Insert */
			$email         = $this->input->post('email');
			$name          = $this->input->post('name');
			$password      = $this->input->post('password');
			$host_name     = $this->input->post('host_name');
			$host_contact  = $this->input->post('host_contact');
			$host_email    = $this->input->post('host_email');
			$host_homepage = $this->input->post('host_homepage');


		 	$new_member = array('email' => $email, 'name' => $name, 'password' => $password, 
		 						'host_name' => $host_name, 'host_contact' => $host_contact, 'host_email' => $host_email,
		 						'host_homepage' => $host_homepage);

		 	$data['result'] = '회원가입(호스트)';

	 		$result = $this->member_model->insert($new_member);
	 		if ($result) {
	 			$data['msg'] = '회원가입(호스트)에 성공했습니다';
	 			$data['redirect'] = '/';
	 			$this->load->view('/success', $data);
	 		} else {
	 			$data['msg'] = '회원가입(호스트)에 실패했습니다';
	 			$data['redirect'] = '/member/signup';
	 			$this->load->view('/fail', $data);
	 		}
	 	}
	}
}