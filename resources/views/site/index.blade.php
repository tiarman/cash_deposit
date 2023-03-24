@extends('layout.site')

@section('stylesheet')

@endsection


@section('content')

    <!--hero section start-->
    <section class="hero-style-2 overflow-hidden position-relative zindex-2" data-background="{{asset('assets/frontend/img/home2/hero-bg.png')}}">
        <img src="{{asset('assets/frontend/img/home2/shape/box.svg')}}" alt="box" class="position-absolute box-red">
        <img src="{{asset('assets/frontend/img/home2/shape/circle-outline.svg')}}" alt="circle outline" class="position-absolute circle-outline">
        <img src="{{asset('assets/frontend/img/home2/shape/tire.svg')}}" alt="tire shape" class="position-absolute tire-shape">
        <img src="{{asset('assets/frontend/img/home2/shape/triangle.svg')}}" alt="triangle" class="position-absolute triangle">
        <img src="{{asset('assets/frontend/img/home2/shape/box-yellow.svg')}}" alt="box shape" class="position-absolute box-yellow">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero2-content-wrapper">
                        <h1 class="display-font text-white">The Manage Yor Cash Services</h1>
                        <p class="lead mt-4 text-white">Touch the success! Cash and Secure Money Service <br class="d-none d-sm-inline-block"> with <mark>a free cost</mark></p>
                        <div class="hero-btns mt-5">
                            <a href="pricing.html" class="template-btn hm2-primary-btn rounded-pill me-4">Get Started</a>
                            <a href="contact.html" class="template-btn outline-btn rounded-pill">Contact Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-right">
                        <img src="{{asset('assets/frontend/img/home2/hero-img.png')}}" alt="hero" class="hero-right-img logo-black">
                        <img src="{{asset('assets/frontend/img/home2/hero-img-white.png')}}" alt="hero" class="hero-right-img logo-white">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--feature section start-->
    <section class="hm2-feature-area pt-120 pb-120 position-relative zindex-1 overflow-hidden">
        <img src="{{asset('assets/frontend/img/home2/shape/feature-right.png')}}" alt="triangle" class="position-absolute right-bottom">
        <div class="container position-relative">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="hm2-section-title">
                        <h2 class="hm2-title"><mark>Discover</mark> all Our <br>Cash Deposite Site</h2>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hm2-section-desc mt-3 mt-lg-0">
                        <p>Focus on your business and avoid all the web hosting hassles. Our managed hosting guarantees unmatched performance, reliability and choice with 24/7 support that acts as your extended team,</p>
                        <a href="" class="hm2-explore-btn fw-bold position-relative">Show all Feature</a>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-5 justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hm2-feature-card deep-shadow bg-white rounded-2">
                        <span class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle"><i class="fa-solid fa-lock"></i></span>
                        <h3 class="h4 mt-4">Maximum <br> Security</h3>
                        <p class="mt-3">Choice for growing agencies and support that acts asyour ecommerce businesses.</p>
                        <a href="#" class="mt-2 d-inline-block rounded-circle text-center position-relative overflow-hidden"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hm2-feature-card deep-shadow bg-white rounded-2">
                        <span class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle"><i class="fa-solid fa-money-check"></i></span>
                        <h3 class="h4 mt-4">100% Moneyback <br>Guarantee</h3>
                        <p class="mt-3">Choice for growing agencies and support that acts asyour ecommerce businesses.</p>
                        <a href="#" class="mt-2 d-inline-block rounded-circle text-center position-relative overflow-hidden"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hm2-feature-card deep-shadow bg-white rounded-2">
                        <span class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle"><i class="fa-solid fa-gauge-simple-high"></i></span>
                        <h3 class="h4 mt-4">Maximum <br>Performance</h3>
                        <p class="mt-3">Choice for growing agencies and support that acts asyour ecommerce businesses.</p>
                        <a href="#" class="mt-2 d-inline-block rounded-circle text-center position-relative overflow-hidden"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="hm2-feature-card deep-shadow bg-white rounded-2">
                        <span class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle"><i class="fa-solid fa-cloud-arrow-down"></i></span>
                        <h3 class="h4 mt-4">Maximum <br>Data Trusted</h3>
                        <p class="mt-3">Choice for growing agencies and support that acts asyour ecommerce businesses.</p>
                        <a href="#" class="mt-2 d-inline-block rounded-circle text-center position-relative overflow-hidden"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <img src="{{asset('assets/frontend/img/home2/shape/feature-triangle.svg')}}" alt="triangle" class="position-absolute ft-triangle">
        </div>
<!--        <div class="container mt-80">-->
<!--            <div class="row justify-content-center">-->
<!--                <div class="col-lg-6">-->
<!--                    <div class="hm2-award-title text-center">-->
<!--                        <h2 class="position-relative">Cash Deposite Best Award</h2>-->
<!--                        <p>Our managed hosting guarantees unmatched performance, reliability and choice with 24/7 support that acts</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="award-wrapper mt-20 d-flex align-items-center justify-content-center">-->
<!--                <div class="item-wrapper">-->
<!--                    <img src="{{asset('assets/frontend/img/home2/award-1.png')}}" alt="award" class="img-fluid">-->
<!--                </div>-->
<!--                <div class="item-wrapper">-->
<!--                    <img src="{{asset('assets/frontend/img/home2/award-2.png')}}" alt="award" class="img-fluid">-->
<!--                </div>-->
<!--                <div class="item-wrapper">-->
<!--                    <img src="{{asset('assets/frontend/img/home2/award-3.png')}}" alt="award" class="img-fluid">-->
<!--                </div>-->
<!--                <div class="item-wrapper">-->
<!--                    <img src="{{asset('assets/frontend/img/home2/award-4.png')}}" alt="award" class="img-fluid">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </section>
    <!--feature section end-->

    <!--services section start-->
    <section class="hm2-service-section pt-80 pb-80 overflow-hidden position-relative zindex-1 bg-primary-gradient">
        <img src="{{asset('assets/frontend/img/home2/shape/service-left-circle.svg')}}" alt="circle" class="position-absolute left-top opacity-25">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="service-left">
                        <img src="{{asset('assets/frontend/img/home2/service-left.png')}}" alt="server" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-right">
                        <h2 class="hm2-title">We're Provide Cash Deposit & Withdraw Solutions.</h2>
                        <p class="mt-3">Focus on your business and avoid all the web hosting managed hosting guarantees unmatched performance, reliability and choice with 24/7 support that acts as your extended team guarantees unmatched performance.</p>
                        <div class="hm2-service-tab mt-30 mb-40">
                            <ul class="nav nav-tabs">
                                <li><button class="active" data-bs-toggle="tab" data-bs-target="#domain_service" type="button"><i class="fa-solid fa-globe"></i>Cash Deposite</button></li>
                                <li><button data-bs-toggle="tab" data-bs-target="#hosting_service" type="button"><i class="fa-solid fa-earth-asia"></i>Cash Withdraw</button></li>
                            </ul>
                            <div class="tab-content mt-4">
                                <div class="tab-pane fade show active" id="domain_service">
                                    <p>Focus on your business and avoid all the web hosting hassles. Our managed hosting guarantees unmatched performance, reliability and agencies hosting guarantees unmatched and e-commerce businesses all the web hosting hassles.</p>
                                </div>
                                <div class="tab-pane fade" id="hosting_service">
                                    <p>Focus on your business and avoid all the web hosting hassles. Our managed hosting guarantees unmatched performance, reliability and agencies hosting guarantees unmatched and e-commerce businesses all the web hosting hassles.</p>
                                </div>
                            </div>
                        </div>
                        <a href="service.html" class="template-btn hm2-primary-btn rounded-pill">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{asset('assets/frontend/img/home2/shape/service-right-bottom.svg')}}" alt="wave" class="position-absolute right-bottom">
    </section>








    <!-- services section end-->

    <!--pricing section start-->
{{--    <section class="hm2-pricing-section bg-light pt-120 pb-120 overflow-hidden" id="pricing">--}}
{{--        <div class="container position-relative zindex-1">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-lg-5">--}}
{{--                    <div class="section-title text-center">--}}
{{--                        <h2 class="hm2-title"><mark>Choose</mark> Awesome Plan for Your Needs</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="hm2-pricing-tab text-center mt-4">--}}
{{--                <ul class="nav nav-tabs justify-content-center bg-white deep-shadow">--}}
{{--                    <li><button class="active" data-bs-toggle="tab" data-bs-target="#domainHosting">Domain & Hosting</button></li>--}}
{{--                    <li><button data-bs-toggle="tab" data-bs-target="#privateServer">Private Server</button></li>--}}
{{--                    <li><button data-bs-toggle="tab" data-bs-target="#dedicatedServer">Dedicated Server</button></li>--}}
{{--                </ul>--}}
{{--                <div class="tab-content text-start mt-50">--}}
{{--                    <div class="tab-pane active fade show" id="domainHosting">--}}
{{--                        <div class="row g-4 justify-content-center">--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="pricing-badge position-absolute rounded">--}}
{{--                                        <span>Save 40%</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/starter-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Regular Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$24.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn outline-primary text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="popular-badge position-absolute">--}}
{{--                                        <span>Most Popular</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/light-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Starlight Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$85.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn primary-btn text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="pricing-badge position-absolute rounded">--}}
{{--                                        <span>Save 40%</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/premium-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Premium Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$99.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn outline-primary text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tab-pane fade" id="privateServer">--}}
{{--                        <div class="row g-4 justify-content-center">--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="pricing-badge position-absolute rounded">--}}
{{--                                        <span>Save 40%</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/starter-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Regular Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$75.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn outline-primary text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="popular-badge position-absolute">--}}
{{--                                        <span>Most Popular</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/light-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Starlight Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$105.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn primary-btn text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="pricing-badge position-absolute rounded">--}}
{{--                                        <span>Save 40%</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/premium-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Premium Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$150.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn outline-primary text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="tab-pane fade" id="dedicatedServer">--}}
{{--                        <div class="row g-4 justify-content-center">--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="pricing-badge position-absolute rounded">--}}
{{--                                        <span>Save 40%</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/starter-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Regular Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$70.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn outline-primary text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="popular-badge position-absolute">--}}
{{--                                        <span>Most Popular</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/light-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Starlight Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$100.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn primary-btn text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                <div class="hm2-pricing-single position-relative bg-white deep-shadow rounded-2">--}}
{{--                                    <div class="pricing-badge position-absolute rounded">--}}
{{--                                        <span>Save 40%</span>--}}
{{--                                    </div>--}}
{{--                                    <span class="icon-wrapper">--}}
{{--                                          <img src="{{asset('assets/frontend/img/home2/premium-pack.png')}}" alt="not found" class="img-fluid">--}}
{{--                                      </span>--}}
{{--                                    <h3 class="h5 mt-3">Premium Plans</h3>--}}
{{--                                    <div class="pricing-amount d-flex justify-content-between mt-3 mb-4">--}}
{{--                                        <h4 class="h2 price-title mb-0">$240.<span>99/month</span></h4>--}}
{{--                                        <h6 class="pricing-deleted align-self-end position-relative">$50.99</h6>--}}
{{--                                    </div>--}}
{{--                                    <p>Packed with great features, such as one click software installs,24/7 support.</p>--}}
{{--                                    <ul class="pricing-feature-list mt-4 mb-40">--}}
{{--                                        <li>1 Domain</li>--}}
{{--                                        <li>RAM 1GB</li>--}}
{{--                                        <li>Processor 1 Core</li>--}}
{{--                                        <li>Storage 25GB</li>--}}
{{--                                        <li>Bandwidth 25GB</li>--}}
{{--                                        <li>Bandwidth 1TB</li>--}}
{{--                                    </ul>--}}
{{--                                    <a href="#" class="template-btn outline-primary text-center w-100 rounded-pill">View Plans</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <img src="{{asset('assets/frontend/img/home2/shape/pricing-circle.svg')}}" alt="not found" class="position-absolute pricing-circle">--}}
{{--        </div>--}}
{{--        <div class="container mt-60">--}}
{{--            <div class="hm2-pricing-bottom">--}}
{{--                <ul class="d-flex align-item-center justify-content-center flex-wrap">--}}
{{--                    <li><i class="fa-solid fa-check"></i>24/7 Customer Support</li>--}}
{{--                    <li><i class="fa-solid fa-check"></i>99.9% Uptime</li>--}}
{{--                    <li><i class="fa-solid fa-check"></i>1-click Install</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!--pricing section end-->



    <!--hosting server start-->
    <section class="hosting-server ptb-120 position-relative overflow-hidden light-bg zindex-1">
        <img src="{{asset('assets/frontend/img/shapes/server-bg.png')}}" alt="server-bg" class="position-absolute right-top">
        <img src="{{asset('assets/frontend/img/shapes/server-line-shape.png')}}" alt="line shape" class="position-absolute left-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="section-title text-center">
                        <h2>The Latest Cash Deposit Service</h2>
                    </div>
                </div>
            </div>
            <div class="server-tab mt-50">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="tab-left">
                            <ul class="hm2-server-tab-control nav nav-tabs border-0">
                                <li><button class="active" data-bs-toggle="tab" data-bs-target="#wp-hosting"><i class="fa-brands fa-wordpress"></i><span class="ms-3">bKash Agent</span></button></li>
                                <li><button data-bs-toggle="tab" data-bs-target="#shared-hosting"><i class="fa-solid fa-server"></i><span class="ms-3">bKash Personal</span></button></li>
                                <li><button data-bs-toggle="tab" data-bs-target="#database"><i class="fa-solid fa-database"></i><span class="ms-3">Rocket</span></button></li>
                                <li><button data-bs-toggle="tab" data-bs-target="#cloud-hosting"><i class="fa-solid fa-cloud-meatball"></i><span class="ms-3">Nagod</span></button></li>
                            </ul>
                            <div class="explore-btn mt-30 d-none d-lg-block">
                                <span class="icon-wrapper me-3"><img src="{{asset('assets/frontend/img/shapes/arrow.png')}}" alt="arrow" class="img-fluid"></span>
                                <a href="service.html" class="template-btn secondary-btn rounded-pill">More Services</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content mt-5 mt-lg-0">
                            <div class="tab-pane fade show active" id="wp-hosting">
                                <div class="hm2-server-content">
                                    <img src="{{asset('assets/frontend/img/home2/server.jpg')}}" alt="server" class="img-fluid rounded-2">
                                    <div class="server-info rounded-2 bg-white deep-shadow position-relative">
                                        <h3>Best WordPress Hosting at <br class="d-none d-sm-block">Affordable Price.</h3>
                                        <p class="mb-0 mt-3">Hostim is a WordPress Hosting, whether you use the Website Builder or build and launch truly impressive WordPress websites.</p>
                                        <a href="wp-hosting.html" class="explore-btn position-absolute rounded-circle text-center text-white"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="shared-hosting">
                                <div class="hm2-server-content">
                                    <img src="{{asset('assets/frontend/img/home2/server-2.jpg')}}" alt="server" class="img-fluid rounded-2">
                                    <div class="server-info rounded-2 bg-white deep-shadow position-relative">
                                        <h3>Best Shared Hosting at <br class="d-none d-sm-block">Affordable Price.</h3>
                                        <p class="mb-0 mt-3">Hostim is a Shared Hosting, whether you use the Website Builder or build and launch truly impressive WordPress websites.</p>
                                        <a href="shared-hosting.html" class="explore-btn position-absolute rounded-circle text-center text-white"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="database">
                                <div class="hm2-server-content">
                                    <img src="{{asset('assets/frontend/img/home2/server-3.jpg')}}" alt="server" class="img-fluid rounded-2">
                                    <div class="server-info rounded-2 bg-white deep-shadow position-relative">
                                        <h3>Best Game Server at <br class="d-none d-sm-block">Affordable Price.</h3>
                                        <p class="mb-0 mt-3">Hostim is a Game Sever, whether you use the Website Builder or build and launch truly impressive WordPress websites.</p>
                                        <a href="index-3.html" class="explore-btn position-absolute rounded-circle text-center text-white"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="cloud-hosting">
                                <div class="hm2-server-content">
                                    <img src="{{asset('assets/frontend/img/home2/server-4.jpg')}}" alt="server" class="img-fluid rounded-2">
                                    <div class="server-info rounded-2 bg-white deep-shadow position-relative">
                                        <h3>Best Dedicated Hosting at <br class="d-none d-sm-block">Affordable Price.</h3>
                                        <p class="mb-0 mt-3">Hostim is a Shared Hosting, whether you use the Website Builder or build and launch truly impressive WordPress websites.</p>
                                        <a href="vps-hosting.html" class="explore-btn position-absolute rounded-circle text-center text-white"><i class="fa-solid fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="explore-btn mt-50 d-block d-lg-none">
                            <span class="icon-wrapper me-3"><img src="{{asset('assets/frontend/img/shapes/arrow.png')}}" alt="arrow" class="img-fluid"></span>
                            <a href="service.html" class="template-btn secondary-btn rounded-pill">More Services</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question-box bg-white deep-shadow rounded-2 mt-100">
                <div class="row align-items-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div class="question-box-content">
                            <h3 class="h2">Questions about Cash Deposite</h3>
                            <p>Contact one of our technical experts now. Our team is available chat and is ready to answer any questions you may have.</p>
                            <span class="phone fw-bold d-block mb-30">+90 178 985 478</span>
                            <a href="mailto:someone@example.com" class="template-btn primary-btn btn-small"><i class="fa-solid fa-comments"></i>Live Chat With Experts</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="agent-thumb mb-4 mb-lg-0">
                            <img src="{{asset('assets/frontend/img/home2/agent.png')}}" alt="agent" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hosting server end-->

    <!--data center start-->
    <section class="data-center pt-120 bg-primary-gradient">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2>Our Data Center Location</h2>
                        <p>Choose data centers worldwide to store your content close to your website visitors. Our CDN provider, Cloud flare has a network.</p>
                    </div>
                </div>
            </div>
            <div class="data-center-location mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="map-location position-relative">
                            <img src="{{asset('assets/frontend/img/home2/map.png')}}" alt="map" class="img-fluid">
                            <ul class="ct-location">
                                <li>
                                    <span class="d-none d-md-block">Dhaka</span>
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Canada, USA"></button>
                                </li>
                                <li>
                                    <span class="d-none d-md-block">Cumilla</span>
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="NewYork, USA"></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="NewYork, Russia">
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Canada, USA"></button>
                                </li>
                                <li>
                                    <span class="d-none d-md-block">Vola</span>
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="NewYork, Russia"></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="NewYork, Russia">
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Australia"></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="NewYork, Russia">
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="NewYork, Russia"></button>
                                </li>
                                <li>
                                    <span class="d-none d-md-block">Chattagram</span>
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Australia"></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Africa">
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Africa"></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Africa">
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Africa"></button>
                                </li>
                                <li>
                                    <span class="d-none d-md-block">Benapul</span>
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Africa"></button>
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Africa">
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Germany"></button>
                                </li>
                                <li>
                                    <span class="d-none d-md-block">Germany</span>
                                    <button class="d-block d-md-none" data-bs-toggle="tooltip" data-bs-placement="top" title="Germany"></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--data center end-->


@endsection
@section('script')
@endsection
