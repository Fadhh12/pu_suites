<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>Contact & Booking - PU SUITES</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        .contact-header {
            height: 25vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('./image/hotel2.jpg') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding-top: 60px;
        }
        
        .contact-header h1 {
            font-size: 3.5rem;
            color: #fff;
            text-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        .contact-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        @media (max-width: 900px) {
            .contact-container { grid-template-columns: 1fr; }
        }

        .contact-info {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .contact-info h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .info-item i {
            color: var(--primary-color);
            font-size: 24px;
            margin-right: 15px;
            margin-top: 5px;
        }

        .info-item p {
            margin: 0;
            color: var(--text-muted);
            font-size: 15px;
        }

        .info-item strong {
            display: block;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .booking-form-container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .booking-form-container h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        .form-group { margin-bottom: 10px; }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 14px;
        }

        .form-control, .form-select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: var(--font-body);
            transition: 0.3s;
            font-size: 13px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.2);
        }

        .btn-submit {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 10px 30px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            width: 100%;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar-hotel scrolled" style="background: var(--dark-bg);">
    <div class="logo">
      <img class="bluebirdlogo" src="./image/President_University_Logo.png" alt="logo">
      <p>PU SUITES</p>
    </div>
    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
    </div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php#secondsection">Rooms & Suites</a></li>
      <li><a href="index.php#thirdsection">Facilities</a></li>
      <li><a href="contact.php" style="color: var(--primary-color);">Contact & Booking</a></li>
    </ul>
  </nav>

  <!-- Header -->
  <header class="contact-header">
      <h1 data-aos="fade-up">Contact & Reservation</h1>
  </header>

  <!-- Main Content -->
  <div class="contact-container">
      
      <!-- Contact Info -->
      <div class="contact-info" data-aos="fade-right">
          <h3>Get in Touch</h3>
          <p style="color: var(--text-muted); margin-bottom: 30px;">We're here to assist you with any inquiries or special requests to make your stay unforgettable.</p>
          
          <div class="info-item">
              <i class="fa-solid fa-location-dot"></i>
              <div>
                  <strong>Location</strong>
                  <p>President University<br>Cikarang, West Java, Indonesia</p>
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
      </div>

      <!-- Booking Form -->
      <div class="booking-form-container" data-aos="fade-left">
          <h3>Book Your Stay</h3>
          
          <form action="" method="POST">
              <h5 style="margin-bottom: 15px; color: #555;">Guest Information</h5>
              <div class="form-grid">
                  <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" name="Name" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Email Address</label>
                      <input type="email" name="Email" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Phone Number</label>
                      <input type="text" name="Phone" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Country</label>
                      <select name="Country" class="form-select" required>
                          <option value="" disabled selected>Select Country</option>
                          <?php
                          $countries = array("Indonesia", "Malaysia", "Singapore", "Australia", "United States", "United Kingdom", "Japan", "South Korea", "China", "India", "Germany", "France", "Others");
                          foreach($countries as $value):
                              echo '<option value="'.$value.'">'.$value.'</option>';
                          endforeach;
                          ?>
                      </select>
                  </div>
              </div>

              <hr style="margin: 15px 0; border-color: #eee;">

              <h5 style="margin-bottom: 15px; color: #555;">Reservation Details</h5>
              <div class="form-grid">
                  <div class="form-group">
                      <label>Room Type</label>
                      <select name="RoomType" class="form-select" required>
                          <option value="" disabled selected>Select Room</option>
                          <option value="Superior Room">SUPERIOR ROOM</option>
                          <option value="Deluxe Room">DELUXE ROOM</option>
                          <option value="Guest House">GUEST HOUSE</option>
                          <option value="Single Room">SINGLE ROOM</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Bedding Type</label>
                      <select name="Bed" class="form-select" required>
                          <option value="" disabled selected>Select Bedding</option>
                          <option value="Single">Single</option>
                          <option value="Double">Double</option>
                          <option value="Triple">Triple</option>
                          <option value="Quad">Quad</option>
                          <option value="None">None</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>No. of Rooms</label>
                      <select name="NoofRoom" class="form-select" required>
                          <option value="" disabled selected>Select Quantity</option>
                          <?php for($i=1; $i<=10; $i++) echo "<option value='$i'>$i</option>"; ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Meal Plan</label>
                      <select name="Meal" class="form-select" required>
                          <option value="" disabled selected>Select Meal</option>
                          <option value="Room only">Room only</option>
                          <option value="Breakfast">Breakfast</option>
                          <option value="Half Board">Half Board</option>
                          <option value="Full Board">Full Board</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Check-In Date</label>
                      <input name="cin" type="date" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Check-Out Date</label>
                      <input name="cout" type="date" class="form-control" required>
                  </div>
              </div>

              <button type="submit" name="guestdetailsubmit" class="btn-submit">Confirm Reservation</button>
          </form>

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

                $sta = "NotConfirm";
                $sql = "INSERT INTO roombook(Name,Email,Country,Phone,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays) VALUES ('$Name','$Email','$Country','$Phone','$RoomType','$Bed','$NoofRoom','$Meal','$cin','$cout','$sta',datediff('$cout','$cin'))";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            swal({ title: 'Reservation Successful', text: 'We will contact you shortly.', icon: 'success' }).then(function() {
                                window.location = 'index.php';
                            });
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
          ?>
      </div>
  </div>

  <!-- Footer -->
  <footer id="contactus" style="margin-top: 0;">
    <div class="footer-content">
        <div class="footer-logo">
            <h2>PU SUITES</h2>
            <p>Experience the peak of luxury and comfort.</p>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS Animation -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({ once: true, offset: 50 });

    function toggleMenu() {
        document.querySelector('.nav-links').classList.toggle('active');
    }
  </script>
</body>
</html>
