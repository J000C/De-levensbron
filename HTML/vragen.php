<?php session_start()?>
<?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "de levensbron gip";
$gebruikersnaam=$_SESSION["gebruikersnaam"];

// Create connection
$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
$result = $mysqli->query("SELECT gebruikersnaam FROM administrators WHERE gebruikersnaam = '$gebruikersnaam'");
  if($result->num_rows == 0) {
    header('location:./home.php');
} else {
  $admin="True";
}
$mysqli->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../CSS/main.css">
<link rel="stylesheet" href="../CSS/groentenfruit.css">
<style>.dropbtn { /*styling voor de dropdownbutton*/
  background-color: #4CAF50; /* Green */
  border: none;
  color: rgb(8, 8, 8);
  padding: 8px 20px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  margin-right: 0%;
  margin: 4px 2px;
  cursor: pointer;
  color: #000000;
  float: right;
  display:inline;

  text-align: center;
  padding: 8px 20px;
  text-decoration: none;
  font-weight: bold;
}

.dropdown {
  position: relative;
  display: inline-flex;
  float: right;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  /* min-width: 160px; */
  width: 107%;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}


.vraag{
    font-size: medium;
}
.line{
    height:7px;
    border-width:0;
    color: red;
    background-color:red
}
</style>
<body>

<div class="top-container">
  <div class="hero text" >De Levensbron</div>    
</div>
<header>
  
<div class="header" id="myHeader">
<a href="home.php" target="_parent"><?php if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Home</button></a>
  <a href="groenten.php" target="_parent"><?php if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Groenten</button></a>
  <a href="fruit.php" target="_parent"><?php if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Fruit</button></a>
  <a href="contact.php" target="_parent"><?php if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Contact</button></a>
  <?php if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {echo "<a href='./vragen.php' target='_parent'><button style='background-color: blue' class='headerbuttons'>Vragen</button></a>";}
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){echo "<div class='dropdown'>
    <button class='dropbtn'"; if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {
      echo"style=background-color:red";
  }  echo"
      >Account</button>
      <div class='dropdown-content'>
      <a href=''>Bestellingen</a>
      <a href='accountgegevens.php'>Account</a>
      <a href='uitloggen.php'>Uitloggen</a>
      <a href='winkelwagen.php'>Winkelwagen</a>";


      if(isset($admin)&& $admin =="True") {
        echo"<a href='administrator.php'>administrator</a></div>";
    } else {
      echo "</div>";
    }
      
      
}else{if(isset($_COOKIE['visited']) == "True" ){
  echo "<a href='login.php' target='_parent'><button class='headerbuttonright'>inloggen</button></a>";
  }
  else {
    echo "<a href='registreren.php' target='_parent'><button class='headerbuttonright'>registreren</button></a>";
  };
}
      
    ?>
</div>

</header>
<?php
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "de levensbron gip"; 

    // Create connection 
    $conn = mysqli_connect($servername, $username, $password, $dbname); 
    // Check connection 
    if (!$conn) { 
      die("Connection failed: " . mysqli_connect_error()); 
    } 

    $sql = "SELECT * FROM vragen";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    ?>
    <?php

    ?> 
    <div class="vraag"><label for="Naam"><b>Naam: </b></label><?php print$row["Naam"]?><br>
    <label for="E-mail"><b>E-mail: </b></label><?php print$row["E-mail"]?><br>
    <label for="E-mail"><b>Vraag: </b></label><?php print$row["Vraag"]?></div><br>
    <form action="./modify.php" method="POST">
        <label for="antw"><b>Antwoord:</b></label>
        <input type="text" id="antw" name="antw" maxlength="188">
        <input type="hidden" name="Naam" id="Naam" value="<?php print $row["Naam"]?>">
        <input type="hidden" name="E-mail" id="E-mail" value="<?php print $row["E-mail"]?>">
        <input type="hidden" name="ID" id="ID" value="<?php print $row["ID"]?>">

        <input type="submit" value="verzenden">
    </form>
    <hr class="line"></hr> <br><br><br>
        
        
        
       <?php 
    }
    }else{print" <h2 style=color:red;text-align:center;>Er zijn geen vragen</h2>";}
    ?>

</body></html>
    