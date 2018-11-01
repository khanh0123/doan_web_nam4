<?php 
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Product_model extends CI_Model {
	
	    /**
	     * @name string TABLE_NAME Holds the name of the table in use by this model
	     */
	    const TABLE_NAME = 'product';
	
	    /**
	     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
	     */
	    const PRI_INDEX = 'id';
	
	    /**
	     * Retrieves record(s) from the database
	     *
	     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
	     *                      If associative array is given, it should fit field_name=>value pattern.
	     *                      If string, value will be used to match against PRI_INDEX
	     * @return mixed Single record if ID is given, or array of results
	     */
	    public function get($where = NULL) {
	        $this->db->select('*');
	        $this->db->from(self::TABLE_NAME);
	        if ($where !== NULL) {
	            if (is_array($where)) {
	                foreach ($where as $field=>$value) {
	                    $this->db->where($field, $value);
	                }
	            } else {
	                $this->db->where(self::PRI_INDEX, $where);
	            }
	        }
	        $result = $this->db->get();
	        if ($result) {
	            return $result->result_array();
	        } else {
	            return false;
	        }
	    }
		public function getByListId(Array $listid)
		{
			$this->db->cache_on();
			$this->db->select('*');
			$this->db->where_in('id',$listid);
			$result = $this->db->get('product');
	        if ($result) {
	            return $result->result_array();
	        } else {
	            return false;
	        }
		}
		public function getByListCode(Array $listcode)
		{
			$this->db->cache_on();
			$this->db->select('*');
			$this->db->where_in('code',$listcode);
			$result = $this->db->get('product');
	        if ($result) {
	            return $result->result_array();
	        } else {
	            return false;
	        }
		}

		public function getByCategory($where = array(), $num_per_page , $page)
		{
			$this->db->cache_on();
			$this->db->select('*');

	        if ($where !== NULL) {
	            if (is_array($where)) {
	                foreach ($where as $field=>$value) {
	                    $this->db->where($field, $value);
	                }
	            } else {
	                $this->db->where(self::PRI_INDEX, $where);
	            }
	        }
	        $result = $this->db->get('product', $num_per_page, $num_per_page*($page-1));
	        if ($result) {
	            return $result->result_array();
	        } else {
	            return false;
	        }
		}
		public function getNumberByCategory($where = array() , $num_per_page)
		{
			$this->db->select('count(*) as count');
			$this->db->from(self::TABLE_NAME);
			if ($where !== NULL) {
	            if (is_array($where)) {
	                foreach ($where as $field=>$value) {
	                    $this->db->where($field, $value);
	                }
	            } else {
	                $this->db->where(self::PRI_INDEX, $where);
	            }
	        }
	        $result = $this->db->get();
	        if ($result) {
	            return $result->result_array();;
	        } else {
	            return false;
	        }
		}
	    /**
	     * Inserts new data into database
	     *
	     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
	     * @return mixed Inserted row ID, or false if error occured
	     */
	    public function insert(Array $data) {
	        if ($this->db->insert(self::TABLE_NAME, $data)) {
	            return $this->db->insert_id();
	        } else {
	            return false;
	        }
	    }
	
	    /**
	     * Updates selected record in the database
	     *
	     * @param Array $data Associative array field_name=>value to be updated
	     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
	     * @return int Number of affected rows by the update query
	     */
	    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
	        $this->db->update(self::TABLE_NAME, $data, $where);
	        return $this->db->affected_rows();
	    }
	
	    /**
	     * Deletes specified record from the database
	     *
	     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
	     * @return int Number of rows affected by the delete query
	     */
	    public function delete($where = array()) {
	        if (!is_array($where)) {
	            $where = array(self::PRI_INDEX => $where);
	        }
	        $this->db->delete(self::TABLE_NAME, $where);
	        return $this->db->affected_rows();
	    }
	}
	        
 ?>