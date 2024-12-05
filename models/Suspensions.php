<?php
require_once('Models.php');
class Suspensions extends Models {
	private static $instance = null;
    protected $db;
    private $table;
    public function __construct() {
		require_once($this->getDocumentRoot() . '/inc/conn.php');
        $this->db = DB::getInstance();
        $this->table = 'suspensions';
	}

	public function getWhere( $where = '', $sortBy = 'name ASC', $assoc = '') {
		$sql = "SELECT * FROM $this->table WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$sql .= " ORDER BY $sortBy ";

        if(empty($assoc)) {
            $rows = $this->db->select($sql);
        } else {
            $rows = $this->db->select($sql, 'assoc');
        }
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

	public function getJoinWhere($where = '', $sortBy = 'sh.id DESC', $startFrom = 0, $pageNo = 20, $enableLimit = 'Y') {
		$sql = "SELECT sh.*
                FROM $this->table sh
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

    public function getTotal($where = '', $sortBy = 'sh.id DESC') {
        
		$sql = "SELECT COUNT(*) total_count
                FROM $this->table sh
                WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$sql .= " ORDER BY $sortBy ";
		$rows = $this->db->select($sql, 'assoc');
        return $rows['total_count'];
	}

    public function getSuspension($where = '') {
        
		$sql = "SELECT s.*, sc.name AS school_name, b.brgyDesc 
                FROM $this->table s
                JOIN schools sc ON sc.id = s.school_id
                JOIN barangays b ON b.id = sc.barangay_id
                WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$rows = $this->db->select($sql);
        return $rows;
	}

    public function deleteAll($where) {
		$sql = "DELETE FROM $this->table WHERE $where";
		return $this->db->exec($sql);
	}
}