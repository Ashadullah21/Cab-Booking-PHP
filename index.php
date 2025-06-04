<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>

</style>
</head>
<?php require_once('inc/header.php') ?>
<body>
<?php $page = isset($_GET['p']) ? $_GET['p'] : 'home';  ?>
<?php require_once('inc/topBarNav.php') ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
<?php endif;?>
<?php 
    if(!file_exists($page.".php") && !is_dir($page)){
        include '404.html';
    }else{
      if(is_dir($page))
        include $page.'/index.php';
      else
        include $page.'.php';
    }
?>


  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog   rounded-0 modal-md modal-dialog-centered" role="document">
      <div class="modal-content  rounded-0">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id='submit' onclick="$('#uni_modal form').submit()">Book</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="c-btn">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog  rounded-0 modal-full-height  modal-md" role="document">
      <div class="modal-content rounded-0">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
<!-- new --->
<!--
<section id="services" class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Our Services</h2>
                <p>We offer a variety of cab services to meet your needs</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card animate__animated animate__fadeIn">
                        <div class="icon-box">
                            <i class="fas fa-car"></i>
                        </div>
                        <h4>Economy Ride</h4>
                        <p>Affordable rides for everyday travel needs. Perfect for solo travelers or small groups.</p>
                        <a href="login.php" class="btn btn-outline-primary" style="background-color: transparent; color: var(--primary-color); border-color: var(--primary-color);" onmouseover="this.style.backgroundColor='var(--primary-color)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--primary-color)';">Book Now</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                        <div class="icon-box">
                            <i class="fas fa-car-side"></i>
                        </div>
                        <h4>Premium Ride</h4>
                        <p>Comfortable, spacious vehicles for a more luxurious travel experience.</p>
                        <a href="login.php" class="btn btn-outline-primary" style="background-color: transparent; color: var(--primary-color); border-color: var(--primary-color);" onmouseover="this.style.backgroundColor='var(--primary-color)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--primary-color)';">Book Now</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card animate__animated animate__fadeIn" style="animation-delay: 0.4s;">
                        <div class="icon-box">
                            <i class="fas fa-shuttle-van"></i>
                        </div>
                        <h4>Group Ride</h4>
                        <p>Spacious vehicles for larger groups. Perfect for family outings or group travel.</p>
                        <a href="login.php" class="btn btn-outline-primary" style="background-color: transparent; color: var(--primary-color); border-color: var(--primary-color);" onmouseover="this.style.backgroundColor='var(--primary-color)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--primary-color)';">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section id="contact" class="py-5">
		<div class="contactfle">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Contact Us</h2>
                <p>We're here to help and answer any question you might have</p>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h5>Address</h5>
                                <p>22 Main Street, Tirunelveli, Tamil Nadu, India</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <h5>Phone</h5>
                                <p>+91 9025797924</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h5>Email</h5>
                                <p>kupido22cs@gmail.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h5>Working Hours</h5>
                                <p>24/7 Customer Support</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form-card">
                        <h4>Send us a message</h4>
                        <form id="contact-form" action="" method="post">
                            <div class="mb-3">
							<i class="fa fa-user" ></i>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
							<i class="fa fa-envelope" style="position:absolute;top:148px;left:500px;"></i>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" style="background-color:#6200ea; border:none;">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		</div>
    </section>
<section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="about-image animate__animated animate__fadeInLeft">
                        <img src="uploads/about-us-violet-updated.jpg" alt="About KupidoCabs" class="img-fluid rounded shadow" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-text animate__animated animate__fadeInRight">
                        <h2>About KupidoCabs</h2>
                        <p>KupidoCabs are premier cab service, providing safe, reliable, and comfortable transportation solutions. Our mission is to revolutionize the way people travel in the city.</p>
                        <p>With a fleet of well-maintained vehicles and professional drivers, we ensure that your journey is smooth and hassle-free. We prioritize your safety and comfort above everything else.</p>
                        <div class="features mt-4">
                            <div class="feature-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>Safe & Secure</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-clock"></i>
                                <span>24/7 Service</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-user-tie"></i>
                                <span>Professional Drivers</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-wallet"></i>
                                <span>Affordable Rates</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<footer class="footer py-5 violet-bg text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-info">
                        <h3><i class="fas fa-taxi me-2"></i>KupidoCabs</h3>
                        <p>Making your journey comfortable, safe, and affordable in Tirunelveli.</p>
                        <div class="social-links mt-3">
                            <a href="https://facebook.com" class="social-icon"><i class="fab fa-facebook-f" ></i></a>
                            <a href="https://x.com/SACTIRUNELVELI" class="social-icon"><i class="fab fa-twitter" ></i></a>
                            <a href="https://www.instagram.com/sadakathullahappacollege?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-icon"><i class="fab fa-instagram" ></i></a>
                            <a href="https://www.linkedin.com/school/sadakathullah-appa-college-rahmath-nagar-palayamkottai-627-011/" class="social-icon"><i class="fab fa-linkedin-in" ></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#" style="text-decoration:none;">Home</a></li>
                        <li><a href="#services" style="text-decoration:none;">Services</a></li>
                        <li><a href="#about" style="text-decoration:none;">About Us</a></li>
                        <li><a href="#contact" style="text-decoration:none;">Contact</a></li>
                    </ul>
                </div>-->
				<!--
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5>Services</h5>
                    <ul class="footer-links">
                        <li><a href="#" style="text-decoration:none;">City Rides</a></li>
                        <li><a href="#" style="text-decoration:none;">Airport Transfers</a></li>
                        <li><a href="#" style="text-decoration:none;">Outstation</a></li>
                        <li><a href="#" style="text-decoration:none;">Rental Packages</a></li>
                    </ul>
                </div>-->
				<!--
                <div class="col-lg-4">
                    <h5>Newsletter</h5>
                    <p>Subscribe to our newsletter for the latest updates and offers</p>
                    <form class="newsletter-form mt-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your Email" required>
                            <button class="btn btn-light" type="submit" >Subscribe</button>
                        </div>
                    </form>
                </div> -->
          <!-- </div>
            <hr class="mt-4 mb-4 bg-light opacity-25">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2025 KupidoCabs. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer> -->
    
<?php require_once('inc/footer.php') ?>
</body>
</html>