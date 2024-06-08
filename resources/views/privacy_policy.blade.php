@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Privacy Policy ')
<style>
    .cont {
        display: flex;
    }

    .box {
        margin: 0 5px;
        /* For visualization */
    }
</style>
<main class="main">
    <div class="ck-content">

        <div>
            <section class="section-box mt-50 mb-50">
                <div class="container ">
                    <h2 class="text-center mb-15 wow animate__ animate__fadeInUp animated page_speed_1390205606">
                        Privacy Policy </h2>
                    <div class="row mt-50">

                        <div class="col-12 col-lg-10 offset-lg-1" style="text-align: justify">

                            <p class="font-md mb-20 color-text-paragraph">Arete Worldwide Business Concept Ltd ("the Company") is
                                committed to protecting the privacy and security of your personal information. This
                                Privacy Policy outlines how we collect, use, and disclose personal information when you
                                use our business directory platform ("the Platform").</p>

                            <h4 class="mb-20">1. Information We Collect</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">1.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph"><b>Personal Information:</b> When
                                    you register for an account on the Platform, we may collect certain personal
                                    information, such as your name, email address, phone number, and business details.
                                </div>
                            </div>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">1.2.</div>
                                <div class="box font-md mb-20 color-text-paragraph"><b>Usage Information:</b> We may
                                    also collect information about how you interact with the Platform, including your
                                    browsing activity, search queries, and interactions with business listings.</div>
                            </div>

                            <h4 class="mb-20">2. How We Use Your Information</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">2.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We may use the information we
                                    collect to:
                                    <ul>
                                        <li>Provide, maintain, and improve the Platform;</li>
                                        <li>Personalize your experience and customize the content you see;</li>
                                        <li>Communicate with you about your account and updates to the Platform;</li>
                                        <li>Analyze usage trends and optimize the Platform's performance;</li>
                                        <li>Detect, prevent, and address technical issues or security vulnerabilities.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <h4 class="mb-20">3. Information Sharing and Disclosure</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">3.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We may share your personal
                                    information with third-party service providers who assist us in operating the
                                    Platform and providing related services. These service providers are contractually
                                    obligated to use your information only as necessary to provide the services on our
                                    behalf and to maintain the confidentiality and security of your information.</div>
                            </div>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">3.2.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We may also disclose your
                                    information in response to a legal request, such as a subpoena, court order, or
                                    other governmental request, or when we believe in good faith that disclosure is
                                    necessary to protect our rights, protect your safety or the safety of others,
                                    investigate fraud, or respond to a legal process.</div>
                            </div>

                            <h4 class="mb-20">4. Data Retention</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">4.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We will retain your personal
                                    information for as long as necessary to fulfill the purposes outlined in this
                                    Privacy Policy, unless a longer retention period is required or permitted by law.
                                </div>
                            </div>

                            <h4 class="mb-20">5. Security</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">5.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We take reasonable measures to
                                    protect your personal information from unauthorized access, use, or disclosure.
                                    However, no method of transmission over the Internet or electronic storage is 100%
                                    secure, and we cannot guarantee absolute security.</div>
                            </div>

                            <h4 class="mb-20">6. Your Choices</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">6.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">You may update or correct your
                                    account information at any time by logging into your account settings. You may also
                                    unsubscribe from marketing communications by following the instructions in the
                                    communication or contacting us directly.</div>
                            </div>

                            <h4 class="mb-20">7. Children's Privacy</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">7.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">The Platform is not intended for use
                                    by children under the age of 13, and we do not knowingly collect personal
                                    information from children under the age of 13. If we become aware that we have
                                    collected personal information from a child under the age of 13, we will take steps
                                    to delete such information from our records.</div>
                            </div>

                            <h4 class="mb-20">8. Changes to this Privacy Policy</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">8.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We may update this Privacy Policy
                                    from time to time to reflect changes in our practices or legal requirements. We will
                                    notify you of any material changes to this Privacy Policy by posting the updated
                                    policy on the Platform or by other means of communication.</div>
                            </div>

                            <h4 class="mb-20">9. Contact Us</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">9.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">If you have any questions or
                                    concerns about this Privacy Policy or our privacy practices, please contact us at
                                    info@areteplanet.com.</div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>
        </div>

    </div>

</main>
@endsection
