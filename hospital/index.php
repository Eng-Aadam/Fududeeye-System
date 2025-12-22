
<?php
include_once('hms/include/config.php');
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['emailid'];
$mobileno=$_POST['mobileno'];
$dscrption=$_POST['description'];
$query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");
echo "<script>alert('Your information succesfully submitted');</script>";
echo "<script>window.location.href ='index.php'</script>";

} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fududeeye</title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- Simple home-page specific enhancements -->
    <style>
        body {
            background-color: #f5f7fb;
        }

        /* Header */
        #nav-head.header-nav {
            background: linear-gradient(90deg, #059669, #0ea5e9);
            box-shadow: 0 2px 14px rgba(15, 23, 42, 0.15);
        }

        #nav-head .nav-item ul li a {
            font-weight: 500;
            letter-spacing: 0.02em;
            color: #e5f9ff;
        }

        #nav-head .nav-item ul li a:hover {
            color: #ffffff;
        }

        .appoint .btn.btn-success {
            padding: 8px 22px;
            border-radius: 999px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            background: #ffffff;
            color: #047857;
            border: none;
            box-shadow: 0 10px 22px rgba(4, 120, 87, 0.35);
        }

        .appoint .btn.btn-success:hover {
            background: #d1fae5;
            color: #065f46;
        }

        /* Hero / slider */
        .slider-detail {
            position: relative;
            overflow: hidden;
        }

        .slider-detail .carousel-item::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(5, 150, 105, 0.92), rgba(14, 165, 233, 0.70));
        }

        .slider-detail .carousel-caption.vdg-cur {
            bottom: 22%;
            text-align: left;
        }

        .hero-title {
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        @media (min-width: 992px) {
            .hero-title {
                font-size: 46px;
            }
        }

        .hero-subtitle {
            font-size: 15px;
            max-width: 480px;
            margin-bottom: 22px;
        }

        .hero-cta {
            padding: 10px 26px;
            border-radius: 999px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: #ffffff;
            color: #047857;
            border: none;
        }

        .hero-cta:hover {
            background: #d1fae5;
            color: #065f46;
        }

        /* Wave separator under hero */
        .slider-detail::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            height: 60px;
            background: #f5f7fb;
            border-top-left-radius: 50% 100%;
            border-top-right-radius: 50% 100%;
        }

        /* Key features / departments */
        .key-features.department {
            padding: 70px 0 40px;
        }

        .key-features .inner-title h2 {
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .key-features .inner-title p {
            color: #6b7280;
        }

        .single-key {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px 22px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            margin-bottom: 26px;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            text-align: center;
        }

        .single-key i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            border-radius: 999px;
            background: rgba(5, 150, 105, 0.08);
            color: #059669;
            font-size: 24px;
            margin-bottom: 12px;
        }

        .single-key h5 {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .single-key p {
            margin-bottom: 0;
            color: #6b7280;
            font-size: 14px;
        }

        .single-key:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.16);
        }

        /* About us */
        .about-us h3 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .about-us p {
            font-size: 15px;
            line-height: 1.7;
            color: #4b5563;
        }

        /* Footer */
        .footer {
            background: #0b1120;
        }

        .footer h2 {
            font-weight: 600;
            margin-bottom: 18px;
        }

        .footer .link-list li a {
            font-size: 14px;
        }

        .copy {
            background: #020617;
            padding: 10px 0;
        }

        /* Our Gallery -> Departments strip */
        #gallery {
            padding: 60px 0 40px;
            background: #f5f7fb;
        }

        #gallery .inner-title h2 {
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        #gallery .inner-title p {
            margin-bottom: 30px;
            color: #6b7280;
        }

        .departments-strip-wrapper {
            overflow: hidden;
            position: relative;
        }

        .departments-strip {
            display: inline-flex;
            white-space: nowrap;
        }

        .dept-card {
            min-width: 230px;
            margin: 0 10px;
            padding: 18px 18px;
            border-radius: 14px;
            border: 1px solid rgba(37, 99, 235, 0.18);
            background: #ffffff;
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
            display: inline-flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .dept-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 999px;
            background: rgba(37, 99, 235, 0.08);
            color: #2563eb;
            margin-bottom: 8px;
            font-size: 18px;
        }

        .dept-title {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }
    </style>
</head>

    <body>

    <!-- ################# Header Starts Here#######################--->
      <header id="menu-jk">
        <div id="nav-head" class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3  col-sm-12" style="color:#000;font-weight:bold; font-size:42px; margin-top: 1% !important;">Fududeeye
                       <a data-toggle="collapse" data-target="#menu" href="#menu" ><i class="fas d-block d-md-none small-menu fa-bars"></i></a>
                    </div>
                    <div id="menu" class="col-lg-8 col-md-9 d-none d-md-block nav-item">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#about_us">About Us</a></li>
                            <li><a href="#gallery">Gallery</a></li>
                            <li><a href="#contact_us">Contact Us</a></li>
                            <li class="d-block d-lg-none"><a href="hms/unified-login.php">Login</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-2 d-none d-lg-block appoint">
                        <a class="btn btn-success" href="hms/unified-login.php">LOGIN</a>
                    </div>
                </div>
            </div>
        </div>
    </header>   
     <!-- ################# Slider Starts Here#######################--->
    <div class="slider-detail">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item ">
                <img class="d-block w-100" src="assets/images/slider/h1.jpeg" alt="First slide">
                <div class="carousel-cover"></div>
                <div class="carousel-caption vdg-cur d-none d-md-block">
                    <h2 class="hero-title animated bounceInDown">Fududeeye</h2>
                    <p class="hero-subtitle animated fadeInUp">
                        Streamline patient appointments, doctor schedules, and hospital operations from a single, secure platform.
                    </p>
                    <a href="hms/unified-login.php" class="btn btn-success hero-cta animated fadeInUp">
                        Login to Portal
                    </a>
                </div>
            </div>
            
            <div class="carousel-item active">
                <img class="d-block w-100" src="assets/images/slider/H2.jpg" alt="Second slide">
                <div class="carousel-cover"></div>
                <div class="carousel-caption vdg-cur d-none d-md-block">
                    <h2 class="hero-title animated bounceInDown">Quality Care, Simplified</h2>
                    <p class="hero-subtitle animated fadeInUp">
                        Patients, doctors, and admins can all access their dashboards through one unified login experience.
                    </p>
                    <a href="hms/unified-login.php" class="btn btn-success hero-cta animated fadeInUp">
                        Get Started
                    </a>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="assets/images/slider/H3.jpg" alt="Third slide">
                <div class="carousel-cover"></div>
                <div class="carousel-caption vdg-cur d-none d-md-block">
                    <h2 class="hero-title animated bounceInDown">Stay Connected</h2>
                    <p class="hero-subtitle animated fadeInUp">
                        Access medical records, appointments, and hospital updates from anywhere, at any time.
                    </p>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="assets/images/slider/H4.jpg" alt="Fourth slide">
                <div class="carousel-cover"></div>
                <div class="carousel-caption vdg-cur d-none d-md-block">
                    <h2 class="hero-title animated bounceInDown">For Patients & Staff</h2>
                    <p class="hero-subtitle animated fadeInUp">
                        Designed to make life easier for patients, doctors, and hospital administrators alike.
                    </p>
                </div>
            </div>    
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

    
    <!-- ################# Our Departments Starts Here#######################--->

<section id="services" class="key-features department">
    <div class="container">
        <div class="inner-title">
            <h2>Our Key Features</h2>
            <p>Explore some of our key features below</p>
        </div>

        <div class="row">
            <!-- Existing key features -->
            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                    <i class="fas fa-heart"></i>
                    <h5>Cardiology</h5>
                    <p>Specialized care for heart-related issues.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                    <i class="fas fa-bone"></i>
                    <h5>Orthopaedic</h5>
                    <p>Comprehensive orthopedic services for bone health.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                   <i class="fas fa-brain"></i>
                    <h5>Neurology</h5>
                    <p>Expert care for neurological disorders.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                    <i class="fas fa-pills"></i>
                    <h5>Pharma Pipeline</h5>
                    <p>Innovative pharmaceutical developments.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                    <i class="fas fa-user-md"></i>
                    <h5>Pharma Team</h5>
                    <p>Collaborative team dedicated to pharmaceutical advancements.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                    <i class="fas fa-medkit"></i>
                    <h5>High-Quality Treatments</h5>
                    <p>Providing top-notch medical treatments for your well-being.</p>
                </div>
            </div>

            <!-- Additional key features -->
            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                    <i class="fas fa-dna"></i>
                    <h5>Genetics</h5>
                    <p>Exploring genetic solutions for personalized healthcare.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                    <i class="fas fa-tooth"></i>
                    <h5>Dentistry</h5>
                    <p>Comprehensive dental care for a healthy smile.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="single-key">
                   <i class="fas fa-microscope"></i>
                    <h5>Research & Development</h5>
                    <p>Advancing healthcare through cutting-edge research.</p>
                </div>
            </div>
        </div>
    </div>
</section>



    <!--  ************************* About Us Starts Here ************************** -->
        
    <section id="about_us" class="about-us">
        <div class="row no-margin">
            <div class="col-sm-6 image-bg no-padding">
                
            </div>
            <div class="col-sm-6 abut-yoiu">
                <h3>About Our Hospital</h3>
<?php
$ret=mysqli_query($con,"select * from tblpage where PageType='aboutus' ");
while ($row=mysqli_fetch_array($ret)) {
?>

    <p><?php  echo $row['PageDescription'];?>.</p><?php } ?>
            </div>
        </div>
    </section>    
    
    
            <!--  ************************* Gallery Starts Here ************************** -->
            <div id="gallery" class="gallery">
    <div class="container">
        <div class="inner-title text-center">
            <h2>Our Departments</h2>
            <p>For Your Health</p>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="departments-strip-wrapper">
                    <div class="departments-strip" id="departmentsStrip">
                        <div class="dept-card">
                            <div class="dept-icon"><i class="fas fa-ambulance"></i></div>
                            <div class="dept-title">Emergency Department</div>
                        </div>
                        <div class="dept-card">
                            <div class="dept-icon"><i class="fas fa-child"></i></div>
                            <div class="dept-title">Pediatric Department</div>
                        </div>
                        <div class="dept-card">
                            <div class="dept-icon"><i class="fas fa-female"></i></div>
                            <div class="dept-title">Obstetrics &amp; Gynecology</div>
                        </div>
                        <div class="dept-card">
                            <div class="dept-icon"><i class="fas fa-heartbeat"></i></div>
                            <div class="dept-title">Cardiology Department</div>
                        </div>
                        <div class="dept-card">
                            <div class="dept-icon"><i class="fas fa-brain"></i></div>
                            <div class="dept-title">Neurology Department</div>
                        </div>
                        <div class="dept-card">
                            <div class="dept-icon"><i class="fas fa-user-md"></i></div>
                            <div class="dept-title">Psychiatry Department</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- ######## Gallery End ####### -->
     <!--  ************************* Contact Us Starts Here ************************** -->
     <style>
    #contact_us {
        background: linear-gradient(135deg, #059669, #0ea5e9);
        padding: 60px 0 40px;
        color: #ffffff;
    }

    .contact-us-single {
        font-family: 'Open Sans', sans-serif;
        text-align: center;
    }

    .contact-heading {
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .contact-subtitle {
        max-width: 520px;
        margin: 0 auto 25px;
        font-size: 14px;
        opacity: 0.9;
    }

    .cop-ck {
        background-color: #ffffff;
        padding: 30px 30px 24px;
        border-radius: 10px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.35);
        max-width: 820px;
        margin: 0 auto;
        text-align: left;
    }

    .cop-ck .form-control {
        width: 100%;
        padding: 10px 12px;
        margin: 8px 0 14px;
        box-sizing: border-box;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
    }

    .cop-ck textarea {
        min-height: 90px;
        resize: vertical;
    }

    .contact-label {
        font-weight: 600;
        font-size: 13px;
        color: #4b5563;
        margin-bottom: 4px;
    }

    .contact-submit-btn {
        background-color: #059669;
        color: #fff;
        padding: 10px 24px;
        border: none;
        border-radius: 999px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .contact-submit-btn:hover {
        background-color: #047857;
    }

    .contact-social {
        margin-top: 25px;
    }

    .contact-social span {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .contact-social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.7);
        color: #ffffff;
        margin: 0 4px;
        font-size: 14px;
    }

    .contact-social a:hover {
        background: rgba(255, 255, 255, 0.16);
    }

    /* Newsletter strip */
    .newsletter-strip {
        background: #059669;
        padding: 22px 0;
        color: #e5f9ff;
        text-align: center;
    }

    .newsletter-strip h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .newsletter-strip .form-inline {
        max-width: 520px;
        margin: 0 auto;
    }

    .newsletter-strip input[type="email"] {
        border-radius: 999px 0 0 999px;
        border: none;
        padding: 8px 14px;
        font-size: 14px;
        width: 70%;
        max-width: 320px;
    }

    .newsletter-strip button {
        border-radius: 0 999px 999px 0;
        border: none;
        padding: 8px 18px;
        background: #ffffff;
        color: #047857;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    /* Footer redesign */
    .footer {
        background: #020617;
        color: #9ca3af;
        padding: 40px 0 25px;
        font-family: 'Open Sans', sans-serif;
    }

    .footer h2 {
        color: #e5e7eb;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 14px;
    }

    .footer .link-list li a {
        font-size: 14px;
        color: #9ca3af;
    }

    .footer .link-list li a:hover {
        color: #e5e7eb;
    }

    .footer address {
        font-style: normal;
        font-size: 14px;
        line-height: 1.6;
    }

    .footer-bottom-copy {
        background: #020617;
        text-align: right;
        font-family: 'Times New Roman', Times, serif;
        padding: 8px 0 14px;
    }
</style>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">

<section id="contact_us" class="contact-us-single">
    <div class="container">
        <h2 class="contact-heading">Send us a message</h2>
        <p class="contact-subtitle">Have a question about appointments, doctors, or our hospital services? Send us a quick message and we will get back to you.</p>
        <div class="row justify-content-center">
            <div class="col-sm-12 cop-ck">
                <form method="post" id="contactForm">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="fullname" class="contact-label">Name</label>
                            <input type="text" id="fullname" name="fullname" placeholder="Enter Name" class="form-control input-sm" required>
                        </div>
                        <div class="col-md-6">
                            <label for="mobileno" class="contact-label">Mobile Number</label>
                            <input type="tel" id="mobileno" name="mobileno" placeholder="Enter Mobile Number" class="form-control input-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="emailid" class="contact-label">Email Address</label>
                            <input type="email" id="emailid" name="emailid" placeholder="Enter Email Address" class="form-control input-sm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description" class="contact-label">Message</label>
                            <textarea rows="4" id="description" placeholder="Enter Your Message" class="form-control input-sm" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="contact-submit-btn" type="submit" name="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="contact-social">
            <span>Follow our social media</span>
            <div>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</section>

<div class="newsletter-strip">
    <div class="container">
        <h3>Sign up to receive updates and health tips</h3>
        <form class="form-inline justify-content-center" onsubmit="return false;">
            <input type="email" placeholder="Enter your email" />
            <button type="submit">Sign Up</button>
        </form>
    </div>
</div>

    <!-- ################# Footer Starts Here#######################--->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <h2>Hospital Info</h2>
					<address class="md-margin-bottom-40">

					<?php
$ret=mysqli_query($con,"select * from tblpage where PageType='contactus' ");
while ($row=mysqli_fetch_array($ret)) {
?>
                        <?php  echo $row['PageDescription'];?> <br>
                        Phone: <?php  echo $row['MobileNumber'];?> <br>
                        Email: <a href="mailto:<?php  echo $row['Email'];?>" class=""><?php  echo $row['Email'];?></a><br>
                        Timing: <?php  echo $row['OpenningTime'];?>
                    </address>
		<?php } ?>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h2>Services</h2>
                    <ul class="list-unstyled link-list">
                        <li><a href="#services">Departments</a></li>
                        <li><a href="#about_us">About Hospital</a></li>
                        <li><a href="#gallery">Our Departments</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6">
                    <h2>Support</h2>
                    <ul class="list-unstyled link-list">
                        <li><a href="#contact_us">Contact support</a></li>
                        <li><a href="#contact_us">Feedback</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
   <div class="footer-bottom-copy">
    <div class="container">
       <b> Fududeeye | It's Me </b>            
    </div>
</div>
</body>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-nav/js/jquery.easing.min.js"></script>
<script src="assets/plugins/scroll-nav/js/scrolling-nav.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="assets/js/script.js"></script>
<script>
// Simple continuous horizontal scroll for departments strip
document.addEventListener('DOMContentLoaded', function () {
    var strip = document.getElementById('departmentsStrip');
    if (!strip) return;

    // Duplicate content for seamless loop
    strip.innerHTML = strip.innerHTML + strip.innerHTML;

    var offset = 0;
    var speed = 0.5; // pixels per frame

    function tick() {
        offset -= speed;
        var width = strip.scrollWidth / 2;
        if (Math.abs(offset) >= width) {
            offset = 0;
        }
        strip.style.transform = 'translateX(' + offset + 'px)';
        requestAnimationFrame(tick);
    }

    requestAnimationFrame(tick);
});
</script>
</html>