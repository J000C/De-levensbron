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
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../CSS/main.css">
<link rel="stylesheet" href="../CSS/contact.css">
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
  display:inline-flex;

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
      <a href='account.php'>Account</a>
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
<button onclick="topFunction()" id="myBtn" title="Go to top">Naar boven</button>

</html>
</header>
<div class="contact_gegevens">
  <h2>Contactgegevens</h2> 
  <h4>Maarten Van Gool</h4> 
  <a maarten.van.gool@telenet.be><h4>maarten.van.gool@telenet.be</h4></a>
  <a href="www.facebook.com/BioboerderijDeLevensbron"><h4></h4></a>
  <h4>Langstraat 41 <br> 3384 Glabbeek</h4>
</div>
  
  
  <div class="vraag_form">
    <h2>Hebt u een vraag voor ons?</h2>
    <form action="DBvraag.php" method="post">
      Naam:<br>
      <input required type="text" maxlength="50" name="Naam"><br>
      E-mail:<br>
      <input required type="text" name="E-mail"><br>
      Vraag:<br>
    <div class="vraag_placeholder">
      <textarea required type="text" name="Vraag" maxlength="188" style="height:120px" ></textarea>
    </div>
      <br>
      <input type="submit" value="Verzenden">
    </form>
  </div>
  
  <div class="maps"> 
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2543.174626353078!2d4.912908892016207!3d50.86836208556695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c1698062c6d445%3A0x16adba40338c14cb!2sDe%20Levensbron!5e0!3m2!1snl!2sbe!4v1634662435016!5m2!1snl!2sbe"  width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" >
  </div>  
  <footer>
  <div class="footer"> 
    <br>
      <div class="bio_explainer" >Dit bedrijf is 
        <a href="https://integra.tuv-nord.com/other/pdfcertificates/Cert/Certout/1099_VAN_GOOL_M_BPD_wet_Vl_20210531_CER_Certificate_Unified_v.2_NL_73507.pdf"> gecertificeerd</a>
        <a href="https://lv.vlaanderen.be/nl/bio/wetgeving-biologische-productie"> bio</a>
        
      </div>
      <div class="footer_desiner" >Designed by Ward Van Gool</div>
      <br>
  <br>
  </div>
</footer>
  

<?php
if ( isset($_COOKIE['$vraagmelding'])) { //kijk of cookie niet bestaat
                print 'ik heb een koekie aangemaakt omdat het niet bestond <br>';
                setcookie("vraagmelding", "", time() - 3600);
                echo "jow dit is eeenneeneneneneopo";
}?>
  
  <script src="../Scripts/sticky_header.js" ></script>
  

      </body>

      </html>
        