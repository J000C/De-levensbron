<?php session_start()?>
<?php print_r($_COOKIE);
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

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

#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
.btnclearcart{
  float: right;
  background-color: red;
  border-radius: 4px;
  background-color: red;
  color: black;
  font-weight: bold;
  padding: 16px 20px;
  margin: 8px 8px;
  border: none;
  border-radius: 4px;
  font-size: medium;
  cursor: pointer;
  width: 14%;
  opacity: 0.9;
  
}
.btnclearcart:hover{
  color: #ddd;
}
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
      <a href='accountgegevens.php'>info</a>
      <a href='uitloggen.php'>Uitloggen</a>
      <a href='winkelwagen.php'>winkelwagen</a>";


      if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True") {
          echo"<a href='administrator.php'>not in use</a></div>";
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

<form action="./winkelwagen.php" method="POST">
  <input class="btnclearcart" id="btnclearcart" name="btnclearcart" type="submit" value="winkelwagen leegmaken">
</form>
<?php if(isset($_POST["btnclearcart"]) && $_POST["btnclearcart"]=="winkelwagen leegmaken"){
  
}
  ?>

  <?php 
  if(!isset($_SESSION["loggedin"])){header('location, ./home.php');}
  
  if(!isset($_COOKIE['winkelwagenGR']) && !isset($_COOKIE['winkelwagenFR'])) {
  echo "<h2 style=text-align:center;color:red>Uw winkelwagen is leeg</h2>";
} else {
  
  if (isset($_COOKIE["winkelwagenGR"])){
    
    $type = "groenten";
    foreach(json_decode($_COOKIE["winkelwagenGR"]) as $id => $aantal){
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "de levensbron gip";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT ID, Naam, Prijs, Voorraad, Oorsprong, Eenheid FROM $type WHERE $id=ID";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "id: " . $row["ID"]. " - Naam: " . $row["Naam"]. " aan " . $row["Prijs"]." per ".$row["Eenheid"]." ".$row["Oorsprong"]." Voorraad is ". $row["Voorraad"]."<br>";
            }
          } else {
            echo "groenten niet gevonden";
          }
          $conn->close(); 



    }
  }

  if (isset($_COOKIE["winkelwagenFR"])){
      $type = "fruit";
      foreach(json_decode($_COOKIE["winkelwagenFR"]) as $id => $aantal){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "de levensbron gip";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT ID, Naam, Prijs, Voorraad, Oorsprong, Eenheid FROM $type WHERE $id=ID";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "id: " . $row["ID"]. " - Naam: " . $row["Naam"]. " aan " . $row["Prijs"]." per ".$row["Eenheid"]." ".$row["Oorsprong"]." Voorraad is ". $row["Voorraad"]."<br>";
        }
      } else {
        echo "groenten niet gevonden";
      }
      $conn->close(); 


    }
  }
}?>
  <p></p>
  
  <script src="../Scripts/naarboven.js"></script>
</body>
</html>
