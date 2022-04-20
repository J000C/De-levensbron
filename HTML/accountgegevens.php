<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../CSS/registreren.css">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background: rgb(4,17,179);
  background: linear-gradient(180deg, rgba(4,17,179,1) 0%, rgba(205,22,22,0.9307073171065301) 100%);
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
  margin-left: 24%;
  margin-right: 24%;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  border-radius: 4px;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}

a:link, a:visited {
  background-color: #0b14bf;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  float:right;
  border-radius: 4px;

}
a:hover{
  opacity: 1;
}
.loginbutton{
  margin-left: 55%;
  margin-right: 0px;
}

</style>
</head>
<body>

<?php
if(!isset($_SESSION["id"])){
    header('location:./home.php');
}
  $id = $_SESSION["id"];
  $gebruikersnaam = $_SESSION["gebruikersnaam"];
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

  $sql = "SELECT * FROM gebruikers WHERE id = '$id'";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     ?>
    <form action="DBregistreren.php" method="post">
    <div class="container">
      <h1>Registreren </h1><p  class="loginbutton">Hebt u al een account?<a  href="inloggen.php" >Inloggen</a></p>    
      <label for="Voornaam"><b>Gebruikersnaam</b></label>
      <input type="text" name="gebruikersnaam"  id="gebruikersnaam" value="<?php print $result["gebruikersnaam"];?>">
      
      <label for="Email"><b>Email</b></label>
      <input type="text" name="Email" id="Email" value="<?php print $result["email"]?>;" required>
      <br><br>
  
      <label for="Wachtwoord"><b>Wachtwoord</b></label>
      <input type="password" placeholder="" name="Wachtwoord" id="Wachtwoord" required>
      <br><br>
      
      <label for="Geboortedatum"><b>Geboortedatum:</b></label>    <br><br>
  
      <input style="width:20%" type="date" id="Geboortedatum" name="Geboortedatum" required>
      <br><br>
      <br><br>
      <label for="Straat"><b>Straat</b></label>      <label style="right: 60%;" for="Huisnummer"><b>+ Huisnummer</b></label><br>
      <input style="width:30%" type="text" placeholder="Langstraat" name="Straat" id="Straat" required>  <input style="width:20%" type="text" placeholder="41" name="Huisnummer" id="Huisnummer" required>
      <br><br>
      <label for="Gemeente"><b>Gemeente + postcode</b></label><br>
      <input style="width:30%" type="text" placeholder="Glabbeek" name="Gemeente" id="Gemeente" required> <input style="width:20%" type="text" placeholder="3384" name="Postcode" id="Postcode" required>
  
      <br><br>
  
      
      <hr>
      <p>Bij het aanmaken van een account gaat u akkoord met de voorwaarden <a  href="#">Terms & Privacy</a></p>
  
      <button type="submit" class="registerbtn">Registreren</button>
    </div>
    
  </form>
  <?php
    }}
  $mysqli->close();
  ?>


</body></html>