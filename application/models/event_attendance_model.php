<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class event_attendance_model extends CI_Model {

	public function getDetailsByBatch($batchId) {
		$this -> db -> where("student_batch.batchId", $batchId);
		$this -> db -> join('event_attendance', 'event_attendance.studentId = user.userId', 'left outer');
		$this -> db -> join('student_batch', 'user.userId = student_batch.studentId');
		return $this -> db -> get('user') -> result();
	}

	public function addAttendance($data) {
		if (isset($data)) {
			return $this -> db -> insert('event_attendance', $data);
		}
		return false;
	}

	public function updateAttendance($data) {
		if (isset($data)) {
			$this -> db -> where('eventId', $data['eventId']);
			$this -> db -> where('studentId', $data['studentId']);
			$this -> db -> set('attendanceIsPresent	', $data['attendanceIsPresent']);
			return $this -> db -> update('event_attendance', $data);
		}
		return false;
	}

	public function deleteAttendance($studentId, $eventId) {
		if (isset($studentId)) {
			$this -> db -> where('studentId', $studentId);
			$this -> db -> where('eventId', $eventId);
			$this -> db -> delete('event_attendance');
			return true;
		}
		return true;
	}

}