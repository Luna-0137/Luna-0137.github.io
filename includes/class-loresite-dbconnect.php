<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

class loresite_Dbh 
{
    private $dbPath = 'documentation/loresite.sqlite';

    public function __construct()
    {
        $this->connect();
    }

    /**
     * Connects to the SQLite database
     */
    public function connect() 
    {
        try 
        {
            $dsn = "sqlite:{$this->dbPath}";
            $dbh = new PDO($dsn);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $dbh;
        } 
        catch (PDOException $e) 
        {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    public function isDatabaseEmpty(PDO $dbh): bool 
    {
        $stmt = $dbh->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        $tables = $stmt->fetchAll();
        return empty($tables);
    }
}

function importSqlFile(PDO $pdo, string $sqlFilePath)
{
    if (!file_exists($sqlFilePath)) {
        die("SQL file not found: $sqlFilePath");
    }

    $sql = file_get_contents($sqlFilePath);

    try {
        $pdo->exec($sql);
    } catch (PDOException $e) {
        die("Error executing SQL: " . $e->getMessage());
    }
}

$sqlFile = dirname(__DIR__) . '/documentation/init.sql'; 
$dbh = (new loresite_Dbh())->connect();

if ((new loresite_Dbh())->isDatabaseEmpty($dbh)) {
    importSqlFile($dbh, $sqlFile);
}