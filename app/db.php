<?php

/**
 * Created by PhpStorm.
 * User: aliozyildirim
 * Date: 25/05/2018
 * Time: 15:49
 */
class db extends PDO
{
    private static $dbInstance = null;

    public function __construct()
    {
        try {
            $dsn = 'mysql:host=' . \Config::$DATABASE_SERVER . ';dbname=' . \Config::$DATABASE_NAME . ';port=' . \Config::$DATABASE_PORT;
            parent::__construct($dsn, \Config::$DATABASE_USERNAME, \Config::$DATABASE_PASSWORD);
        } catch (\Exception $exception) {

            $error = $exception;
        }

    }

    /**
     * Singleton
     * @return db|null
     */
    public function connect()
    {
        if (!isset(self::$dbInstance)) {
            self::$dbInstance = new self();
        }
        return self::$dbInstance;
    }

    public function select($table, $where_clause = '',  $values = [], $columns = "*",  $fetchMode = PDO::FETCH_ASSOC, $use_cache = true)
    {
        $sql = "select $columns FROM $table";

        if (! empty($where_clause))
        {
            $sql .= (' WHERE ' . $where_clause );
        }

        if($use_cache)
        {
            $cacheKey = md5($sql . '-' . print_r($values, true));
            $loadFromCache = \App\cache::get($cacheKey);

            if(! empty($loadFromCache))
            {
                return $loadFromCache;
            }
        }
        
        $data = $this->prepare($sql);
        foreach ($values as $key => $value) {
            $data->bindValue("$key", $value);
        }
        $data->execute();
        $response = $data->fetch($fetchMode);

        if($use_cache)
        {
            \App\cache::set($cacheKey, $response);
        }

        return $response;
    }

    public function insert($table, $data)
    {
        ksort($data);
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO $table ('$fieldNames') VALUES ($fieldValues)");
        print_r($fieldValues);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }

    public function update($table, $data, $where)
    {
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
    }

    public function delete($table, $where, $limit = 1)
    {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }
}