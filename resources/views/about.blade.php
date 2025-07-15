<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Procurement & Project Management Systems</title>

		<!-- <script src="https://cdn.tailwindcss.com"></script> -->
		<link rel="stylesheet" href="{{ asset("website/output.css") }}" />
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
	<body class="font-sans bg-gray-50">
		<!-- Header -->
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
							<p>Procurement and Project</p>
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
						<a href="/register"><button
							class="bg-[#02611A] text-white px-6 py-2.5 rounded-full transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50 font-jaka font-normal text-[16px] leading-[24.4px] tracking-[0%]">
							Get Started
						</button></a>

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
						<a href="/register"><button
							class="w-full px-6 py-3 text-base font-semibold text-white transition-all duration-200 bg-green-800 rounded-lg shadow-md">
							Get Started
						</button></a>
					</div>
				</div>
			</div>
		</header>

		<!-- main -->

		<main>
			<!-- recent tenders -->
			<section class="px-6 py-16">
				<div class="max-w-6xl mx-auto">
					<div class="grid items-start gap-12 lg:grid-cols-2">
						<!-- Left Content -->
						<div>
							<h2
								class="text-3xl md:text-[33px] font-sora leading-[120%] tracking-[0%] text-[#232323] font-semibold mb-6">
								<span class="text-[#949494]">Open Tenders:</span>
								<span class=""
									>Opportunities <br />
									for Transparent Partnership</span
								>
							</h2>

							<p
								class="font-jaka font-normal text-[16px] leading-[22.4px] tracking-[0%] text-[#232323] mb-8">
								We are committed to fair, competitive, and transparent procurement.
								Here, you'll find active tender opportunities published by the Benua
								State Public Procurement Commission. Each tender aligns with the values
								of value- for-money, inclusivity, and accountability.
							</p>
						</div>

						<!-- Right Content -->
						<div>
							<h3
								class="font-sora font-bold text-[19px] leading-[26.6px] tracking-[0%] mb-3">
								Why Participate?
							</h3>

							<ul class="space-y-1">
								<li
									class="flex items-start font-jaka font-normal text-[16px] leading-[24.4px] text-[#232323] tracking-[0%]">
									<div
										class="flex-shrink-0 w-2 h-2 mt-2 mr-4 bg-black rounded-full"></div>
									<span>Equal access to government contracts</span>
								</li>
								<li
									class="flex items-start font-jaka font-normal text-[16px] leading-[24.4px] text-[#232323] tracking-[0%]">
									<div
										class="flex-shrink-0 w-2 h-2 mt-2 mr-4 bg-black rounded-full"></div>
									<span>Clear evaluation criteria</span>
								</li>
								<li
									class="flex items-start font-jaka font-normal text-[16px] leading-[24.4px] text-[#232323] tracking-[0%]">
									<div
										class="flex-shrink-0 w-2 h-2 mt-2 mr-4 bg-black rounded-full"></div>
									<span>Real-time updates and notifications</span>
								</li>
								<li
									class="flex items-start font-jaka font-normal text-[16px] leading-[24.4px] text-[#232323] tracking-[0%]">
									<div
										class="flex-shrink-0 w-2 h-2 mt-2 mr-4 bg-black rounded-full"></div>
									<span
										>Opportunities across multiple sectors: construction, ICT, healthcare,
										education, and more</span
									>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!-- image -->
			<section class="">
				<!-- Full Width Banner Image -->
				<div class="h-64 max-w-6xl mx-auto overflow-hidden md:h-80 lg:h-96">
					<img
						src="{{ asset("website/assets/images/frame4.png")}}"
						class="object-cover object-center w-full h-full" />
				</div>
			</section>
			<section class="px-6 py-16">
				<div class="max-w-6xl mx-auto">
					<div class="grid items-center gap-12 lg:grid-cols-2">
						<!-- Left Content -->
						<div class="space-y-12">
							<div>
								<h2 class="mb-4 text-4xl font-bold text-gray-900 md:text-5xl">
									What we stand for
								</h2>
								<p class="text-lg text-gray-600">
									Step by step direction on how to bid for tenders
								</p>
							</div>

							<!-- Vision Section -->
							<div class="relative flex items-start space-x-6">
								<div class="relative z-10 flex-shrink-0">
									<div
										class="flex items-center justify-center w-12 h-12 bg-green-100 border-4 border-white rounded-full shadow-lg">
										<svg
											class="w-6 h-6 text-green-800"
											fill="none"
											stroke="currentColor"
											viewBox="0 0 24 24">
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
										</svg>
									</div>
									<!-- Connecting line -->
									<div
										class="absolute top-12 left-1/2 transform -translate-x-1/2 w-0.5 h-32 bg-green-300"></div>
								</div>
								<div>
									<h3 class="mb-4 text-2xl font-bold text-gray-900">Vision</h3>
									<p class="leading-relaxed text-gray-600">
										To ensure efficiency service delivery that significantly impacts on
										the lives of the people by ensuring that available resources for
										procurement are effectively harnessed and deployed.
									</p>
								</div>
							</div>

							<!-- Mission Section -->
							<div class="flex items-start space-x-6">
								<div class="relative z-10 flex-shrink-0">
									<div
										class="flex items-center justify-center w-12 h-12 bg-green-100 border-4 border-white rounded-full shadow-lg">
										<svg
											class="w-6 h-6 text-green-800"
											fill="none"
											stroke="currentColor"
											viewBox="0 0 24 24">
											<path
												stroke-linecap="round"
												stroke-linejoin="round"
												stroke-width="2"
												d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
										</svg>
									</div>
								</div>
								<div>
									<h3 class="mb-4 text-2xl font-bold text-gray-900">Mission</h3>
									<p class="leading-relaxed text-gray-600">
										A agency responsible for the monitoring and oversight of public
										procurement, harmonizing the existing government policies and
										practices by regulating, setting standards and developing the
										professional capacity of public procurement in the state.
									</p>
								</div>
							</div>
						</div>

						<!-- Right Image -->
						<div class="relative">
							<div class="overflow-hidden shadow-xl rounded-2xl">
								<img
									src="{{ asset("website/assets/images/image 2.png")}}"
									alt="Three professionals in safety vests shaking hands at a construction site"
									class="w-full h-96 lg:h-[500px] object-cover" />
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="px-6 py-16">
				<div class="max-w-5xl mx-auto">
					<!-- Header -->
					<div class="mb-12 text-center">
						<h2 class="mb-4 text-3xl font-bold text-gray-900 md:text-4xl">
							Our Objectives
						</h2>
						<p class="max-w-2xl mx-auto text-gray-600">
							Transforming the Way You Do Business, Ensuring Quality and Excellence
						</p>
					</div>

					<!-- Objectives Cards -->
					<div class="grid gap-8 md:grid-cols-3">
						<!-- Integrity Card -->
						<div
							class="p-8 transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
							<div class="mb-6">
								<div
									class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
									<svg
										class="w-6 h-6 text-green-600"
										fill="none"
										stroke="currentColor"
										viewBox="0 0 24 24">
										<path
											stroke-linecap="round"
											stroke-linejoin="round"
											stroke-width="2"
											d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
									</svg>
								</div>
							</div>
							<h3 class="mb-4 text-xl font-bold text-gray-900">Integrity</h3>
							<p class="leading-relaxed text-gray-600">
								We uphold the highest ethical standards in all our operations, promoting
								trust and accountability in the procurement ecosystem.
							</p>
						</div>

						<!-- Innovation Card -->
						<div
							class="p-8 transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
							<div class="mb-6">
								<div
									class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
									<svg
										class="w-6 h-6 text-green-600"
										fill="none"
										stroke="currentColor"
										viewBox="0 0 24 24">
										<path
											stroke-linecap="round"
											stroke-linejoin="round"
											stroke-width="2"
											d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
									</svg>
								</div>
							</div>
							<h3 class="mb-4 text-xl font-bold text-gray-900">Innovation</h3>
							<p class="leading-relaxed text-gray-600">
								We are focused on developing innovative solutions that streamline
								processes, aiming to revolutionize clients' experience with real-time
								solutions.
							</p>
						</div>

						<!-- Customer-Centric Card -->
						<div
							class="p-8 transition-shadow duration-300 bg-white shadow-lg rounded-xl hover:shadow-xl">
							<div class="mb-6">
								<div
									class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
									<svg
										class="w-6 h-6 text-green-600"
										fill="none"
										stroke="currentColor"
										viewBox="0 0 24 24">
										<path
											stroke-linecap="round"
											stroke-linejoin="round"
											stroke-width="2"
											d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
									</svg>
								</div>
							</div>
							<h3 class="mb-4 text-xl font-bold text-gray-900">Customer-Centric</h3>
							<p class="leading-relaxed text-gray-600">
								Our clients' success is our top priority. We work tirelessly to
								understand their unique needs and provide them with tailored solutions.
							</p>
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
							src="{{ asset("website/assets/images/contractor.png")}}"
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
								<img src="{{ asset("website/assets/images/benue-logo.png")}}" alt="" />
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
									src="{{ asset("website/assets/images/location-icon.png")}}"
									alt="Location"
									class="object-contain w-full h-full" />
							</span>
							<span>Benue State Secretariat, Abu Obe Road, High Level, Makurdi.</span>
						</li>
						<li class="flex items-start gap-3">
							<span class="flex-shrink-0 w-5 h-5 mt-1">
								<img
									src="{{ asset("website/assets/images/phone-icon.png")}}"
									alt="Phone"
									class="object-contain w-full h-full" />
							</span>
							<span>(+234) 0703 836 6307</span>
						</li>
						<li class="flex items-start gap-3">
							<span class="flex-shrink-0 w-5 h-5 mt-1">
								<img
									src="{{ asset("website/assets/images/email-icon.png")}}"
									alt="Email"
									class="object-contain w-full h-full" />
							</span>
							<span>info@benue-eprocurement.be.gov.ng</span>
						</li>
						<li class="flex items-start gap-3">
							<span class="flex-shrink-0 w-5 h-5 mt-1">
								<img
									src="{{ asset("website/assets/images/skype icon.png")}}"
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
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
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
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
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
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
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
										src="{{ asset("website/assets/images/solar_arrow-right-up-broken.png")}}"
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
						src="{{ asset("website/assets/images/bdiclogo.png")}}"
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
				if (filename.includes("home")) return "home"
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
