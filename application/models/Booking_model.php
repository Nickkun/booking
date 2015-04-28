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
    	return $query->row_array();
    }
    public function get_booking($booking_no) {
    	$this->db->from('booking');
    	$this->db->join('item', 'item.item_no = booking.item_no');
    	$this->db->where('booking.booking_no', $booking_no);
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
		$this->db->order_by('item_no', 'DESC');
		$query = $this->db->get('item');
		return $query->result_array();
	}
	public function get_apply_list($member_no) {
		$this->db->from('booking');
		$this->db->join('item', 'item.item_no = booking.item_no', 'left');
		$this->db->where('booking.member_no', $member_no);
		$query = $this->db->get();
		return $query->result_array();

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
	 |------------------------------------------------------
	 */
    public function delete($condition) {
    	$result = $this->db->delete('booking', $condition);
    	return $result;
    }
}
