<?php
include 'config.php';

// Static room catalog. There's no admin-editable "room description" table in
// the DB (admin/room.php only tracks type+bedding for booking dropdowns), so
// the rich copy/gallery below is maintained here. Add a new array entry to
// add a new room type.
$rooms = [
    'superior' => [
        'name' => 'Superior Room',
        'tagline' => 'Where classic comfort meets modern ease',
        'description' => "A bright, well-appointed room built for guests who want a dependable, comfortable stay without compromise. Soft linens, a quiet layout, and quick access to the pool and spa make the Superior Room a favorite for both short business trips and relaxed getaways.",
        'size' => '32 m²',
        'bed' => 'King or Twin',
        'guests' => 'Up to 2 Guests',
        'hero' => './image/hotel1.jpg',
        'gallery' => [
            ['src' => './image/hotel1.jpg', 'caption' => 'Room View'],
            ['src' => './image/hotel1photo.webp', 'caption' => 'Lounge Area'],
            ['src' => './image/swimingpool.jpg', 'caption' => 'Pool Access'],
            ['src' => './image/spa.jpg', 'caption' => 'Spa Access'],
        ],
        'amenities' => [
            ['icon' => 'fa-wifi', 'label' => 'Free High-Speed Wifi'],
            ['icon' => 'fa-burger', 'label' => '24/7 Room Service'],
            ['icon' => 'fa-spa', 'label' => 'Spa Access'],
            ['icon' => 'fa-dumbbell', 'label' => 'Gym Access'],
            ['icon' => 'fa-person-swimming', 'label' => 'Pool Access'],
            ['icon' => 'fa-tv', 'label' => 'Smart TV'],
            ['icon' => 'fa-snowflake', 'label' => 'Air Conditioning'],
            ['icon' => 'fa-broom', 'label' => 'Daily Housekeeping'],
        ],
    ],
    'deluxe' => [
        'name' => 'Deluxe Room',
        'tagline' => 'Extra space, elevated details',
        'description' => "A step up in size and finish, the Deluxe Room adds room to breathe -- a dedicated seating nook, richer furnishings, and a calmer palette. Ideal if you're staying a few nights and want a little more room to work, unwind, or spread out.",
        'size' => '38 m²',
        'bed' => 'King',
        'guests' => 'Up to 3 Guests',
        'hero' => './image/hotel2.jpg',
        'gallery' => [
            ['src' => './image/hotel2.jpg', 'caption' => 'Room View'],
            ['src' => './image/hotel2photo.jpg', 'caption' => 'Interior Detail'],
            ['src' => './image/spa.jpg', 'caption' => 'Spa Access'],
            ['src' => './image/gym.jpg', 'caption' => 'Gym Access'],
        ],
        'amenities' => [
            ['icon' => 'fa-wifi', 'label' => 'Free High-Speed Wifi'],
            ['icon' => 'fa-burger', 'label' => '24/7 Room Service'],
            ['icon' => 'fa-spa', 'label' => 'Spa Access'],
            ['icon' => 'fa-dumbbell', 'label' => 'Gym Access'],
            ['icon' => 'fa-tv', 'label' => 'Smart TV'],
            ['icon' => 'fa-martini-glass', 'label' => 'Mini Bar'],
            ['icon' => 'fa-snowflake', 'label' => 'Air Conditioning'],
            ['icon' => 'fa-broom', 'label' => 'Daily Housekeeping'],
        ],
    ],
    'guesthouse' => [
        'name' => 'Guest House',
        'tagline' => 'A private home away from home',
        'description' => "Our largest and most private option -- a standalone-feeling space with its own living area, perfect for families, small groups, or longer stays. Everything you'd want from an apartment, with hotel-level service on call.",
        'size' => '55 m²',
        'bed' => 'Multiple Configurations',
        'guests' => 'Up to 6 Guests',
        'hero' => './image/hotel3.jpg',
        'gallery' => [
            ['src' => './image/hotel3.jpg', 'caption' => 'Exterior View'],
            ['src' => './image/hotel3photo.jpg', 'caption' => 'Living Area'],
            ['src' => './image/spa.jpg', 'caption' => 'Spa Access'],
            ['src' => './image/food.jpg', 'caption' => 'In-House Dining'],
        ],
        'amenities' => [
            ['icon' => 'fa-wifi', 'label' => 'Free High-Speed Wifi'],
            ['icon' => 'fa-burger', 'label' => '24/7 Room Service'],
            ['icon' => 'fa-spa', 'label' => 'Spa Access'],
            ['icon' => 'fa-couch', 'label' => 'Private Living Area'],
            ['icon' => 'fa-kitchen-set', 'label' => 'Kitchenette'],
            ['icon' => 'fa-snowflake', 'label' => 'Air Conditioning'],
            ['icon' => 'fa-broom', 'label' => 'Daily Housekeeping'],
        ],
    ],
    'single' => [
        'name' => 'Single Room',
        'tagline' => 'Smart, simple, and comfortable',
        'description' => "A compact, efficient room designed for the solo traveler who just needs a great night's sleep and the essentials done right. Everything you need, nothing you don't -- at a price that makes sense.",
        'size' => '22 m²',
        'bed' => 'Single',
        'guests' => '1 Guest',
        'hero' => './image/hotel4.jpg',
        'gallery' => [
            ['src' => './image/hotel4.jpg', 'caption' => 'Room View'],
            ['src' => './image/hotel4photo.jpg', 'caption' => 'Interior Detail'],
            ['src' => './image/food.jpg', 'caption' => 'In-House Dining'],
        ],
        'amenities' => [
            ['icon' => 'fa-wifi', 'label' => 'Free High-Speed Wifi'],
            ['icon' => 'fa-burger', 'label' => 'Room Service'],
            ['icon' => 'fa-tv', 'label' => 'Smart TV'],
            ['icon' => 'fa-snowflake', 'label' => 'Air Conditioning'],
            ['icon' => 'fa-broom', 'label' => 'Daily Housekeeping'],
        ],
    ],
];

$type = $_GET['type'] ?? '';
if (!isset($rooms[$type])) {
    $type = 'superior';
}
$room = $rooms[$type];
// ROOM_RATES (config.php) keys by the RoomType string stored in the DB --
// the same string used for booking/payment -- so it's the source of truth
// for the price shown here too.
$room['price'] = ROOM_RATES[$room['name']] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($room['name']); ?> at PU SUITES - <?php echo htmlspecialchars($room['tagline']); ?>. View photos, amenities, and book your stay.">
    <meta name="theme-color" content="#111111">
    <link rel="icon" type="image/png" href="./image/President_University_Logo.png">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="./css/home.css?v=4">
    <title><?php echo htmlspecialchars($room['name']); ?> - PU SUITES</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        .room-hero {
            /* padding, not margin -- a top margin here collapses with
               body's own margin (nothing else is above it in flow, since
               the navbar is position:fixed) and throws off layout. */
            padding-top: 80px;
        }
        .room-hero-main {
            width: 100%;
            height: 55vh;
            min-height: 320px;
            object-fit: cover;
            display: block;
            cursor: zoom-in;
        }
        .room-thumbs {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            gap: 12px;
            overflow-x: auto;
        }
        .room-thumbs img {
            width: 110px;
            height: 75px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            flex-shrink: 0;
            opacity: 0.65;
            border: 2px solid transparent;
            transition: var(--transition-smooth);
        }
        .room-thumbs img:hover {
            opacity: 1;
        }
        .room-thumbs img.active {
            opacity: 1;
            border-color: var(--primary-color);
        }
        .room-detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            align-items: start;
        }
        .room-detail-main .breadcrumb-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 15px;
            transition: var(--transition-smooth);
        }
        .room-detail-main .breadcrumb-link:hover {
            color: var(--primary-color);
        }
        .room-detail-main .tagline {
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        .room-detail-main h1 {
            font-size: 2.2rem;
            color: var(--dark-bg);
            margin-bottom: 20px;
        }
        .detail-price {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark-bg);
            margin-bottom: 15px;
        }
        .detail-price span {
            font-size: 0.95rem;
            font-weight: 400;
            color: var(--text-muted);
        }
        .room-specs {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eee;
        }
        .room-specs .spec {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-dark);
            font-size: 0.9rem;
        }
        .room-specs .spec i {
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        .room-detail-main .description {
            color: var(--text-muted);
            line-height: 1.9;
            margin-bottom: 30px;
        }
        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 15px;
        }
        .amenities-grid .amenity {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--light-bg);
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.9rem;
            color: var(--text-dark);
        }
        .amenities-grid .amenity i {
            color: var(--primary-color);
            width: 20px;
            text-align: center;
        }
        .room-booking-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-soft);
            position: sticky;
            top: 100px;
            text-align: center;
        }
        .room-booking-card h3 {
            color: var(--dark-bg);
            margin-bottom: 10px;
        }
        .booking-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        .booking-price span {
            font-size: 0.85rem;
            font-weight: 400;
            color: var(--text-muted);
        }
        .room-booking-card p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 20px;
            line-height: 1.7;
        }
        .room-booking-card .btn-submit-booking {
            width: 100%;
            margin-bottom: 12px;
        }
        .room-booking-card .btn-view-room {
            width: 100%;
            justify-content: center;
        }
        .other-rooms {
            background-color: var(--light-bg);
        }

        /* Lightbox */
        .lightbox {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.9);
            z-index: 3000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .lightbox.open {
            display: flex;
        }
        .lightbox img {
            max-width: 100%;
            max-height: 85vh;
            border-radius: 8px;
        }
        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 25px;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
        }
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 32px;
            cursor: pointer;
            padding: 10px 18px;
            user-select: none;
        }
        .lightbox-prev { left: 10px; }
        .lightbox-next { right: 10px; }

        @media (max-width: 991px) {
            .room-detail-grid {
                grid-template-columns: 1fr;
            }
            .room-booking-card {
                position: static;
            }
        }
        @media (max-width: 480px) {
            .room-hero-main {
                height: 40vh;
                min-height: 220px;
            }
            .room-detail-main h1 {
                font-size: 1.6rem;
            }
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
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php#aboutsection">About</a></li>
      <li><a href="index.php#secondsection">Rooms & Suites</a></li>
      <li><a href="index.php#thirdsection">Facilities</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
    <div class="nav-cta">
      <a href="contact.php?room=<?php echo urlencode($room['name']); ?>#book" class="btn-nav-book">Book Now</a>
      <button class="menu-toggle" onclick="toggleMenu()" aria-label="Toggle menu">
        <span class="hamburger-icon"></span>
      </button>
    </div>
  </nav>

  <!-- Hero Gallery -->
  <section class="room-hero">
    <img id="mainImage" class="room-hero-main" src="<?php echo htmlspecialchars($room['gallery'][0]['src']); ?>" alt="<?php echo htmlspecialchars($room['name']); ?>">
    <div class="room-thumbs">
      <?php foreach ($room['gallery'] as $i => $photo): ?>
        <img src="<?php echo htmlspecialchars($photo['src']); ?>" alt="<?php echo htmlspecialchars($photo['caption']); ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" onclick="setMainImage(<?php echo $i; ?>, this)">
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Room Details -->
  <section>
    <div class="section-container">
      <div class="room-detail-grid">
        <div class="room-detail-main" data-aos="fade-up">
          <a href="index.php#secondsection" class="breadcrumb-link"><i class="fa-solid fa-arrow-left"></i> Back to Rooms & Suites</a>
          <p class="tagline"><?php echo htmlspecialchars($room['tagline']); ?></p>
          <h1><?php echo htmlspecialchars($room['name']); ?></h1>

          <?php if ($room['price'] !== null): ?>
            <p class="detail-price">$<?php echo number_format($room['price']); ?> <span>/ night</span></p>
          <?php endif; ?>

          <div class="room-specs">
            <div class="spec"><i class="fa-solid fa-ruler-combined"></i> <?php echo htmlspecialchars($room['size']); ?></div>
            <div class="spec"><i class="fa-solid fa-bed"></i> <?php echo htmlspecialchars($room['bed']); ?></div>
            <div class="spec"><i class="fa-solid fa-user-group"></i> <?php echo htmlspecialchars($room['guests']); ?></div>
          </div>

          <p class="description"><?php echo htmlspecialchars($room['description']); ?></p>

          <h4 style="margin-bottom: 15px; color: var(--dark-bg);">What's Included</h4>
          <div class="amenities-grid">
            <?php foreach ($room['amenities'] as $amenity): ?>
              <div class="amenity"><i class="fa-solid <?php echo htmlspecialchars($amenity['icon']); ?>"></i> <?php echo htmlspecialchars($amenity['label']); ?></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="100">
          <div class="room-booking-card">
            <h3><?php echo htmlspecialchars($room['name']); ?></h3>
            <?php if ($room['price'] !== null): ?>
              <p class="booking-price">$<?php echo number_format($room['price']); ?> <span>/ night</span></p>
            <?php endif; ?>
            <p>Ready to stay? Fill out our reservation form and our team will confirm availability with you shortly.</p>
            <a href="contact.php?room=<?php echo urlencode($room['name']); ?>#book" class="btn-submit-booking" style="display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">Book This Room</a>
            <a href="index.php#secondsection" class="btn-view-room">See All Rooms</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Other Rooms -->
  <section class="other-rooms">
    <div class="section-container">
      <div class="section-header" data-aos="fade-up">
        <h2 class="head-title">You Might Also Like</h2>
      </div>
      <div class="room-grid">
        <?php foreach ($rooms as $slug => $r): if ($slug === $type) continue; ?>
          <div class="room-card" data-aos="fade-up">
            <a href="room-detail.php?type=<?php echo urlencode($slug); ?>" class="room-image" style="background-image: url('<?php echo htmlspecialchars($r['hero']); ?>'); background-size: cover; background-position: center;" aria-label="View <?php echo htmlspecialchars($r['name']); ?> details"></a>
            <div class="room-content">
              <a href="room-detail.php?type=<?php echo urlencode($slug); ?>" class="room-title-link"><h3><?php echo htmlspecialchars($r['name']); ?></h3></a>
              <?php $rPrice = ROOM_RATES[$r['name']] ?? null; if ($rPrice !== null): ?>
                <p class="room-price">From $<?php echo number_format($rPrice); ?> <span>/ night</span></p>
              <?php endif; ?>
              <div class="room-actions">
                <a href="room-detail.php?type=<?php echo urlencode($slug); ?>" class="btn-view-room">View Details</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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

  <!-- Lightbox -->
  <div class="lightbox" id="lightbox">
    <i class="fa-solid fa-xmark lightbox-close" onclick="closeLightbox()" role="button" aria-label="Close"></i>
    <i class="fa-solid fa-chevron-left lightbox-nav lightbox-prev" onclick="navLightbox(-1)" role="button" aria-label="Previous photo"></i>
    <img id="lightboxImage" src="" alt="">
    <i class="fa-solid fa-chevron-right lightbox-nav lightbox-next" onclick="navLightbox(1)" role="button" aria-label="Next photo"></i>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({ once: true, offset: 50 });

    const gallery = <?php echo json_encode(array_column($room['gallery'], 'src')); ?>;
    let currentIndex = 0;
    const mainImage = document.getElementById('mainImage');
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');

    function setMainImage(index, thumbEl) {
        currentIndex = index;
        mainImage.src = gallery[index];
        document.querySelectorAll('.room-thumbs img').forEach(img => img.classList.remove('active'));
        if (thumbEl) thumbEl.classList.add('active');
    }

    mainImage.addEventListener('click', function() {
        openLightbox(currentIndex);
    });

    function openLightbox(index) {
        currentIndex = index;
        lightboxImage.src = gallery[index];
        lightbox.classList.add('open');
    }

    function closeLightbox() {
        lightbox.classList.remove('open');
    }

    function navLightbox(dir) {
        currentIndex = (currentIndex + dir + gallery.length) % gallery.length;
        lightboxImage.src = gallery[currentIndex];
        const thumb = document.querySelectorAll('.room-thumbs img')[currentIndex];
        setMainImage(currentIndex, thumb);
    }

    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('open')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navLightbox(-1);
        if (e.key === 'ArrowRight') navLightbox(1);
    });

    function toggleMenu() {
        document.querySelector('.nav-links').classList.toggle('active');
        document.querySelector('.menu-toggle').classList.toggle('active');
    }

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
