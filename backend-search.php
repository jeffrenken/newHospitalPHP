<!DOCTYPE html>
<html lang="en">
<head><link rel="stylesheet" type="text/css" href="css/other.css"/>
</head>

<?php

//include("db_connect.php");

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "root", "hospital_short");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


function titleCase($string, $delimiters = array(" ", "-", ".", "O'", "Mc"), $exceptions = array("and", "to", "of", "das", "dos", "I", "II", "III", "IV", "V", "VI"))
{
    /*
     * Exceptions in lower case are words you don't want converted
     * Exceptions all in upper case are any words you don't want converted to title case
     *   but should be converted to upper case, e.g.:
     *   king henry viii or king henry Viii should be King Henry VIII
     */
    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, "UTF-8");
            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, "UTF-8");
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = join($delimiter, $newwords);
    }//foreach
    return $string;
}



if(isset($_REQUEST['term'])) {
    $conn = mysqli_connect("localhost", "root", "root", "hospital_short");

    $term = "%" . $_REQUEST['term'] . "%";
    $term_clean = $_REQUEST['term'];
    $term_clean = trim($term_clean, '"');

    if (is_numeric($term_clean)) {

        $query = "SELECT hospital_name, provider_id, zip_code FROM hospital_general_information_lower WHERE zip_code LIKE ? LIMIT 10";
        $statement = $conn->prepare($query);
        $statement->bind_param("s", $term);
        $statement->execute();
        $statement->store_result();


        if ($statement->num_rows() == 0) {
            //echo "<p>Geen producten gevonden ".$_REQUEST['term']."</p>";
            $statement->close();
            $conn->close();
        } else {
            $statement->bind_result($hospital_name, $provider_id, $zip_code);
            while ($statement->fetch()) {
                echo "<p><a href=zip_search.php?zip_code=" . $zip_code . " style=\"text-decoration: none\">" . $zip_code . "</a></p>";
            }
        }
    } else {
        $query = "SELECT hospital_name, provider_id, zip_code FROM hospital_general_information_lower WHERE hospital_name LIKE ? LIMIT 10";
        $statement = $conn->prepare($query);
        $statement->bind_param("s", $term);
        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows() == 0) {
            //echo "<p>Geen producten gevonden ".$_REQUEST['term']."</p>";
            $statement->close();
            $conn->close();
        } else {
            $statement->bind_result($hospital_name, $provider_id, $zip_code);
            while ($statement->fetch()) {

                //$link_address = "profile.php?provider_id=".$row['provider_id'];
                //echo "<a href='".$link_address."'>Link</a>";
                //echo "<p>$hospital_name;</p>";};
                $hospital_name = titleCase($hospital_name);
                echo "<p><a href=profile.php?provider_id=" . $provider_id . " style=\"text-decoration: none\">" . $hospital_name . "</a></p>";
            };
        }
        //echo "<p><a href='".$link_address."'>" . titleCase($row["hname"])."</a></p>";        };
        $statement->close();
        $conn->close();
    }
}


/*


if(isset($_REQUEST['term'])){
    // Prepare a select statement
    $sql = "SELECT hospital_name as hname, provider_id, zip_code FROM hospital_general_information_lower WHERE hospital_name LIKE ? LIMIT 10";

    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);

        // Set parameters
        $param_term = $_REQUEST['term'] . '%';

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                $array = array();

                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){


                        //<a class="nav-link js-scroll-trigger" href="#about">About</a>

                    $link_address = "profile.php?provider_id=".$row['provider_id'];
                    //echo "<a href='".$link_address."'>Link</a>";


                    echo "<p><a href='".$link_address."'>" . titleCase($row["hname"])."</a></p>";

                    //echo "<p><a href='".$link_address."'>" . titleCase($row["hname"])  . $row['provider_id'] . "</a></p>";
                    //$array [] = array("hname"=>$rows['hname'],"href"=>"profile.php?provider_id=".$rows['provider_id']);
                    //echo $array;

                }
                //echo $array;

            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    } else{
        echo "couldn't connect1";}

// Close statement
mysqli_stmt_close($stmt);
}

// close connection
mysqli_close($link);
?>


