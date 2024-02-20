<style>
    @media (max-width: 767px) {

        .footer .footer-col-2,
        .footer .footer-col-3,
        .footer .footer-col-4,
        .footer .footer-col-5 {
            width: 50% !important
        }
    }
</style>
<footer class="footer mt-50 pt-70" style="background: #101828">
    <div class="container">
        <div class="row">
            <div class="footer-col-1 col-md-3 col-sm-12"><a href="/" aria-label="{{ env('APP_NAME') }}"><img
                        alt="" src="{{ asset('files/general/logo.png') }}"></a>
                <div class="mt-20 mb-20 font-sm text-white"> Arete is the world class cutting-edge job portal designed
                    for professionals like you to elevate your job search experience!
                </div>
                <div class="footer-social">
                    <a class="icon-socials" title="Facebook" href="https://facebook.com/" target="_blank"><img
                            src="{{ asset('files/socials/facebook.png') }}" alt="Facebook"></a>
                    <a class="icon-socials" title="Linkedin" href="https://linkedin.com/" target="_blank"><img
                            src="{{ asset('files/socials/twitter.png') }}" alt="Linkedin"></a>
                    <a class="icon-socials" title="Twitter" href="https://twitter.com/" target="_blank"><img
                            src="{{ asset('files/socials/twitter.png') }}" alt="Twitter"></a>
                    <a class="icon-socials" title="Twitter" href="https://twitter.com/" target="_blank"><img
                            src="{{ asset('files/socials/twitter.png') }}" alt="Twitter"></a>
                </div>
            </div>

            <div class="footer-col-2 col-md-2 col-sm-6 col-xs-6 text-white">
                <div class="h6 mb-20">Resources</div>
                <ul class="menu-footer text-white">
                    <li><a href="about-us.html" class="text-white">About Us</a></li>
                    <li><a href="#" class="text-white">Our Team</a></li>
                    <li><a href="#" class="text-white">Products</a></li>
                    <li><a href="contact.html" class="text-white">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col-2 col-md-2 col-sm-6 col-xs-6 text-white">
                <div class="h6 mb-20">Community</div>
                <ul class="menu-footer text-white">
                    <li><a href="about-us.html" class="text-white">Feature</a></li>
                    <li><a href="pricing-plan.html" class="text-white">Pricing</a></li>
                    <li><a href="#" class="text-white">Credit</a></li>
                    <li><a href="faqs.html" class="text-white">FAQ</a></li>
                </ul>
            </div>

            <div class="footer-col-2 col-md-2 col-xs-6 text-white">
                <div class="h6 mb-20">Quick links</div>
                <ul class="menu-footer text-white">
                    <li><a href="#" class="text-white">iOS</a></li>
                    <li><a href="#" class="text-white">Android</a></li>
                    <li><a href="#" class="text-white">Microsoft</a></li>
                    <li><a href="#" class="text-white">Desktop</a></li>
                </ul>
            </div>
            <div class="footer-col-2 col-md-2 col-xs-6 text-white">
                <div class="h6 mb-20">More</div>
                <ul class="menu-footer">
                    <li><a href="cookie-policy.html" class="text-white">Cookie Policy</a></li>
                    <li><a href="terms.html" class="text-white">Terms</a></li>
                    <li><a href="homepage-5.html" class="text-white">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-col-6 col-md-3 col-sm-12 text-white">
                <div class="h6 mb-20">Download App</div>
                <p class="color-text-paragraph-2 font-xs"></p>
                <div class="mt-15">
                    <a class="mr-5" href="#"><img src={{ asset('files/general/app-store.png') }} alt="App Store"
                            style="max-width: 100px"></a>
                    <a class="mr-5" href="#"><img src={{ asset('files/general/android.png') }} alt="Google Play"
                            style="max-width: 100px"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom mt-50">
            <div class="row">
                <div class="col-md-6"><span class="font-sm text-white"> © {{ date('Y') }}
                        {{ env('APP_NAME') }}. All
                        right reserved. </span></div>
                <div class="col-md-6 text-md-end text-start">
                    <div class="footer-social"></div>
                    <div class="nav float-right language-switcher-footer">
                        <li class="dropdown nav-item me-5">
                            <a class="dropdown-toggle text-white" id="dropdownLanguage" data-bs-toggle="dropdown"
                                href="#" aria-expanded="false">
                                <span class="text-language">
                                    <img src= "{{ asset('vendor/core/core/base/img/flags/us.svg') }}" title="English"
                                        alt="English" class="flag page_speed_1267805100 text-white">
                                    English <span class="caret"></span>
                                </span>
                            </a>

                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    window.currencies = {
        "display_big_money": null,
        "billion": "billion",
        "million": "million",
        "is_prefix_symbol": 1,
        "symbol": "₦",
        "title": "NGN",
        "decimal_separator": ".",
        "thousands_separator": ",",
        "number_after_dot": 0,
        "show_symbol_or_title": true
    };
</script>
<script src={{ asset('themes/jobbox/plugins/wow.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/modernizr-3.6.0.min.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/jquery-3.6.3.min.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/jquery-migrate-3.3.0.min.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/bootstrap/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/waypoints.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/magnific-popup.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/perfect-scrollbar.min.js') }}></script>
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src={{ asset('themes/jobbox/plugins/isotope.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/scrollup.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/swiper-bundle.min.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/counterup.js') }}></script>
<script src={{ asset('themes/jobbox/js/main9d7d.js') }}?v=1.10.0></script>
<script src={{ asset('themes/jobbox/js/script9d7d.js') }}?v=1.10.0></script>
<script src={{ asset('themes/jobbox/js/backend9d7d.js') }}?v=1.10.0></script>
<script src={{ asset('vendor/core/plugins/cookie-consent/js/cookie-consentf700.js') }}?v=1.0.1></script>
<script src={{ asset('vendor/core/plugins/language/js/language-publicd1f1.js') }}?v=2.2.0></script>
<script src={{ asset('themes/jobbox/js/noUISlider.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/leaflet/leaflet.js') }}></script>
<script src={{ asset('themes/jobbox/plugins/leaflet/leaflet.markercluster-src.js') }}></script>


{{-- <div class="js-cookie-consent cookie-consent cookie-consent-full-width page_speed_287683390">
    <div class="cookie-consent-body page_speed_2125851095"><span class="cookie-consent__message"> Your
            experience on this site will be improved by allowing cookies <a href="cookie-policy.html">Cookie
                Policy</a></span><button
            class="js-cookie-consent-agree cookie-consent__agree page_speed_1815023329"> Allow cookies </button>
    </div>
</div> --}}

<script type="text/javascript">
    $(document).ready(function() {
        $('#myloc').select2();
    });
</script>
