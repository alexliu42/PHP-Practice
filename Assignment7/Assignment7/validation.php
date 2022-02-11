<?php
// Global result of form validation
$valid = false;
// Global array of validation messages. For valid fields, message is ""
$val_messages = Array();

// Output the results if all fields are valid.
function the_results()
{
  global $valid;

  
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if($valid == true){
      echo "<div class='results'><div class='result-text'> Your email address is: ";
      echo $_POST['email'];
      echo "</div><div class='result-text'> Your favorite animals are: <ul>";  
      foreach($_POST['animals'] as &$value){
        if($value){
          echo "<li>";
          echo $value;
          echo "</li>";
        }  
      }
      echo "</ul></div><div class='result-text'>Your favourite date is: ";
      echo $_POST['date'];
      echo "</div></div>";      

    }
  }
}

// Check each field to make sure submitted data is valid. If no boxes are checked, isset() will return false
function validate()
{
    global $valid;
    global $val_messages;
    $count=0;

    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
      // Use the following patterns to validate email and date or come up with your own.
      // email: '#^(.+)@([^\.].*)\.([a-z]{2,})$#'
      // date: '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#'
      if(isset($_POST['animals'])){
        foreach($_POST['animals'] as &$value){
          if($value){
            $count=$count+1;
          }  
        }  
      }
      if(preg_match('#^(.+)@([^\.].*)\.([a-z]{2,})$#',$_POST['email'])&&preg_match('#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#',$_POST['date'])&&$count>2){
        $valid=true;
      }
      if(!preg_match('#^(.+)@([^\.].*)\.([a-z]{2,})$#',$_POST['email'])){
        $val_messages[0]="email is not correct format";
      }
      if(!preg_match('#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#',$_POST['date'])){
        $val_messages[2]="please enter a valid date in the format yyyy/mm/dd";
      }

      if($count<3){
        $val_messages[1]="please choose at least three animals";
      }      
    }
}

function registerUser(){
  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['dob'])&&isset($_POST['password'])&&isset($_POST['password2'])&&$_POST['password']==$_POST['password2']){
      $valid=true;
      echo "Hello";
      echo  $_POST['username'];
      echo ", you have successfully registered. You should receive a confirmation email at: ";
      echo  $_POST['email'];  
    }
    else{
      echo "Checks that values for all fields have been entered or verifies if password 1 and password 2 match.";
    } 
  }
}

// Display error message if field not valid. Displays nothing if the field is valid.
function the_validation_message($type) {

  global $val_messages;

  if($_SERVER['REQUEST_METHOD']== 'POST')
  {

      if($type=="email"){
        if(!empty($val_messages[0])){
          echo "<div class='failure-message'><p>";
          echo $val_messages[0];
          echo "</p></div>";
        }
      }
      elseif($type=="animals"){
        if(!empty($val_messages[1])){
          echo "<div class='failure-message'><p>";
          echo $val_messages[1];
          echo "</p></div>";
        }
      }
      elseif($type=="date"){
        if(!empty($val_messages[2])){
          echo "<div class='failure-message'><p>";
          echo $val_messages[2];
          echo "</p></div>";
        }
      }
  }
}
