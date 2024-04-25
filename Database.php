<?php
// Include the Database class
require 'Database.php';

// Instantiate the Database class
$db = new Database();

// Example usage:
// Execute a SELECT query
$rows = $db->fetchAll("SELECT * FROM your_table");

// Execute an INSERT query
$inserted = $db->execute("INSERT INTO your_table (column1, column2) VALUES (?, ?)", [$value1, $value2]);

// Execute an UPDATE query
$updated = $db->execute("UPDATE your_table SET column1 = ? WHERE id = ?", [$newValue, $id]);

// Execute a DELETE query
$deleted = $db->execute("DELETE FROM your_table WHERE id = ?", [$id]);
?>
<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "php2";
    private $conn;

    // Constructor to establish database connection
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Method to execute SQL queries
    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    // Method to fetch single row from a query result
    public function fetch($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to fetch all rows from a query result
    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to execute INSERT, UPDATE, DELETE queries
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($params);
        } catch(PDOException $e) {
            echo "Execution failed: " . $e->getMessage();
        }
    }
}
?>



