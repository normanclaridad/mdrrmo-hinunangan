<?php
require_once('Models.php');
class Electricity extends Models {
	private static $instance = null;
    protected $db;
    private $table;
    public function __construct() {
		require_once($this->getDocumentRoot() . '/inc/conn.php');
        $this->db = DB::getInstance();
        $this->table = 'electricity';
	}

	public function getWhere( $where = '', $sortBy = 'name ASC') {
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

	public function getJoinWhere($where = '', $sortBy = 'br.id DESC', $startFrom = 0, $pageNo = 20, $enableLimit = 'Y') {
		$sql = "SELECT br.*, brgyDesc, cm.citymunDesc, p.provDesc 
                FROM $this->table br
                JOIN barangays b ON b.id = br.barangay_id
                JOIN city_mun cm ON cm.cityMunCode = b.cityMunCode
                JOIN provinces p ON p.provCode = b.provCode
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

    public function getTotal($where = '', $sortBy = 'br.id DESC') {
        
		$sql = "SELECT COUNT(*) total_count
                FROM $this->table br
                JOIN barangays b ON b.id = br.barangay_id
                JOIN city_mun cm ON cm.cityMunCode = b.cityMunCode
                JOIN provinces p ON p.provCode = b.provCode
                WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$sql .= " ORDER BY $sortBy ";
		$rows = $this->db->select($sql, 'assoc');
        return $rows['total_count'];
	}

    public function getElectricity( $where = '', $sortBy = 'e.id ASC') {
		$sql = "SELECT e.*, b.brgyDesc 
                FROM electricity e
                JOIN barangays b ON b.id = e.baragay_id
                WHERE 1 ";
		
		if(!empty($where)) {
			$sql .= " $where";
		}

		$sql .= " ORDER BY $sortBy ";

        $rows = $this->db->select($sql);
        return $rows;
	}
    public function deleteAll($where) {
		$sql = "DELETE FROM $this->table WHERE $where";
		return $this->db->exec($sql);
	}
}