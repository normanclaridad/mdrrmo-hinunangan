<?php
require_once('Models.php');
class Workshops_trainings extends Models {
	private static $instance = null;
    protected $db;
    private $table;
    public function __construct() {
		require_once($this->getDocumentRoot() . '/inc/conn.php');
        $this->db = DB::getInstance();
        $this->table = 'workshops_trainings';
	}

	public function getWhere( $where = '', $sortBy = 'id ASC') {
		$sql = "SELECT * FROM $this->table WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$sql .= " ORDER BY $sortBy ";

        $rows = $this->db->select($sql);
        return $rows;
	}

	public function insertData($data) {
        $sql = "INSERT INTO $this->table (";
        $sql .= implode(",", array_keys($data)) . ') VALUES ';            
        $sql .= "('" . implode("','", array_values($data)) . "')";
		$this->db->exec($sql);
		return $this->db->lastInsertId($sql);
	}

    public function updateData($data, $where) {
        $set = [];
        foreach($data as $key => $value) {
            $set[] = "$key='$value'";
        }
        
        $sql = "UPDATE $this->table SET ". implode(', ', $set);
        $sql .= " WHERE $where";
		return $this->db->exec($sql);
	}

	public function delete($id) {
		$sql = "DELETE FROM $this->table WHERE id=" . $id;
		return $this->db->exec($sql);
	}

	public function getJoinWhere($where = '', $sortBy = 'wt.id DESC', $startFrom = 0, $pageNo = 20, $enableLimit = 'Y') {
		$sql = "SELECT wt.*, s.name AS source_name, b.brgyDesc, wtt.name AS workshop_training_type_name, 
                (CASE WHEN wt.conducted_attended = 'A' THEN 'Attended' ELSE 'Conducted' END) AS conduct_attend
                FROM workshops_trainings wt
                JOIN sources s ON s.id = wt.source_id
                LEFT JOIN barangays b ON b.id = wt.barangay_id
                JOIN workshop_training_types wtt ON wtt.id = wt.workshop_training_type_id
                WHERE 1
                ";

        if(!empty($where)) {
            $sql .= " $where";
        }

        $sql .= " ORDER BY $sortBy ";

        if($enableLimit == 'Y') {
            $sql .= " LIMIT $startFrom, $pageNo";
        }
	
        $rows = $this->db->select($sql);
        return $rows;
	}

    public function getTotal($where = '', $sortBy = 'id DESC') {
        
		$sql = "SELECT COUNT(*) total_count
                FROM workshops_trainings wt
                JOIN sources s ON s.id = wt.source_id
                LEFT JOIN barangays b ON b.id = wt.barangay_id
                JOIN workshop_training_types wtt ON wtt.id = wt.workshop_training_type_id
                WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$sql .= " ORDER BY $sortBy ";
		$rows = $this->db->select($sql, 'assoc');
        return $rows['total_count'];
	}

    public function getWaterLevelAlarm( $where = '', $sortBy = 'level_from ASC') {
		$sql = "SELECT * 
                FROM $this->table 
                WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$sql .= " ORDER BY $sortBy ";

        $rows = $this->db->select($sql);
        return $rows;
	}

}