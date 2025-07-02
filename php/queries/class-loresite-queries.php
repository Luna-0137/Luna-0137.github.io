<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Queries
{
    protected $dbh;

    public function __construct() 
    {
        $this->dbh = new loresite_Dbh();
    }

    /**
     * Executes an INSERT query and returns the ID of the last inserted row.
     * 
     * @param string $table The name of the table to insert into.
     * @param array $data An associative array containing column names and their values.
     * @return int The ID of the last inserted row.
     */
    public function insert($table, $data)
    {
        $connection = $this->dbh->connect();

        // Prepare the SQL query
        $sql = "INSERT INTO $table (";
        $sql .= implode(', ', array_keys($data));
        $sql .= ") VALUES (:" . implode(', :', array_keys($data)) . ")";
        $stmt = $connection->prepare($sql);

        // Bind parameters
        foreach ($data as $key => &$value) 
        {
            $stmt->bindParam(":$key", $value);
        }

        // Checking for errors in prepare
        if (!$stmt) 
        {
            throw new PDOException('Error in preparing the statement.');
        }

        // Execute the query
        if (!$stmt->execute()) 
        {
            throw new PDOException('Error in executing the statement.');
        }

        return $connection->lastInsertId();
    }
    
   /**
     * Executes a SELECT query.
     * 
     * @param string $table The name of the main table to select from.
     * @param array $conditions (Optional) Conditions for the SELECT query.
     * @param string $columns (Optional) Columns to select. Default is '*'.
     * @param array $joins (Optional) Joins to include in the query.
     * @param string $table_prefix (Optional) Prefix to use for the main table columns.
     * @return array Associative array containing the results of the SELECT query.
     */
    public function select($table, $conditions = array(), $columns = '*', $joins = array(), $table_prefix = '') {
        // Establish a database connection
        $connection = $this->dbh->connect();

        // Prepare the JOIN clause
        $joins_str = '';
        if (!empty($joins)) {
            foreach ($joins as $join) {
                // Assuming $join is an array with keys: type, table, condition
                $joins_str .= " {$join['type']} JOIN {$join['table']} ON {$join['condition']}";
            }
        }

        // Prepare the WHERE clause
        $conditions_str = '';
        if (!empty($conditions)) {
            $conditions_str = ' WHERE ';
            foreach ($conditions as $key => $value) {
                // Prefix the column name if a prefix is provided
                $prefixed_key = $table_prefix ? "{$table_prefix}.{$key}" : $key;
                $conditions_str .= "$prefixed_key = :$key AND ";
            }
            $conditions_str = rtrim($conditions_str, ' AND ');
        }

        // Prepare the SQL query
        $sql = "SELECT $columns FROM $table$joins_str$conditions_str";
        $stmt = $connection->prepare($sql);

        // Bind parameters
        foreach ($conditions as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        // Execute the query
        $stmt->execute();

        // Fetch and return results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executes an UPDATE query.
     * 
     * @param string $table The name of the table to update.
     * @param array $data An associative array containing column names and their new values.
     * @param array $conditions (Optional) Conditions for the UPDATE query.
     * @return int The number of affected rows.
     */
    public function update($table, $data, $conditions = array()) {
        // Establish a database connection
        $connection = $this->dbh->connect();

        // Prepare the SQL query
        $set_str = '';
        foreach ($data as $key => $value) {
            $set_str .= "$key = :$key, ";
        }
        $set_str = rtrim($set_str, ', ');

        $conditions_str = '';
        if (!empty($conditions)) {
            $conditions_str = ' WHERE ';
            foreach ($conditions as $key => $value) {
                $conditions_str .= "$key = :$key AND ";
            }
            $conditions_str = rtrim($conditions_str, ' AND ');
        }

        $sql = "UPDATE $table SET $set_str$conditions_str";
        $stmt = $connection->prepare($sql);

        // Bind parameters
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        foreach ($conditions as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        // Execute the query
        $stmt->execute();

        // Return the number of affected rows
        return $stmt->rowCount();
    }

    /**
     * Executes a DELETE query.
     * 
     * @param string $table The name of the table to delete from.
     * @param array $conditions (Optional) Conditions for the DELETE query.
     * @return int The number of affected rows.
     */
    public function delete($table, $conditions = array()) {
        // Establish a database connection
        $connection = $this->dbh->connect();

        // Prepare the SQL query
        $conditions_str = '';
        if (!empty($conditions)) {
            $conditions_str = ' WHERE ';
            foreach ($conditions as $key => $value) {
                $conditions_str .= "$key = :$key AND ";
            }
            $conditions_str = rtrim($conditions_str, ' AND ');
        }
        $sql = "DELETE FROM $table$conditions_str";
        $stmt = $connection->prepare($sql);

        // Bind parameters
        foreach ($conditions as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        // Execute the query
        $stmt->execute();

        // Return the number of affected rows
        return $stmt->rowCount();
    }
}
?>
