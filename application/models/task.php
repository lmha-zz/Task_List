<?php

class Task extends CI_Model {

	public function create_task($name) {
		$query = "INSERT INTO tasks (name, created_at, updated_at) VALUES (?, NOW(), NOW())";
		$flag = $this->db->query($query, array($name));
		$data = array('flag' => $flag,
					  'task_id' => $this->db->insert_id());
		return $data;
	}
	
	public function read_tasks() {
		$query = "SELECT * FROM tasks";
		return $this->db->query($query)->result_array();
	}

	public function update_task($id, $name) {
		$query = "UPDATE tasks SET name = ?, updated_at = NOW() WHERE id = {$id}";
		return $this->db->query($query, array($name));
	}

	public function delete_tasks($ids) {
		$query = "DELETE FROM tasks WHERE id IN ({$ids})";
		return $this->db->query($query);
	}

}

?>