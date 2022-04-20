<?php session_start()?>
<?php print_r($_POST); ?>

<?php if(isset ($_SESSION["admin"]) && $_SESSION["admin"]=="True" && !empty($_POST["delete"]) && $_POST["delete"]=="True"){ 
$ID = $_POST["ID"];
if ($_POST["type"]=="FR"){
  $type="fruit";//zet waarde fruit zodat die de tabel kan vinden
}
if ($_POST["type"]=="GR"){
  $type="groenten";//zet waarde groenten zodat die de tabel kan vinden
}

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

$sql = "DELETE FROM $type WHERE ID='$ID';";//delete de opgegeven rij in database

if ($conn->query($sql) === TRUE) {
    if($type=="fruit"){header('location:./fruit.php');}
    if($type=="groenten"){header('location:./groenten.php');}
} else {
  echo "Error updating record: " . $conn->error;//eventuele error
}

$conn->close();
}?>


<?php if(isset($_POST["update"])&& isset ($_SESSION["admin"])&& $_POST["update"]=="True"&& $_SESSION["admin"]=="True"){
  $Naam = $_POST["Naam"];
  $ID = $_POST["ID"];
  $Eenheid = $_POST["Eenheid"];
  $Oorsprong = $_POST["Oorsprong"];
  $Prijs = $_POST["Prijs"];
  $Voorraad = $_POST["Voorraad"];
  if ($_POST["type"]=="FR"){
    $type="fruit";//zet waarde fruit zodat die de tabel kan vinden
  }
  if ($_POST["type"]=="GR"){
    $type="groenten";//zet waarde groenten zodat die de tabel kan vinden
  }

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
  
  $sql = "UPDATE $type SET Naam='$Naam', Eenheid='$Eenheid', Oorsprong='$Oorsprong', Prijs='$Prijs', Voorraad='$Voorraad' WHERE ID=$ID";
  
  if ($conn->query($sql) === TRUE) {
    if($type=="fruit"){header('location:./fruit.php');}
    if($type=="groenten"){header('location:./groenten.php');}
  } else {
    echo "Error updating record: " . $conn->error;//eventuele error
  }
  
  $conn->close();
  
  
}?>

<?php
if(isset($_POST["add"])&&$_POST["add"]=="True"){
  $Naam = $_POST["Naam"];//zet alles om in mooie variabelen
  $ID = $_POST["ID"];
  $Eenheid = $_POST["Eenheid"];
  $Oorsprong = $_POST["Oorsprong"];
  $Prijs = $_POST["Prijs"];
  $Voorraad = $_POST["Voorraad"];

  if ($_POST["type"]=="FR"){
    $type="fruit";//zet waarde fruit zodat die de tabel kan vinden
  }
  if ($_POST["type"]=="GR"){
    $type="groenten";//zet waarde groenten zodat die de tabel kan vinden
  }

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
  
  $sql = "INSERT INTO $type (Naam, Eenheid, Oorsprong, Prijs, Voorraad) VALUES ('" . $Naam . "', '" . $Eenheid . "', '" .   $Oorsprong ."', '" . $Prijs ."', '" . $Voorraad ."')";
  
  if ($conn->query($sql) === TRUE) {
    if($type=="fruit"){header('location:./fruit.php');}
    if($type=="groenten"){header('location:./groenten.php');}
  } else {
    echo "Error updating record: " . $conn->error;//eventuele error
  }
  
  $conn->close();
}
?>

<?php 
if(isset($_POST["winkelwagen"])&&$_POST["winkelwagen"]=="True"&& isset($_SESSION["loggedin"])=="True"){
  $ID = $_SESSION["id"];
  $productID = $_POST["ID"];
  $BW = "winkelwagen";
  $aantal = $_POST["aantal"];
  if($_POST["type"]=="GR"){$type="groenten";}
  if($_POST["type"]=="FR"){$type="fruit";}
  $gebruikersnaam = $_SESSION["gebruikersnaam"];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bestellingen";

  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "de levensbron gip";                          
  // Create connection
  $mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  $result = $mysqli->query("SELECT voorraad FROM $type WHERE productID = '$productID'");
    if($result->num_rows == 0) {
      $Voorraad=$result;
      echo"dit is de voorraad".$result;
      if($aantal>=$Voorraad){$aantal=$Voorraad;}
      if($aantal<0){$aantal=0;}
      if(!is_numeric($aantal)){$aantal=1;}
  } else {
    echo"error";
  }
$mysqli->close();


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS $gebruikersnaam(
  ID int(10) ,productID int(10) NOT NULL,
  BW varchar(255) NOT NULL, 
  typeP varchar(10) NOT NULL, aantal int(10)                          
  )";

if ($conn->query($sql) === TRUE) {
  echo "De tabel is gemaakt als hij niet bestond";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bestellingen";                          
// Create connection
$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
$result = $mysqli->query("SELECT ID FROM $gebruikersnaam WHERE productID = '$$productID'");
  if($result->num_rows == 0) {
    $sql = "INSERT INTO $gebruikersnaam (ID, productID, BW, 'typeP', aantal) 
    VALUES ('" . $ID . "', '" . $productID . "', '" . $BW ."', '" . $type ."', '" . $aantal ."')";
 } else {
    
}
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$mysqli->close();

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


}
?>


<?php
  // $servername = "localhost";
  // $dbusername = "root";
  // $dbpassword = "";
  // $dbname = "de levensbron gip";
  // $gebruikersnaam=$_SESSION["gebruikersnaam"];
                          
  // // Create connection
  // $mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
  // $result = $mysqli->query("SELECT gebruikersnaam FROM administrators WHERE gebruikersnaam = '$gebruikersnaam'");
  //   if($result->num_rows == 0) {
      
  //     $_SESSION["admin"] = false;
  //     header('location:./home.php');
  // } else {
  //     $_SESSION["admin"] = True;
  //   }
  // $mysqli->close();
?>
<?php
// if (isset($_SESSION["admin"]) && $_SESSION["admin"]=="True" && isset($_POST["addmin"])&& !empty($_POST["addmin"])){
//   echo"admin toevoegen";
//   $servername = "localhost";
//   $dbusername = "root";
//   $dbpassword = "";
//   $dbname = "de levensbron gip";
//   $gebruikersnaam=$_SESSION["gebruikersnaam"];
//   $addmin=$_POST["addmin"];
//   // Create connection
//   $mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
//   $result = $mysqli->query("SELECT gebruikersnaam, id FROM administrators WHERE gebruikersnaam = '$addmin'");
  
//     if($result->num_rows == 0) {
//       while($row = $result->fetch_assoc()) {
//       $insert = "True";
//       $id = $row["id"];}
//   } else {
//       setcookie($_COOKIE["action"] = "bestaat");
//       setcookie("action", "bestaat", time() + (86400), "/");
//       header('location:./administrator.php');
//     }
//   $mysqli->close();
//   echo"1 voorbij";
//   $mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
//   $result = $mysqli->query("SELECT gebruikersnaam, id FROM gebruikers WHERE gebruikersnaam = '$addmin'");
//     if($result->num_rows == 0) {
//       $insert = "False";
//       setcookie("action", "geen gebruiker", time() + (86400), "/");
//       header('location:./administrator.php');
//   }
//   $mysqli->close();
//   echo"2 voorbij";
//   if ($insert == "True"){
//   $conn = new mysqli($servername, $username, $password, $dbname);
//   // Check connection
//   if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//   }
  
//   $sql = "INSERT INTO administrators (gebruikersnaam, id) VALUES ('" . $addmin . "', '" . $id . "')";
  
//   if ($conn->query($sql) === TRUE) {
//     setcookie("action", "toegevoegd", time() + (86400), "/");
//     header('location:./administrator.php');
   

//   } else {
//     echo "Error updating record: " . $conn->error;//eventuele error
//   }
//   echo"3 voorbij";
//   $conn->close();

// }else{ echo"bestaat niet ";}

  
//}

if(isset($_POST["antw"])){
  print_r($_POST);
$antw = $_POST["antw"];
$Naam = $_POST["Naam"];
$email = $_POST["E-mail"];
$ID = $_POST["ID"];

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

$sql = "DELETE FROM vragen WHERE ID='$ID';";

if ($conn->query($sql) === TRUE) {
  
// the message
  $msg = $antw;

// use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg,70);

// send email
  mail($email,"uw vraag aan de levensbron",$msg);
  header('location:./vragen.php');
} else {
  echo "Error updating record: " . $conn->error;//eventuele error
}

$conn->close();
}


if(isset($_POST["delgebruiker"])&& !empty($_POST["id"]) && !empty($_POST["delgebruiker"])) {
$id = $_POST["id"];

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

$sql = "DELETE FROM gebruikers WHERE id='$id';";

if ($conn->query($sql) === TRUE) {
  echo "gebruiker is verwijderd";
  header('location:./gebruikers.php');
} else {
  echo "Error updating record: " . $conn->error;//eventuele error
}

$conn->close();
}


if(isset($_POST["changegebruiker"])&& !empty($_POST["changegebruiker"])){
  $id = $_POST["id"];
  $gebruikersnaam = $_POST["gebruikersnaam"];//zet alles om in mooie variabelen
  $email = $_POST["email"];
  $geboortedatum = $_POST["geboortedatum"];
  $straat = $_POST["straat"];
  $gemeente = $_POST["gemeente"];
  $postcode = $_POST["postcode"];
  $huisnummer = $_POST["huisnummer"];



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
  
  $sql = "UPDATE gebruikers SET gebruikersnaam='$gebruikersnaam', id='$id', email='$email', geboortedatum='$geboortedatum', straat='$straat', gemeente='$gemeente', postcode='$postcode', huisnummer='$huisnummer' WHERE id='$id';";
  
  if ($conn->query($sql) === TRUE) {
    echo "gebruiker zijn gegevens zijn aangepast";
  header('location:./gebruikers.php');
  } else {
    echo "Error updating record: " . $conn->error;//eventuele error
  }
  
  $conn->close();
}
?>