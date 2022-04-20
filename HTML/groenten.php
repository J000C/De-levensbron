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

.uitverkocht{
  color: red;/*style voor als iets uitverkocht is  */
}
.notkoggedin{
  text-align: center;/*styling voor de waarschuwing dat je moet ingelogd zijn om bestellingen te plaatsen*/
  color: red;
}
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
<button onclick="topFunction()" id="myBtn" title="Go to top">Naar boven</button>

  <div id="myBtnContainer">
    <button class="btn active" onclick="filterSelection('all')">  alles</button>
    <button class="btn" onclick="filterSelection('aangekocht')"> aangekocht</button>
    <button class="btn" onclick="filterSelection('eigen teelt')"> van eigen teelt <span class="dot"></span></button></button>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  </div>  
  <br>
  <?php if(isset($_SESSION["loggedin"])&& $_SESSION["loggedin"]=="True" &&!empty($_SESSION["id"])){
    
  }else{ echo"<div class='notkoggedin'><b>U moet ingelogd zijn om bestellingen te kunnen plaatsen</b></div>";}
  ?>
  <p></p>
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

    $sql = "SELECT * FROM groenten";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?>
<?php if(isset($_SESSION["admin"])&& $_SESSION["admin"]=="True"&&(isset($_SESSION['loggedin']) == "True" )) { ?> <div class="column <?php print $row["Oorsprong"]?>">
        <div class="content">
          <a href="../Images/groenten/<?php echo $row["Naam"]?>.jpg" ><img class="magic_wizzard" src="../Images/groenten/<?php echo $row["Naam"]?>.jpg"  alt="<?php print $row["Oorsprong"]?>" style="width:100%"> </a>
          <h2> <?php print $row["Naam"]; ?>
          <?php if ($row["Oorsprong"]=="eigen teelt"){?>
            <span 
              style="height: 15px; width: 15px; background-color:rgb(255, 0, 0);; border-radius: 50%; display: inline-block;">
            </span><?php } 
            ?>
          </h2>
            <div ><?php print " ". $row["Prijs"]."&#8364"." per ". $row["Eenheid"]?></div>
              <br>
              <?php if($row["Voorraad"]>0){print "Voorraad: ".$row["Voorraad"];if($row["Voorraad"]>1&&$row["Eenheid"]=="stuk"){print " ".$row["Eenheid"]."s";}else{print " ".$row["Eenheid"];};}else{print"<div class='uitverkocht' >Uitverkocht</div>";}?>
              <form action="./modify.php" method="POST"><br>          
              <hr style="background-color:red;margin-left:0;height: 5px;border:none"><br>
                <label for="points"><b>Naam:</b></label> 
                <input id="Naam" name="Naam" type="text" value="<?php print $row["Naam"]; ?>"></input><br><br>
                <label for="points">Voorraad:</label> 
                <input style="color: #164391; width: 20%" value="<?php print $row["Voorraad"]?>" type="number" id="Voorraad" name="Voorraad"  step="1" ><br><br>
                <input type="hidden" name="type" value="GR">
                <input type="text" value="True" name="update" id="update" hidden>
                <input type="hidden"  id="ID" name="ID" value="<?php print $row["ID"];?>">
                <label for="points"><b>Prijs:</b></label> 
                <input name="Prijs" id="Prijs" type="text" value="<?php print $row["Prijs"]; ?>&#8364"></input><br><br>
                <label for="points"><b>Oorsprong:</b></label>
                <select name="Oorsprong" id="Oorsprong">
                  <option value="eigen teelt"<?php if($row["Oorsprong"] == "eigen teelt"){echo"selected";}?>>eigen teelt</option>
                  <option value="aangekocht"<?php if($row["Oorsprong"] == "aangekocht"){echo"selected";}?>>aangekocht</option>>
                </select><br><br>
                <label for="points"><b>Eenheid:</b></label>
                <select name="Eenheid" id="Eenheid">
                  <option value="kilo"<?php if($row["Eenheid"] == "kilo"){echo"selected";}?>>kilo</option>
                  <option value="stuk"<?php if($row["Eenheid"] == "stuk"){echo"selected";}?>>stuk</option>>
                </select><br><br>
                <input class="button" type="submit" value="wijzigingen opslaan">
                </form>
                <form action="./modify.php" method="POST">
                <input type="hidden" name="type" value="GR">
                <input type="hidden"  id="ID" name="ID" value="<?php print $row["ID"];?>">
                <input type="text" id="delete" name="delete" value="True" hidden>
                <input class="button" style="background-color: red;" type="submit" onclick="return confirm('bent u zeker dat u dit item wilt verwijderen')" value="dit item verwijderen">
                </form>
                <p></p>
                
                
            </div><br><p></p>
          </div>
        </div> <?php } else{?>

      <div class="column <?php print $row["Oorsprong"]?>">
        <div class="content">
          <a href="../Images/groenten/<?php echo $row["Naam"]?>.jpg" ><img class="magic_wizzard" src="../Images/groenten/<?php echo $row["Naam"]?>.jpg"  alt="<?php print $row["Oorsprong"]?>" style="width:100%"> </a>
          <h2> <?php print $row["Naam"]; ?>
          <?php if ($row["Oorsprong"]=="eigen teelt"){?>
            <span 
              style="height: 15px; width: 15px; background-color:rgb(255, 0, 0);; border-radius: 50%; display: inline-block;">
            </span><?php } 
            ?>
          </h2>
          
            <div ><?php print " ". $row["Prijs"]."&#8364"." per ". $row["Eenheid"]?></div>
            <?php if ($row["Voorraad"]<=0){echo "<h3 style=color:red>Uitverkocht</h3>";} else{print "<h3 style=font-weight:normal>Voorraad: ". 
              $row["Voorraad"]." "; if ($row["Eenheid"]=="stuk"&& $row["Voorraad"]>1 ){print $row["Eenheid"]."s </h3";} else print $row["Eenheid"]." </h3";}?>
              </h3>
              <form action="./action_page.php" method="POST"><br>
                <?php if ($row["Voorraad"]> 0 && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]=="True"){ ?> <label for='points'>aantal:</label> 
                <?php if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]=="True"){ echo "<input style='color: #164391;' value='1' type='number' name='aantal' step='1' max=".$row["Voorraad"]." min='1' width='10%'>"; }?>
                <input type="text" hidden name="type" value="GR">
                <input type="text" hidden name="ID" value="<?php print $row["ID"];?>">
                <!-- <input type="text" hidden name="winkelwagen" id="winkelwagen" value="True"> -->
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]=="True")?>
                <?php 
                if(isset($_SESSION['loggedin']) == "True"){ if($row["Voorraad"]>0){echo "<input class='button'type='submit' value='toevoegen aan winkelwagen'>";}else{echo "<input class='button' style='display: none 'type='submit' value='add to cart'>";}
                  
                }
              ?> </form>       
             <?php }?>
            </div><br>
           
            
          </div>
          
        </div>
              
        <?php
      }}
      } 
      else {
        echo "Foutmelding";
      }
      $conn->close();

    if (isset($_SESSION["admin"])&&$_SESSION["admin"]=="True"){?>
      
      <div class="column">
        <div class="content">
          
              <h2><b>Een nieuw product toevoegen</b></h2>
              <form action="./modify.php" method="POST"><br>
              <label for="points"><b>Naam:</b></label> 
                <input id="Naam" name="Naam" type="text"></input><br><br>
                <label for="points"><b>Voorraad:</b></label> 
                <input style="color: #164391; width: 20%" type="number" id="Voorraad" name="Voorraad" step="1" ><br><br>
                <input type="hidden" name="type" value="GR">
                <input type="text" value="True" name="add" id="add" hidden>
                <input type="hidden"  id="ID" name="ID" >
                <label for="points"><b>Prijs:</b></label> 
                <input name="Prijs" id="Prijs" type="text" ></input><br><br>
                <label for="points"><b>Oorsprong:</b></label>
                <select name="Oorsprong" id="Oorsprong">
                  <option value="eigen teelt">eigen teelt</option>
                  <option value="aangekocht">aangekocht</option>>
                </select><br><br>
                <label for="points"><b>Eenheid:</b></label>
                <select name="Eenheid" id="Eenheid">
                  <option value="kilo">kilo</option>
                  <option value="stuk">stuk</option>>
                </select><br><br>
                <input class="button" type="submit" value="opslaan">
                  
      
             <?php ?>
            </div><br>
          </div>
          
        </div>
              
        <?php
      }
    ?>

    







    
  
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
  <script src="../Scripts/sticky_header.js" ></script>
  <script src="../Scripts/search_groenten_fruit.js"></script>  
  <script src="../Scripts/naarboven.js"></script>

  
      </body>
      </html>
    