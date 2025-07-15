<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>BSPP Navigation</title>
		<link rel="stylesheet" href="{{ asset("website/output.css") }}" />
		<link
			href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap"
			rel="stylesheet" />
		<style>
			.font-sora {
				font-family: "Sora", sans-serif;
			}
			.font-jaka {
				font-family: "Sora", sans-serif;
			}
			.current-page {
				position: relative;
			}
			.current-page::after {
				content: "";
				position: absolute;
				bottom: -8px;
				left: 50%;
				transform: translateX(-50%);
				width: 100%;
				height: 3px;
				background: #02611a;
				border-radius: 2px;
			}
			.mobile-current-page {
				background-color: #f0f9ff;
				border-left: 4px solid #02611a;
				color: #02611a;
			}
		</style>
	</head>
	<body class="bg-gray-50">
		<header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm">
			<div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div class="flex items-center justify-between h-20">
					<!-- Logo and Brand -->
					<div class="flex items-center space-x-4">
						<div class="flex-shrink-0">
							<div class="flex items-center justify-center w-16 h-16 rounded-full">
								<img src="{{ asset("website/assets/images/benue-logo.png") }}" alt="" />
							</div>
						</div>
						<div
							class="hidden sm:block text-[#232323] font-normal text-[11px] tracking-normal font-jaka leading-[120%]">
							<p>Benue State</p>
							<p>Procurement and Project</p>
							<p>Management System</p>
						</div>
						<!-- Mobile brand text -->
						<div class="sm:hidden">
							<div class="text-base font-bold text-gray-900">BSPP</div>
							<div class="text-sm text-gray-600">Procurement System</div>
						</div>
					</div>

					<!-- Desktop Navigation -->
					<nav class="items-center hidden space-x-2 lg:flex">
						<a
							href="/"
							data-page="home"
							class="nav-link hover:text-primary transition-colors duration-200 px-3 py-2 rounded-md hover:bg-gray-50 font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#232323]">
							Home
						</a>
						<a
							href="/about"
							data-page="about"
							class="nav-link hover:text-primary transition-colors duration-200 px-3 py-2 rounded-md hover:bg-gray-50 font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#232323]">
							About Us
						</a>
						<a
							href="/tenders"
							data-page="tenders"
							class="nav-link hover:text-primary transition-colors duration-200 px-3 py-2 rounded-md hover:bg-gray-50 font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#232323]">
							Tenders
						</a>
						<a
							href="/awards"
							data-page="awards"
							class="nav-link hover:text-primary transition-colors duration-200 px-3 py-2 rounded-md hover:bg-gray-50 font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#232323]">
							Awards
						</a>

						<!-- Media dropdown -->
						<div class="relative group">
							<button
								class="nav-link hover:text-primary flex items-center hover:text-primary transition-colors duration-200 px-3 py-2 rounded-md hover:bg-gray-50 font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#232323]"
								data-page="media">
								Media
								<svg
									class="w-4 h-4 ml-2 transition-transform duration-200 group-hover:rotate-180"
									fill="none"
									stroke="currentColor"
									viewBox="0 0 24 24">
									<path
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M19 9l-7 7-7-7"></path>
								</svg>
							</button>

							<!-- Enhanced dropdown menu -->
							<div
								class="absolute left-0 z-20 invisible w-56 mt-2 transition-all duration-300 transform translate-y-2 bg-white border border-gray-100 shadow-lg opacity-0 rounded-xl group-hover:opacity-100 group-hover:visible group-hover:translate-y-0">
								<div class="py-2">
									<a
										href="/news"
										data-page="news"
										class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 dropdown-link hover:bg-green-600 hover:text-white">
										<svg
											class="w-4 h-4 mr-3"
											fill="none"
											stroke="currentColor"
											viewBox="0 0 24 24">
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
										</svg>
										News & Updates
									</a>
									<a
										href="/press"
										data-page="press"
										class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 dropdown-link hover:bg-green-600 hover:text-white">
										<svg
											class="w-4 h-4 mr-3"
											fill="none"
											stroke="currentColor"
											viewBox="0 0 24 24">
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
										</svg>
										Press Releases
									</a>
									<a
										href="/resources"
										data-page="resources"
										class="flex items-center px-4 py-3 text-sm text-gray-700 transition-colors duration-200 dropdown-link hover:bg-green-600 hover:text-white">
										<svg
											class="w-4 h-4 mr-3"
											fill="none"
											stroke="currentColor"
											viewBox="0 0 24 24">
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
										</svg>
										Resource Center
									</a>
								</div>
							</div>
						</div>

						<a
							href="/contact"
							data-page="contact"
							class="nav-link hover:text-primary transition-colors duration-200 px-3 py-2 rounded-md hover:bg-gray-50 font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#232323]">
							Contact
						</a>
					</nav>

					<!-- Action Buttons -->
					<div class="flex items-center space-x-4">
						<!-- Get Started Button -->

						<div>
							<a
								href="/register"
								class="bg-green-800 hover:bg-green-600 text-white px-6 py-2.5 rounded-full transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 font-jaka font-normal text-[16px] leading-[24.4px] tracking-[0%]"
								>Get Started</a
							>
						</div>

						<!-- Mobile menu button -->
						<button
							type="button"
							class="flex items-center justify-center w-10 h-10 text-gray-700 transition-colors duration-200 rounded-lg lg:hidden hover:text-green-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50"
							onclick="toggleMobileMenu()">
							<svg
								id="menu-icon"
								class="w-6 h-6"
								fill="none"
								stroke="currentColor"
								viewBox="0 0 24 24">
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M4 6h16M4 12h16M4 18h16"></path>
							</svg>
							<svg
								id="close-icon"
								class="hidden w-6 h-6"
								fill="none"
								stroke="currentColor"
								viewBox="0 0 24 24">
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M6 18L18 6M6 6l12 12"></path>
							</svg>
						</button>
					</div>
				</div>
			</div>

			<!-- Enhanced Mobile menu -->
			<div
				id="mobile-menu"
				class="hidden bg-white border-t border-gray-200 lg:hidden">
				<div class="px-4 pt-4 pb-6 space-y-2">
					<a
						href="/"
						data-page="home"
						class="block px-4 py-3 text-base font-medium text-gray-700 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
						Home
					</a>
					<a
						href="/about"
						data-page="about"
						class="block px-4 py-3 text-base font-medium text-gray-700 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
						About Us
					</a>
					<a
						href="/tenders"
						data-page="tenders"
						class="block px-4 py-3 text-base font-medium text-gray-700 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
						Tenders
					</a>
					<a
						href="/awards"
						data-page="awards"
						class="block px-4 py-3 text-base font-medium text-gray-700 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
						Awards
					</a>

					<!-- Mobile Media submenu -->
					<div class="space-y-1">
						<button
							onclick="toggleMobileSubmenu()"
							data-page="media"
							class="flex items-center justify-between w-full px-4 py-3 text-base font-medium text-gray-700 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
							Media
							<svg
								id="submenu-arrow"
								class="w-5 h-5 transition-transform duration-200"
								fill="none"
								stroke="currentColor"
								viewBox="0 0 24 24">
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M19 9l-7 7-7-7"></path>
							</svg>
						</button>
						<div id="mobile-submenu" class="hidden pl-4 space-y-1">
							<a
								href="/news"
								data-page="news"
								class="block px-4 py-2 text-sm text-gray-600 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
								News & Updates
							</a>
							<a
								href="/press"
								data-page="press"
								class="block px-4 py-2 text-sm text-gray-600 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
								Press Releases
							</a>
							<a
								href="/resources"
								data-page="resources"
								class="block px-4 py-2 text-sm text-gray-600 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
								Resource Center
							</a>
						</div>
					</div>

					<a
						href="/contact"
						data-page="contact"
						class="block px-4 py-3 text-base font-medium text-gray-700 transition-colors duration-200 rounded-lg mobile-nav-link hover:text-green-600 hover:bg-gray-50">
						Contact
					</a>

					<div class="pt-4 border-t border-gray-200">
						<button
							class="w-full px-6 py-3 text-base font-semibold text-white transition-all duration-200 bg-green-800 rounded-lg shadow-md">
							<a href="/register">Get Started</a>
						</button>
					</div>
				</div>
			</div>
		</header>

		<main>
			<!-- Hero Section with Full-width Stats -->
			<section class="relative bg-[#4BA35A] text-white overflow-hidden">
				<!-- Background Image with Overlay -->
				<div class="absolute inset-0">
					<img
						src="{{ asset("website/assets/images/image-1.png")}}"
						alt="Contractors"
						class="object-cover w-full h-full opacity-90" />
					<div class="absolute inset-0"></div>
				</div>

				<!-- Hero Content -->
				<div class="relative z-10 max-w-6xl px-6 pt-24 pb-40 mx-auto text-center">
					<h1
						class="font-sora font-bold text-3xl md:text-5xl leading-[120%] tracking-[0% text-[#FFFFFF]">
						Transparent Procurement<br />for a Better Benue
					</h1>
					<p
						class="mt-4 text-base md:text-[19px] text-white/90 max-w-xl mx-auto leading-[120%] tracking-[0% text-[#FFFFFF] font-sora font-normal">
						Access government tenders, register as a contractor, and track your
						applications
					</p>

					<!-- Buttons -->
					<div class="flex flex-col justify-center gap-4 mt-8 sm:flex-row">
						<a
							href="#"
							class="px-6 py-3 bg-green-800 text-white rounded-full hover:bg-gray-100 transition hover:text-green-800 font-jaka font-normal font-base leading-[22.4px]">
							View Tenders
						</a>
						<a
							href="/register"
							class="px-6 py-3 bg-white/20 border border-white text-[#FFFFFF] rounded-full hover:bg-white hover:text-green-800 transition font-jaka font-normal font-base leading-[22.4px]">
							Become a Contractor →
						</a>
					</div>
				</div>

				<!-- Full-width Stats Section -->
				<div class="relative z-10 w-full">
					<div
						class="bg-[#FFFFFFCC] backdrop-blur-md rounded-t-[80px] shadow-md py-8 px-6 md:px-20 flex flex-col md:flex-row justify-center items-center gap-6 md:gap-24 text-center">
						<div>
							<p
								class="text-[33px] font-sora font-normal leading-[120%] tracking-[0%] text-green-800">
								3000+
							</p>
							<p
								class="mt-1 font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#232323]">
								Registered Contractors
							</p>
						</div>
						<div>
							<p
								class="text-[33px] font-sora font-normal leading-[120%] tracking-[0%] text-green-800">
								100+
							</p>
							<p
								class="mt-1 font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text text-[#232323]">
								Active Tenders
							</p>
						</div>
						<div>
							<p
								class="text-[33px] font-sora font-normal leading-[120%] tracking-[0%] text-green-800">
								₦57.6bn+
							</p>
							<p
								class="mt-1 font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text text-[#232323]">
								Value of Awards
							</p>
						</div>
					</div>
				</div>
			</section>

			<section class="max-w-5xl mx-auto mt-24">
				<h2
					class="font-sora font-bold text-[40px] leading-[120%] tracking-normal mb-2 text-[#232323]">
					Recent Tenders
				</h2>
				<p
					class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#535353] mb-6">
					Stay informed on the most recent open tender

					<!-- Tender Card -->
				</p>

				<div class="space-y-6">
					<!-- Card 1 -->
					<div class="flex flex-col overflow-hidden bg-white rounded-lg md:flex-row">
						<div class="md:w-3/4 p-6 border-[1px] border-gray-300">
							<h3
								class="font-sora font-bold text-[23px] leading-[120%] tracking-[0%] text-[#535353] mb-1">
								Road Rehabilitation in Gboko LGA
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494] mb-4 max-w-xl">
								Rehabilitation of key access roads in Gboko LGA to improve rural
								mobility and logistics, including grading, drainage, and resurfacing.
							</p>
							<div
								class="flex flex-col mb-4 sm:flex-row sm:items-center gap-x-8 gap-y-3">
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Deadline:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										30 June 2025
									</p>
								</div>
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Contract Category:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										Civil Engineering / Road Construction
									</p>
								</div>
							</div>
							<button
								class="inline-flex items-center gap-2 bg-[#535353] text-white px-4 py-2 rounded hover:bg-gray-700 font-jaka text-base leading-[22.4px] tracking-[0%] font-normal">
								Apply Now
								<span>
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
										alt=""
										class="w-4 h-4" />
								</span>
							</button>
						</div>
						<div class="md:w-1/4">
							<img
								src="{{ asset("website/assets/images/road.png")}}"
								alt="Road Rehabilitation"
								class="object-cover w-full h-full" />
						</div>
					</div>

					<!-- Card 2 -->
					<div class="flex flex-col overflow-hidden bg-white rounded-lg md:flex-row">
						<div class="md:w-3/4 p-6 border-[1px] border-gray-300">
							<h3
								class="font-sora font-bold text-[23px] leading-[120%] tracking-[0%] text-[#535353] mb-1">
								Supply of Medical Equipment to General Hospitals
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494] mb-4 max-w-xl">
								Procurement and delivery of surgical and diagnostic medical equipment to
								general hospitals across Benue State.
							</p>
							<div
								class="flex flex-col mb-4 sm:flex-row sm:items-center gap-x-8 gap-y-3">
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Deadline:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										15 July 2025
									</p>
								</div>
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Contract Category:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										Medical Equipment Suppliers / Biomedical Engineering
									</p>
								</div>
							</div>
							<button
								class="inline-flex items-center gap-2 bg-[#535353] text-white px-4 py-2 rounded hover:bg-gray-700 font-jaka text-base leading-[22.4px] tracking-[0%] font-normal">
								Apply Now
								<span>
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
										alt=""
										class="w-4 h-4" />
								</span>
							</button>
						</div>
						<div class="md:w-1/4">
							<img
								src="{{ asset("website/assets/images/hospital.png")}}"
								alt="Road Rehabilitation"
								class="object-cover w-full h-full" />
						</div>
					</div>

					<!-- Card 3 -->
					<div class="flex flex-col overflow-hidden bg-white rounded-lg md:flex-row">
						<div class="md:w-3/4 p-6 border-[1px] border-gray-300">
							<h3
								class="font-sora font-bold text-[23px] leading-[120%] tracking-[0%] text-[#535353] mb-1">
								Construction of Boreholes in Rural Communities
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494] mb-4 max-w-xl">
								Drilling and installation of solar-powered boreholes in 25 rural
								communities to provide access to clean water.
							</p>
							<div
								class="flex flex-col mb-4 sm:flex-row sm:items-center gap-x-8 gap-y-3">
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Deadline:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										25 May 2025
									</p>
								</div>
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Contract Category:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										Water Engineering / Borehole Drilling Services
									</p>
								</div>
							</div>
							<button
								class="inline-flex items-center gap-2 bg-[#535353] text-white px-4 py-2 rounded hover:bg-gray-700 font-jaka text-base leading-[22.4px] tracking-[0%] font-normal">
								Apply Now
								<span>
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
										alt=""
										class="w-4 h-4" />
								</span>
							</button>
						</div>
						<div class="md:w-1/4">
							<img
								src="{{ asset("website/assets/images/borehole.png")}}"
								alt="Road Rehabilitation"
								class="object-cover w-full h-full" />
						</div>
					</div>
					<div class="flex flex-col overflow-hidden bg-white rounded-lg md:flex-row">
						<div class="md:w-3/4 p-6 border-[1px] border-gray-300">
							<h3
								class="font-sora font-bold text-[23px] leading-[120%] tracking-[0%] text-[#535353] mb-1">
								Construction of Boreholes in Rural Communities
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494] mb-4 max-w-xl">
								Drilling and installation of solar-powered boreholes in 25 rural
								communities to provide access to clean water.
							</p>
							<div
								class="flex flex-col mb-4 sm:flex-row sm:items-center gap-x-8 gap-y-3">
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Deadline:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										25 May 2025
									</p>
								</div>
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Contract Category:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										Water Engineering / Borehole Drilling Services
									</p>
								</div>
							</div>
							<button
								class="inline-flex items-center gap-2 bg-[#535353] text-white px-4 py-2 rounded hover:bg-gray-700 font-jaka text-base leading-[22.4px] tracking-[0%] font-normal">
								Apply Now
								<span>
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
										alt=""
										class="w-4 h-4" />
								</span>
							</button>
						</div>
						<div class="md:w-1/4">
							<img
								src="{{ asset("website/assets/images/borehole.png")}}"
								alt="Road Rehabilitation"
								class="object-cover w-full h-full" />
						</div>
					</div>
					<div class="flex flex-col overflow-hidden bg-white rounded-lg md:flex-row">
						<div class="md:w-3/4 p-6 border-[1px] border-gray-300">
							<h3
								class="font-sora font-bold text-[23px] leading-[120%] tracking-[0%] text-[#535353] mb-1">
								Construction of Boreholes in Rural Communities
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494] mb-4 max-w-xl">
								Drilling and installation of solar-powered boreholes in 25 rural
								communities to provide access to clean water.
							</p>
							<div
								class="flex flex-col mb-4 sm:flex-row sm:items-center gap-x-8 gap-y-3">
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Deadline:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										25 May 2025
									</p>
								</div>
								<div>
									<p
										class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#949494]">
										Contract Category:
									</p>
									<p
										class="font-sora font-normal text-[19px] leading-[26.6px] tracking-[0%] text-[#535353]">
										Water Engineering / Borehole Drilling Services
									</p>
								</div>
							</div>
							<button
								class="inline-flex items-center gap-2 bg-[#535353] text-white px-4 py-2 rounded hover:bg-gray-700 font-jaka text-base leading-[22.4px] tracking-[0%] font-normal">
								Apply Now
								<span>
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
										alt=""
										class="w-4 h-4" />
								</span>
							</button>
						</div>
						<div class="md:w-1/4">
							<img
								src="{{ asset("website/assets/images/borehole.png")}}"
								alt="Road Rehabilitation"
								class="object-cover w-full h-full" />
						</div>
					</div>
				</div>
			</section>

			<section class="px-16 py-12 mx-auto text-center max-w-7xl">
				<h2
					class="text-2xl font-sora font-bold md:text-[40px] leading-[120%] tracking-normal mb-2 text-[#232323]">
					How it works
				</h2>
				<p
					class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#535353] mb-6">
					Step-by-step direction on how to bid for tenders
				</p>

				<div class="grid gap-6 md:gap-8 md:grid-cols-3">
					<!-- Card 1 -->
					<div class="overflow-hidden bg-white shadow-sm rounded-xl">
						<img
							src="{{ asset("website/assets/images/how-it-work.png")}}"
							alt="Step 3"
							class="object-cover w-full h-48" />
						<div class="p-6 text-left">
							<div
								class="p-1 rounded-[12px] bg-[#D0FFDC] flex w-16 h-6 items-center justify-center text-center">
								<p
									class="font-sora font-normal text-[13px] leading-[120%] tracking-[0%] text-[#02611A] whitespace-nowrap">
									STEP 1
								</p>
							</div>

							<h3
								class="font-sora font-bold text-[19px] leading-[120%] tracking-[0%] text-[#535353] mb-2">
								Create an Account to Get Started
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#535353]">
								Fill in your company details and create a secure account to access
								tender opportunities.
							</p>
						</div>
					</div>

					<!-- Card 2 -->
					<div class="overflow-hidden bg-white shadow-sm rounded-xl">
						<img
							src="{{ asset("website/assets/images/how-it-work.png")}}"
							alt="Step 3"
							class="object-cover w-full h-48" />
						<div class="p-6 text-left">
							<div
								class="p-1 rounded-[12px] bg-[#D0FFDC] flex w-16 h-6 items-center justify-center text-center">
								<p
									class="font-sora font-normal text-[13px] leading-[120%] tracking-[0%] text-[#02611A] whitespace-nowrap">
									STEP 2
								</p>
							</div>
							<h3
								class="font-sora font-bold text-[19px] leading-[120%] tracking-[0%] text-[#535353] mb-2">
								Ensure Compliance with Procurement Standards
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#535353]">
								Upload your CAC Certificate, tax clearance, and other relevant documents
								for verification.
							</p>
						</div>
					</div>

					<!-- Card 3 -->
					<div class="overflow-hidden bg-white shadow-sm rounded-xl">
						<img
							src="{{ asset("website/assets/images/how-it-work.png")}}"
							alt="Step 3"
							class="object-cover w-full h-48" />
						<div class="p-6 text-left">
							<div
								class="p-1 rounded-[12px] bg-[#D0FFDC] flex w-16 h-6 items-center justify-center text-center">
								<p
									class="font-sora font-normal text-[13px] leading-[120%] tracking-[0%] text-[#02611A] whitespace-nowrap">
									STEP 1
								</p>
							</div>
							<h3
								class="font-sora font-bold text-[19px] leading-[120%] tracking-[0%] text-[#535353] mb-2">
								Find Projects That Match Your Expertise
							</h3>
							<p
								class="font-jaka font-normal text-base leading-[22.4px] tracking-[0%] text-[#535353]">
								Read project requirements and submit your proposal directly through the
								portal before the deadline.
							</p>
						</div>
					</div>
				</div>
			</section>

			<!-- Why Use this platform -->
			<section class="p-16 py-16 bg-green-800">
				<div class="max-w-6xl mx-auto">
					<div class="grid items-center gap-4 lg:grid-cols-2">
						<!-- Left Content -->
						<div class="text-white">
							<h2
								class="font-sora text-3xl md:text-4xl font-normal leading-[120%] tracking-normal mb-8">
								Why Use This Platform?
							</h2>

							<ul class="space-y-4">
								<li class="flex items-start">
									<span class="flex items-center justify-center w-5 h-5 mt-1 mr-3">
										<img
											src="{{ asset("website/assets/images/check.png")}}"
											alt="bullet"
											class="object-contain w-4 h-4" />
									</span>
									<p
										class="text-[23px] font-sora leading-[120%] tracking-normal text-white">
										Transparency
									</p>
								</li>

								<li class="flex items-start">
									<span class="flex items-center justify-center w-5 h-5 mt-1 mr-3">
										<img
											src="{{ asset("website/assets/images/check.png")}}"
											alt="bullet"
											class="object-contain w-4 h-4" />
									</span>
									<p
										class="text-[23px] font-sora leading-[120%] tracking-normal text-white">
										Fairness
									</p>
								</li>

								<li class="flex items-start">
									<span class="flex items-center justify-center w-5 h-5 mt-1 mr-3">
										<img
											src="{{ asset("website/assets/images/check.png")}}"
											alt="bullet"
											class="object-contain w-4 h-4" />
									</span>
									<p
										class="text-[23px] font-sora leading-[120%] tracking-normal text-white">
										Real-time Updates
									</p>
								</li>

								<li class="flex items-start">
									<span class="flex items-center justify-center w-5 h-5 mt-1 mr-3">
										<img
											src="{{ asset("website/assets/images/check.png")}}"
											alt="bullet"
											class="object-contain w-4 h-4" />
									</span>
									<p
										class="text-[23px] font-sora leading-[120%] tracking-normal text-white">
										Easy Access
									</p>
								</li>
							</ul>
						</div>

						<!-- Right Image -->
						<div class="relative">
							<div class="overflow-hidden bg-gray-200 rounded-lg shadow-xl">
								<img
									src="{{ asset("website/assets/images/image 2.png")}}"
									alt="Three professionals in safety vests discussing work"
									class="object-cover w-full h-auto" />
							</div>

							<!-- Optional: Add decorative elements -->
							<div
								class="absolute w-16 h-16 bg-green-400 rounded-full -top-4 -right-4 opacity-30"></div>
							<div
								class="absolute w-24 h-24 bg-green-800 rounded-full -bottom-6 -left-6 opacity-20"></div>
						</div>
					</div>
				</div>
			</section>

			<!-- Join our community section -->
			<section
				class="flex items-center justify-center min-h-screen p-4 bg-green-50">
				<div
					class="relative flex items-center w-full max-w-5xl px-8 py-10 text-white bg-green-800 rounded-xl">
					<!-- Absolutely Positioned Image -->
					<div class="absolute bottom-0 right-6 md:block">
						<img
							src="{{ asset("website/assets/images/contractor.png") }}"
							alt="Contractor"
							class="w-auto h-96" />
						<!-- Replace the image src with your own -->
					</div>

					<!-- Text Content -->
					<div class="z-10 md:w-2/3">
						<h2
							class="text-2xl font-sora md:text-[33px] leading-[120%] tracking-normal font-normal mb-4">
							Join our community of<br />
							trusted contractors and suppliers.
						</h2>
						<p
							class="text-sm font-sora md:text-[19px] text-[#F4F4F4] leading-[26.6px] tracking-[0%] mb-6 max-w-md">
							Gain instant access to verified opportunities, transparent procurement
							processes, and real-time updates — all in one place.
						</p>
						<a
							href="/register"
							class="inline-block px-4 py-2 font-semibold text-green-700 transition bg-white rounded-full hover:bg-green-100">
							Get started →
						</a>
					</div>
				</div>
			</section>
		</main>

		<footer class="px-16 py-10 text-white bg-green-800 md:py-12">
			<div
				class="grid grid-cols-1 gap-8 mx-auto max-w-7xl sm:grid-cols-2 md:grid-cols-4 md:gap-10">
				<!-- Logo & Description -->
				<div class="space-y-4">
					<!-- Logo and Brand -->
					<div class="flex items-center space-x-4">
						<div class="flex-shrink-0">
							<div class="w-12 h-12">
								<img src="{{ asset("website/assets/images/benue-logo.png") }}" alt="" />
							</div>
						</div>
						<div
							class="hidden sm:block text-white font-normal text-[11px] tracking-normal font-jaka leading-[120%]">
							<p>Procurement and Project</p>
							<p>Procurement and Project</p>
							<p>Management System</p>
						</div>
						<!-- Mobile brand text -->
						<div class="sm:hidden">
							<div class="text-base font-bold text-white">BSPP</div>
							<div class="text-sm text-white">Procurement System</div>
						</div>
					</div>
					<p class="font-sora font-normal text-[13px] leading-[120%] tracking-[0%]">
						The Benue State E-Procurement is an information system that provides
						suppliers and contractors with government and private tendering
						opportunities in the State.
					</p>
				</div>

				<!-- Contact -->
				<div class="space-y-4">
					<h3
						class="font-sora font-bold text-base leading-[120%] tracking-normal text-[#FFFFFF]">
						Contact
					</h3>
					<ul
						class="text-[13px] leading-[120%] tracking-normal font-sora font-normal space-y-4 text-white">
						<li class="flex items-start gap-3">
							<span class="flex-shrink-0 w-5 h-5 mt-1">
								<img
									src="{{ asset("website/assets/images/location-icon.png") }}"
									alt="Location"
									class="object-contain w-full h-full" />
							</span>
							<span>Benue State Secretariat, Abu Obe Road, High Level, Makurdi.</span>
						</li>
						<li class="flex items-start gap-3">
							<span class="flex-shrink-0 w-5 h-5 mt-1">
								<img
									src="{{ asset("website/assets/images/phone-icon.png") }}"
									alt="Phone"
									class="object-contain w-full h-full" />
							</span>
							<span>(+234) 0703 836 6307</span>
						</li>
						<li class="flex items-start gap-3">
							<span class="flex-shrink-0 w-5 h-5 mt-1">
								<img
									src="{{ asset("website/assets/images/email-icon.png") }}"
									alt="Email"
									class="object-contain w-full h-full" />
							</span>
							<span>info@benue-eprocurement.be.gov.ng</span>
						</li>
						<li class="flex items-start gap-3">
							<span class="flex-shrink-0 w-5 h-5 mt-1">
								<img
									src="{{ asset("website/assets/images/skype icon.png") }}"
									alt="Skype"
									class="object-contain w-full h-full" />
							</span>
							<span>BenueTender_online</span>
						</li>
					</ul>
				</div>

				<!-- About -->
				<div class="space-y-4">
					<h3
						class="font-sora font-bold text-base leading-[120%] tracking-normal text-[#FFFFFF]">
						About
					</h3>
					<ul
						class="text-[13px] leading-[120%] tracking-normal font-sora font-normal space-y-2">
						<li><a href="#" class="hover:underline">Plans & pricing</a></li>
						<li><a href="#" class="hover:underline">Affiliates</a></li>
						<li><a href="#" class="hover:underline">Terms</a></li>
						<li><a href="#" class="hover:underline">Privacy Policy</a></li>
					</ul>
				</div>

				<!-- External Links -->
				<div class="space-y-4">
					<h3
						class="font-sora font-bold text-base leading-[120%] tracking-normal text-[#FFFFFF]">
						External Links
					</h3>
					<ul
						class="text-[13px] leading-[120%] tracking-normal font-sora font-normal space-y-3 text-white">
						<li>
							<a href="#" class="flex items-center gap-2 hover:underline">
								<span>Benue State Ministry of Finance and Economic Planning</span>
								<span class="flex-shrink-0 w-4 h-4">
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png") }}"
										alt="External link icon"
										class="object-contain w-full h-full" />
								</span>
							</a>
						</li>
						<li>
							<a href="#" class="flex items-center gap-2 hover:underline">
								<span>Benue State Planning Commission</span>
								<span class="flex-shrink-0 w-4 h-4">
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png") }}"
										alt="External link icon"
										class="object-contain w-full h-full" />
								</span>
							</a>
						</li>
						<li>
							<a href="#" class="flex items-center gap-2 hover:underline">
								<span>Benue State Internal Revenue Service</span>
								<span class="flex-shrink-0 w-4 h-4">
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png") }}"
										alt="External link icon"
										class="object-contain w-full h-full" />
								</span>
							</a>
						</li>
						<li>
							<a href="#" class="flex items-center gap-2 hover:underline">
								<span>Benue State Government</span>
								<span class="flex-shrink-0 w-4 h-4">
									<img
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png") }}"
										alt="External link icon"
										class="object-contain w-full h-full" />
								</span>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<!-- Bottom Bar -->
			<div
				class="mt-10 border-t border-green-600 pt-6 text-[14px] flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto px-6 space-y-4 md:space-y-0">
				<p class="text-[14px] leading-[100%] tracking-[2%] font-sora font-normal">
					© Copyright 2025. All Rights Reserved
				</p>
				<div class="flex items-center gap-2">
					<span
						class="text-[14px] leading-[100%] tracking-[2%] font-sora font-normal"
						>Powered by</span
					>
					<img
						src="{{ asset("website/assets/images/bdiclogo.png") }}"
						alt="BDIC Logo"
						class="w-10 h-auto" />
				</div>
			</div>
		</footer>

		<script>
			// Function to toggle mobile menu
			function toggleMobileMenu() {
				const mobileMenu = document.getElementById("mobile-menu")
				const menuIcon = document.getElementById("menu-icon")
				const closeIcon = document.getElementById("close-icon")

				if (mobileMenu.classList.contains("hidden")) {
					mobileMenu.classList.remove("hidden")
					menuIcon.classList.add("hidden")
					closeIcon.classList.remove("hidden")
				} else {
					mobileMenu.classList.add("hidden")
					menuIcon.classList.remove("hidden")
					closeIcon.classList.add("hidden")
				}
			}

			// Function to toggle mobile submenu
			function toggleMobileSubmenu() {
				const submenu = document.getElementById("mobile-submenu")
				const arrow = document.getElementById("submenu-arrow")

				if (submenu.classList.contains("hidden")) {
					submenu.classList.remove("hidden")
					arrow.style.transform = "rotate(180deg)"
				} else {
					submenu.classList.add("hidden")
					arrow.style.transform = "rotate(0deg)"
				}
			}

			// Function to get current page from URL
			function getCurrentPage() {
				const path = window.location.pathname
				const filename = path.split("/").pop()

				if (filename === "" || filename === "index.html") return "home"
				if (filename.includes("about")) return "about"
				if (filename.includes("tenders")) return "tenders"
				if (filename.includes("awards")) return "awards"
				if (filename.includes("contact")) return "contact"
				if (filename.includes("news")) return "news"
				if (filename.includes("press")) return "press"
				if (filename.includes("resources")) return "resources"
				if (filename.includes("media")) return "media"

				return null
			}

			// Function to highlight current page
			function highlightCurrentPage(currentPage) {
				// Remove existing current page classes
				document
					.querySelectorAll(".nav-link, .mobile-nav-link, .dropdown-link")
					.forEach((link) => {
						link.classList.remove("current-page", "mobile-current-page")
					})

				if (!currentPage) return

				// Highlight desktop navigation
				const desktopLink = document.querySelector(
					`nav .nav-link[data-page="${currentPage}"]`
				)
				if (desktopLink) {
					desktopLink.classList.add("current-page")
				}

				// Highlight mobile navigation
				const mobileLink = document.querySelector(
					`#mobile-menu .mobile-nav-link[data-page="${currentPage}"]`
				)
				if (mobileLink) {
					mobileLink.classList.add("mobile-current-page")
				}

				// Highlight dropdown items and their parent
				const dropdownLink = document.querySelector(
					`.dropdown-link[data-page="${currentPage}"]`
				)
				if (dropdownLink) {
					dropdownLink.classList.add("current-page")
					// Also highlight the Media parent
					const mediaButton = document.querySelector(`button[data-page="media"]`)
					if (mediaButton) {
						mediaButton.classList.add("current-page")
					}
					// Mobile media button
					const mobileMediaButton = document.querySelector(
						`#mobile-menu button[data-page="media"]`
					)
					if (mobileMediaButton) {
						mobileMediaButton.classList.add("mobile-current-page")
					}
				}
			}

			// Function to set current page (for demo purposes)
			function setCurrentPage(page) {
				highlightCurrentPage(page)
			}

			// Initialize current page highlighting on page load
			document.addEventListener("DOMContentLoaded", function () {
				// First check if there's a stored current page (for SPA-like behavior)
				let currentPage = sessionStorage.getItem("currentPage")

				// If no stored page, detect from URL
				if (!currentPage) {
					currentPage = getCurrentPage()
				}

				highlightCurrentPage(currentPage)
			})

			// Handle navigation clicks - allow normal navigation
			document.querySelectorAll("a[data-page]").forEach((link) => {
				link.addEventListener("click", function (e) {
					// Allow normal navigation - no preventDefault()
					// The highlighting will be handled on the new page load
					const page = this.getAttribute("data-page")
					// Optional: Store the current page in sessionStorage for SPA-like behavior
					sessionStorage.setItem("currentPage", page)
				})
			})
		</script>
	</body>
</html>
