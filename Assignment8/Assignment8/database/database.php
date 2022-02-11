<?php
require 'config.php';

// Should return a PDO
function db_connect() {

  try {
    // TODO
    // try to open database connection using constants set in config.php
    // return $pdo;
    $pdo = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    return $pdo;
  }
  catch (PDOException $e)
  {
    die($e->getMessage());
  }
}

// Handle form submission
function handle_form_submission() {
  global $pdo;

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // TODO
    $stmt = $pdo->prepare("INSERT INTO comments (ID, date, mood, email, commentText) VALUES (?, ?, ?, ?, ?)");
    $date = date('Y-m-d');
    $email = $_POST['email'];
    $mood = $_POST['mood'];
    $commentText = $_POST['comment'];
    $stmt->bind_param("issss", $ID, $date,$mood,$email, $commentText); 
    $stmt->execute();
  }
}

// Get all comments from database and store in $comments
function get_comments() {
  global $pdo;
  global $comments;

  //TODO
  $sql = "SELECT * FROM comments ORDER BY ID DESC";


  if ($result = $pdo->query($sql)) {
    
    $result = $pdo->query($sql);

    foreach($result as $row) {
        array_push($comments, $row);
      
  }
}

}

// Get unique email addresses and store in $commenters
function get_commenters() {
  global $pdo;
  global $commenters;

  $sql = "SELECT DISTINCT email FROM comments";

  
  if ($result = $pdo->query($sql)) {
    
    $result = $pdo->query($sql);

    foreach($result as $row) {
        array_push($commenters, $row);
    }
  }

}
