<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		$this->body_Data = array();
		$this->body_Data['title'] = 'Doctors';
		$this->load->model(array('Department_model','Doctor_model'));
		$allDepartments = $this->Department_model->get();
		$departmentArrray = array();
		foreach ($allDepartments as $key => $value) {
			$departmentArrray[$value->id] = $value->name;
		}
		$countries = get_country();
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => 'Doctor Name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'value' => set_value('name')
										)
								);
		$this->body_Data['inputs']['nic'] 	=	array(
									'label' => 'National ID Card Number',
									'id' => 'nic',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'nic',
											'id' => 'nic',
											'value' => set_value('nic')
										)
								);
		$this->body_Data['inputs']['department'] 	=	array(
									'label' => 'Department',
									'id' => 'department',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'department',
											'id' => 'department',
											'options' => $departmentArrray,
											'value' => set_value('department')
										)
								);

		
		$this->body_Data['inputs']['blood_group'] 	=	array(
									'label' => 'Blood Group',
									'id' => 'blood_group',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'blood_group',
											'id' => 'blood_group',
											'options' => array('A+','B-','O+','O-','AB+','AB-'),
											'value' => set_value('blood_group')
										)
								);
		$this->body_Data['inputs']['birth_date'] 	=	array(
									'label' => 'Date of Birth',
									'id' => 'birth_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'birth_date',
											'id' => 'birth_date',
											'value' => set_value('birth_date')
										)
								);	
		$this->body_Data['inputs']['sex'] 	=	array(
									'label' => 'Sex',
									'id' => 'sex',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'id' => 'sex',
											'name' => 'sex',
											'options' => array('Male','Female'),
											'value' => set_value('sex')
										)
								);
		$this->body_Data['inputs']['email'] 	=	array(
									'label' => 'Email',
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => set_value('email')
										)
								);
		$this->body_Data['inputs']['phone'] 	=	array(
									'label' => 'Phone',
									'id' => 'phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'phone',
											'id' => 'phone',
											'value' => set_value('phone')
										)
								);
		$this->body_Data['inputs']['country'] 	=	array(
									'label' => 'Country',
									'id' => 'country',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control rs_country',
											'name' => 'country',
											'id' => 'country',
											'options' => $countries,
											'value' => set_value('country')
										)
								);
		$this->body_Data['inputs']['state'] 	=	array(
									'label' => 'Distric / State',
									'id' => 'state',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'state',
											'id' => 'state',
											'value' => set_value('state')
										)
								);
		$this->body_Data['inputs']['address'] 	=	array(
									'label' => 'Address',
									'id' => 'address',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'address',
											'id' => 'address',
											'value' => set_value('address')
										)
								);
		$this->body_Data['inputs']['about'] 	=	array(
									'label' => 'About Doctor',
									'id' => 'about',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'about',
											'id' => 'about',
											'value' => set_value('about')
										)
								);
	}
	public function index()
	{
		$this->page();
	}
	
	public function page($page = 1)
	{
		$this->body_Data['title'] = "All Doctors";
		$this->body_Data['all_doctors'] = $this->Doctor_model->get();
		$this->load->view('header');
		$this->load->view('doctors/all_doctors',$this->body_Data);
		$this->load->view('footer');
	}

	public function add(){
		$this->body_Data['title'] = 'Add New Doctor';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'nic',
					'label' => 'National ID Card',
					'rules' => 'required|callback__doctor_check',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			foreach ($this->input->post() as $key => $value) {
				$newData[$key] = $value;
			}
			$this->Doctor_model->add($newData);
			$this->body_Data['message'] = "A doctor has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update Doctor';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$this->body_Data['message'] = "A doctor has been updated.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	/*
		Delete a department
	*/
	public function delete($id = null){
		if(is_null($id))
			return;
		$this->Doctor_model->delete(array('id'=>$id));
		$this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->body_Data['doctor'] = $this->Doctor_model->get(array('id'=>$id));
		$this->load->view('header');
		$this->load->view('doctors/about',$this->body_Data);
		$this->load->view('footer');
	}
	public function _doctor_check($data){
		if ($this->Doctor_model->exist(array('nic'=>$this->input->post('nic'))))
        {
                $this->form_validation->set_message('_doctor_check', 'Doctor Exist');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
	}
}
