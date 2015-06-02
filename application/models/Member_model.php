<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 작성한 데이터와 일치하는 
	 | 멤버를 조회한다
	 |------------------------------------------------------
	 */
    public function get_member($condition) {
    	$this->db->where($condition);
    	$query = $this->db->get('member');
    	return $query->row_array();
    }
    /*
     |------------------------------------------------------
     | DESCRIPTION : 
     | 작성한 데이터를 기준으로 멤버 DB에 저장한다
     |------------------------------------------------------
     */
    public function insert($new_member) {
        $this->db->where('email', $new_member['email']);
        $query = $this->db->get('member');
        if ($query->num_rows > 0) {
            $condition = array('email' => $new_member['email']);
            $result = $this->db->update('member', $new_member, $condition);
        } else {
            $result = $this->db->insert('member', $new_member);
        }
    
        return $result;
    }
    /*
     |------------------------------------------------------
     | DESCRIPTION : 
     | 멤버의 정보를 수정한다
     |------------------------------------------------------
     */
    public function update($data, $condition) {
        $result = $this->db->update('member', $data, $condition);
        return $result;
    }
    /*
     |------------------------------------------------------
     | DESCRIPTION : 
     | 멤버를 탈퇴한다. Flag 값 (is_available) 변경 
     |------------------------------------------------------
     */
    public function delete($condition) {
        $data = array('is_available' => 0);
        $result = $this->db->update('member', $data, $condition);
        return $result;
    }
    /*
     |------------------------------------------------------
     | DESCRIPTION : 
     | 멤버의 비밀번호를 수정한다
     |------------------------------------------------------
     */
    public function update_password($data, $condition) {
        $result = $this->db->update('member', $data, $condition);
        return $result;
    }
}
