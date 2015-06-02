<?php
$config = array (
	'signup' => array(
		array(
			'field' => 'email',
			'label' => '',
			'rules' => 'required|valid_email',
			'errors' => array(
				'required' => '이메일은 필수 입력입니다.',
				'valid_email' => '올바른 이메일 형식이 아닙니다.'
			)
		),
		array(
			'field' => 'name',
			'label' => '',
			'rules' => 'required',
			'errors' => array(
				'required' => '이름은 필수 입력입니다.',
			)
		),
		array(
			'field' => 'password',
			'label' => '',
			'rules' => 'required|min_length[4]|max_length[12]|md5',
			'errors' => array(
				'required' => '비밀번호는 필수 입력입니다.',
				'min_length' => '비밀번호는 최소 4자 이상 입력입니다',
				'max_length' => '비밀번호는 최대 12자 이하로 입력입니다'
			)
		),
		array(
			'field' => 'password_confirm',
			'label' => '',
			'rules' => 'required|md5|matches[password]',
			'errors' => array(
				'required' => '비밀번호 확인은 필수 입력입니다.',
				'matches' => '비밀번호가 일치하지 않습니다'
			)
		)
	),
	'host_signup' => array(
		array(
			'field' => 'host_name',
			'label' => '',
			'rules' => 'required',
			'errors' => array(
				'required' => '호스트 이름은 필수 입력입니다'
			)
		),
		array(
			'field' => 'host_contact',
			'label' => '',
			'rules' => 'required|min_length[9]|max_length[11]',
			'errors' => array(
				'required' => '호스트 연락처는 필수 입력입니다'
			)
		),
		array(
			'field' => 'host_email',
			'label' => '',
			'rules' => 'required|valid_email',
			'errors' => array(
				'required' => '호스트 이메일은 필수 입력입니다',
				'valid_email' => '올바른 이메일 형식이 아닙니다'
			)
		),
		array(
			'field' => 'host_homepage',
			'label' => '',
			'rules' => 'trim|valid_url',
			'errors' => array(
				'valid_url' => '올바른 URL 형식이 아닙니다'
			)
		)
	),
	'item' => array(
		array(
			'field' => 'title',
			'label' => '',
			'rules' => 'required',
			'errors' => array(
				'required' => '제목은 필수 입력입니다'
			)
		),
		array(
			'field' => 'content',
			'label' => '',
			'rules' => 'required',
			'errors' => array(
				'required' => '내용은 필수 입력입니다'
			)
		),
		array(
			'field' => 'applicant_limit',
			'label' => '',
			'rules' => 'required|is_natural_no_zero',
			'errors' => array(
				'required' => '모집인원은 필수 입력입니다',
				'is_natural_no_zero' => '자연수로 입력하셔야 합니다'
			)
		)
	),
	'myinfo' => array(
		array(
			'field' => 'name',
			'label' => '',
			'rules' => 'required',
			'errors' => array(
				'required' => '이름은 필수 입력입니다'
			)
		),
		array(
			'field' => 'password',
			'label' => '',
			'rules' => 'required|min_length[4]|max_length[12]|md5',
			'errors' => array(
				'required' => '비밀번호를 입력해야 수정이 가능합니다',
				'min_length' => '비밀번호는 최소 4자 이상 입력입니다',
				'max_length' => '비밀번호는 최대 12자 이하로 입력입니다'
			)
		),
		array(
			'field' => 'password_confirm',
			'label' => '',
			'rules' => 'matches[password]',
			'errors' => array(
				'matches' => '비밀번호가 일치하지 않습니다'
			)
		)
	),
	'myinfo_host' => array(
		array(
			'field' => 'name',
			'label' => '',
			'rules' => 'required',
			'errors' => array(
				'required' => '이름은 필수 입력입니다'
			)
		),
		array(
			'field' => 'password',
			'label' => '',
			'rules' => 'required|min_length[4]|max_length[12]|md5',
			'errors' => array(
				'required' => '비밀번호를 입력해야 수정이 가능합니다',
				'min_length' => '비밀번호는 최소 4자 이상 입력입니다',
				'max_length' => '비밀번호는 최대 12자 이하로 입력입니다'
			)
		),
		array(
			'field' => 'password_confirm',
			'label' => '',
			'rules' => 'matches[password]',
			'errors' => array(
				'matches' => '비밀번호가 일치하지 않습니다'
			)
		),
		array(
			'field' => 'host_name',
			'label' => '',
			'rules' => 'required',
			'errors' => array(
				'required' => '호스트 가입자는 호스트명이 필수 입력입니다'
			)
		),
		array(
			'field' => 'host_contact',
			'label' => '',
			'rules' => 'required|min_length[9]|max_length[11]',
			'errors' => array(
				'required' => '호스트 가입자는 호스트 연락처가 필수 입력입니다'
			)
		),
		array(
			'field' => 'host_email',
			'label' => '',
			'rules' => 'required|valid_email',
			'errors' => array(
				'required' => '호스트 가입자는 호스트 이메일이 필수 입력입니다',
				'valid_email' => '올바른 이메일 형식이 아닙니다'
			)
		),
		array(
			'field' => 'host_homepage',
			'label' => '',
			'rules' => 'trim|valid_url',
			'errors' => array(
				'valid_url' => '홈페이지 주소가 올바른 URL 형식이 아닙니다'
			)
		)
	),
	'password_change' => array(
		array(
			'field' => 'password',
			'label' => '',
			'rules' => 'required|min_length[4]|max_length[12]|md5',
			'errors' => array(
				'required' => '현재 비밀번호는 필수 입력입니다',
				'min_length' => '비밀번호는 최소 4자 이상 입력입니다',
				'max_length' => '비밀번호는 최대 12자 이하로 입력입니다'
			)
		),
		array(
			'field' => 'password_confirm',
			'label' => '',
			'rules' => 'matches[password]',
			'errors' => array(
				'matches' => '현재 비밀번호가 일치하지 않습니다'
			)
		),
		array(
			'field' => 'new_password',
			'label' => '',
			'rules' => 'required|min_length[4]|max_length[12]|md5',
			'errors' => array(
				'required' => '새로운 비밀번호는 필수 입력입니다',
				'min_length' => '새로운 비밀번호는 최소 4자 이상 입력입니다',
				'max_length' => '새로운 비밀번호는 최대 12자 이하로 입력입니다'
			)
		),
		array(
			'field' => 'new_password_confirm',
			'label' => '',
			'rules' => 'required|md5|matches[new_password]',
			'errors' => array(
				'required' => '새로운 비밀번호 확인은 필수 입력입니다.',
				'matches' => '새로운 비밀번호가 일치하지 않습니다'
			)
		)
	)
);

$config['error_prefix'] = "<div class='error'>*";
$config['error_suffix'] = "</div>";
