<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["gebruikersnaam"]))){
        $username_err = "<div style=color:red>vul een gebruikersnaam in</div>";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["gebruikersnaam"]))){
        $username_err = "<div style=color:red>de gebruikersnaam kan alleen letters, nummers, en underscores bevatten.</div>";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM gebruikers WHERE gebruikersnaam = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["gebruikersnaam"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "<div style=color:red >Deze gebruikersnaam bestaat al.</div>";
                } else{
                    $username = trim($_POST["gebruikersnaam"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["wachtwoord"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["wachtwoord"])) < 6){
        $password_err = "<div style=color:red>het wachtwoord moet ten minste 6 caracters hebben</div>";
    } else{
        $password = trim($_POST["wachtwoord"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "<div style=color:red>bevestig uw wachtwoord</div>";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "<div style=color:red>wachtwoorden komen niet overeen</div>";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord, email, geboortedatum, straat, huisnummer, gemeente, postcode) VALUES (?, ?,'" . $_POST['email'] . "', '" . $_POST['geboortedatum'] . "', '" . $_POST['straat'] ."', '" . $_POST['huisnummer'] ."', '" . $_POST['gemeente'] ."', '" . $_POST['postcode']."')";
        // $sql = "INSERT INTO gebruikers (email, geboortedatum, straat, huisnummer, gemeente, postcode) VALUES ('" . $_POST['email'] . "', '" . $_POST['geboortedatum'] . "', '" . $_POST['straat'] ."', '" . $_POST['huisnummer'] ."', '" . $_POST['gemeente'] ."', '" . $_POST['postcode']."')";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
    <link rel="stylesheet" href="../CSS/registreren.css">
    

<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <h1>Registreren </h1><p  class="loginbutton">Hebt u al een account?<a  href="login.php" >Inloggen</a></p>
    

    <label><b>Gebruikersnaam</b></label>
    <input type="text" required name="gebruikersnaam" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
    <span class="invalid-feedback"><?php echo $username_err; ?></span>
    <br><br>
    <br>
    

    <label for="wachtwoord"><b>Wachtwoord</b></label>
    <input type="password" required  name="wachtwoord" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
    <?php echo $password_err; ?></span>
    <br><br>
    <br>


    

    <label><b>Bevestig wachtwoord</b></label>
    <input type="password" required name="confirm_password" class="form-control  <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
    <br><br>
    <br>
    <label for="email"><b>Email</b></label>
    <input type="text" name="email" id="email" required>
    <br><br>

    <label for="geboortedatum"><b>Geboortedatum:</b></label><br><br>

    <input style="width:20%" type="date" id="geboortedatum" name="geboortedatum" required>
    <br><br>
    <br><br>
    <label for="straat"><b>Straat</b></label>      <label style="right: 60%;" for="huisnummer"><b>+ Huisnummer</b></label><br>
    <input style="width:30%" type="text" placeholder="Langstraat" name="straat" id="straat" required>  <input style="width:20%" type="text" placeholder="41" name="huisnummer" id="huisnummer" required>
    <br><br>
    <label for="gemeente"><b>Gemeente + postcode</b></label><br>
    <input style="width:30%" type="text" placeholder="Glabbeek" name="gemeente" id="gemeente" required> <input style="width:20%" type="text" placeholder="3384" name="postcode" id="postcode" required>

    <br><br>

    
    <hr>
    <p>Bij het aanmaken van een account gaat u akkoord met de voorwaarden <a  href="#">Voorwaarden</a></p>
<div >
    <input type="submit" class="registerbtn" value="Registreren">
    <!-- <input type="reset" class="registerbtn" value="Reset"> -->
</div>
</head>
</body>
</html>







