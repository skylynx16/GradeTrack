<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
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
							redirect(base_url().'Admin');
						}
						if($getPassword[0]->UserTypeID == 2)
						{	
							$this->session->set_flashdata('msg', 'UNAUTHORIZED ACCESS. YOU ARE NOT ALLOWED HERE.');
							redirect(base_url().'Admin');
						}
						if($getPassword[0]->UserTypeID == 3)
						{	
							redirect(base_url().'Admin/adminbody.html');
						}
					}
					else
					{
						$this->session->set_flashdata('msg', 'Wrong Password.');
						redirect(base_url().'Admin');
					}
				} 
				else
				{
					$this->session->set_flashdata('msg', 'Wrong Username.');
					redirect(base_url().'Admin');
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
			redirect(base_url().'Admin');
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

		@$this->session->unset_userdata($key, $val);
		@$this->session->sess_destroy();
		redirect(base_url().'Admin');
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
		$backup = $this->dbutil->backup($db_format);
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
			$title['title'] = "Users";

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
			redirect(base_url().'Admin');
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
			$title['title'] = "General Audit Trail";

			$data['tblaudittrail'] = $getWholeTable;

			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/AuditTrail', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'Admin');
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
			$title['title'] = "Set School Year, Semester, and Grading Period";
		
			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/SetSySemGp', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'Admin');
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

			$getData1 = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblsetsysemgp'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			if($getData1[0]->Sem != $getData1[0]->prevSem)
			{
				$tblusersUpdate = array(
					'parentNotif' => 0,
					'parentNotifIsSet' => 0
				);

				$this->Gt_model->createTblForProfAuditTrail($getData1[0]->Sem,$getData1[0]->SY);

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
		$title['title'] = "Users";

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
		$UserType = $this->input->post('UserType');
		$ActionDone = $this->input->post('ActionDone');
		$DateTime = $this->input->post('DateTime');
		$numberUserType = null;

		if(strtolower($UserType) == 'professor')
		{
			$numberUserType = 1;
		}
		if(strtolower($UserType) == 'student')
		{
			$numberUserType = 2;	
		}
		if(strtolower($UserType) == 'admin')
		{
			$numberUserType = 3;
		}

		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));

		$getSearch = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblaudittrail'), 
			$fieldName = null,
			$where = null,
			$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
			$fieldNameLike = array('Username','UserType','ActionDone','DateTimeActionMade'),
			$like = array($clean['Username'],$numberUserType,$clean['ActionDone'],$clean['DateTime']), 
			$whereSpecial = null, $groupBy = null );

		header("Access-Control-Allow-Origin: *");
		$title['title'] = "Audit Trail";

		$data['tblaudittrail'] = $getSearch;

		$this->load->view('header', $title);
		$this->load->view('adminpage/adminnavbar');
		$this->load->view('adminpage/AuditTrail', $data);
		$this->load->view('footer');
	}
	/************************************END SEARCH AUDIT TRAIL******************************************** */

	/************************************GET DATE AND TIME******************************************** */
	public function serverdateandtime()
	{
		echo $timestamp = 'Server Date: '.date('M. d, Y').'<br>Server Time: '.date('H:i:s').'<br>Server Timezone: '.date('e');
	}
	/************************************END GET DATE AND TIME******************************************** */

	/************************************SETTING DEADLINE******************************************** */
	public function showdeadline()
	{
		if($this->session->userdata('Username') != '')
		{
			$getData = $this->_getRecordsData($data = array('*'), 
					$tables = array('tbldeadlines'), 
					$fieldName = null,
					$where = null,
					$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = array('10','0'), 
					$fieldNameLike = null, $like = null, 
					$whereSpecial = null, $groupBy = null );

			header("Access-Control-Allow-Origin: *");
			$title['title'] = "Set Deadline and Toggle System Accessibility";

			$data['wholetable'] = $getData;

			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/SetDeadlineEnableDisableSys', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'Admin');
		}
	}

	public function setdeadline()
	{
		$getData = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblsetsysemgp'), 
			$fieldName = null,
			$where = null,
			$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

		//insert records into database
		$data = null;
		$data = array(
			'deadlineDateTime' => $this->input->post('deadlineDate').' '.$this->input->post('deadlineTime'),
			'Sem' => $getData[0]->Sem,
			'SY' => $getData[0]->SY,
			'datetimeSet' => date('Y-m-d H:i:s')
		);
		$id = $this->_insertRecords($tableName = 'tbldeadlines', $data);

		//Audit Trails
		$audit_trail = null;
		$audit_trail = array(
			'Username' => $this->session->userdata('Username'),
			'UserType' => $this->session->userdata('UserTypeID'),
			'ActionDone' => 'Set Deadline ('.$this->input->post('deadlineDate').') for Encoding of Final Grades in SY: '.$getData[0]->SY.' Sem: '.$getData[0]->Sem.'.',
			'DateTimeActionMade' => date('Y-m-d H:i:s'),
			'ip_address' => $this->input->ip_address()
		);
		//Audit Trail
		$this->_insertRecords($tableName = 'tblaudittrail', $audit_trail);

		//unlock system for professors
		$tblusersUpdate = array(
			'deadlineTrigger' => 0
		);

		$recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserTypeID'), $where = array(1), $tblusersUpdate);

		$this->showdeadline();
	}
	/************************************END SETTING DEADLINE******************************************** */

	/******************************CUSTOM DISABLE/ENABLE OF PROF ACCOUNTS(FOR SPECIAL CASES)************************************* */
	public function enableprofaccounts()
	{
		$tblusersUpdate = array(
				'deadlineTrigger' => 0
			);

		$recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserTypeID'), $where = array(1), $tblusersUpdate);

		$getData = $this->_getRecordsData($data = array('*'), 
				$tables = array('tbldeadlines'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

		$tbldeadlinesUpdate = array(
				'manualOverride' => 1,
				'ProfAccountsDisabled' => 0
			);

		$recordUpdated2 = $this->_updateRecords($tableName = 'tbldeadlines', $fieldName = array('ID'), $where = array($getData[0]->ID), $tbldeadlinesUpdate);

		//Audit Trails
		$audit_trail = null;
		$audit_trail = array(
			'Username' => $this->session->userdata('Username'),
			'UserType' => $this->session->userdata('UserTypeID'),
			'ActionDone' => 'Enabled Professor Accounts.',
			'DateTimeActionMade' => date('Y-m-d H:i:s'),
			'ip_address' => $this->input->ip_address()
		);
		//Audit Trail
		$this->_insertRecords($tableName = 'tblaudittrail', $audit_trail);

		$this->showdeadline();
	}

	public function disableprofaccounts()
	{
		$getData = $this->_getRecordsData($data = array('*'), 
				$tables = array('tbldeadlines'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

		$tbldeadlinesUpdate = array(
				'manualOverride' => 0,
				'ProfAccountsDisabled' => 1
			);

		$recordUpdated = $this->_updateRecords($tableName = 'tbldeadlines', $fieldName = array('ID'), $where = array($getData[0]->ID), $tbldeadlinesUpdate);

		//lock system for professors
		$tblusersUpdate = array(
			'deadlineTrigger' => 1
		);

		$recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserTypeID'), $where = array(1), $tblusersUpdate);

		//Audit Trails
		$audit_trail = null;
		$audit_trail = array(
			'Username' => $this->session->userdata('Username'),
			'UserType' => $this->session->userdata('UserTypeID'),
			'ActionDone' => 'Disabled Professor Accounts.',
			'DateTimeActionMade' => date('Y-m-d H:i:s'),
			'ip_address' => $this->input->ip_address()
		);
		//Audit Trail
		$this->_insertRecords($tableName = 'tblaudittrail', $audit_trail);

		$this->showdeadline();
	}
	/******************************END CUSTOM DISABLE/ENABLE OF PROF ACCOUNTS(FOR SPECIAL CASES)************************************* */

	/******************************AUDIT TRAIL FOR PROFESSOR ENCODING************************************* */
	public function profencodeaudittrail()
	{
		if($this->session->userdata('Username') != '')
		{
			$getSYsem = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblsetsysemgp'), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null );

			$getWholeTable = $this->_getRecordsData($data = array('*'), 
				$tables = array('tblAuditTrailForProfEncode_'.$getSYsem[0]->SY.'_'.$getSYsem[0]->Sem), 
				$fieldName = null,
				$where = null,
				$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = array('10','0'), 
				$fieldNameLike = null, $like = null, 
				$whereSpecial = null, $groupBy = null);

			header("Access-Control-Allow-Origin: *");
			$title['title'] = "Professor Encoding Audit Trail";

			$data['tblaudittrail'] = $getWholeTable;
			$data['SY'] = $getSYsem[0]->SY;
			$data['Sem'] = $getSYsem[0]->Sem;

			$this->load->view('header', $title);
			$this->load->view('adminpage/adminnavbar');
			$this->load->view('adminpage/AuditTrailProfEncode', $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url().'Admin');
		}
	}

	public function searchProfEncodeAuditTrail()
	{
		$getSYsem = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblsetsysemgp'), 
			$fieldName = null,
			$where = null,
			$join = null, $joinType = null, $sortBy = array('ID'), $sortOrder = array('DESC'), $limit = null, 
			$fieldNameLike = null, $like = null, 
			$whereSpecial = null, $groupBy = null );

		$clean = $this->security->xss_clean($this->input->post(NULL, TRUE));

		$getSearch = $this->_getRecordsData($data = array('*'), 
			$tables = array('tblAuditTrailForProfEncode_'.$getSYsem[0]->SY.'_'.$getSYsem[0]->Sem),
			$fieldName = null,
			$where = null,
			$join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
			$fieldNameLike = array('SubjCode_ProfName_Section'),
			$like = array($clean['SearchKey']), 
			$whereSpecial = null, $groupBy = null );

		header("Access-Control-Allow-Origin: *");
		$title['title'] = "Professor Encoding Audit Trail";

		$data['tblaudittrail'] = $getSearch;
		$data['SY'] = $getSYsem[0]->SY;
		$data['Sem'] = $getSYsem[0]->Sem;

		$this->load->view('header', $title);
		$this->load->view('adminpage/adminnavbar');
		$this->load->view('adminpage/AuditTrailProfEncode', $data);
		$this->load->view('footer');
	}
	/******************************END AUDIT TRAIL FOR PROFESSOR ENCODING************************************* */
}