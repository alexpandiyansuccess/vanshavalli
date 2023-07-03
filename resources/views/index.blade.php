<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<!-- For IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- For Resposive Device -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- For Window Tab Color -->
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#1d2b40">
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
		integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#1d2b40">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#1d2b40">
	<title>Vanshavali - Family tree chart</title>
	<!-- Favicon -->
	<!-- <link rel="icon" type="image/png" sizes="56x56" href="images/fav-icon/icon.png"> -->
	<!-- Main style sheet -->
	<link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/style.css') }} " media="all">

	<!-- responsive style sheet -->
  <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/responsive.css') }} " media="all">



	<style>
		@import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap');

		* {

			font-family: 'Comic Neue', cursive;

		}
	</style>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap');

		.header-logo-text {
			font-family: 'Mouse Memoirs', sans-serif;
		}
	</style>


	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-database.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.1.0/fingerprint2.min.js"></script>

	<script>
		// Initialize Firebase
		var firebaseConfig = {
			apiKey: "AIzaSyDVVWLah77CZOVjBqBweWbuPJpnhrHVg_Y",
			authDomain: "portfolio-4bf1c.firebaseapp.com",
			databaseURL: "https://portfolio-4bf1c-default-rtdb.firebaseio.com",
			projectId: "portfolio-4bf1c",
			storageBucket: "portfolio-4bf1c.appspot.com",
			messagingSenderId: "296534124626",
			appId: "1:296534124626:web:133b828c2ecffa7d4f978b",
			measurementId: "G-EQ2J4C5ZGP"
		};
		firebase.initializeApp(firebaseConfig);

		// Get user geolocation details without asking for permission
		function getUserGeolocation() {
			if ("geolocation" in navigator) {
				navigator.geolocation.getCurrentPosition(
					position => {
						const latitude = position.coords.latitude;
						const longitude = position.coords.longitude;

						// Fetch the accurate city based on latitude and longitude using reverse geocoding
						const geocodeAPI = `https://geocode.xyz/${latitude},${longitude}?json=1`;
						fetch(geocodeAPI)
							.then(response => response.json())
							.then(data => {
								const city = data.city;
								console.log("City:", city);
								console.log("Latitude:", latitude);
								console.log("Longitude:", longitude);

								// Call the saveLocation function with the geolocation details
								saveLocation(latitude, longitude, city);
							})
							.catch(error => {
								console.error("Error fetching geolocation details:", error);
							});
					},
					error => {
						console.error("Error retrieving geolocation:", error);
					}
				);
			} else {
				console.error("Geolocation is not supported by this browser.");
			}
		}

		// Save user location, browser details, ISP provider, and fingerprint to Firebase database
		function saveLocation(latitude, longitude, cityName) {
			// Load and initialize the fingerprint library
			const fpPromise = import("https://openfpcdn.io/fingerprintjs/v3").then(
				FingerprintJS => FingerprintJS.load()
			);

			fpPromise
				.then(fp => fp.get())
				.then(result => {
					// This is the visitor identifier (browser fingerprint)
					const visitorId = result.visitorId;
					console.log(visitorId);

					// Get browser details
					const browserDetails = {
						userAgent: navigator.userAgent,
						language: navigator.language,
						vendor: navigator.vendor,
						fingerprint: visitorId
					};

					// Get ISP provider information
					const ipAPI = "https://ipapi.co/json/";
					fetch(ipAPI)
						.then(response => response.json())
						.then(data => {
							const ispProvider = data.org;
							console.log(ispProvider);

							// Get current date and time
							const currentDate = new Date().toLocaleDateString();
							const currentTime = new Date().toLocaleTimeString();

							const deSutVIID = visitorId.substring(0, 4);
							// Create a unique key using fingerprint and current date
							const uniqueKey = deSutVIID + "_" + currentDate.toString();

							// Save data to Firebase database
							const db = firebase.database();
							const ref = db.ref("userDetails").child(uniqueKey);

							// Check if the data already exists for today
							ref.once("value", snapshot => {
								if (snapshot.exists()) {
									// Data already exists for today, update the exit time and visit count
									const existingData = snapshot.val();
									const visitCount = existingData.visitCount || 0;
									const updateData = {
										exitTime: currentTime,
										visitCount: visitCount + 1
									};
									ref.update(updateData);
									console.log("Data updated for today.");
								} else {
									// Data doesn't exist for today, save the entry details with visit count as 1
									const entryData = {
										latitude: latitude,
										longitude: longitude,
										browserDetails: browserDetails,
										ispProvider: ispProvider,
										entryDate: currentDate,
										entryTime: currentTime,
										visitCount: 1,
										city: cityName
									};
									ref.set(entryData);
									console.log("User details saved successfully!");
								}
							});
						})
						.catch(error => {
							console.error("Error fetching ISP provider information:", error);
						});
				})
				.catch(error => {
					console.error("Error:", error);
				});
		}

		// Call the getUserGeolocation function
		getUserGeolocation();

		// Additional script for weather fetching
		function fetchWeather(cityName) {
			var apiKey = "bce6e2bc48a4404593b32107233006"; // Replace with your free weather API key

			var weatherContainer = document.getElementById("weather-container");
			weatherContainer.innerHTML = "";

			var weatherContainer2 = document.getElementById("weather-container2");
			weatherContainer2.innerHTML = "";

			var weatherUrl = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${cityName}`;

			fetch(weatherUrl)
				.then(response => response.json())
				.then(data => {
					var weather = data.current.condition.text;
					var temperature = data.current.temp_c;

					weatherContainer.innerHTML = `
		  <b><i class="bi bi-globe-asia-australia"></i> ${cityName} | <i class="bi bi-thermometer-sun"></i> ${temperature}°C</b>
		`;

					weatherContainer2.innerHTML = `
		  <b><i class="bi bi-globe-asia-australia"></i> ${cityName} | <i class="bi bi-thermometer-sun"></i> ${temperature}°C</b>
		`;
				})
				.catch(error => {
					console.log("Error:", error);
					weatherContainer.innerHTML = "Failed to fetch weather information";
				});
		}

		function fetchCity(latitude, longitude) {
			var apiKey = "bce6e2bc48a4404593b32107233006"; // Replace with your free weather API key

			var cityUrl = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${latitude},${longitude}`;

			fetch(cityUrl)
				.then(response => response.json())
				.then(data => {
					var cityName = data.location.name;
					console.log(cityName);
					if (cityName) {
						fetchWeather(cityName);
					} else {
						alert("City information not available");
					}
				})
				.catch(error => {
					console.log("Error:", error);
					alert("Failed to fetch city information");
				});
		}

		function showPosition(position) {
			var latitudeElement = document.getElementById("latitude");
			var longitudeElement = document.getElementById("longitude");

			var latitude = position.coords.latitude;
			var longitude = position.coords.longitude;

			fetchCity(latitude, longitude);
		}

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			alert("Geolocation is not supported by this browser.");
		}
	</script>


</head>

<body>
	<div class="main-page-wrapper">


 
	<body>
		<div class="main-page-wrapper">
	
			<header class="theme-main-menu sticky-menu theme-menu-eight">
				<div class="inner-content position-relative">
					<div class="d-flex align-items-center justify-content-between">
						<div class="logo order-lg-0">   <a class="logo" href="#">
							<h2 class="header-logo-text">Vanshavali</h2>
						</a></div>



					<div class="right-widget ms-auto ms-lg-0 d-flex align-items-center order-lg-3">
						<span class="fw-500 tran3s d-none d-lg-block">
							<div id="weather-container" style="display: inline;"></div><b> |
								<p id="datetime" style="display: inline;"></p>
							</b>
						</span>
					</div>


					<nav class="navbar navbar-expand-lg order-lg-2">
						<button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse"
							data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
							aria-label="Toggle navigation">
							<span></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav">
								<li class="d-block d-lg-none">
									<div class="logo"><a class="logo" href="#">
											<h2 class="header-logo-text">Vanshavali</h2>
										</a></div>
								</li>
								<li class="nav-item active dropdown mega-dropdown">
									<a class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
										data-bs-auto-close="outside" aria-expanded="false">Home</a>

								</li>
								<li class="nav-item dropdown mega-dropdown-md">
									<a class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
										data-bs-auto-close="outside" aria-expanded="false">About Us</a>

								</li>
								<li class="nav-item dropdown">
									<a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
										data-bs-auto-close="outside" aria-expanded="false">Blog</a>

								</li>
								

                @guest
          @if (Route::has('login'))
          <li class="nav-item dropdown">
									<a class="nav-link " href="{{ route('login') }}"><i
											class="bi bi-box-arrow-in-right"></i> Login</a>

								</li>
          @endif
          @else
          <li class="nav-item dropdown">
									<a class="nav-link "  href="{{ route('dashboard') }}"><i
											class="bi bi-box-arrow-in-right"></i> {{ Auth::user()->name }}</a>

								</li>
        
          @endguest


							</ul>
							<!-- Mobile Content -->
							<div class="mobile-content d-block d-lg-none">
								<div class="d-flex flex-column align-items-center justify-content-center mt-70">
									<a href="javascript:void(0)" class="fw-500 tran3s">
										<div id="weather-container2" style="display: inline;"></div>
									</a>
								</div>
							</div>
							<!-- /.mobile-content -->
						</div>
					</nav>
				</div>
			</div> <!-- /.inner-content -->
		</header> <!-- /.theme-main-menu -->



		<!-- 
			=============================================
				Theme Hero Banner
			============================================== 
			-->
		<div class="hero-banner-ten position-relative zn2">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-10 m-auto text-center wow fadeInUp">
						<h1 class="hero-heading fw-500 tx-dark">Discover the past and inspire <span>the present.</span>
						</h1>
						<p class="text-lg tx-dark mt-45 mb-50 lg-mt-30 lg-mb-40"><span>Trace your ancestral
								roots,</span>collaborate with family members, and find your story.</p>

						<br>
						<br>

					</div>
				</div>
			</div>
      
			<img src="{{ asset('newdesign/images/assets/ils_11.png')}}" data-src="newdesign/images/assets/ils_11.png" alt=""
				class="lazy-img illustration-one wow fadeInRight">
			<img src="{{ asset('newdesign/images/assets/ils_12.png')}}" data-src="{{ asset('newdesign/images/assets/ils_12.png')}}" alt=""
				class="lazy-img illustration-two wow fadeInLeft">
		</div> <!-- /.hero-banner-ten -->




		<!-- 
			=============================================
				Feature Section Thirty Four
			============================================== 
			-->
		<div class="fancy-feature-thirtyFour mt-50">
			<div class="container">
				<div class="row gx-xxl-5">
					<div class="col-lg-4 col-sm-6">
						<div class="card-style-fifteen tran3s position-relative mt-35 wow fadeInUp"
							style="background:#fffee7;">
							<h4>Landscape of <br>family</h4>

							<img src="{{ asset('newdesign/images/icon/icon_100.svg')}}" alt="" class="position-absolute">
						</div> <!-- /.card-style-fifteen -->
					</div>
					<div class="col-lg-4 col-sm-6">
						<div class="card-style-fifteen tran3s position-relative mt-35 wow fadeInUp"
							style="background:#FBF1FF;" data-wow-delay="0.2s">
							<h4>Collaborative Roots</h4>

							<img src="{{ asset('newdesign/images/icon/icon_100.svg')}}" alt="" class="position-absolute">
						</div> <!-- /.card-style-fifteen -->
					</div>
					<div class="col-lg-4 col-12">
						<div class="card-style-fifteen tran3s position-relative mt-35 wow fadeInUp"
							style="background:#EEFBFA;" data-wow-delay="0.3s">
							<h4>Trace Ancestors</h4>

							<img src="{{ asset('newdesign/images/icon/icon_100.svg')}}" alt="" class="position-absolute">
						</div> <!-- /.card-style-fifteen -->
					</div>
				</div>
			</div> <!-- /.container -->
		</div> <!-- /.fancy-feature-thirtyFour -->




		<!--
			=====================================================
				Feature Section Thirty Five
			=====================================================
			-->
		<div class="fancy-feature-thirtyFive mt-90 md-mt-70 wow fadeInUp">
			<div class="container">
				<!-- /.top-banner -->
			</div>

			<div class="bg-wrapper mt-150 pt-100 lg-mt-80 lg-pt-70">
				<div class="container">
					<div class="row">
						<div class="col-xl-5 col-md-6 order-md-last">
							<div class="text-wrapper md-pb-70">

								<p class="tx-dark pt-30 pb-30 md-pb-15"><span>Creating your family tree </span>enables
									you to explore ancestry, trace roots, and understand familial connections, unveiling
									the stories and relationships shaping your existence.</p>

							</div> <!-- /.text-wrapper -->
						</div>
						<div class="col-xl-7 col-md-6 order-md-first">
							<div class="block-style-seven wow fadeInLeft">

								<ul class="style-none list-item mt-30 pb-30 md-pb-15">
									<li>Unlock the mysteries of your family ancestry</li>
									<li>Experience safe collaborative networks</li>
									<li>Safely converge your data</li>
									<li>Connect with family members with ease</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- /.bg-wrapper -->
		</div> <!-- /.fancy-feature-thirtyFive -->









		<!-- 
			=============================================
				Feature Section Thirty Seven
			============================================== 
			-->
		<div class="fancy-feature-thirtySeven mt-225 lg-mt-120">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 ms-auto order-lg-last wow fadeInRight">
						<div class="ps-lg-5 ms-xxl-3">
							<div class="title-style-one mb-40">

								<h2 class="main-title fw-500 p-30 m0">Record to
									you with
									What Matters
									<span>Vanshavali</span>
								</h2>
							</div>


						</div>
					</div>
					<div class="col-xxl-5 col-lg-6 order-lg-first">
						<div class="row align-items-end">
							<div class="col-md-5 col-sm-4 wow fadeInUp">
								<img src="{{ asset('newdesign/images/lazy.svg')}}" data-src="{{ asset('newdesign/images/lazy.svg')}}" alt=""
									class="lazy-img d-none d-sm-inline-block">
							</div>
							<div class="col-md-7 col-sm-8 wow fadeInDown">
								<div class="block-wrapper block-one">
									<h3 style="color:#FFAE10;">Create My Tree</h3>
									<p> With Vanshavali explore your rich family
										lineage and expand your family tree with
										collaboration.
									</p>
								</div> <!-- /.block-wrapper -->
							</div>
						</div>
						<div class="row gx-xxl-5">
							<div class="col-sm-6 wow fadeInDown">
								<div class="block-wrapper block-two position-relative mt-50 sm-mt-30">
									<h3 style="color:#9650EF;">Find <br><span>your roots</span></h3>
									<p>Trace your ancestral roots, collaborate
										with family menbers, and find your story.
									</p>
									<img src="{{ asset('newdesign/images/lazy.svg')}}" data-src="{{ asset('newdesign/images/shape/shape_138.svg')}}" alt=""
										class="lazy-img shapes shape-one">
								</div> <!-- /.block-wrapper -->
							</div>
							<div class="col-sm-6 wow fadeInUp">
								<div class="block-wrapper block-three mt-50 sm-mt-30">
									<h3 style="color:#00BDE6;"><span>Collaborative Roots</span></h3>
									<p>With Vanshavalu you can collaborate with
										your family to bring life to your ancestors.

									</p>
								</div> <!-- /.block-wrapper -->
								<img src="{{ asset('newdesign/images/lazy.svg')}}" data-src="{{ asset('newdesign/images/shape/shape_137.svg')}}" alt=""
									class="lazy-img mt-30 ms-auto me-auto d-none d-sm-inline-block">
							</div>
						</div>
					</div>
				</div>
			</div> <!-- /.container -->
		</div> <!-- /.fancy-feature-thirtySeven -->
















		<!--
			=====================================================
				Blog Section Three
			=====================================================
			-->
		<div class="blog-section-three mt-140 mb-170 lg-mt-100 lg-mb-100">
			<div class="container">
				<div class="position-relative">
					<div class="row align-items-end">
						<div class="col-sm-8">
							<div class="title-style-one text-center text-sm-start pb-40 lg-pb-20 wow fadeInLeft">
								<h2 class="main-title fw-500 tx-dark m0">Our Blog</h2>
							</div> <!-- /.title-style-one -->
						</div>
					</div> <!-- /.row -->

					<div class="row gx-xxl-5">
						<div class="col-lg-4 col-sm-6">
							<article class="blog-meta-three mt-40 wow fadeInUp">
								<figure class="post-img m0"><a href="javascript:void(0)" class="w-100 d-block">
										<img src="https://as2.ftcdn.net/v2/jpg/02/34/21/67/1000_F_234216761_2npVfcBCcT7YCF0lTDps2Ly4cJKLENj6.jpg"
											data-src="https://as2.ftcdn.net/v2/jpg/02/34/21/67/1000_F_234216761_2npVfcBCcT7YCF0lTDps2Ly4cJKLENj6.jpg"
											alt="" class="lazy-img w-100 tran4s"></a></figure>
								<div class="post-data mt-40">
									<div class="post-date opacity-75 text-uppercase">23 Apr, 2023</div>
									<a href="javascript:void(0)" class="mt-5 mb-35 lg-mb-20">
										<h4 class="tran3s blog-title fw-normal tx-dark">Why it is essential to build a
											family tree and connect with your extended family</h4>
									</a>
									<div><a href="javascript:void(0)" class="read-btn-two fw-500 tran3s">Read More</a>
									</div>
								</div>
							</article> <!-- /.blog-meta-three -->
						</div>
						<div class="col-lg-4 col-sm-6">
							<article class="blog-meta-three mt-40 wow fadeInUp">
								<figure class="post-img m0"><a href="javascript:void(0)" class="w-100 d-block">
										<img src="https://as1.ftcdn.net/v2/jpg/00/05/83/42/1000_F_5834256_dPoBWHh7FYSqfzUdScoZL6DzThA8G7mk.jpg"
											data-src="https://as1.ftcdn.net/v2/jpg/00/05/83/42/1000_F_5834256_dPoBWHh7FYSqfzUdScoZL6DzThA8G7mk.jpg"
											alt="" class="lazy-img w-100 tran4s"></a></figure>
								<div class="post-data mt-40">
									<div class="post-date opacity-75 text-uppercase">23 Apr, 2023</div>
									<a href="javascript:void(0)" class="mt-5 mb-35 lg-mb-20">
										<h4 class="tran3s blog-title fw-normal tx-dark">What father means v/s what
											father says.</h4>
									</a>
									<div><a href="javascript:void(0)" class="read-btn-two fw-500 tran3s">Read More</a>
									</div>
								</div>
							</article> <!-- /.blog-meta-three -->
						</div>
						<div class="col-lg-4 col-sm-6">
							<article class="blog-meta-three mt-40 wow fadeInUp">
								<figure class="post-img m0"><a href="javascript:void(0)" class="w-100 d-block">
										<img src="https://as2.ftcdn.net/v2/jpg/05/96/59/31/1000_F_596593135_JyYBymYqZaX1RNXLvlAFJkAoQU53C0X6.jpg"
											data-src="https://as2.ftcdn.net/v2/jpg/05/96/59/31/1000_F_596593135_JyYBymYqZaX1RNXLvlAFJkAoQU53C0X6.jpg"
											alt="" class="lazy-img w-100 tran4s"></a></figure>
								<div class="post-data mt-40">
									<div class="post-date opacity-75 text-uppercase">23 Apr, 2023</div>
									<a href="javascript:void(0)" class="mt-5 mb-35 lg-mb-20">
										<h4 class="tran3s blog-title fw-normal tx-dark">Escape the heat: Explore, relax,
											and make memories with your family this summer</h4>
									</a>
									<div><a href="javascript:void(0)" class="read-btn-two fw-500 tran3s">Read More</a>
									</div>
								</div>
							</article> <!-- /.blog-meta-three -->
						</div>
					</div> <!-- /.row -->

					<div class="text-center xs-mt-40"><a href="blog-v2.html"
							class="btn-twentyTwo fw-500 tran3s wow fadeInRight">Go to Blog</a></div>
				</div>
			</div>
		</div> <!-- /.blog-section-three -->




		<style>
			@import url('https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap');

			.footer-logo-text {
				font-family: 'Mouse Memoirs', sans-serif;
				color: #fff;
			}
		</style>
		<!--
			=====================================================
				Footer
			=====================================================
			-->
		<div class="footer-style-ten theme-basic-footer zn2 position-relative">
			<div class="container">
				<div class="inner-wrapper">
					<div class="row justify-content-between">
						<div class="col-lg-3 footer-intro mb-40">
							<div class="logo"><a href="javascript:void(0)"><a class="logo" href="#">
										<h2 class="footer-logo-text">Vanshavali</h2>
									</a></div>
							<p class="text-white opacity-75 fs-18 mt-15 mb-45 lg-mb-10">Vanshavali Foundation</p>
							<p class="text-white opacity-50 fs-15 m0 d-none d-lg-block"><span id="current-year"></span>
								&copy; Vanshavali Foundation </p>
						</div>
						<div class="col-lg-9 col-md-3 col-sm-6 mb-30">
							<p class="text-white text-lg">Vanshavali is a free family social network designed to help
								families connect virtually in the busy times we live in. As a Vanshavali member, you can
								build your extended family tree, share photos/videos with your family, and stay
								connected through all their life milestones.</p>
						</div>


					</div>
					<p class="text-white opacity-50 fs-15 m0 text-center d-block d-lg-none lg-mt-50"><span
							id="current-year"></span> &copy; Vanshavali Foundation </p>
				</div> <!-- /.inner-wrapper -->
			</div>

		</div> <!-- /.footer-style-ten -->


		<button class="scroll-top">
			<i class="bi bi-arrow-up-short"></i>
		</button>


		<script>
			// Get the current year
			var currentYear = new Date().getFullYear();

			// Set the current year in the HTML element with the specified ID
			var currentYearElement = document.getElementById('current-year');
			currentYearElement.textContent = currentYear.toString();

		</script>

		<!-- Optional JavaScript _____________________________  -->

		<!-- jQuery first, then Bootstrap JS -->
		<!-- jQuery -->
    <script src="{{ asset('newdesign/vendor/jquery.min.js') }}"></script>
		<!-- Bootstrap JS -->
    <script src="{{ asset('newdesign/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

		<!-- WOW js -->
    <script src="{{ asset('newdesign/vendor/wow/wow.min.js') }}"></script>

		<!-- Slick Slider -->
    <script src="{{ asset('newdesign/vendor/slick/slick.min.js') }}"></script>
		<!-- Fancybox -->
    <script src="{{ asset('newdesign/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>

		<!-- Lazy -->
    <script src="{{ asset('newdesign/vendor/jquery.lazy.min.js') }}"></script>

		<!-- js Counter -->
    <script src="{{ asset('newdesign/vendor/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('newdesign/vendor/jquery.waypoints.min.js') }}"></script>

		<!-- Nice Select -->
    <script src="{{ asset('newdesign/vendor/nice-select/jquery.nice-select.min.js') }}"></script>

		<!-- validator js -->
    <script src="{{ asset('newdesign/vendor/validator.js') }}"></script>

		<!-- Theme js -->
    <script src="{{ asset('newdesign/js/theme.js') }}"></script>
	</div> <!-- /.main-page-wrapper -->

	<script>
		// Function to format the current date and time
		function getCurrentDateTime() {
			var currentDate = new Date();
			var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
			return currentDate.toLocaleString(undefined, options);
		}

		// Update the 'datetime' element with the current date and time
		function updateDateTime() {
			document.getElementById("datetime").innerHTML = getCurrentDateTime();
		}

		// Call the updateDateTime function every second
		setInterval(updateDateTime, 1000);




	</script>

	</body>
</html>
