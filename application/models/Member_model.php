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
        $result = $this->db->insert('member', $new_member);
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
     | 멤버를 탈퇴한다 
     |------------------------------------------------------
     */
    public function delete($condition) {
        $result = $this->db->delete('member', $condition);
        return $result;
    }
}
