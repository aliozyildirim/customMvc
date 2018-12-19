<?php
/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 26/05/2018
 * Time: 12:09
 */

namespace Library;

use db;
use PDO;

class Model
{

    protected $db;

    protected function __construct()
    {
        $this->db = new db;
        $this->db->connect();
    }

    /**
     * @param $table
     * @param string $where_clause
     * @param array $values
     * @param string $columns
     * @param int $fetchMode
     * @return mixed
     */
    protected function select($table, $where_clause = '', $values = [], $columns = "*", $fetchMode = PDO::FETCH_ASSOC)
    {
        return $this->db->select($table, $where_clause, $values, $columns, $fetchMode);
    }

    /**
     * @param $table
     * @param $data
     */
    protected function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    /**
     * @param $table
     * @param $data
     * @param string $where_clause
     */
    protected function update($table, $data, $where_clause = '')
    {
        return $this->db->update($table, $data, $where_clause);
    }

    /**
     * @param $table
     * @param string $where_clause
     * @param int $limit
     * @return int
     */
    protected function delete($table, $where_clause = '', $limit = 1)
    {
        return $this->db->delete($table, $where_clause, $limit);
    }
}