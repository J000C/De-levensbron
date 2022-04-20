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
          
      } else {
        $admin="True";
      }
      $mysqli->close();
    }
    if(!isset($admin)||empty($admin)){header('location:./home.php');

    }
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../CSS/main.css">
<link rel="stylesheet" href="../CSS/home.css">
<style>
.dropbtn {
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
</style>
<body>

<div class="top-container">
  <div class="hero text" >De Levensbron</div>    
</div>
<header>
  
<div class="header" id="myHeader">
<a href="home.php" target="_parent"><?php if(isset($admin)&& $admin =="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Home</button></a>
  <a href="groenten.php" target="_parent"><?php if(isset($admin)&& $admin=="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Groenten</button></a>
  <a href="fruit.php" target="_parent"><?php if(isset($admin)&& $admin=="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Fruit</button></a>
  <a href="contact.php" target="_parent"><?php if(isset($admin)&& $admin=="True") {echo "<button style='background-color: red' class='headerbuttons'>";} else{ echo "<button class='headerbuttons'>";}?>Contact</button></a>
  <?php if(isset($admin)&& $admin=="True") {echo "<a href='./vragen.php' target='_parent'><button style='background-color: blue' class='headerbuttons'>Vragen</button></a>";}
  if(isset($admin)&& $admin=="True") {echo "<a href='./gebruikers.php' target='_parent'><button style='background-color: blue;  margin-left: 6px;' class='headerbuttons'>gebruikers info</button></a>";}
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == "True"){echo "<div class='dropdown'>
    <button class='dropbtn'"; if(isset($admin)&& $admin=="True") {
      echo"style=background-color:red";
  }  echo"
      >Account</button>
      <div class='dropdown-content'>
      <a href=''>Bestellingen</a>
      <a href='accountgegevens.php'>Account</a>
      <a href='uitloggen.php'>Uitloggen</a>
      <a href='winkelwagen.php'>winkelwagen</a>";


      if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {
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
<button onclick="topFunction()" id="myBtn" title="Go to top">Naar boven</button>
<br>
<form style="text-align:center; margin: 12px;" action="./modify.php" method="POST">
  <label for="addmin">Nieuwe administrator toevoegen: </label>
  <input type="text" name="addmin" id="addmin">
  <?php 
  if(isset($_COOKIE["action"]) && $_COOKIE["action"] == "toegevoegd"){echo"<div style='color: green'>administrator is toegevoegd</div>";}
  if(isset($_COOKIE["action"]) && $_COOKIE["action"] == "bestaat"){echo"<div style='color: red'>deze administrator bestaat al</div>";}?>
  <input type="submit" value="toevoegen">
</form>
<script src="../Scripts/naarboven.js"></script>
</body>
</html>
