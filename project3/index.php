<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.html');
    exit();
    if(!isset($_POST['role'])){
    header('Location: login.html');
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ILIASS Coffee Haven</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --bg-color: #f9f5f0;
            --text-color: #3e2c1c;
            --primary-color: #6f4e37;
            --secondary-color: #ffd700;
            --card-bg: white;
            --shadow: rgba(0,0,0,0.1);
        }
        
        body.dark-mode {
            --bg-color: #1a1a1a;
            --text-color: #e0e0e0;
            --primary-color: #8b5e3c;
            --secondary-color: #ffb700;
            --card-bg: #2a2a2a;
            --shadow: rgba(255,255,255,0.1);
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.2s ease, color 0.2s ease;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }

        /* Performance optimizations */
        .hero-slider, .product, .slide {
            will-change: transform, opacity;
        }
        
        img {
            will-change: transform;
            backface-visibility: hidden;
            transform: translateZ(0);
        }

        /* Header */
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px var(--shadow);
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            animation: fadeIn 0.6s ease-out;
        }
        
        .logo img {
            height: 40px;
            margin-right: 10px;
        }
        
        nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        nav a {
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 5px 10px;
            position: relative;
        }
        
        nav a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: width 0.2s ease;
        }
        
        nav a:hover::before {
            width: 100%;
        }
        
        nav a:hover {
            color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        /* Dark Mode Toggle */
        .dark-mode-toggle {
            background: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.2s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .dark-mode-toggle:hover {
            transform: scale(1.05);
        }

        /* Hero Slider */
        .hero-slider {
            position: relative;
            height: 500px;
            overflow: hidden;
        }
        
        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.6s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 5px #000;
            background-size: cover;
            background-position: center;
        }
        
        .slide.active {
            opacity: 1;
        }
        
        .slide-1 {
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1511920170033-f8396924c348');
        }
        
        .slide-2 {
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1509042239860-f550ce710b93');
        }
        
        .slide-3 {
            background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f');
        }
        
        .slide h1 {
            font-size: 60px;
            margin: 0;
            animation: fadeInUp 0.6s ease;
        }
        
        .slide p {
            font-size: 24px;
            margin-top: 20px;
            animation: fadeInUp 0.7s ease;
        }
        
        .slide button {
            margin-top: 30px;
            padding: 12px 25px;
            font-size: 18px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s ease;
            animation: fadeInUp 0.8s ease;
        }
        
        .slide button:hover {
            transform: scale(1.05);
        }
        
        /* Slider Controls */
        .slider-controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }
        
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .slider-dot:hover {
            transform: scale(1.2);
        }
        
        .slider-dot.active {
            background: var(--secondary-color);
            width: 30px;
            border-radius: 6px;
        }
        
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.3);
            color: white;
            border: none;
            padding: 15px 20px;
            cursor: pointer;
            font-size: 24px;
            transition: all 0.2s ease;
            border-radius: 5px;
        }
        
        .slider-arrow:hover {
            background: rgba(255,255,255,0.5);
        }
        
        .slider-arrow.prev {
            left: 20px;
        }
        
        .slider-arrow.next {
            right: 20px;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Scroll Animations */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .scroll-animate.animated {
            opacity: 1;
            transform: translateY(0);
        }
        
        .scroll-animate-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .scroll-animate-left.animated {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-animate-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .scroll-animate-right.animated {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-animate-scale {
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        
        .scroll-animate-scale.animated {
            opacity: 1;
            transform: scale(1);
        }

        /* Sections */
        section {
            padding: 60px 20px;
            text-align: center;
        }
        
        section h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }
        
        section h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: var(--secondary-color);
            transition: width 0.4s ease;
        }
        
        section h2.animated::after {
            width: 80%;
        }
        
        section p {
            font-size: 18px;
            max-width: 800px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        /* Products */
        .filter-btns {
            margin-bottom: 30px;
        }
        
        .filter-btns button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border-radius: 25px;
            transition: all 0.2s ease;
            font-weight: bold;
        }
        
        .filter-btns button:hover,
        .filter-btns button.active {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        
        .product {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            width: 280px;
            text-align: center;
            box-shadow: 0px 5px 15px var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .product::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,215,0,0.2), transparent);
            transition: left 0.4s ease;
        }
        
        .product:hover::before {
            left: 100%;
        }
        
        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }
        
        .product:hover img {
            transform: scale(1.05);
        }
        
        .product:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 25px var(--shadow);
        }
        
        .product h3 {
            color: var(--primary-color);
            margin: 10px 0;
            transition: color 0.2s ease;
        }
        
        .product:hover h3 {
            color: var(--secondary-color);
        }
        
        .product button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.2s ease;
            font-weight: bold;
        }
        
        .product button:hover {
            transform: scale(1.1);
        }

        /* Cart */
        #cart {
            position: fixed;
            top: 80px;
            right: 20px;
            background: var(--secondary-color);
            color: var(--primary-color);
            padding: 15px 20px;
            border-radius: 50px;
            font-weight: bold;
            z-index: 1000;
            box-shadow: 0 5px 15px var(--shadow);
            transition: transform 0.2s ease;
            cursor: pointer;
            animation: fadeIn 0.4s ease;
        }
        
        #cart:hover {
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }
        
        footer h2 {
            color: white;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media(max-width: 768px) {
            header {
                flex-direction: column;
                gap: 15px;
            }
            
            nav {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .slide h1 {
                font-size: 40px;
            }
            
            .slide p {
                font-size: 18px;
            }
            
            .slider-arrow {
                padding: 10px 15px;
                font-size: 18px;
            }
            
            .product {
                width: 100%;
                max-width: 350px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        ILIASS
    </div>
    <nav>
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#service">Service</a>
        <a href="#menu">Menu</a>
        <a href="#pages">Pages</a>
        <a href="#contact">Contact</a>
        <a href="reservation.php">Reservation</a>
        <a href="#" onclick="logout(); return false;">logout</a>
        <button class="dark-mode-toggle" onclick="toggleDarkMode()">
            <span id="mode-icon">🌙</span>
            <span id="mode-text">Dark</span>
        </button>
    </nav>
</header>

<div id="cart" onclick="showCart()">🛒 Cart: 0</div>

<section class="hero-slider" id="home">
    <div class="slide slide-1 active">
        <h1>Welcome to <?php echo ($_SESSION['name']); ?> Coffee Haven</h1>
        <p>Your perfect cup of coffee, brewed with passion.</p>
        <button onclick="scrollToSection('#menu')">View Menu</button>
    </div>         
    <div class="slide slide-2">
        <h1>Premium Quality Beans</h1>
        <p>Sourced from the finest coffee farms around the world.</p>
        <button onclick="scrollToSection('#menu')">Explore Coffee</button>
    </div>
    <div class="slide slide-3">
        <h1>Crafted with Love</h1>
        <p>Every cup tells a story of excellence and dedication.</p>
        <button onclick="scrollToSection('#about')">Learn More</button>
    </div>
    
    <button class="slider-arrow prev" onclick="changeSlide(-1)">‹</button>
    <button class="slider-arrow next" onclick="changeSlide(1)">›</button>
    
    <div class="slider-controls">
        <span class="slider-dot active" onclick="goToSlide(0)"></span>
        <span class="slider-dot" onclick="goToSlide(1)"></span>
        <span class="slider-dot" onclick="goToSlide(2)"></span>
    </div>
</section>

<section id="about">
    <h2 class="scroll-animate">About Us</h2>
    <p class="scroll-animate">At ILIASS Coffee Haven, we are dedicated to serving the finest coffee, crafted with care and love. From freshly roasted beans to creamy lattes, we ensure every cup is perfect. Our journey began with a simple passion for great coffee, and today we're proud to share that passion with you.</p>
</section>

<section id="service">
    <h2 class="scroll-animate">Our Services</h2>
    <p class="scroll-animate">We offer in-store coffee experiences, online ordering, home delivery, and subscriptions. Whether you want to enjoy coffee in our cozy atmosphere or have it delivered to your door, we've got you covered. Enjoy coffee your way!</p>
</section>

<section id="menu">
    <h2 class="scroll-animate">Our Coffee Menu</h2>
    <div class="filter-btns scroll-animate-scale">
        <button class="active" onclick="filterProducts('all')">All</button>
        <button onclick="filterProducts('Espresso')">Espresso</button>
        <button onclick="filterProducts('Latte')">Latte</button>
        <button onclick="filterProducts('Cappuccino')">Cappuccino</button>
    </div>
    <div class="products" id="products">
        <!-- Example Product -->
        <div class="product scroll-animate-scale" data-category="Espresso">
            <img src="https://images.unsplash.com/photo-1586190848861-99aa4a171e90" alt="Espresso">
            <h3>Classic Espresso</h3>
            <p>Strong, bold espresso shot.</p>
            <button onclick="addToCart('Classic Espresso')">Add to Cart</button>
        </div>
        <div class="product scroll-animate-scale" data-category="Latte">
            <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348" alt="Latte">
            <h3>Vanilla Latte</h3>
            <p>Sweet and smooth vanilla latte.</p>
            <button onclick="addToCart('Vanilla Latte')">Add to Cart</button>
        </div>
        <div class="product scroll-animate-scale" data-category="Cappuccino">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="Cappuccino">
            <h3>Classic Cappuccino</h3>
            <p>Rich espresso with foamy milk.</p>
            <button onclick="addToCart('Classic Cappuccino')">Add to Cart</button>
        </div>
    </div>
</section>

<section id="contact">
    <h2 class="scroll-animate">Contact Us</h2>
    <p class="scroll-animate">Have questions or want to make a reservation? Reach out to us via email or phone. We're always happy to help you enjoy your coffee experience to the fullest.</p>
</section>

<footer>
    <h2>ILIASS Coffee Haven</h2>
    <p>&copy; 2025 ILIASS Coffee Haven. All rights reserved.</p>
</footer>

<script>
    // Dark Mode
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const modeText = document.getElementById('mode-text');
        const modeIcon = document.getElementById('mode-icon');
        if(document.body.classList.contains('dark-mode')){
            modeText.textContent = 'Light';
            modeIcon.textContent = '☀️';
        } else {
            modeText.textContent = 'Dark';
            modeIcon.textContent = '🌙';
        }
    }

    // Logout
    function logout() {
        fetch('logout.php').then(()=> window.location.href='login.html');
    }

    // Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');

    function showSlide(index) {
        slides.forEach((s, i) => {
            s.classList.toggle('active', i === index);
            dots[i].classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    function changeSlide(n) {
        showSlide((currentSlide + n + slides.length) % slides.length);
    }

    function goToSlide(n) {
        showSlide(n);
    }

    setInterval(() => changeSlide(1), 5000);

    // Scroll Animations
    const scrollElements = document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('animated');
            }
        });
    }, {threshold: 0.2});
    scrollElements.forEach(el => observer.observe(el));

    // Cart
    let cartCount = 0;
    function addToCart(item){
        cartCount++;
        document.getElementById('cart').textContent = '🛒 Cart: ' + cartCount;
        alert(item + ' added to cart!');
    }

    function showCart(){
        alert('You have ' + cartCount + ' items in your cart.');
    }

    // Filter Products
    function filterProducts(category){
        const buttons = document.querySelectorAll('.filter-btns button');
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        const products = document.querySelectorAll('.product');
        products.forEach(p => {
            if(category === 'all' || p.dataset.category === category){
                p.style.display = 'block';
            } else {
                p.style.display = 'none';
            }
        });
    }

    // Scroll to section
    function scrollToSection(id){
        document.querySelector(id).scrollIntoView({behavior:'smooth'});
    }
</script>

</body>
</html>
