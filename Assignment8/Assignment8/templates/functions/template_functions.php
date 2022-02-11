<?php
require "format_comment_text.php";
// Output comments to HTML
function the_comments() {
  $count = 0;
  global $comments;
  echo "<div class='comments'>";
  echo "<h2>Comments</h2>";
 
  foreach($comments as $row){
    echo "<div class='comment'>";
    if($row){
      
      $ID="";
      $date="";
      $mood="";
      $email="";
      $comment="";
        
      foreach($row as $value ){
          if($count % 5 == 0){
            $ID = $value;
          }
          else if($count % 5 == 1){
            $date = $value;
          }
          else if($count % 5 == 2){
            $mood = $value;
          }
          else if($count % 5 == 3){
            $email = $value;  
          }
          else if($count % 5 == 4){
            $comment= $value;
          }
          $count = $count + 1;
          if($count==5){
            echo "<div class='ID'> Post ID: ";
            echo $ID;
            echo "</div>";
            echo "<div class='date'>Posted on: ";
            echo $date;
            echo "</div>";
            echo "<h3> New comment by: ";
            echo $email;
            echo "</h3>";
            echo "<div class='mood'> Current mood: ";
            echo $mood; 
            echo "</div>";
            echo "<div class='comment-text'><p>";
            echo $comment; 
            echo "</p></div>";
          }
      }
      $count=0;
    }
    echo "</div>";
  }  
  echo "</div>";
  // TODO

}

// Output unique email addresses to HTML
function the_commenters() {
  global $filter;
  global $commenters;

  echo "<div class='commenters'><h2>People Who have Commented:</h2><ul>";
  
  foreach($commenters as $row){
    if($row){
      foreach ($row as $value){
        echo "<li><a rel='noopener' href='index.php?filter=";
        echo $value;
        echo "'>";
        echo $value;
        echo "</a></li>";
      }
    }
  }
  echo "</ul></div>";
  //TODO
  
}
