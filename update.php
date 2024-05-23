<?php
include('config.php');

$id=$_SESSION['id'];
$nom="";
$email="";
$objet="";
$msg="";


$search_Query ="SELECT * FROM contact where id LIKE '$id'";   
    
$search_Result=mysqli_query ($conn,$search_Query);

while($row = mysqli_fetch_array($search_Result))
   {
      $nom=$row ['nom'];
      $email=$row['email'];
      $objet=$row['objet'];
      $msg=$row['msg'];
   }

?>

<html>
<head>
    <meta charset="utf-8">
    <title>GYMSTER - Gym HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Header Start -->
    <div class="container-fluid bg-dark px-0">
        <div class="row gx-0">
            <div class="col-lg-3 bg-dark d-none d-lg-block">
                <a href="index.html" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-4 text-primary text-uppercase">California</h1>
                </a>
            </div>
            <div class="col-lg-9">
                <div class="row gx-0 bg-secondary d-none d-lg-flex">
                    <div class="col-lg-7 px-5 text-start">
                        <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                            <i class="fa fa-envelope text-primary me-2"></i>
                            <h6 class="mb-0">info@california-gym.com</h6>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center py-2">
                            <i class="fa fa-phone-alt text-primary me-2"></i>
                            <h6 class="mb-0">+216 25199133</h6>
                        </div>
                    </div>
                    <div class="col-lg-5 px-5 text-end">
                        <div class="d-inline-flex align-items-center py-2">
                            <a class="btn btn-light btn-square rounded-circle me-2" href="https://www.facebook.com/californiagymtunisia/">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="btn btn-light btn-square rounded-circle me-2" href="https://twitter.com/californiagymtn">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="btn btn-light btn-square rounded-circle me-2" href="https://www.linkedin.com/company/california-gym-tunisia/">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="btn btn-light btn-square rounded-circle me-2" href="https://www.instagram.com/california_gym/?hl=fr">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="btn btn-light btn-square rounded-circle" href="https://www.youtube.com/channel/UCrf6o71TVlO6D-Div1RLU3g">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0 px-lg-5">
                    <a href="index.html" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary text-uppercase">California</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="about.html" class="nav-item nav-link">About</a>
                            <a href="class.html" class="nav-item nav-link">Classes</a>
                            <a href="team.html" class="nav-item nav-link">Trainers</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="blog.html" class="dropdown-item">Blog Grid</a>
                                    <a href="detail.html" class="dropdown-item">Blog Detail</a>
                                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                </div>
                            </div>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <a href="login.php" class="btn btn-primary py-md-3 px-md-5 d-none d-lg-block">Join Us</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
<div class="center">
    <div class="row g-0">
            <div class="col-lg-6">
                <div class="bg-dark p-5">
                    <form method="POST" action="updatee.php">
                        <div class="row g-3">
                            <div class="col-6">
                                <input value="<?php echo $nom?>"type="text" class="form-control bg-light border-0 px-4" name="nom" placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-6">
                                <input value="<?php echo $email?>"type="email" class="form-control bg-light border-0 px-4" name="email" placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <input value="<?php echo $objet?>"type="text" class="form-control bg-light border-0 px-4" name="objet" placeholder="Subject" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea value="<?php echo $msg?>" class="form-control bg-light border-0 px-4 py-3" name="msg" rows="4" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="Modifier" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                        
                </div>
                
            </div>
            <div class="col-lg-6">
                <iframe class="w-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1617.1509512170826!2d10.625701581697879!3d35.841600064887515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x130275b8469424b5%3A0x685a7499cac68ad1!2sCalifornia%20Gym!5e0!3m2!1sfr!2stn!4v1672695143634!5m2!1sfr!2stn" width="600" height="440" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    frameborder="0" style="height: 457px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
</div>
<div class="container-fluid bg-dark text-secondary px-5 mt-5">
        <div class="row gx-5">
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-primary me-2"></i>
                            <p class="mb-0">Centre commercial Tej Marhaba Sousse</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-primary me-2"></i>
                            <p class="mb-0">info@california-gym.com</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-primary me-2"></i>
                            <p class="mb-0">+216 25199133</p>
                        </div>
                        <div class="d-flex mt-4">
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="https://twitter.com/californiagymtn"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="https://www.facebook.com/californiagymtunisia/"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle me-2" href="https://www.linkedin.com/company/california-gym-tunisia/"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square rounded-circle" href="https://www.instagram.com/california_gym/?hl=fr"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Quick Links</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index.html"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="about.html"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="class.html"><i class="bi bi-arrow-right text-primary me-2"></i>Class Schedule</a>
                            <a class="text-secondary mb-2" href="team.html"><i class="bi bi-arrow-right text-primary me-2"></i>Our Trainers</a>
                            <a class="text-secondary mb-2" href="blog.html"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-secondary" href="contact.php"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-uppercase text-light mb-4">Popular Links</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index.html"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="about.html"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="class.html"><i class="bi bi-arrow-right text-primary me-2"></i>Class Schedule</a>
                            <a class="text-secondary mb-2" href="team.html"><i class="bi bi-arrow-right text-primary me-2"></i>Our Trainers</a>
                            <a class="text-secondary mb-2" href="blog.html"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-secondary" href="contact.php"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-5">
                    <h4 class="text-uppercase text-white mb-4">Newsletter</h4>
                    <h6 class="text-uppercase text-white">Subscribe Our Newsletter</h6>
                    <p class="text-light">Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                    <form action="">
                        <div class="input-group">
                            <button class="btn btn-dark"><a href="login.php">Sign Up</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 py-lg-0 px-5" style="background: #111111;">
        <div class="row gx-5">
            <div class="col-lg-8">
                <div class="py-lg-4 text-center">
                    <p class="text-secondary mb-0">&copy; <a class="text-light fw-bold" href="index.html">California</a>. GYM.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="py-lg-4 text-center credit">
                    <p class="text-light mb-0">Designed by <a class="text-light fw-bold" >ZARROUK Slim</a></p>
                </div>
            </div>
        </div>
    </div>
        </body>
</html>

