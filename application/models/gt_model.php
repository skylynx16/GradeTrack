<?php

class gt_model extends CI_Model
{
	//--------------------------------------------------------------------------------------------------------------------------------------
    //GET RECORDS BY GENERIC ACCESS VERSION1
	function getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial) {
		$q = $this->db->select('*')
			 ->distinct()
			 ->from($tables[0]); 
			 
			 //JOIN---------------------------------------
			 if(!empty($join)) {
				 for($i = 0; $i < count($join);$i++) {
					$q->join($tables[$i + 1], $join[$i],  $joinType[$i]);
				 }
			 }
			 
			 //WHERE--------------------------------------
			 if(!empty($where)) {
				 for($i = 0; $i < count($where);  $i++) {
					$q->where($fieldName[$i],  $where[$i]); 
				 }
			 }

			 //WHERE SPECIAL--------------------------------------
			 if(!empty($whereSpecial)) {
				 for($i = 0; $i < count($whereSpecial);  $i++) {
					$q->where($whereSpecial[$i]);
				 }
			 }
			 
			 
			 //LIKE--------------------------------------
			 if(!empty($like)) {
				 for($i = 0; $i < count($like);  $i++) {
					$q->like($fieldNameLike[$i],  $like[$i]);
				 }
			 }
			 
			 
			 //ORDER BY----------------------------------
			 if(!empty($sortBy)) {
				 for($i = 0; $i < count($sortBy);  $i++) {
					$q->order_by($sortBy[$i],  $sortOrder[$i]);
				 }
			 }
			 //LIMIT----------------------------------
			 if(!empty($limit)) {
				$q->limit($limit[0],  $limit[1]);
			 }
			 
		$data = $q->get()->result();
        return $data;
	}

     //--------------------------------------------------------------------------------------------------------------------------------------
    //GET RECORDS BY GENERIC ACCESS
	function getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy) {

		//DATA--------------------------------------
		$dataSelect = null;
		if(!empty($data)) {
			for($i = 0; $i < count($data);  $i++) {
				if($i == 0) {
					$dataSelect = $dataSelect . $data[$i];
				} else {	
					$dataSelect = $dataSelect . ", " . $data[$i];
				}
			}
		}
		
		$q = $this->db->select($dataSelect)
			 ->distinct()
			 ->from($tables[0]); 
			 
			 //JOIN---------------------------------------
			 if(!empty($join)) {
				 for($i = 0; $i < count($join);$i++) {
					$q->join($tables[$i + 1], $join[$i],  $joinType[$i]);
				 }
			 }
			 
			 //WHERE--------------------------------------
			 if(!empty($where)) {
				 for($i = 0; $i < count($where);  $i++) {
					$q->where($fieldName[$i],  $where[$i]); 
				 }
			 }

			 //WHERE SPECIAL--------------------------------------
			 if(!empty($whereSpecial)) {
				 for($i = 0; $i < count($whereSpecial);  $i++) {
					$q->where($whereSpecial[$i]);
				 }
			 }
			 
			 
			 //LIKE--------------------------------------
			 if(!empty($like)) {
				 for($i = 0; $i < count($like);  $i++) {
					$q->like($fieldNameLike[$i],  $like[$i]);
				 }
			 }
			 
			 
			 //ORDER BY----------------------------------
			 if(!empty($sortBy)) {
				 for($i = 0; $i < count($sortBy);  $i++) {
					$q->order_by($sortBy[$i],  $sortOrder[$i]);
				 }
			 }
			 //LIMIT----------------------------------
			 if(!empty($limit)) {
				$q->limit($limit[0],  $limit[1]);
			 }
			 //GROUP BY----------------------------------
			 if(!empty($groupBy)) {
				 for($i = 0; $i < count($groupBy);  $i++) {
					$q->group_by($groupBy[$i]);
				 }
			 }
			 
		$data = $q->get()->result();
        return $data;
	}
    //GET RECORDS BY GENERIC ACCESS
    //--------------------------------------------------------------------------------------------------------------------------------------
    

    //------------------------------------------------------------------------
    //INSERT RECORDS
	function insertRecords($tableName, $data)
	{
		$id = $this->db->insert($tableName, $data);
		
		return $this->db->insert_id();
	}
    //INSERT RECORDS
    //------------------------------------------------------------------------
    //------------------------------------------------------------------------
    //UPDATE RECORDS
	function updateRecords($tableName, $fieldName, $where, $data)
	{
		//WHERE--------------------------------------
		if(!empty($where)) {
			for($i = 0; $i < count($where);  $i++) {
		    	$this->db->where($fieldName[$i], $where[$i]);
			}
		}
		$this->db->update($tableName, $data);

		return 1;
    }
    //UPDATE RECORDS
    //------------------------------------------------------------------------
    //------------------------------------------------------------------------
    //DELETE RECORDS
	function deleteRecords($tableName, $fieldName, $where)
	{
		$this->db->where($fieldName, $where);
		$this->db->delete($tableName);
    }
    //DELETE RECORDS
    //------------------------------------------------------------------------

    //------------------------------------------------------------------------
    //GET SUBJECTS TAUGHT
	function getsubjectstaught($FCode, $SY, $Sem)
	{
		$subjectstaught =
		$this->db->query(
		"Select distinct
		tblenrollment.SectCode,
		tblenrollment.ESubjCode,
		tblsubject.Description,
		tblschedule.FCode
		from tblenrollment
		left join tblsubject on tblenrollment.ESubjCode = tblsubject.SubjCode
		left join tblschedule on tblenrollment.ESubjCode = tblschedule.SubjCode
		left join tblstudentpersonaldata on tblenrollment.StudNo = tblstudentpersonaldata.StudNo
		where tblschedule.FCode = '".$FCode."'
		and tblenrollment.SY = '".$SY."'
		and tblenrollment.Sem = '".$Sem."';"
		);

		return $subjectstaught->result();
	}
    //GET SUBJECTS TAUGHT
    //------------------------------------------------------------------------

    //------------------------------------------------------------------------
    //GET SUBJECTS ENROLLED
	function getsubjectsenrolled($StudNo, $SY, $Sem)
	{
		$subjectsenrolled=
		$this->db->query(
		"Select
		tblenrollment.SectCode,
		tblenrollment.ESubjCode,
		tblsubject.Description,
		tblenrollment.StudNo
		from tblenrollment
		left join tblsubject on tblenrollment.ESubjCode = tblsubject.SubjCode
		left join tblschedule on tblenrollment.ESubjCode = tblschedule.SubjCode
		where tblenrollment.StudNo = '".$StudNo."'
		and tblenrollment.SY = '".$SY."'
		and tblenrollment.Sem = '".$Sem."';"
		);

		return $subjectsenrolled->result();
	}
    //GET SUBJECTS ENROLLED
    //------------------------------------------------------------------------
	//CREATE TABLE
	function createtable($SubjCode,$SectCode, $SY, $Sem)
	{
		$changedname = str_replace(".","",str_replace("_","",$SubjCode));
		$changedSectCode = "_".str_replace("-","_",str_replace("%20", "_",$SectCode));

		$this->db->query(
		"CREATE TABLE IF NOT EXISTS tbl".$changedname.$changedSectCode."_".$SY."_".$Sem." (
		    StudNo varchar(15) Unique,
		    StudName varchar(100),
		    PercMidtermGrade DECIMAL(8,2),
		    DecMidtermGrade DECIMAL(8,2),
		    MidtermGradeConfirmed int default 0,
		    PercPreFinalGrade DECIMAL(8,2),
		    DecPreFinalGrade DECIMAL(8,2),
		    FinalGrade DECIMAL(8,2),
		    ComputedFinalGrade DECIMAL(8,2)
		);"
		);

		//check how many rows in created table
		$created_tbl_num_rows = $this->db->query("Select * from tbl".$changedname.$changedSectCode."_".$SY."_".$Sem.";")->num_rows();
		
		//check how many rows in query that will be done for insertion
		$tblenrollment_query_num_rows = $this->db->query("select
			tblenrollment.StudNo,
			concat(tblstudentpersonaldata.LName,', ', tblstudentpersonaldata.FName,' ',tblstudentpersonaldata.MName ) As StudName
		from tblenrollment
		left join tblsubject on tblenrollment.ESubjCode = tblsubject.SubjCode
		left join tblschedule on tblenrollment.ESubjCode = tblschedule.SubjCode
		left join tblstudentpersonaldata on tblenrollment.StudNo = tblstudentpersonaldata.StudNo
		where tblenrollment.ESubjCode = '".$SubjCode."' and tblenrollment.SY = '".$SY."' and tblenrollment.Sem = '".$Sem."';")->num_rows();
		
		//if created table != query from tblenrollment, truncate first the created table then insert new rows.
		if($created_tbl_num_rows != $tblenrollment_query_num_rows)
		{
			$this->db->query("TRUNCATE TABLE tbl".$changedname.$changedSectCode."_".$SY."_".$Sem.";");
		}

		$this->db->query(
		"INSERT IGNORE INTO tbl".$changedname.$changedSectCode."_".$SY."_".$Sem." (StudNo, StudName)
		select
			tblenrollment.StudNo,
			concat(tblstudentpersonaldata.LName,', ', tblstudentpersonaldata.FName,' ',tblstudentpersonaldata.MName ) As StudName
		from tblenrollment
		left join tblsubject on tblenrollment.ESubjCode = tblsubject.SubjCode
		left join tblschedule on tblenrollment.ESubjCode = tblschedule.SubjCode
		left join tblstudentpersonaldata on tblenrollment.StudNo = tblstudentpersonaldata.StudNo
		where tblenrollment.ESubjCode = '".$SubjCode."'
		and tblenrollment.SY = '".$SY."'
		and tblenrollment.Sem = '".$Sem."'
		order by StudName;
		");

		return "tbl".$changedname.$changedSectCode."_".$SY."_".$Sem;
	}
    //CREATE TABLE
    //------------------------------------------------------------------------
	//------------------------------------------------------------------------
	//UPDATE TABLE FOR IMPORTING BY BATCH
	public function customUpdateTable($tblname, $data)
	{
		$this->db->update_batch($tblname, $data, 'StudNo');
	}
	//UPDATE TABLE FOR IMPORTING BY BATCH
    //------------------------------------------------------------------------
    //------------------------------------------------------------------------
	//UPDATE TABLE FOR ENROLLMENT IN BATCH
	public function customUpdateTable1($ESubjCode, $data)
	{
		$this->db->where('ESubjCode', $ESubjCode);
		$this->db->update_batch('tblenrollment', $data, 'StudNo');
	}
	//UPDATE TABLE FOR ENROLLMENT IN BATCH
    //------------------------------------------------------------------------
}