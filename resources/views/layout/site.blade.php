<!DOCTYPE html>
<html lang="en">

<head>
    <!--required meta tags-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--twitter og-->
    <meta name="twitter:site" content="@themetags" />
    <meta name="twitter:creator" content="@themetags" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Hostim - Hosting Service Provider HTML Template" />
    <meta name="twitter:description" content="Hosting Services HTML Template, software technology, agency & business Bootstrap 5 Html template. It is best and famous hosting services company website template." />
    <meta name="twitter:image" content="#" />

    <!--facebook og-->
    <meta property="og:url" content="#" />
    <meta name="twitter:title" content="cash deposit" />
    <meta property="og:description" content="Cash Deposit" />
    <meta property="og:image" content="#" />
    <meta property="og:image:secure_url" content="#" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="600" />

    <!--meta-->
    <meta name="description" content="Cash Deposit - Deposite Services HTML Template, software technology, agency & business Bootstrap 5 Html template. It is best and famous hosting services company website template." />
    <meta name="author" content="ThemeTags" />

    <!--favicon icon-->
    <link rel="icon" href="{{asset('assets/frontend/img/favicon.png')}}" type="image/png" sizes="16x16" />

    <!--title-->
    <title>Hostim - 2 - HTML Template</title>

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&amp;family=Urbanist:wght@600;700&amp;display=swap" rel="stylesheet">

    <!--build:css-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/main.css')}}" />
    <!-- endbuild -->

    <!--custom css-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom.css')}}" />

    @yield('stylesheet')

</head>

<body>

<!--dark light switcher-->
<button class="dark-light-switcher" id="theme-switch">
    <span class="light-sun"><i class="fa-solid fa-sun"></i></span>
    <span class="dark-moon"><i class="fa-solid fa-moon"></i></span>
</button>

<!--body overlay -->
<div class="body-overlay"></div>

<!--scrolltop button -->
<button class="scrolltop-btn"><i class="fa-solid fa-angle-up"></i></button>

<!--preloader start-->
<div class="loader-wrap">
    <div class="preloader">
        <div id="handle-preloader" class="handle-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="H" class="letters-loading">H</span>
                    <span data-text-preloader="O" class="letters-loading">O</span>
                    <span data-text-preloader="S" class="letters-loading">S</span>
                    <span data-text-preloader="T" class="letters-loading">T</span>
                    <span data-text-preloader="I" class="letters-loading">I</span>
                    <span data-text-preloader="M" class="letters-loading">M</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--preloader end-->
<!--main content wrapper start-->
<div class="main-wrapper">

    <!--notice bar start-->
    <div class="notice-bar-area">
        <div class="notice-bar">
            <div class="container">
                <div class="row align-items-center g-4 justify-content-center">
                    <div class="col-xl-4 col-md-7">
                        <div class="nt-sale d-flex align-items-center justify-content-center justify-content-md-start">
                            <h5 class="mb-0 text-white me-3 me-md-4">Black Friday Sale</h5>
                            <ul class="countdown-timer nt-downcount d-flex align-items-center" data-date="12/30/2024 23:59:59">
                                <li>
                                    <span class="hours box">12</span>
                                    <span class="subtitle d-block">Hour</span>
                                </li>
                                <li>
                                    <span class="minutes box">54</span>
                                    <span class="subtitle d-block">Minutes</span>
                                </li>
                                <li>
                                    <span class="seconds box">32</span>
                                    <span class="subtitle d-block">Sec</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-5 d-none d-xl-block">
                        <div class="notice-info">
                            <p class="mb-0 text-white">Get 80% off Hosting plans + free Domain & SSL!</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-5">
                        <div class="text-center text-md-end">
                            <button type="button" class="notice-toggle notice-btn fs-sm fw-bold">View Details<span class="ms-1"><i class="fa-solid fa-angle-down"></i></span></button>
                            <button type="button" class="notice-close notice-btn fs-sm fw-bold ms-5"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="notice-wrapper w-100">
        <section class="friday-hero position-relative overflow-hidden zindex-1">
            <img src="{{asset('assets/frontend/img/shapes/gift-box.png')}}" alt="gift box" class="position-absolute start-0 top-0 zindex--1">
            <img src="{{asset('assets/frontend/img/shapes/gift-box-2.png')}}" alt="gift box" class="position-absolute gift-box-right zindex--1">
            <img src="{{asset('assets/frontend/img/shapes/black-circle-right.png')}}" alt="circle" class="position-absolute bottom-0 end-0 zindex--1">
            <img src="{{asset('assets/frontend/img/shapes/black-circle-left.png')}}" alt="circle" class="position-absolute bottom-0 start-0 zindex--1">
            <img src="{{asset('assets/frontend/img/shapes/bf-line.png')}}" alt="not found" class="position-absolute bf-line-left">
            <img src="{{asset('assets/frontend/img/shapes/bf-line-2.png')}}" alt="not found" class="position-absolute bf-line-top zindex--1">
            <img src="{{asset('assets/frontend/img/shapes/gift-box-2.png')}}" alt="gift box" class="position-absolute gift-box-sm start-50 zindex--1">
            <img src="{{asset('assets/frontend/img/shapes/bf-dots-white.png')}}" alt="dots shape" class="position-absolute dots-shape-white zindex--1">
            <div class="container">
                <div class="row align-items-center justify-content-center g-4">
                    <div class="col-xl-4 col-md-6">
                        <div class="super-sale-countdown">
                            <img src="{{asset('assets/frontend/img/black-friday/super-sale.png')}}" alt="not found" class="img-fluid">
                            <ul class="countdown-timer sp-downcount-timer d-flex align-items-center mt-4 mb-5" data-date="12/30/2022 23:59:59">
                                <li>
                                    <span class="days box">24</span>
                                    <span class="subtitle">Days</span>
                                </li>
                                <li>
                                    <span class="hours box">10</span>
                                    <span class="subtitle">Hour</span>
                                </li>
                                <li>
                                    <span class="minutes box">45</span>
                                    <span class="subtitle">Minutes</span>
                                </li>
                                <li>
                                    <span class="seconds box">10</span>
                                    <span class="subtitle">Sec</span>
                                </li>
                            </ul>
                            <a href="pricing.html" class="template-btn primary-btn">Get Started Now</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="offer-badge">
                            <img src="{{asset('assets/frontend/img/black-friday/offer-badge.png')}}" alt="not found" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-10">
                        <div class="friday-offer-packages">
                            <div class="friday-hosting-offer position-relative rounded">
                                <span class="title-badge">Shared Hosting</span>
                                <span class="angle-shape"></span>
                                <span class="sale-price">From $8.54</span>
                                <h3 class="price mt-2 mb-20">$1.35 <span>USD/MO</span></h3>
                                <a href="pricing.html" class="template-btn primary-btn py-2 text-uppercase">Save Now</a>
                            </div>
                            <div class="friday-hosting-offer position-relative rounded mt-40">
                                <span class="title-badge">Web Hosting</span>
                                <span class="angle-shape"></span>
                                <span class="sale-price">From $8.54</span>
                                <h3 class="price mt-2 mb-20">$3.25 <span>USD/MO</span></h3>
                                <a href="pricing.html" class="template-btn primary-btn py-2 text-uppercase">Save Now</a>
                            </div>
                            <div class="friday-hosting-offer position-relative rounded mt-40">
                                <span class="title-badge">Email Hosting</span>
                                <span class="angle-shape"></span>
                                <span class="sale-price">From $8.54</span>
                                <h3 class="price mt-2 mb-20">$4.35 <span>USD/MO</span></h3>
                                <a href="pricing.html" class="template-btn primary-btn py-2 text-uppercase">Save Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--notice bar end-->

    <!--header area start-->
    <header class="header-two position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-5">
                    <div class="logo-wrapper">
                        <a href="index.html"><img src="{{asset('assets/frontend/img/logo-white.png')}}" alt="logo" class="logo"></a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 d-none d-lg-block">
                    <div class="nav-wrapper">
                        <nav>
                            <ul>
                                <li class="has-submenu"><a href="#">Home</a>
                                    <div class="submenu-wrapper menu-list theme-megamenu theme-megamenu-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="megamenu-item">
                                                    <a href="index.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper bg-transparent"><img src="{{asset('assets/frontend/img/server.svg')}}" alt="server" class="list-logo"></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Web Hosting</h6>
                                                                <span>Powerful bare metal server</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="megamenu-item">
                                                    <a href="index-2.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper bg-transparent"><img src="{{asset('assets/frontend/img/server-1.svg')}}" alt="server" class="list-logo"></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Hosting Services</h6>
                                                                <span>Powerful virtual machine</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="megamenu-item">
                                                    <a href="index-3.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper bg-transparent"><img src="{{asset('assets/frontend/img/laptop.svg')}}" alt="server" class="list-logo"></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Game Hosting</h6>
                                                                <span>Super fast game server</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="megamenu-item">
                                                    <a href="index-4.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper bg-transparent"><img src="{{asset('assets/frontend/img/globe.svg')}}" alt="server" class="list-logo"></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Application Hosting</h6>
                                                                <span>Flexible Application Hosting</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="megamenu-item">
                                                    <a href="index-5.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper bg-transparent"><img src="{{asset('assets/frontend/img/server-2.svg')}}" alt="server" class="list-logo"></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Hosting Solutions</h6>
                                                                <span>Powerful Hosting Solution</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="megamenu-item">
                                                    <a href="index-6.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper bg-transparent"><img src="{{asset('assets/frontend/img/server-1.svg')}}" alt="server" class="list-logo"></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Minimal Hosting</h6>
                                                                <span>Minimal Web Hosting</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="megamenu-item">
                                                    <a href="index-7.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper bg-transparent"><img src="{{asset('assets/frontend/img/laptop.svg')}}" alt="server" class="list-logo"></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Slider Home</h6>
                                                                <span>Web Hosting Services</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="domain.html">Domain</a></li>
                                <li class="has-submenu"><a href="#">Hosting</a>
                                    <div class="submenu-wrapper menu-list theme-megamenu">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="megamenu-item"><a href="shared-hosting.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-solid fa-server"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Shared Hosting</h6>
                                                                <span>Powerful bare metal server</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                                <div class="megamenu-item"><a href="wp-hosting.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-brands fa-wordpress"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>WordPress Hosting</h6>
                                                                <span>Powerful bare metal server</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                                <div class="megamenu-item"><a href="vps-hosting.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-solid fa-cloud"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>VPS Hosting</h6>
                                                                <span>Powerful bare metal server</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                                <div class="megamenu-item"><a href="dedicated-server.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-solid fa-shield"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Dedicated Server</h6>
                                                                <span>Powerful dedicated server</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                                <div class="megamenu-item"><a href="email-hosting.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-regular fa-envelope"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Email Hosting<span class="badge bg-danger ms-3">New</span></h6>
                                                                <span>Powerful Email Hosting</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="megamenu-item"><a href="reseller-hosting.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-brands fa-audible"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Reseller Hosting</h6>
                                                                <span>Reseller Hosting server</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                                <div class="megamenu-item"><a href="game-hosting.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-solid fa-dice-d6"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Game Hosting</h6>
                                                                <span>Game Hosting server</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                                <div class="megamenu-item"><a href="cloud-hosting.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-solid fa-cloud"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Cloud Hosting<span class="badge bg-danger ms-3">New</span></h6>
                                                                <span>Cloud Hosting server</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                                <div class="megamenu-item"><a href="black-friday.html">
                                                        <div class="menu-list-wrapper d-flex align-items-center">
                                                            <span class="icon-wrapper"><i class="fa-brands fa-buffer"></i></span>
                                                            <div class="menu-list-content-right ms-3">
                                                                <h6>Black Friday<span class="badge bg-danger ms-3">New</span></h6>
                                                                <span>Black Friday Sales</span>
                                                            </div>
                                                        </div>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="has-submenu has-megamenu-list"><a href="#">Pages</a>
                                    <ul class="submenu-wrapper">
                                        <li><a href="service.html">Services</a></li>
                                        <li><a href="pricing.html">Pricing</a></li>
                                        <li><a href="features.html">Features</a></li>
                                        <li><a href="blog-grids.html">Blog Grid</a></li>
                                        <li><a href="blog-list.html">Blog List</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="terms.html">Terms & Conditions</a></li>
                                        <li><a href="privacy.html">Privacy Policy</a></li>
                                        <li><a href="pricing-2.html">Pricing V2</a></li>
                                        <li><a href="affiliate.html">Affiliate</a></li>
                                        <li><a href="status.html">Status</a></li>
                                        <li><a href="404.html">404</a></li>
                                        <li><a href="data-center.html">Data Center<span class="badge bg-danger ms-3">New</span></a></li>
                                        <li><a href="compare-pricing.html">Compare<span class="badge bg-danger ms-3">New</span></a></li>
                                        <li><a href="career.html">Career<span class="badge bg-danger ms-3">New</span></a></li>
                                        <li><a href="career-details.html">Career Details<span class="badge bg-danger ms-3">New</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-7">
                    <div class="header-right-btn d-flex align-items-center justify-content-end">
                        <a href="{{route('login')}}" class="template-btn hm2-primary-btn rounded-pill btn-small d-none d-sm-block">Login</a>

                        <a href="#" class="mobile-menu-toggle d-lg-none text-white ms-3"><i class="fa-solid fa-bars-staggered"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--header area end-->

    <!--mobile menu start-->
    <div class="mobile-menu position-fixed bg-white deep-shadow">
        <button class="close-menu position-absolute"><i class="fa-solid fa-xmark"></i></button>
        <a href="index.html" class="logo-wrapper"><img src="{{asset('assets/frontend/img/logo.png')}}" alt="logo" class="logo logo-black"></a>
        <a href="index.html" class="logo-wrapper"><img src="{{asset('assets/frontend/img/logo-white.png')}}" alt="logo" class="logo logo-white"></a>
        <nav class="mobile-menu-wrapper mt-40">
            <ul>
                <li class="has-submenu"><a href="#">Home</a>
                    <ul>
                        <li><a href="index.html">
                                <div class="menu-list-wrapper d-flex align-items-center">
                                    <img src="{{asset('assets/frontend/img/server.svg')}}" alt="server" class="list-logo">
                                    <div class="menu-list-content-right ms-3">
                                        <h6>Web Hosting</h6>
                                        <span>Powerful bare metal server</span>
                                    </div>
                                </div>
                            </a></li>
                        <li><a href="index-2.html">
                                <div class="menu-list-wrapper d-flex align-items-center">
                                    <img src="{{asset('assets/frontend/img/server-1.svg')}}" alt="server" class="list-logo">
                                    <div class="menu-list-content-right ms-3">
                                        <h6>Hosting Services</h6>
                                        <span>Flexible virtual machine</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><a href="index-3.html">
                                <div class="menu-list-wrapper d-flex align-items-center">
                                    <img src="{{asset('assets/frontend/img/laptop.svg')}}" alt="server" class="list-logo">
                                    <div class="menu-list-content-right ms-3">
                                        <h6>Game Server</h6>
                                        <span>Super fast game server</span>
                                    </div>
                                </div>
                            </a></li>
                        <li><a href="index-4.html">
                                <div class="menu-list-wrapper d-flex align-items-center">
                                    <img src="{{asset('assets/frontend/img/globe.svg')}}" alt="server" class="list-logo">
                                    <div class="menu-list-content-right ms-3">
                                        <h6>Application Hosting</h6>
                                        <span>Flexible Application Hosting</span>
                                    </div>
                                </div>
                            </a></li>
                        <li><a href="index-5.html">
                                <div class="menu-list-wrapper d-flex align-items-center">
                                    <img src="{{asset('assets/frontend/img/server-2.svg')}}" alt="server" class="list-logo">
                                    <div class="menu-list-content-right ms-3">
                                        <h6>Hosting Solution</h6>
                                        <span>Powerful Hosting Solutions</span>
                                    </div>
                                </div>
                            </a></li>
                        <li><a href="index-6.html">
                                <div class="menu-list-wrapper d-flex align-items-center">
                                    <img src="{{asset('assets/frontend/img/server-1.svg')}}" alt="server" class="list-logo">
                                    <div class="menu-list-content-right ms-3">
                                        <h6>Minimal Hosting<span class="badge bg-danger ms-3">New</span></h6>
                                        <span>Minimal Web Hosting</span>
                                    </div>
                                </div>
                            </a></li>
                        <li><a href="index-7.html">
                                <div class="menu-list-wrapper d-flex align-items-center">
                                    <img src="{{asset('assets/frontend/img/laptop.svg')}}" alt="server" class="list-logo">
                                    <div class="menu-list-content-right ms-3">
                                        <h6>Slider Home<span class="badge bg-danger ms-3">New</span></h6>
                                        <span>Web Hosting Services</span>
                                    </div>
                                </div>
                            </a></li>
                    </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li><a href="domain.html">Domain</a></li>
                <li class="has-submenu"><a href="#">Hosting</a>
                    <ul>
                        <li><a href="shared-hosting.html">Shared Hosting</a></li>
                        <li><a href="wp-hosting.html">WordPress Hosting</a></li>
                        <li><a href="vps-hosting.html">VPS Hosting</a></li>
                        <li><a href="dedicated-server.html">Dedicated Server</a></li>
                        <li><a href="reseller-hosting.html">Reseller Hosting</a></li>
                        <li><a href="game-hosting.html">Game Hosting</a></li>
                        <li><a href="cloud-hosting.html">Cloud Hosting</a></li>
                        <li><a href="email-hosting.html">Email Hosting</a></li>
                        <li><a href="black-friday.html">Black Friday</a></li>
                    </ul>
                </li>
                <li class="has-submenu"><a href="#">Pages</a>
                    <ul class="submenu-wrapper">
                        <li><a href="service.html">Services</a></li>
                        <li><a href="pricing.html">Pricing</a></li>
                        <li><a href="features.html">Features</a></li>
                        <li><a href="blog-grids.html">Blog Grid</a></li>
                        <li><a href="blog-list.html">Blog List</a></li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="terms.html">Terms & Conditions</a></li>
                        <li><a href="privacy.html">Privacy Policy</a></li>
                        <li><a href="pricing-2.html">Pricing V2</a></li>
                        <li><a href="affiliate.html">Affiliate</a></li>
                        <li><a href="status.html">Status</a></li>
                        <li><a href="404.html">404</a></li>
                        <li><a href="data-center.html">Data Center<span class="badge bg-danger ms-3">New</span></a></li>
                        <li><a href="compare-pricing.html">Compare<span class="badge bg-danger ms-3">New</span></a></li>
                        <li><a href="career.html">Career<span class="badge bg-danger ms-3">New</span></a></li>
                        <li><a href="career-details.html">Career Details<span class="badge bg-danger ms-3">New</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div class="contact-info mt-60">
            <h4 class="mb-20">Contact Info</h4>
            <p>Chicago 12, Melborne City, USA</p>
            <p>+88 01682648101</p>
            <p>info@example.com</p>
            <div class="contact-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <!--mobile menu end-->


@yield('content')



    <!-- Footer Area -->
    <footer class="hm2-footer pt-250 mt--150" data-background="assets/img/shapes/map-bg.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Hostim Hosting</h5>
                        <ul class="footer-nav">
                            <li><a href="pricing.html">Pricing Plans</a></li>
                            <li><a href="features.html">Hostim Features</a></li>
                            <li><a href="#">Add-Ons</a></li>
                            <li><a href="#">Cloudflare Integration</a></li>
                            <li><a href="#">APM Tool</a></li>
                            <li><a href="#">Dev Hostim</a></li>
                            <li><a href="contact-2.html">Hostim Support</a></li>
                            <li><a href="#">Free Migration</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Company Links</h5>
                        <ul class="footer-nav">
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Clients & Case Studies</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="testimonials.html">Kinsta Reviews</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Why Us</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Resources Links</h5>
                        <ul class="footer-nav">
                            <li><a href="#">All Resources</a></li>
                            <li><a href="blog-grids.html">Blog</a></li>
                            <li><a href="#">Knowledge Base</a></li>
                            <li><a href="contact.html">Help Center</a></li>
                            <li><a href="#">Feature Updates</a></li>
                            <li><a href="#">Agency Directory</a></li>
                            <li><a href="#">Affiliate Academy</a></li>
                            <li><a href="#">System Status</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Products & Solution</h5>
                        <ul class="footer-nav">
                            <li><a href="wp-hosting.html">Managed WordPress Hosting</a></li>
                            <li><a href="shared-hosting.html">Shared Hosting</a></li>
                            <li><a href="vps-hosting.html">VPS Hosting</a></li>
                            <li><a href="index-3.html">Game Hosting</a></li>
                            <li><a href="#">WooCommerce Hosting</a></li>
                            <li><a href="#">Multisite Hosting</a></li>
                            <li><a href="#">Secure Hosting</a></li>
                            <li><a href="#">Hosting for Publishers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="hm2-footer-copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-6 order-2 order-lg-1">
                        <div class="copyright-txt mt-3 mt-lg-0">
                            <p class="mb-0 text-white">&copy; 2022 Hostim. All rights reserved</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 order-1 order-lg-2">
                        <div class="footer-logo text-start text-lg-center">
                            <a href="index.html"><img src="{{asset('assets/frontend/img/logo-white.png')}}" alt="logo" class="logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 order-3">
                        <div class="footer-social text-start text-lg-end mt-3 mt-lg-0">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                            <a href="#"><i class="fab fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->



</div>
<!-- main content wrapper ends -->


<!--build:js-->
<script src="{{asset('assets/frontend/js/vendors/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/easing.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/swiper.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/massonry.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/bootstrap-slider.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/waypoints.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/counterup.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/isotop.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/countdown.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/app.js')}}"></script>

@yield('script')
<!--endbuild-->
</body>

</html>
