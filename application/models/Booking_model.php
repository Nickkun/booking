<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 번호에 해당하는 아이템을 조회한다
	 |------------------------------------------------------
	 */
    public function get_item($item_no) {
    	$this->db->where('item_no', $item_no);
    	$query = $this->db->get('item');
    	$result = $query->row_array();

    	// 신청 가능한 인원 수
    	$present_applicants = $this->get_item_applicants($item_no);
    	$possible_applicant = $result['applicant_limit'] - $present_applicants;
    	$result['possible_applicant'] = $possible_applicant;

    	return $result;
    }
    public function get_booking($booking_no) {
    	$this->db->from('booking');
    	$this->db->join('item', 'item.item_no = booking.item_no');
    	$this->db->where('booking.booking_no', $booking_no);
    	$this->db->where('booking.is_available', 1);
    	$query = $this->db->get();
    	return $query->row_array();
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | DB에 저장된 아이템 목록을 조회한다
	 |------------------------------------------------------
	 */
	public function get_list() {
		$this->db->where('is_available', 1);
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
	public function get_apply_list($member_no) {
		$this->db->from('booking');
		$this->db->join('item', 'item.item_no = booking.item_no', 'left');
		$this->db->where('booking.member_no', $member_no);
		$this->db->where('booking.is_available', 1);
		$this->db->order_by('booking.booking_no', 'DESC');
		$query = $this->db->get();
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
	 | 해당 멤버가 이미 신청한 아이템인지 여부를 조회한다
	 |------------------------------------------------------
	 */
    public function check_member_item($item_no, $member_no) {
    	$condition = array('item_no' => $item_no, 'member_no' => $member_no, 'is_available' => 1);
    	$this->db->where($condition);

    	return $this->db->count_all_results('booking');
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
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 아이템을 신청한다
	 | 멤버의 정보와 아이템 정보를 이용하여 
	 | booking DB에 저장한다
	 |------------------------------------------------------
	 */
    public function insert($data) {
    	if ($data['applicant'] === NULL) return FALSE;
    	
    	$result = $this->db->insert('booking', $data);
    	return $result;
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 예약정보를 수정한다
	 |------------------------------------------------------
	 */
    public function update($data, $condition) {    	
    	$result = $this->db->update('booking', $data, $condition);
    	return $result;
    }
    /*
	 |------------------------------------------------------
	 | DESCRIPTION : 
	 | 예약을 취소한다
	 | 실제로 DB에서 삭제하지 않고 
	 | Flag 값 (is_available) 변경
	 |------------------------------------------------------
	 */
    public function delete($condition) {
    	//$result = $this->db->delete('booking', $condition);
    	$data = array('is_available' => 0);
    	$result = $this->db->update('booking', $data, $condition);
    	return $result;
    }
}
