<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends MY_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
	}
	
	public function index()
	{
		if(!empty($this->session->userdata('UserID')))
		{
			@$this->session->unset_userdata($key, $val);
			$this->session->sess_destroy();

			$tblusersUpdate = array(
				'isloggedin' => 0
			);

			$recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserID'), $where = array($this->session->userdata('UserID')), $tblusersUpdate);
		}

		header("Access-Control-Allow-Origin: *");
		$title['title'] = "GradeTrack Admin";

		$this->load->view('header', $title);
		$this->load->view('adminpage/adminlogin');
		$this->load->view('footer');
	}

	/*********************************LOGIN******************************************* */
	public function login()
	{
		if($this->session->userdata('Username') == '')
		{
			$this->form_validation->set_rules('username', 'Username', 'required');    
			$this->form_validation->set_rules('password', 'Password', 'required'); 
				
			if($this->form_validation->run() == FALSE)
			{
				header("Access-Control-Allow-Origin: *");
				$title['title'] = "GradeTrack Admin";

				$this->load->view('header', $title);
				$this->load->view('adminpage/adminlogin');
				$this->load->view('footer');
			}
			else
			{
				$post = $this->input->post();  
				$clean = $this->security->xss_clean($post);
			
				$getPassword = $this->_getRecordsData(
					$data = array('*'),
					$tables = array('tblusers'),
					$fieldName = array('Username'),
					$where = array($clean['username']), 
					$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, $fieldNameLike = null, $like = null, $whereSpecial = null, $groupBy = null );
			
				if(!empty($getPassword)) {
					$decryptedPassword = $this->encryption->decrypt($getPassword[0]->Password);
					//echo $decryptedPassword;
				
					if($decryptedPassword === $clean['password']) {
						foreach($getPassword[0] as $key=>$val){
							$this->session->set_userdata($key, $val);
						}

						$tblusersUpdate = array(
							'lastLogin' => date('Y-m-d H:i:s'),
							'isloggedin' => 1
						);

						$recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserID'), $where = array($getPassword[0]->UserID), $tblusersUpdate);

						//Audit Trails
						$audit_trail = null;
						$audit_trail = array(
							'Username' => $getPassword[0]->Username,
							'UserType' => $getPassword[0]->UserTypeID,
							'ActionDone' => 'Logged In.',
							'DateTimeActionMade' => date('Y-m-d H:i:s'),
							'ip_address' => $this->input->ip_address()
						);
						//Audit Trail
				        $this->_insertRecords($tableName = 'tblaudittrail', $audit_trail);
						
						if($getPassword[0]->UserTypeID == 1)
						{
							$this->session->set_flashdata('msg', 'UNAUTHORIZED ACCESS. YOU ARE NOT ALLOWED HERE.');
							redirect(base_url().'admin');
						}
						if($getPassword[0]->UserTypeID == 2)
						{	
							$this->session->set_flashdata('msg', 'UNAUTHORIZED ACCESS. YOU ARE NOT ALLOWED HERE.');
							redirect(base_url().'admin');
						}
						if($getPassword[0]->UserTypeID == 3)
						{	
							redirect(base_url().'admin/adminbody.html');
						}
					}
					else
					{
						$this->session->set_flashdata('msg', 'Wrong Password.');
						redirect(base_url().'admin');
					}
				} 
				else
				{
					$this->session->set_flashdata('msg', 'Wrong Username.');
					redirect(base_url().'admin');
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	/************************************END LOGIN ******************************************** */

	/************************************ADMIN BODY ******************************************** */
	public function adminbody()
	{
		if($this->session->userdata('Username') != '')
		{
			header("Access-Control-Allow-Origin: *");
			$title['title'] = "Admin";

			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/adminbody');
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'/admin');
		}

	}
	/************************************END ADMIN BODY ******************************************** */

	/************************************LOGOUT ******************************************** */
	public function logout()
	{
		$tblusersUpdate = array(
			'isloggedin' => 0
		);

		$recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserID'), $where = array($this->session->userdata('UserID')), $tblusersUpdate);

		//Audit Trails
		$audit_trail = null;
		$audit_trail = array(
			'Username' => $this->session->userdata('Username'),
			'UserType' => $this->session->userdata('UserTypeID'),
			'ActionDone' => 'Logged Out.',
			'DateTimeActionMade' => date('Y-m-d H:i:s'),
			'ip_address' => $this->input->ip_address()
		);
		//Audit Trail
		$this->_insertRecords($tableName = 'tblaudittrail', $audit_trail);

		$this->session->unset_userdata($key, $val);
		$this->session->sess_destroy();
		redirect(base_url().'admin');
	}

	/************************************END LOGOUT ******************************************** */

	/************************************BACKUP DATABASE ******************************************** */
	public function database_backup(){
		//Audit Trails
		$audit_trail = null;
		$audit_trail = array(
			'Username' => $this->session->userdata('Username'),
			'UserType' => $this->session->userdata('UserTypeID'),
			'ActionDone' => 'Backed Up Database.',
			'DateTimeActionMade' => date('Y-m-d H:i:s'),
			'ip_address' => $this->input->ip_address()
		);
		//Audit Trail
		$this->_insertRecords($tableName = 'tblaudittrail', $audit_trail);
		
		$this->load->dbutil();
		$db_format = array('format'=>'zip','filename'=>'dbgradetrack_backup.sql');
		$backup =& $this->dbutil->backup($db_format);
		$dbname = 'backup-on-' .date('Y-m-d'). ' .zip';
		$save = 'resources/db_backup/'. $dbname;
		write_file($save,$backup);
		force_download($dbname,$backup);
	}
	/************************************END BACKUP DATABASE ******************************************** */

	/************************************SHOW USERS DETAILS ******************************************** */
	public function users()
	{
		if($this->session->userdata('Username') != '')
		{
			$getWholeTable = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblusers'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			$getNumberOfActiveUsers = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblusers'), 
				$fieldName = array('status'),
				$where = array('confirmed'),
				$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			$getNumberOfOnlineUsers = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblusers'), 
				$fieldName = array('isloggedin'),
				$where = array(1),
				$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			$numOfActive = count($getNumberOfActiveUsers);
			$numOfLoggedIn = count($getNumberOfOnlineUsers);

			header("Access-Control-Allow-Origin: *");
			$title['title'] = "Admin";

			$data['tblusers'] = $getWholeTable;
			$data['noOfActiveUsers'] = $numOfActive;
			$data['noOfLoggedInUsers'] = $numOfLoggedIn;

			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/UsersDetails', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'admin');
		}	
	}
	/************************************END SHOW USERS DETAILS ******************************************** */

	/************************************SHOW AUDIT TRAIL ******************************************** */
	public function audittrail()
	{
		if($this->session->userdata('Username') != '')
		{
			$getWholeTable = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblaudittrail'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = array('10','0'), 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			header("Access-Control-Allow-Origin: *");
			$title['title'] = "Admin";

			$data['tblaudittrail'] = $getWholeTable;

			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/AuditTrail', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'admin');
		}	
		
	}
	/************************************END SHOW AUDIT TRAIL ******************************************** */

	/************************************SHOW SET SY SEM GP******************************************** */
	public function showsysemgp()
	{
		if($this->session->userdata('Username') != '')
		{
			$getData = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblsetsysemgp'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			$data['SY'] = @$getData[0]->SY;
			$data['Sem'] = @$getData[0]->Sem;
			$data['GradingPeriod'] = @$getData[0]->GradingPeriod;
			$data['wholetable'] = @$getData;

			header("Access-Control-Allow-Origin: *");
			$title['title'] = "Admin";
		
			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/SetSySemGp', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'admin');
		}
	}

	public function setsysemgp()
	{
		$this->form_validation->set_rules('schoolYear', 'School Year', 'required|numeric|exact_length[4]');
				
		if($this->form_validation->run() == FALSE)
		{
			$this->showsysemgp();
		}
		else
		{
			$getData = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblsetsysemgp'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			$schoolYear = $this->input->post('schoolYear');
			$semester = $this->input->post('semester');
			$gradingperiod = $this->input->post('gradingperiod');

			$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));

			//insert records into database
			$data = null;
			$data = array(
				'SY' => $clean['schoolYear'],
				'Sem' => $semester,
				'GradingPeriod' => $gradingperiod,
				'datetime_updated' => date('Y-m-d H:i:s'),
				'prevSem' => @$getData[0]->Sem
			);
			$id = $this->_insertRecords($tableName = 'tblsetsysemgp', $data);

			//Audit Trails
			$audit_trail = null;
			$audit_trail = array(
				'Username' => $this->session->userdata('Username'),
				'UserType' => $this->session->userdata('UserTypeID'),
				'ActionDone' => 'Updated SY, Sem, or Grading Period.',
				'DateTimeActionMade' => date('Y-m-d H:i:s'),
				'ip_address' => $this->input->ip_address()
			);
			//Audit Trail
			$this->_insertRecords($tableName = 'tblaudittrail', $audit_trail);

			if(@$getData[0]->Sem != @$getData[0]->prevSem)
			{
				$tblusersUpdate = array(
					'parentNotif' => 0,
					'parentNotifIsSet' => 0
				);

				$this->_updateRecords($tableName = 'tblusers', $fieldName = array('parentNotif'), $where = null, $tblusersUpdate);
			}

			$this->showsysemgp();
		}
	}
	/************************************END SHOW SET SY SEM GP******************************************** */

	/************************************SEARCH USER'S DETAILS******************************************** */
	public function searchuserdetails()
	{
		$FName = $this->input->post('FName');
		$MName = $this->input->post('MName');
		$LName = $this->input->post('LName');
		$Username = $this->input->post('Username');

		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));

		$getSearch = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblusers'), 
			$fieldName = null,
			$where = null,
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
			$fieldNameLike = array('FName','MName','LName','Username'),
			$like = array($clean['FName'],$clean['MName'],$clean['LName'],$clean['Username']), 
			$whereSpecial = null, $groupBy = null );

		$getNumberOfActiveUsers = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblusers'), 
			$fieldName = array('status'),
			$where = array('confirmed'),
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

		$getNumberOfOnlineUsers = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblusers'), 
			$fieldName = array('isloggedin'),
			$where = array(1),
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

		$numOfActive = count($getNumberOfActiveUsers);
		$numOfLoggedIn = count($getNumberOfOnlineUsers);

		header("Access-Control-Allow-Origin: *");
		$title['title'] = "Admin";

		$data['tblusers'] = $getSearch;
		$data['noOfActiveUsers'] = $numOfActive;
		$data['noOfLoggedInUsers'] = $numOfLoggedIn;

		$this->load->view('header', $title);
		$this->load->view('adminpage/adminnavbar');
		$this->load->view('adminpage/UsersDetails', $data);
		$this->load->view('footer');
	}
	/************************************END SEARCH USER'S DETAILS******************************************** */

	/************************************SEARCH AUDIT TRAIL******************************************** */
	public function searchaudittrail()
	{
		$Username = $this->input->post('Username');
		$ActionDone = $this->input->post('ActionDone');
		$DateTime = $this->input->post('DateTime');

		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));

		$getSearch = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblaudittrail'), 
			$fieldName = null,
			$where = null,
			$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
			$fieldNameLike = array('Username','ActionDone','DateTimeActionMade'),
			$like = array($clean['Username'],$clean['ActionDone'],$clean['DateTime']), 
			$whereSpecial = null, $groupBy = null );

		header("Access-Control-Allow-Origin: *");
		$title['title'] = "Admin";

		$data['tblaudittrail'] = $getSearch;

		$this->load->view('header', $title);
		$this->load->view('adminpage/adminnavbar');
		$this->load->view('adminpage/AuditTrail', $data);
		$this->load->view('footer');
	}
	/************************************END SEARCH AUDIT TRAIL******************************************** */
}