<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('booking_model', 'host_model', 'member_model'));
    }
    public function _remap($method) {
        $view = '/mypage/' . $method;
        $data['view'] = $view;
        
        $logged_in = $this->session->has_userdata('logged_in');
        if ($logged_in) {
            $data['logged_in'] = $this->session->logged_in;
            $data['password'] = $this->session->password;
        } else {
            redirect('/member/login');
        }
        
        $member_no = $this->session->member_no;
        switch ($method) {
            case 'booking_list':
                $data['list'] = $this->booking_model->get_apply_list($member_no);
                break;
            case 'item_list':
                $condition    = array('member_no' => $member_no);
                $member       = $this->member_model->get_member($condition);
                $data['host'] = $member['host_name'];
                $data['list'] = $this->host_model->get_list($member_no);
                break;
            case 'myinfo': 
                $condition      = array('member_no' => $member_no);
                $member         = $this->member_model->get_member($condition);
                $data['myinfo'] = $member;
                $data['host']   = $member['host_name'];
                break;
            default : 
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
        if (method_exists($this, $method)) {
            $this->$method($view, $data);
        } else {
            $this->load->view($view, $data);
        }
        $this->load->view('/mypage/footer');
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
            $data['redirect'] = '/mypage/edit_booking/' . $booking_no;
            $this->load->view('/success', $data);
        } else {
            $data['msg'] = '예약 정보 수정에 실패했습니다';
            $data['redirect'] = '/mypage/edit_booking/' . $booking_no;
            $this->load->view('/fail', $data);
        }
    }
    public function delete_booking() {
        $booking_no = $this->uri->segment(3);
        $condition = array('booking_no' => $booking_no);
        $result = $this->booking_model->delete($condition);
        
        $data['result'] = '예약 취소';
        
        if ($result) {
            $data['msg'] = '예약 삭제를 성공했습니다.';
            $data['redirect'] = '/mypage/booking_list';
            $this->load->view('/success', $data);
        } else {
            $data['msg'] = '예약 삭제를 실패했습니다.';
            $data['redirect'] = '/mypage/booking_list';
            $this->load->view('/fail', $data);
        }
    }
    
    /* (VIEW)
    |------------------------------------------------------
    | DESCRIPTION :
    | 아이템을 추가한다
    |------------------------------------------------------
    */
    public function add_item($url) {
        $member_no = $this->session->userdata('member_no');
        $condition = array('member_no' => $member_no);
        $member = $this->member_model->get_member($condition);
        
        if (is_null($member['host_name'])) {
            $data['result'] = '호스트';
            $data['msg'] = '호스트 정보를 등록하셔야 개설하실 수 있습니다.' . anchor('/member/host_signup', '호스트 등록하기');
            $data['redirect'] = '/mypage';
            $this->load->view('/fail', $data);
        } else {
            $this->load->view($url);
        }
    }
    
    /* (VIEW)
    |------------------------------------------------------
    | DESCRIPTION :
    | 내 아이템 정보를 수정하거나,
    | 아이템을 삭제한다
    |------------------------------------------------------
    */
    public function edit_item($url) {
		$item_no      = $this->uri->segment(3);
		$item         = $this->host_model->get_item($item_no);

        // 진행시작 일자
        $start              = explode(' ', $item['start_date']);
        $data['start_date'] = $start[0];
        $data['start_time'] = $start[1];
        
        // 진행종료 일자
        $end              = explode(' ', $item['end_date']);		
        $data['end_date'] = $end[0];
        $data['end_time'] = $end[1];
        
        // 신청마감 일자
        $deadline              = explode(' ', $item['deadline_date']);		
        $data['deadline_date'] = $deadline[0];
        $data['deadline_time'] = $deadline[1];

        $data['applicant_limit'] = $item['applicant_limit'];
        $data['title'] = $item['title'];
        $data['content'] = $item['content'];
        $data['item_no'] = $item_no;
        
        $this->load->view($url, $data);
    }
    public function insert_item() {        
        /* 현재시간 */
		$present_time  = time();
		$data['error'] = NULL;
		$time_check    = FALSE;
		
        $start_date    = $this->input->post('start_date') . ' ' . $this->input->post('start_time');
        $end_date      = $this->input->post('end_date') . ' ' . $this->input->post('end_time');
        $deadline_date = $this->input->post('deadline_date') . ' ' . $this->input->post('deadline_time');
        
        // 진행시작 시간 체크
        if ($present_time > strtotime($start_date)) {
            $data['error'] = '진행시작 일시가 현재시간보다 빠릅니다';
        } else {   
            // 진행종료 시간 체크
            if (strtotime($start_date) > strtotime($end_date) || $present_time > strtotime($end_date)) {
                $data['error'] = '진행종료 일시가 진행시작 일시 혹은 현재시간 보다 빠릅니다';
            } else {
            	// 신청마감 시간 체크
                if ($present_time > strtotime($deadline_date) || strtotime($start_date) < strtotime($deadline_date) || strtotime($end_date) < strtotime($deadline_date)) {
                    $data['error'] = '신청마감 일시가 현재시간보다 빠르거나, 진행일시와 같거나 늦습니다.';
                } else {
                    $time_check = TRUE;
                }
            }
        }
        
        
        if ($this->form_validation->run('item') == FALSE || !$time_check) {
            $this->load->view('/mypage/add_item', $data);
        } else {
            $member_no       = $this->session->member_no;
            $title           = $this->input->post('title');
            $content         = $this->input->post('content');
            $applicant_limit = $this->input->post('applicant_limit');
            
            $new_data = array('member_no' => $member_no, 
                              'title' => $title, 
                              'content' => $content, 
                              'start_date' => $start_date, 
                              'end_date' => $end_date, 
                              'deadline_date' => $deadline_date,
                              'applicant_limit' => $applicant_limit);
            
            $result = $this->host_model->insert($new_data);
            
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
    }
    public function update_item() {
        $item_no = $this->input->post('item_no');
        
        /* 현재시간 */
        $present_time  = time();
        $data['error'] = NULL;
        $time_check    = FALSE;
        
        $start_date    = $this->input->post('start_date') . ' ' . $this->input->post('start_time');
        $end_date      = $this->input->post('end_date') . ' ' . $this->input->post('end_time');
        $deadline_date = $this->input->post('deadline_date') . ' ' . $this->input->post('deadline_time');
        
        // 진행시작 시간 체크
        if ($present_time > strtotime($start_date)) {
            $data['error'] = '진행시작 일시가 현재시간보다 빠릅니다';
        } else {   
            // 진행종료 시간 체크
            if (strtotime($start_date) > strtotime($end_date) || $present_time > strtotime($end_date)) {
                $data['error'] = '진행종료 일시가 진행시작 일시 혹은 현재시간 보다 빠릅니다';
            } else {
                // 신청마감 시간 체크
                if ($present_time > strtotime($deadline_date) || strtotime($start_date) < strtotime($deadline_date) || strtotime($end_date) < strtotime($deadline_date)) {
                    $data['error'] = '신청마감 일시가 현재시간보다 빠르거나, 진행일시와 같거나 늦습니다.';
                } else {
                    $time_check = TRUE;
                }
            }
        }
        
        if ($this->form_validation->run('item') == FALSE || !$time_check) {
            $data['start_date']      = $this->input->post('start_date');
            $data['start_time']      = $this->input->post('start_time');
            $data['end_date']        = $this->input->post('end_date');
            $data['end_time']        = $this->input->post('end_time');
            $data['deadline_date']   = $this->input->post('deadline_date');
            $data['deadline_time']   = $this->input->post('deadline_time');
            $data['applicant_limit'] = $this->input->post('applicant_limit');
            $data['title']           = $this->input->post('title');
            $data['content']         = $this->input->post('content');
            $data['item_no']         = $item_no;

            $this->load->view('/mypage/edit_item', $data);
        } else {
            $condition = array('item_no' => $item_no);
            
            $member_no = $this->session->member_no;
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $applicant_limit = $this->input->post('applicant_limit');
            
            $update_data = array('member_no' => $member_no, 
                                 'title' => $title, 
                                 'content' => $content, 
                                 'start_date' => $start_date, 
                                 'end_date' => $end_date, 
                                 'deadline_date' => $deadline_date,
                                 'applicant_limit' => $applicant_limit);
            
            $result = $this->host_model->update($update_data, $condition);
            
            $data['result'] = '아이템 수정';
            
            if ($result) {
                $data['msg'] = '아이템 수정에 성공했습니다.';
                $data['redirect'] = '/mypage/edit_item/' . $item_no;
                $this->load->view('/success', $data);
            } 
            else {
                $data['msg'] = '아이템 수정에 실패했습니다';
                $data['redirect'] = '/mypage/edit_item/' . $item_no;
                $this->load->view('/fail', $data);
            }
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
            $data['redirect'] = '/mypage/edit_item/' . $item_no;
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
        $member_no      = $this->session->member_no;
        $name           = $this->input->post('name');
        $password       = $this->input->post('password');
        $host_name      = $this->input->post('host_name');
        $host_contact   = $this->input->post('host_contact');
        $host_email     = $this->input->post('host_email');
        $host_homepage  = $this->input->post('host_homepage');
        $data['result'] = '개인정보 수정';
        
        if (!is_null($host_name)) $form_validation = 'myinfo_host';
        else $form_validation = 'myinfo';
        
        // FORM VALIDATION CHECK
        if ($this->form_validation->run($form_validation) == FALSE) {
            $condition      = array('member_no' => $member_no);
            $member         = $this->member_model->get_member($condition);
            $data['myinfo'] = $member;
            $data['host']   = $member['host_name'];
            $this->load->view('/mypage/myinfo', $data);
        } else {
            $myinfo = array('name' => $name, 'host_name' => $host_name, 'host_contact' => $host_contact, 'host_email' => $host_email, 'host_homepage' => $host_homepage);
            $condition = array('member_no' => $member_no);
            
            $result = $this->member_model->update($myinfo, $condition);
            
            if ($result) {
                $data['msg'] = '개인정보 수정에 성공했습니다.';
                $data['redirect'] = '/mypage/myinfo';
                $this->load->view('/success', $data);
            } 
            else {
                $data['msg'] = '개인정보 수정에 실패했습니다';
                $data['redirect'] = '/mypage/myinfo';
                $this->load->view('/fail', $data);
            }
        }
    }
    
    /*
    |------------------------------------------------------
    | DESCRIPTION :
    | 비밀번호를 변경한다
    |------------------------------------------------------
    */
    public function edit_password_change() {
        if ($this->form_validation->run('password_change') == FALSE) {
            $this->load->view('/mypage/password_change');
        } else {
            $member_no = $this->session->member_no;
            $new_password = $this->input->post('new_password');
            $condition = array('member_no' => $member_no);
            $new_password_data = array('password' => $new_password);
            
            $data['result'] = '비밀번호 변경';
            
            $result = $this->member_model->update_password($new_password_data, $condition);
            if ($result) {
                
                // 세션 업데이트
                $this->session->unset_userdata('password');
                 // 기존의 세션정보 제거
                $this->session->set_userdata('password', $new_password);
                
                $data['msg'] = '비밀번호 변경에 성공했습니다';
                $data['redirect'] = '/mypage';
                $this->load->view('/success', $data);
            } 
            else {
                $data['msg'] = '비밀번호 변경에 실패했습니다';
                $data['redirect'] = '/mypage/password_change';
                $this->load->view('/fail', $data);
            }
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
