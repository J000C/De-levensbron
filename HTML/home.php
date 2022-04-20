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
<section>
  <img class="mySlides" src="../Images/20211030_112715.jpg"
  style="width:50%">
  <img class="mySlides" src="../Images/20211030_112649.jpg"
  style="width:50%">
  <img class="mySlides" src="../Images/20211030_112657.jpg"
  style="width:50%">
</section>
<div class="hometext">Wij telen heel het jaar door een 40- tal groenten naar gelang het seizoen, we telen ook aardbeien (van mei tot juni), aardappelen en we hebben ook enkele hoogstamfruitbomen (appel en peer).
We telen ook in een glazen serre: 10 are (zomer: tomaten, paprika, komkommer, meloen, aubergines, winter: veldsla, kervel, postelein, raapsteeltjes, rucola en plantgoed)
>Gewassen:45 gekweekte soorten per jaar
<div style="text-align:center"><iframe width="760" height="415" src="https://www.youtube.com/embed/ZT3QlbFYRmk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
<div class="hometext">
  

Kweek in volle grond, kweek in koude kassen

Behandeling van gewassen
Gebruik van organische meststoffen (mest, gier), gebruik van biologische meststoffen en gewasbeschermingsmiddelen

Poot- en zaaigoed 
Afkomstig van een leverancier binnen de EU

Biologisch zaaigoed

Verwerking
Ik verwerk mijn producten niet

Andere ingrediënten: niet ingevuld

Herkomst van de andere ingrediënten: niet ingevuld

Kenmerken van de andere ingrediënten: niet ingevuld</h5>
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
<script src="../Scripts/sticky_header.js"></script>
<script src="../Scripts/home.js"></script>
<script src="../Scripts/naarboven.js"></script>

      </body>
      </html>
  