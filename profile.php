<?php
include_once("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <?php

    if(isset($_GET['provider_id'])) {
        $sql = "SELECT provider_id,hospital_name,address,city,state,zip_code,county_name,phone_number,hospital_type,hospital_ownership,emergency_services,meets_criteria_for_meaningful_use_of_ehrs,hospital_overall_rating,hospital_overall_rating_footnote,mortality_national_comparison,mortality_national_comparison_footnote,safety_of_care_national_comparison,safety_of_care_national_comparison_footnote,readmission_national_comparison,readmission_national_comparison_footnote,patient_experience_national_comparison,patient_experience_national_comparison_footnote,effectiveness_of_care_national_comparison,effectiveness_of_care_national_comparison_footnote,timeliness_of_care_national_comparison,timeliness_of_care_national_comparison_footnote,efficient_use_of_medical_imaging_national_comparison,efficient_use_of_medical_imaging_national_comparison_footnote
							FROM hospital_general_information_lower
							WHERE provider_id = '" . ($_GET['provider_id']) . "'";
        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
        while ($rows = mysqli_fetch_assoc($resultset)) {
            $hospital_name = $rows['hospital_name'];
            $streetAddress = $rows['address'];
            $city = $rows['city'];
            $state = $rows['state'];
            $zip_code = $rows['zip_code'];
            $cityStateZip = $rows['city'] . ", " . $rows['state'] . " " . $rows['zip_code'];
            $phone_number = $rows['phone_number'];
            $mortality_national_comparison = $rows['mortality_national_comparison'];
            $safety_of_care_national_comparison = $rows['safety_of_care_national_comparison'];
            $patient_experience_national_comparison = $rows['patient_experience_national_comparison'];
            $effectiveness_of_care_national_comparison = $rows['effectiveness_of_care_national_comparison'];
            $timeliness_of_care_national_comparison = $rows['timeliness_of_care_national_comparison'];
            $efficient_use_of_medical_imaging_national_comparison = $rows['efficient_use_of_medical_imaging_national_comparison'];
            $hospital_ownership = $rows['hospital_ownership'];
            $emergency_services = $rows['emergency_services'];
            $hospital_overall_rating = $rows['hospital_overall_rating'];
            $phone_number =   $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $phone_number);
        }

    }
    ?>


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
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Bootstrap</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">Map</a>
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
                <h1 class="text-uppercase">
                    <strong><?php echo $hospital_name; ?></strong>
                </h1>
                <hr>
            </div>
            <div class="col-lg-8 mx-auto">
                <h3>
                    <?php echo $streetAddress; ?><br>
                    <?php echo $cityStateZip; ?><br>
                    <?php echo $phone_number; ?><br>


                </h3>

                <div class="hospitalstats">
                    <p>
                        <?php echo "Emergency Services: " . $emergency_services; ?><br>
                        <?php echo "Hospital Ownership: " . $hospital_ownership; ?><br>
                        <?php echo "Mortality National Comparison: " . $mortality_national_comparison; ?><br>
                        <?php echo "Safety of Care: " . $safety_of_care_national_comparison; ?><br>
                        <?php echo "Patient Experience: " . $patient_experience_national_comparison; ?><br>
                        <?php echo "Effectiveness of Care: " . $effectiveness_of_care_national_comparison; ?><br>
                        <?php echo "Timeliness of Care: " . $timeliness_of_care_national_comparison; ?><br>
                    </p>
                    <h3>
                        <?php echo "Hospital Overall Rating: " ; ?> <br>
                            <?php echo "";
                                for ( $i = (int)$hospital_overall_rating; $i >= 1; $i-- ) {
                                    echo '<img src="images/gold_star.png" width="30" height="30" title="star" alt="gold star" />';
                                }?>

                    </h3>
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

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-heading text-white">Map.</h2>
            </div>

            <?php
            $map_address = $streetAddress . " " . $city . " ". $state;
            $map_address = str_replace(' ', '%20', $map_address);
            $google_map_src = "https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=" . $map_address . "+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed";
            ?>

            <p class="text-faded mb-4"></p>
            <div style="width: 100%">

                <?php echo "<iframe width='100%' height='500' src=$google_map_src><a href='https://www.maps.ie/create-google-map/'>Create Google Map</a></iframe>";
                ?>
            </div><br />
            <!--<a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>-->
        </div>
    </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">At Your Service</h2>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <i class="fa fa-4x fa-diamond text-primary mb-3 sr-icons"></i>
                    <h3 class="mb-3">Sturdy Templates</h3>
                    <p class="text-muted mb-0">Our templates are updated regularly so they don't break.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <i class="fa fa-4x fa-paper-plane text-primary mb-3 sr-icons"></i>
                    <h3 class="mb-3">Ready to Ship</h3>
                    <p class="text-muted mb-0">You can use this theme as is, or you can make changes!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <i class="fa fa-4x fa-newspaper-o text-primary mb-3 sr-icons"></i>
                    <h3 class="mb-3">Up to Date</h3>
                    <p class="text-muted mb-0">We update dependencies to keep things fresh.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box mt-5 mx-auto">
                    <i class="fa fa-4x fa-heart text-primary mb-3 sr-icons"></i>
                    <h3 class="mb-3">Made with Love</h3>
                    <p class="text-muted mb-0">You have to make your websites with love these days!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="p-0" id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/1.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/1.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/2.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/2.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/3.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/3.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/4.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/4.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/5.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/5.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="img/portfolio/fullsize/6.jpg">
                    <img class="img-fluid" src="img/portfolio/thumbnails/6.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="portfolio-box-caption-content">
                            <div class="project-category text-faded">
                                Category
                            </div>
                            <div class="project-name">
                                Project Name
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-dark text-white">
    <div class="container text-center">
        <h2 class="mb-4">Free Download at Start Bootstrap!</h2>
        <a class="btn btn-light btn-xl sr-button" href="http://startbootstrap.com/template-overviews/creative/">Download Now!</a>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-heading">Let's Get In Touch!</h2>
                <hr class="my-4">
                <p class="mb-5">Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center">
                <i class="fa fa-phone fa-3x mb-3 sr-contact"></i>
                <p>123-456-6789</p>
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i>
                <p>
                    <a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a>
                </p>
            </div>
        </div>
    </div>
</section>

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
