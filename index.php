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
    <link rel="stylesheet" href="./css/home.css">
    <title>PU SUITES - Luxury Hotel & Resort</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar-hotel">
    <div class="logo">
      <img class="bluebirdlogo" src="./image/President_University_Logo.png" alt="logo">
      <p>PU SUITES</p>
    </div>
    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
    </div>
    <ul class="nav-links">
      <li><a href="#firstsection" onclick="toggleMenu()">Home</a></li>
      <li><a href="#secondsection" onclick="toggleMenu()">Rooms & Suites</a></li>
      <li><a href="#thirdsection" onclick="toggleMenu()">Facilities</a></li>
      <li><a href="contact.php">Contact & Booking</a></li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel" data-bs-pause="false">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel1.jpg" alt="Hotel 1">
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel2.jpg" alt="Hotel 2">
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel3.jpg" alt="Hotel 3">
        </div>
        <div class="carousel-item" data-bs-interval="4000">
            <img class="carousel-image" src="./image/hotel4.jpg" alt="Hotel 4">
        </div>

        <div class="hero-overlay"></div>
        <div class="welcomeline" data-aos="fade-up" data-aos-duration="1500">
          <h1 class="welcometag">Experience<br>Unrivaled Luxury</h1>
          <p class="subtitle">Stay. Relax. Repeat.</p>
          <button class="btn-explore" onclick="document.getElementById('secondsection').scrollIntoView({behavior: 'smooth'})">Explore Rooms</button>
        </div>
    </div>

    <!-- Booking Panel (Hidden by default) -->
    <div id="guestdetailpanel" class="glass-panel">
        <form action="" method="POST" class="guestdetailpanelform" data-aos="zoom-in" data-aos-duration="500">
            <div class="head">
                <h3>RESERVATION</h3>
                <i class="fa-solid fa-xmark close-btn" onclick="closebox()"></i>
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
                        <option value="Superior Room">SUPERIOR ROOM</option>
                        <option value="Deluxe Room">DELUXE ROOM</option>
						<option value="Guest House">GUEST HOUSE</option>
						<option value="Single Room">SINGLE ROOM</option>
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
          <div class="room-image h1"></div>
          <div class="room-content">
            <h3>Superior Room</h3>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
              <i class="fa-solid fa-spa" title="Spa Access"></i>
              <i class="fa-solid fa-dumbbell" title="Gym"></i>
              <i class="fa-solid fa-person-swimming" title="Pool"></i>
            </div>
            <button class="btn-book-now" onclick="openbookbox('Superior Room')">Book Now</button>
          </div>
        </div>
        
        <!-- Room 2 -->
        <div class="room-card" data-aos="fade-up" data-aos-delay="200">
          <div class="room-image h2"></div>
          <div class="room-content">
            <h3>Deluxe Room</h3>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
              <i class="fa-solid fa-spa" title="Spa Access"></i>
              <i class="fa-solid fa-dumbbell" title="Gym"></i>
            </div>
            <button class="btn-book-now" onclick="openbookbox('Deluxe Room')">Book Now</button>
          </div>
        </div>
        
        <!-- Room 3 -->
        <div class="room-card" data-aos="fade-up" data-aos-delay="300">
          <div class="room-image h3"></div>
          <div class="room-content">
            <h3>Guest House</h3>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
              <i class="fa-solid fa-spa" title="Spa Access"></i>
            </div>
            <button class="btn-book-now" onclick="openbookbox('Guest House')">Book Now</button>
          </div>
        </div>
        
        <!-- Room 4 -->
        <div class="room-card" data-aos="fade-up" data-aos-delay="400">
          <div class="room-image h4"></div>
          <div class="room-content">
            <h3>Single Room</h3>
            <div class="room-amenities">
              <i class="fa-solid fa-wifi" title="Free Wifi"></i>
              <i class="fa-solid fa-burger" title="Room Service"></i>
            </div>
            <button class="btn-book-now" onclick="openbookbox('Single Room')">Book Now</button>
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
    AOS.init({ once: true, offset: 50 });

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
    }
  </script>
</body>
</html>
