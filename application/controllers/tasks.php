<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('task');
	}

	public function index()
	{
		$this->load->view('index', array('tasks' => $this->task->read_tasks()));
	}

	public function process_task() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Task Name', 'trim|required');
		if($this->form_validation->run()) {
			$taskStatus = $this->create_task($this->input->post('name'));
			if($taskStatus['flag']) {
				$taskInfo = array('flag' => $taskStatus['flag'],
								  'id' => $taskStatus['task_id'],
								  'name' => $this->input->post('name'));
			} else {
				$taskInfo = array('flag' => $taskStatus['flag'],
								  'error' => "<p class='error'>An error occurred while creating your note. Please try again.</p>");
			}
		} else {
			$taskInfo = array('flag' => false,
							  'error' => "<p class='error'>Task title is required.</p>");
		}
		echo json_encode($taskInfo);
	}

	public function process_updated_task() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('updated_name', 'Task Name', 'trim|required');
		if($this->form_validation->run()) {
			$updateStatus = $this->update_task($this->input->post('task_id'), $this->input->post('updated_name'));
			if($updateStatus) {
				$updateInfo = array('flag' => $updateStatus,
									'name' => $this->input->post('updated_name'));
			} else {
				$updateInfo = array('flag' => false,
									'error' => "<p class='error'>Task name is required.</p>",
									'placeholder' => "Task name required");
			}
		} else {
			$updateInfo = array('flag' => false,
								'error' => validation_errors(),
								'placeholder' => "Task name required");
		}
		echo json_encode($updateInfo);
	}

	public function create_task($name) {
		return $this->task->create_task($name);
	}

	public function update_task($id, $name) {
		return $this->task->update_task($id, $name);
	}

	public function delete_completed_tasks() {
		$flag =  $this->task->delete_tasks($this->input->get('ids'));
		echo json_encode($flag);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */