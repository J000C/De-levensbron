<?php
    if (isset($_POST)) { //kijk of post is TRUE
        if ($_POST['type'] == "FR") { //kijk of groenten of fruit is
            print 'het is fruit! <br>';

            if (! isset($_COOKIE['winkelwagenFR'])) { //kijk of cookie niet bestaat
                print 'ik heb een koekie aangemaakt omdat het niet bestond <br>';
                
                $winkelwagen = array(
                    $_POST["ID"] => $_POST["aantal"]
                );
                
                setcookie('winkelwagenFR', json_encode($winkelwagen), time() + 600);
            } else { //koekie bestaat
                print 'ik heb een koekie gevonden!<br>';

                $winkelwagen = json_decode($_COOKIE['winkelwagenFR'], true);
                
                if ($winkelwagen[$_POST['ID']]) { //add extra to cart
                    $winkelwagen[$_POST['ID']] += $_POST['aantal'];
                } else {
                    $winkelwagen[$_POST['ID']] = $_POST['aantal'];
                }

                setcookie('winkelwagenFR', json_encode($winkelwagen), time() + 600);

                print 'koekie inhoud:: ';
                print_r($winkelwagen);

            } 
        } else {
            print 'het is een groente!<br>';

            if (! isset($_COOKIE['winkelwagenGR'])) { //kijk of cookie niet bestaat
                print 'ik heb een koekie aangemaakt omdat het niet bestond <br>';
                
                $winkelwagen = array(
                    $_POST["ID"] => $_POST["aantal"]
                );
                
                setcookie('winkelwagenGR', json_encode($winkelwagen), time() + 600);
            } else { //koekie bestaat
                print 'ik heb een koekie gevonden!<br>';

                $winkelwagen = json_decode($_COOKIE['winkelwagenGR'], true);
                
                if ($winkelwagen[$_POST['ID']]) { //add extra to cart
                    $winkelwagen[$_POST['ID']] += $_POST['aantal'];// ed
                } else {
                    $winkelwagen[$_POST['ID']] = $_POST['aantal'];
                }

                setcookie('winkelwagenGR', json_encode($winkelwagen), time() + 600);

                print 'koekie inhoud:: ';
                print_r($winkelwagen);

            } 
        }
        
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>