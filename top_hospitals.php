<?php
include_once("db_connect.php");
include_once("geoplugin.class.php");
$geoplugin = new geoPlugin();
$geoplugin->locate();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>




    <meta charset="UTF-8">
    <title>PHP Live MySQL Database Search</title>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.search-box input[type="text"]').on("keyup input", function(){
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal}).done(function(data){
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/other.css"/>


</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="/startbootstrap-creative-gh-pages/index.php">Home</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead text-center text-white d-flex">
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <table class="table-active table-hover  text-left" id="location_search_table">

                    <?php
                    $sql = "SELECT provider_id,hospital_name,address,city,state,zip_code,county_name,phone_number,hospital_type,hospital_ownership,emergency_services,meets_criteria_for_meaningful_use_of_ehrs,hospital_overall_rating,hospital_overall_rating_footnote,mortality_national_comparison,mortality_national_comparison_footnote,safety_of_care_national_comparison,safety_of_care_national_comparison_footnote,readmission_national_comparison,readmission_national_comparison_footnote,patient_experience_national_comparison,patient_experience_national_comparison_footnote,effectiveness_of_care_national_comparison,effectiveness_of_care_national_comparison_footnote,timeliness_of_care_national_comparison,timeliness_of_care_national_comparison_footnote,efficient_use_of_medical_imaging_national_comparison,efficient_use_of_medical_imaging_national_comparison_footnote
							FROM hospital_general_information_lower
							WHERE hospital_overall_rating = '5' ORDER BY state";
                    $result_set = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                    $city = $geoplugin->city;
                    $city_state = $geoplugin->city . ", " .$geoplugin->region;
                    $state = $geoplugin->region;
                    ?>
                    <H3>Five-star hospitals </H3>

                    <thead>
                    <tr>
                        <thscope="col"></th>
                        <thscope="col"></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php while ($row = mysqli_fetch_array($result_set)) {
                        $city_state = $row[3] . ", " . $row[4];
                        echo "<tr scope= 'row'>
                            <td><a href=profile.php?provider_id=" . $row[0] . " style=\"text-decoration: none\">" . $row[1] . "</a></td>
                            <td>" . $city_state . "</td>
                          </tr>";}
                    ?>
                    </tbody>
                </table>
                <h1 class="text-uppercase">
                </h1>

            </div>
            <div class="col-lg-8 mx-auto">
                <h3>




                </h3>

                <div class="hospitalstats">



                </div>
                <!--<p class="text-faded mb-5">This box below should let you search. Right now, I think it only works by Hospital Name.</p>

                <div class="search-box">
                    <input type="text" autocomplete="off" placeholder="Search hospital name..." />
                    <div class="result"></div>
                </div>

                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a> -->
            </div>
        </div>
    </div>
</header>

<!-- Bootstrap core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/creative.min.js"></script>

</body>

</html>
