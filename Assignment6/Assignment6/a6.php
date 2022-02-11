<?php
$my_name= "Alex Liu";
$description = "My name is Alex Liu, currently an international student studying in Canada";
$favorite_animals = array("Dog","Sheep","Donkey");

function the_developer_profile(){

echo "<div class='developer-profile'><h2>Developer Profile: ";
echo $GLOBALS['my_name'];
echo "</h2>";
echo "<p>Description: ";
echo $GLOBALS['description'];
echo ".</p>";
echo "<p>His favortie animals are ";

foreach($GLOBALS['favorite_animals'] as &$value){
  if($value == reset($GLOBALS['favorite_animals'])){
    echo $value;
  }
  else if($value == end($GLOBALS['favorite_animals'])){
    echo " and ";
    echo $value;
  }
  else{
    echo ", ";
    echo $value;
  }
  
}
echo ".</p>";
echo "</div>";

}

function the_color_form(){
  echo "<div class='page-color'>";
  echo "<form method='POST' action='a6.php'>";
  echo "<label>Which color do you prefer for the text of this page?</label>";
  echo "<input type='color' name='colorr' value='#FF8C00' style='margin:auto;'>";
  echo "<input type='submit' name='submit' value='Submit'>";
  echo "</form>";
  echo "</div>";
 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $color = $_POST['colorr'];
}
else{
  $color="";
}

function get_color(){
    if($GLOBALS['color']==NULL){
      return "#000000";
    }
    else{
      return $GLOBALS['color'];
    }
}

echo "<html style='display:inline; color:";
echo get_color();
echo ";'>";


?>
<!DOCTYPE html>
<html style="inline">
  <head>
    <meta charset="utf-8">
    <title>Assigment 6: Hello PHP World!</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="icomoon/style.css">

  </head>
  <body>

    <header>
        <h1>Hello PHP World!</h1>
        <div class="subtitle">
          An Introduction to Server-Side Scripting.
        </div>

    </header>

    <main>
      <?php 
      
      the_developer_profile();
      the_color_form();
      get_color();
      ?>    
    </main>

  </body>
</html>
