<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Host_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 번호에 해당하는 멤버의 아이템을 조회한다
	 |------------------------------------------------------
	 */
    public function get_item($item_no) {
    	$condition = array('item_no' => $item_no);
    	$this->db->where($condition);
    	$query = $this->db->get('item');
    	return $query->row_array();
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | DB에 저장된 멤버의 아이템 목록을 조회한다
	 |------------------------------------------------------
	 */
	public function get_list($member_no) {
		$this->db->where('member_no', $member_no);
		$this->db->order_by('item_no', 'DESC');
		$query = $this->db->get('item');
		return $query->result_array();
	}
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 아이템을 개설합니다
	 | 멤버의 정보와 작성한 아이템 정보를 이용하여 
	 | Item DB에 저장합니다
	 |------------------------------------------------------
	 */
    public function insert($data) {
    	$result = $this->db->insert('item', $data);
    	return $result;
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 아이템을 수정합니다
	 | 입력한 정보를 바탕으로 아이템 정보를 대체하여
	 | Item DB에 저장합니다
	 |------------------------------------------------------
	 */
    public function update($data, $condition) {
    	$result = $this->db->update('item', $data, $condition);
    	return $result;
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 아이템을 삭제합니다
	 | 선택한 아이템에 해당하는 아이템을 
	 | Item DB에서 삭제합니다
	 |------------------------------------------------------
	 */
    public function delete($condition) {
    	$result = $this->db->delete('item', $condition);
    	return $result;
    }
}
