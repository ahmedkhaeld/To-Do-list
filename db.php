<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lists";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE tasks (
    task_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    parent_id INT UNSIGNED NOT NULL DEFAULT 0,
    task VARCHAR(100) NOT NULL,
    date_added TIMESTAMP NOT NULL,
    date_completed TIMESTAMP,
    PRIMARY KEY (task_id),
    INDEX parent (parent_id),INDEX added (date_added),
    INDEX completed (date_completed)
    )";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>