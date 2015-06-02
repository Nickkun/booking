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
    	$condition = array('item_no' => $item_no, 'is_available' => 1);
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
		$condition = array('member_no' => $member_no, 'is_available' => 1);
		$this->db->where($condition);
		$this->db->order_by('item_no', 'DESC');
		$query = $this->db->get('item');
		$result = $query->result_array();

		// 신청 가능한 인원 수 추가
		foreach ($result as $key => $value) {
			$present_applicants = $this->get_item_applicants($value['item_no']);
			$possible_applicant = $value['applicant_limit'] - $present_applicants;
			$result[$key]['possible_applicant'] = $possible_applicant;
		}

		return $result;
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
	 | Item DB에서 삭제하지 않고, Flag 값을 변경 (is_available)
	 |------------------------------------------------------
	 */
    public function delete($condition) {
    	//$result = $this->db->delete('item', $condition);
    	$data = array('is_available' => 0);
    	$result = $this->db->update('item', $data, $condition);
    	return $result;
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 해당 아이템을 신청한 총 인원을 조회한다
	 |------------------------------------------------------
	 */
	public function get_item_applicants($item_no) {
		$condition = array('item_no' => $item_no, 'is_available' => 1);
		
		$this->db->select_sum('applicant');
		$this->db->where($condition);

		$query = $this->db->get('booking');
		$result = $query->row_array();
		return $result['applicant'];
	}

    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 해당 아이템의 신청인원이 초과되지 않는지 검사한다
	 |------------------------------------------------------
	 */
    public function check_applicant_limit($item_no, $applicant) {
    	$item = $this->get_item($item_no);
    	$present_applicants = $this->get_item_applicants($item_no);
    	
    	// 신청가능한 지원자 수
    	$possible_applicant = $item['applicant_limit'] - $present_applicants;

    	if ($applicant > $possible_applicant) {
    		return FALSE;
    	} else {
    		return TRUE;
    	}
    }
}
