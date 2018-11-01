<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Homepage_model extends CI_Model {

    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'homepage';

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

    public function searchProduct($query,$page,$numperpage)
    {
        //turn on cache
        $this->db->cache_on();

        $data = $this->searchByOptions("code",$query);

        $arrkey = explode(" ",$query);
        for ($i = 0; $i < count($arrkey); $i++) {
            $result = $this->searchByOptions("detail",$arrkey[$i]);
            for ($j = 0; $j < count($result); $j++) {
                $index = array_search($result[$j], $data);
                if( $index > -1 )
                    $result = array_splice($result, $index);
            }
            $data = array_merge($data,$result);
        }

        $total_page = ceil(count($data)/$numperpage); //sum result search

        $offset_start = ($page-1)*$numperpage;
        $data = array_slice($data, $offset_start ,$numperpage);

        $res = array(
            'total' =>  $total_page,
            'data' => $data
        );
        return $res;
    }
    private function searchByOptions($option,$query)
    {
        switch ($option) {
            case 'all':

            case 'code':
                $this->db->select('*');
                $this->db->like('code', $query);
                $data = $this->db->get('product')->result_array();
                break;
            case 'category':
                $this->db->select('*');
                $this->db->join('category', 'category.id = product.category', 'right');
                $this->db->like('category.name', $query);
                $data = $this->db->get('product')->result_array();
                break;
            case 'detail':
                $this->db->select('*');
                $this->db->or_like('detail', $query);
                $data = $this->db->get('product')->result_array();                
                break;
            default:
                $data = array();
                break;
        }
        return $data;
    }
}
        
 ?>