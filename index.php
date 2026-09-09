<?php
include 'config.php';
// No session authentication required for public visitors
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PU SUITES is a luxury hotel & resort offering elegant rooms, a full-service spa, swimming pool, and fine dining. Book your unforgettable stay today.">
    <meta name="theme-color" content="#111111">
    <!-- Open Graph -->
    <meta property="og:title" content="PU SUITES - Luxury Hotel & Resort">
    <meta property="og:description" content="Experience unrivaled luxury. Elegant rooms, world-class facilities, and unforgettable stays at PU SUITES.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="./image/hotel1.jpg">
    <link rel="icon" type="image/png" href="./image/President_University_Logo.png">
    <!-- Warm up the CDNs used below so their connections aren't started cold
         the moment the parser reaches each tag -- shaves the DNS/TLS
         handshake off the critical path for first paint. -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="image" href="./image/hotel1.jpg" fetchpriority="high">
    <link rel="stylesheet" href="./css/home.css?v=4">
    <title>PU SUITES - Luxury Hotel & Resort</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Sweet Alert -- deferred so it can't block HTML parsing/first paint;
         it's only ever invoked after DOMContentLoaded anyway. -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" defer></script>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar-hotel">
    <div class="logo">
      <img class="bluebirdlogo" src="./image/President_University_Logo.png" alt="logo">
      <p>PU SUITES</p>
    </div>
    <ul class="nav-links">
      <li><a href="#firstsection" onclick="toggleMenu()">Home</a></li>
      <li><a href="#aboutsection" onclick="toggleMenu()">About</a></li>
      <li><a href="#secondsection" onclick="toggleMenu()">Rooms & Suites</a></li>
      <li><a href="#thirdsection" onclick="toggleMenu()">Facilities</a></li>
      <li><a href="contact.php" onclick="toggleMenu()">Contact</a></li>
    </ul>
    <div class="nav-cta">
      <button class="btn-nav-book" onclick="openbookbox()">Book Now</button>
      <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle menu">
        <span class="hamburger-icon"></span>
      </button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel" data-bs-pause="false">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel1.jpg" alt="Hotel 1" fetchpriority="high" decoding="async">
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel2.jpg" alt="Hotel 2" loading="lazy" decoding="async">
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel3.jpg" alt="Hotel 3" loading="lazy" decoding="async">
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel4.jpg" alt="Hotel 4" loading="lazy" decoding="async">
        </div>

        <div class="hero-overlay"></div>
        <div class="welcomeline" data-aos="fade-up" data-aos-duration="1500">
          <h1 class="welcometag">Experience <br class="hero-break">Unrivaled Luxury</h1>
          <p class="subtitle">Stay. Relax. Repeat.</p>
          <button class="btn-explore" onclick="document.getElementById('secondsection').scrollIntoView({behavior: 'smooth'})">Explore Rooms</button>
        </div>
    </div>

    <!-- Booking Panel (Hidden by default) -->
    <div id="guestdetailpanel" class="glass-panel">
        <form action="" method="POST" class="guestdetailpanelform" data-aos="zoom-in" data-aos-duration="500">
            <div class="head">
                <h3>RESERVATION</h3>
                <i class="fa-solid fa-xmark close-btn" onclick="closebox()" role="button" aria-label="Close reservation form" tabindex="0"></i>
            </div>
            <div class="middle">
                <div class="guestinfo">
                    <h4>Guest Information</h4>
                    <input type="text" name="Name" placeholder="Full Name" required>
                    <input type="email" name="Email" placeholder="Email Address" required>

                    <?php
                    $countries = array("Indonesia", "Malaysia", "Singapore", "Australia", "United States", "United Kingdom", "Japan", "South Korea", "China", "India", "Germany", "France", "Others");
                    ?>
                    <select name="Country" class="selectinput" required>
						<option value="" disabled selected>Select your country</option>
                        <?php
							foreach($countries as $value):
							echo '<option value="'.$value.'">'.$value.'</option>';
							endforeach;
						?>
                    </select>
                    <input type="text" name="Phone" placeholder="Phone Number" required>
                </div>

                <div class="divider-line"></div>

                <div class="reservationinfo">
                    <h4>Reservation Details</h4>
                    <select name="RoomType" class="selectinput" required>
						<option value="" disabled selected>Type Of Room</option>
                        <?php foreach (ROOM_RATES as $roomTypeName => $rate): ?>
                            <option value="<?php echo htmlspecialchars($roomTypeName); ?>"><?php echo strtoupper(htmlspecialchars($roomTypeName)); ?> &mdash; $<?php echo number_format($rate); ?>/night</option>
                        <?php endforeach; ?>
                    </select>
                    <select name="Bed" class="selectinput" required>
						<option value="" disabled selected>Bedding Type</option>
                        <option value="Single">Single</option>
                        <option value="Double">Double</option>
						<option value="Triple">Triple</option>
                        <option value="Quad">Quad</option>
						<option value="None">None</option>
                    </select>
                    <select name="NoofRoom" class="selectinput" required>
						<option value="" disabled selected>No of Rooms</option>
                        <?php for($i=1; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                    <select name="Meal" class="selectinput" required>
						<option value="" disabled selected>Meal Plan</option>
                        <option value="Room only">Room only</option>
                        <option value="Breakfast">Breakfast</option>
						<option value="Half Board">Half Board</option>
						<option value="Full Board">Full Board</option>
					</select>
                    <div class="datesection">
                        <div class="date-input">
                            <label for="cin">Check-In</label>
                            <input name="cin" type="date" required>
                        </div>
                        <div class="date-input">
                            <label for="cout">Check-Out</label>
                            <input name="cout" type="date" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <button class="btn-submit-booking" name="guestdetailsubmit">Confirm Booking</button>
            </div>
        </form>

        <!-- Room Book PHP Logic -->
        <?php       
            if (isset($_POST['guestdetailsubmit'])) {
                $Name = $_POST['Name'];
                $Email = $_POST['Email'];
                $Country = $_POST['Country'];
                $Phone = $_POST['Phone'];
                $RoomType = $_POST['RoomType'];
                $Bed = $_POST['Bed'];
                $NoofRoom = $_POST['NoofRoom'];
                $Meal = $_POST['Meal'];
                $cin = $_POST['cin'];
                $cout = $_POST['cout'];

                if($Name == "" || $Email == "" || $Country == ""){
                    echo "<script>swal({ title: 'Please fill all details', icon: 'warning', });</script>";
                } else {
                    $sta = "NotConfirm";
                    $sql = "INSERT INTO roombook(Name,Email,Country,Phone,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays) VALUES (?,?,?,?,?,?,?,?,?,?,?,datediff(?,?))";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sssssssssssss", $Name, $Email, $Country, $Phone, $RoomType, $Bed, $NoofRoom, $Meal, $cin, $cout, $sta, $cout, $cin);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                swal({ title: 'Reservation Successful', text: 'We will contact you shortly.', icon: 'success' });
                            });
                        </script>";
                    } else {
                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                swal({ title: 'Something went wrong', icon: 'error' });
                            });
                        </script>";
                    }
                }
            }
        ?>
    </div>
  </section>
    
  <!-- About Section -->
  <section id="aboutsection">
    <div class="section-container">
      <div class="about-grid">
        <div class="about-images" data-aos="fade-right">
          <img class="about-img img-main" src="./image/hotel4.jpg" alt="PU Suites grand lobby" loading="lazy" decoding="async">
          <img class="about-img img-accent" src="./image/hotel2.jpg" alt="PU Suites guest room" loading="lazy" decoding="async">
        </div>
        <div class="about-text" data-aos="fade-left">
          <h2 class="head-title">A Legacy of Hospitality</h2>
          <p>
            Nestled in the heart of Cikarang, PU SUITES blends timeless elegance with modern comfort.
            Every detail, from our hand-picked furnishings to our attentive staff, is crafted to make
            your stay feel effortless. Whether you're here for business or leisure, we promise an
            experience that lingers long after check-out.
          </p>
          <div class="about-stats">
            <div>
              <span class="stat-num">15+</span>
              <span class="stat-label">Years of Service</span>
            </div>
            <div>
              <span class="stat-num">40+</span>
              <span class="stat-label">Rooms & Suites</span>
            </div>
            <div>
              <span class="stat-num">4.8/5</span>
              <span class="stat-label">Guest Rating</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Rooms Section -->
  <section id="secondsection">
    <div class="section-container">
      <div class="section-header" data-aos="fade-up">
        <h2 class="head-title">Our Rooms & Suites</h2>
        <p class="head-subtitle">Discover the perfect space for your stay</p>
      </div>
      
      <div class="room-grid">
        <!-- Room 1 -->
        <div class="room-card" data-aos="fade-up" data-aos-delay="100">
          <a href="room-detail.php?type=superior" class="room-image h1" aria-label="View Superior Room details and photos"></a>
          <div class="room-content">
            <a href="room-detail.php?type=superior" class="room-title-link"><h3>Superior Room</h3></a>
            <p class="room-price">From $<?php echo number_format(ROOM_RATES['Superior Room']); ?> <span>/ night</span></p>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
              <i class="fa-solid fa-spa" title="Spa Access"></i>
              <i class="fa-solid fa-dumbbell" title="Gym"></i>
              <i class="fa-solid fa-person-swimming" title="Pool"></i>
            </div>
            <div class="room-actions">
              <a href="room-detail.php?type=superior" class="btn-view-room">View Details</a>
              <button class="btn-book-now" onclick="openbookbox('Superior Room')">Book Now</button>
            </div>
          </div>
        </div>

        <!-- Room 2 -->
        <div class="room-card" data-aos="fade-up" data-aos-delay="200">
          <a href="room-detail.php?type=deluxe" class="room-image h2" aria-label="View Deluxe Room details and photos"></a>
          <div class="room-content">
            <a href="room-detail.php?type=deluxe" class="room-title-link"><h3>Deluxe Room</h3></a>
            <p class="room-price">From $<?php echo number_format(ROOM_RATES['Deluxe Room']); ?> <span>/ night</span></p>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
              <i class="fa-solid fa-spa" title="Spa Access"></i>
              <i class="fa-solid fa-dumbbell" title="Gym"></i>
            </div>
            <div class="room-actions">
              <a href="room-detail.php?type=deluxe" class="btn-view-room">View Details</a>
              <button class="btn-book-now" onclick="openbookbox('Deluxe Room')">Book Now</button>
            </div>
          </div>
        </div>

        <!-- Room 3 -->
        <div class="room-card" data-aos="fade-up" data-aos-delay="300">
          <a href="room-detail.php?type=guesthouse" class="room-image h3" aria-label="View Guest House details and photos"></a>
          <div class="room-content">
            <a href="room-detail.php?type=guesthouse" class="room-title-link"><h3>Guest House</h3></a>
            <p class="room-price">From $<?php echo number_format(ROOM_RATES['Guest House']); ?> <span>/ night</span></p>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
              <i class="fa-solid fa-spa" title="Spa Access"></i>
            </div>
            <div class="room-actions">
              <a href="room-detail.php?type=guesthouse" class="btn-view-room">View Details</a>
              <button class="btn-book-now" onclick="openbookbox('Guest House')">Book Now</button>
            </div>
          </div>
        </div>

        <!-- Room 4 -->
        <div class="room-card" data-aos="fade-up" data-aos-delay="400">
          <a href="room-detail.php?type=single" class="room-image h4" aria-label="View Single Room details and photos"></a>
          <div class="room-content">
            <a href="room-detail.php?type=single" class="room-title-link"><h3>Single Room</h3></a>
            <p class="room-price">From $<?php echo number_format(ROOM_RATES['Single Room']); ?> <span>/ night</span></p>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
            </div>
            <div class="room-actions">
              <a href="room-detail.php?type=single" class="btn-view-room">View Details</a>
              <button class="btn-book-now" onclick="openbookbox('Single Room')">Book Now</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Facilities Section -->
  <section id="thirdsection">
    <div class="section-container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="head-title">World-Class Facilities</h2>
            <p class="head-subtitle">Everything you need for an unforgettable experience</p>
        </div>
        <div class="facility-grid">
            <div class="facility-box f-pool" data-aos="zoom-in" data-aos-delay="100">
                <div class="facility-overlay">
                    <h3>Swimming Pool</h3>
                </div>
            </div>
            <div class="facility-box f-spa" data-aos="zoom-in" data-aos-delay="200">
                <div class="facility-overlay">
                    <h3>Luxury Spa</h3>
                </div>
            </div>
            <div class="facility-box f-food" data-aos="zoom-in" data-aos-delay="300">
                <div class="facility-overlay">
                    <h3>24/7 Restaurant</h3>
                </div>
            </div>
            <div class="facility-box f-gym" data-aos="zoom-in" data-aos-delay="400">
                <div class="facility-overlay">
                    <h3>Fitness Center</h3>
                </div>
            </div>
        </div>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section id="whychooseus">
    <div class="section-container">
      <div class="section-header" data-aos="fade-up">
        <h2 class="head-title">Why Stay With Us</h2>
        <p class="head-subtitle">The little things that make a big difference</p>
      </div>
      <div class="feature-grid">
        <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
          <i class="fa-solid fa-location-dot"></i>
          <h3>Prime Location</h3>
          <p>Steps away from President University, Cikarang's business and education hub.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="150">
          <i class="fa-solid fa-headset"></i>
          <h3>24/7 Front Desk</h3>
          <p>Our team is on hand around the clock for anything you need, day or night.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
          <i class="fa-solid fa-van-shuttle"></i>
          <h3>Shuttle on Request</h3>
          <p>Arrange campus or airport transfers in advance through our front desk.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="250">
          <i class="fa-solid fa-calendar-check"></i>
          <h3>Flexible Booking</h3>
          <p>Plans change — reach out and we'll do our best to accommodate you.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
          <i class="fa-solid fa-wifi"></i>
          <h3>Free High-Speed Wifi</h3>
          <p>Stay connected throughout your stay, in every room and common area.</p>
        </div>
        <div class="feature-card" data-aos="fade-up" data-aos-delay="350">
          <i class="fa-solid fa-shield-heart"></i>
          <h3>Safe & Spotless</h3>
          <p>Rigorous housekeeping standards so every room feels brand new.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonialsection">
    <div class="section-container">
      <div class="section-header" data-aos="fade-up">
        <h2 class="head-title">What Our Guests Say</h2>
        <p class="head-subtitle">Real stories from real stays</p>
      </div>
      <div class="testimonial-grid">
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p>"Absolutely stunning property. The staff went above and beyond and the room was spotless. We'll definitely be back."</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">A</div>
            <div>
              <strong>Andini R.</strong>
              <span>Jakarta, Indonesia</span>
            </div>
          </div>
        </div>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          </div>
          <p>"Booking was smooth and the facilities exceeded expectations. The pool and spa were a perfect way to unwind."</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">M</div>
            <div>
              <strong>Marcus T.</strong>
              <span>Singapore</span>
            </div>
          </div>
        </div>
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-stars">
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
          </div>
          <p>"Great value for a luxury stay. The Deluxe Room was spacious and the breakfast spread was fantastic."</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">S</div>
            <div>
              <strong>Sarah K.</strong>
              <span>Melbourne, Australia</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section id="faqsection">
    <div class="section-container">
      <div class="section-header" data-aos="fade-up">
        <h2 class="head-title">Frequently Asked Questions</h2>
        <p class="head-subtitle">Everything you might want to know before you book</p>
      </div>
      <div class="faq-list" data-aos="fade-up" data-aos-delay="100">
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            What time is check-in and check-out?
            <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Check-in starts at 2:00 PM and check-out is by 12:00 PM (noon). Early check-in and late check-out can be arranged on request, subject to availability.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            What is your cancellation policy?
            <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Free cancellation up to 24 hours before your check-in date. Cancellations after that may be subject to a one-night charge.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            Is breakfast included in the room rate?
            <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>It depends on the meal plan you pick when booking — Room Only, Breakfast, Half Board, or Full Board — so you only pay for what you'll actually use.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            Do you offer airport or campus transfer?
            <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Yes, our front desk can arrange a shuttle for you — just let us know your schedule a day in advance via the contact form or on arrival.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            What payment methods do you accept?
            <i class="fa-solid fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Cash, bank transfer, and major debit/credit cards are accepted at check-in or check-out. Your reservation is confirmed by our staff before payment is due.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Location Section -->
  <section id="locationsection">
    <div class="section-container">
      <div class="section-header" data-aos="fade-up">
        <h2 class="head-title">Find Us</h2>
        <p class="head-subtitle">Right in the heart of Cikarang</p>
      </div>
      <div class="location-grid" data-aos="fade-up" data-aos-delay="100">
        <div class="location-map">
          <iframe
            src="https://www.google.com/maps?q=President%20University%2C%20Cikarang&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="PU SUITES location map">
          </iframe>
        </div>
        <div class="location-info">
          <div class="info-item">
            <i class="fa-solid fa-location-dot"></i>
            <div>
              <strong>Address</strong>
              <p>President University, Cikarang<br>West Java, Indonesia</p>
            </div>
          </div>
          <div class="info-item">
            <i class="fa-solid fa-phone"></i>
            <div>
              <strong>Phone</strong>
              <p>+62 812 3456 7890</p>
            </div>
          </div>
          <div class="info-item">
            <i class="fa-solid fa-envelope"></i>
            <div>
              <strong>Email</strong>
              <p>reservations@pusuites.com</p>
            </div>
          </div>
          <a href="contact.php" class="btn-explore" style="align-self: flex-start; color: var(--dark-bg); border-color: var(--dark-bg); text-decoration: none;">Get Directions & Book</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer id="contactus">
    <div class="footer-content">
        <div class="footer-logo">
            <h2>PU SUITES</h2>
            <p>Experience the peak of luxury and comfort.</p>
        </div>
        <div class="footer-booking">
            <h4 style="color: #c5a880; font-family: 'Playfair Display', serif; margin-bottom: 15px;">Ready for your stay?</h4>
            <a href="contact.php"><button class="btn-explore" style="padding: 10px 25px; font-size: 12px; border-color: #c5a880; color: #fff;">Make a Reservation</button></a>
        </div>
        <div class="social-icons">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-solid fa-envelope"></i></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 PU SUITES. All Rights Reserved. | Created by Nabil & Sam</p>
        <p><a href="login.php" style="color: #666; text-decoration: none; font-size: 12px;">Admin Login</a></p>
    </div>
  </footer>

  <!-- Floating Actions -->
  <div class="float-actions">
    <a class="float-btn whatsapp" href="https://wa.me/6281234567890" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
      <i class="fa-brands fa-whatsapp"></i>
    </a>
    <button class="float-btn totop" id="backToTop" aria-label="Back to top">
      <i class="fa-solid fa-arrow-up"></i>
    </button>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- AOS Animation -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
        once: true,
        offset: 100
    });

    const bookbox = document.getElementById("guestdetailpanel");
    const roomSelect = document.querySelector('select[name="RoomType"]');

    function openbookbox(roomName = "") {
        bookbox.style.display = "flex";
        bookbox.style.opacity = "0";
        setTimeout(() => {
            bookbox.style.opacity = "1";
        }, 50);

        if(roomName && roomSelect) {
            for(let i = 0; i < roomSelect.options.length; i++) {
                if(roomSelect.options[i].value === roomName) {
                    roomSelect.selectedIndex = i;
                    break;
                }
            }
        }
    }

    // Was missing entirely -- the close (X) button called this but it was
    // never defined, so clicking it silently did nothing.
    function closebox() {
        bookbox.style.opacity = "0";
        setTimeout(() => {
            bookbox.style.display = "none";
        }, 300);
    }

    // Also close on backdrop click or Escape, which users expect from any modal.
    bookbox.addEventListener('click', function(e) {
        if (e.target === bookbox) closebox();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape" && bookbox.style.display === "flex") closebox();
    });

    // Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-hotel');
        if(window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile Menu Toggle
    function toggleMenu() {
        document.querySelector('.nav-links').classList.toggle('active');
        document.querySelector('.menu-toggle').classList.toggle('active');
    }

    // FAQ Accordion
    function toggleFaq(btn) {
        const item = btn.closest('.faq-item');
        const wasOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
        if (!wasOpen) item.classList.add('open');
    }

    // Back to Top Button
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });
    backToTop.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  </script>
</body>
</html>
