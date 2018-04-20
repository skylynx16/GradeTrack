<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
    }

    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial) {
        $rows = $this->gt_model->getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------



    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy) {
        $rows = $this->gt_model->getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------GET RECORDS--------------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------



    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _updateRecords($tableName, $fieldName, $where, $data) {
        $rows = $this->gt_model->updateRecords($tableName, $fieldName, $where, $data);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------INSERT RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _insertRecords($tableName, $data) {
        $rows = $this->gt_model->insertRecords($tableName, $data);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------


    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------
    function _deleteRecords($tableName, $fieldName, $where) {
        $rows = $this->gt_model->deleteRecords($tableName, $fieldName, $where);
        return $rows;
    }
    //--------------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------UPDATE RECORDS-----------------------------------------------------------
    //--------------------------------------------------------------------------------------------------------------------------------

    public function _base64urlEncode($data) { 
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
	} 


    public function _base64urlDecode($data) { 
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
	}

    public function _insertToken($id)
    {
        $token = substr(sha1(rand()), 0, 30); 
        $date = date('Y-m-d');
    
        $data_token = null;
        $data_token = array(
              'token' => $token,
              'userID' => $id,
              'timeStamp' => $date,
        ); 
        $this->gt_model->insertRecords($tableName = 'tbltokens', $data_token);
        $token = $token . $id;
        $qstring = $this->_base64urlEncode($token);                      
        return $qstring;
    }

    public function _sendMail($toEmail, $subject, $message, $id) { 
  
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_port' => 587,
            'smtp_user' => 'gradetrack.official@gmail.com',
            'smtp_pass' => 'gradetrack123',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'starttls'  => TRUE,
            'wordwrap' => TRUE

        );
        $this->load->library('email', $config); 
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        
        $fromEmail = "gradetrack.official@gmail.com"; 
  
  
        $this->email->from($fromEmail, 'Grade Track Admin'); 
        $this->email->to($toEmail);
        $this->email->subject($subject); 
        $this->email->message($message); 
  
        //Send mail 
        if($this->email->send()) {
            $title['title'] = "Confirm Your Registration";

            $this->load->view('header', $title);
            $this->load->view('ghostnavbar');
            echo '
            <div class="container">
            	<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
            			<p style="font-family: \'Century Gothic\', Arial; font-size: 2rem; text-align: center; border-radius: 20px; background-color: rgba(0,255,0,0.2); padding: 2rem;">
            			Registration successful! Please check your email to verify your account.
            			</p>
            		</div>
					<div class="col-md-2"></div>
            	</div>
            </div
            ';
			$this->load->view('footer');
        } else {
            $title['title'] = "Registration Error";

            $this->load->view('header', $title);
            $this->load->view('navbar');
            echo '
            <div class="container">
            	<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
            			<p style="font-family: \'Century Gothic\', Arial; font-size: 2rem; text-align: center; border-radius: 20px; background-color: rgba(255,0,0,0.3); padding: 2rem;">
            			Oops! Something went wrong. Please contact the ICT for assistance.
            			</p>
            		</div>
					<div class="col-md-2"></div>
            	</div>
            </div
            ';
            $this->load->view('footer');
            
            //if email did not send, update records to this
            $tblusersUpdate = array(
                'status' => 'send email error',
                'isactive' => 0
            );
            $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserID'), $where = array($id), $tblusersUpdate);
        }
    }

    public function _sendMail2($toEmail, $subject, $message) { 
  
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_port' => 587,
            'smtp_user' => 'gradetrack.official@gmail.com',
            'smtp_pass' => 'gradetrack123',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'starttls'  => TRUE,
            'wordwrap' => TRUE

        );
        $this->load->library('email', $config); 
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        
        $fromEmail = "gradetrack.official@gmail.com"; 
  
  
        $this->email->from($fromEmail, 'Grade Track Admin'); 
        $this->email->to($toEmail);
        $this->email->subject($subject); 
        $this->email->message($message); 
  
        //Send mail 
        if($this->email->send()) {
            $title['title'] = "Password Reset Request Success";

            $this->load->view('header', $title);
            $this->load->view('ghostnavbar');
            echo '
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <p style="font-family: \'Century Gothic\', Arial; font-size: 2rem; text-align: center; border-radius: 20px; background-color: rgba(0,255,0,0.2); padding: 2rem;">
                        Password reset request successful! Please check your email to continue password reset.
                        </p>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div
            ';
            $this->load->view('footer');
        } else {
            $title['title'] = "Password Reset Request Error";

            $this->load->view('header', $title);
            $this->load->view('navbar');
            echo '
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <p style="font-family: \'Century Gothic\', Arial; font-size: 2rem; text-align: center; border-radius: 20px; background-color: rgba(255,0,0,0.3); padding: 2rem;">
                        Oops! Something went wrong. Please contact the ICT for assistance.
                        </p>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div
            ';
            $this->load->view('footer');
        }
    }

    public function _isTokenValid($token) {
       $tkn = substr($token,0,30);
       $uid = substr($token,30);      
       
       $result = $this->gt_model->getRecordsData($data = array('*'), 
            $tables = array('tbltokens'), 
            $fieldName = array('token', 'UserID'), 
            $where = array($tkn, $uid), 
            $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
            $fieldNameLike = null, $like = null, 
            $whereSpecial = null, $groupBy = null );

       $status = $this->gt_model->getRecordsData($data = array('*'), 
            $tables = array('tblusers'), 
            $fieldName = array('UserID'), 
            $where = array($uid), 
            $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
            $fieldNameLike = null, $like = null, 
            $whereSpecial = null, $groupBy = null );

        if($result && $status)
        {       
            $created = $result[0]->timeStamp;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);

            if($createdTS != $todayTS && $status[0]->status == 'pending')
            {
                //update db if expired token
                $UserUpdate = array(
                    'status' => "expired token",
                    'isactive' => 0
                );
                $recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserID'), $where = array($result[0]->UserID), $UserUpdate);

                if(!$recordUpdated){
                    error_log('Unable to updateUserInfo('.$userInfo[0]->UserID.')');
                    return false;
                }
                return false;
            }

            else if($createdTS != $todayTS && $status[0]->status == 'confirmed')
            {
                return false;
            }

            else if($status[0]->status == 'confirmed')
            {
                return false;
            }

            $userInfo = $this->_getRecordsData($data = array('*'), $tables = array('tblusers'), $fieldName = array('UserID'), $where = array($result[0]->UserID), 
                $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
                $fieldNameLike = null, $like = null, 
                $whereSpecial = null, $groupBy = null );
            return $userInfo;
        }
        else
        {
            return false;
        }
    }

    public function _isTokenValid2($token) {
       $tkn = substr($token,0,30);
       $uid = substr($token,30);      
       
       $result = $this->gt_model->getRecordsData($data = array('*'), 
            $tables = array('tbltokens'), 
            $fieldName = array('token', 'UserID'), 
            $where = array($tkn, $uid), 
            $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
            $fieldNameLike = null, $like = null, 
            $whereSpecial = null, $groupBy = null );

       $passresetreq = $this->gt_model->getRecordsData($data = array('*'), 
            $tables = array('tblusers'), 
            $fieldName = array('UserID'), 
            $where = array($uid), 
            $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
            $fieldNameLike = null, $like = null, 
            $whereSpecial = null, $groupBy = null );

        if($result && $passresetreq)
        {       
            $created = $result[0]->timeStamp;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);

            if($createdTS != $todayTS && $passresetreq[0]->passresetreq == 'pending')
            {
                $UserUpdate = array(
                    'passresetreq' => NULL
                );
                $recordUpdated = $this->_updateRecords($tableName = 'tblusers', $fieldName = array('UserID'), $where = array($passresetreq[0]->UserID), $UserUpdate);
                return false;
            }

            else if($createdTS != $todayTS && $passresetreq[0]->passresetreq == NULL)
            {
                return false;
            }

            else if($passresetreq[0]->passresetreq == NULL)
            {
                return false;
            }

            $userInfo = $this->_getRecordsData($data = array('*'), $tables = array('tblusers'), $fieldName = array('UserID'), $where = array($result[0]->UserID), 
                $join = null, $joinType = null, $sortBy = null, $sortOrder = null, $limit = null, 
                $fieldNameLike = null, $like = null, 
                $whereSpecial = null, $groupBy = null );
            return $userInfo;
        }
        else
        {
            return false;
        }
    }
}