@extends('layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Cookie Policy ')
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
                        Cookie Policy </h2>
                    <div class="row mt-50">

                        <div class="col-12 col-lg-10 offset-lg-1" style="text-align: justify">

                            <p class="font-md mb-20 color-text-paragraph">Arete Nigeria Limited ("the Company") uses
                                cookies on our business directory platform ("the Platform"). By using the Platform, you
                                consent to the use of cookies in accordance with this Cookie Policy.</p>

                            <h4 class="mb-20">1. What are Cookies</h4>
                            <p class="font-md mb-20 color-text-paragraph">Cookies are small text files that are stored
                                on your device when you visit a website. They are widely used to make websites work more
                                efficiently and to provide a better browsing experience for users.</p>

                            <h4 class="mb-20">2. How We Use Cookies</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">2.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We use cookies for the following
                                    purposes:
                                    <ul>
                                        <li><strong>Essential Cookies:</strong> These cookies are necessary for the
                                            operation of
                                            the Platform and enable you to access its features.</li>
                                        <li><strong>Functional Cookies:</strong> These cookies allow us to remember
                                            choices you
                                            make and provide enhanced functionality and personalization.</li>
                                        <li><strong>Performance Cookies:</strong> These cookies collect information
                                            about how you
                                            use the Platform, such as which pages you visit and any errors you may
                                            encounter. This information helps us improve the performance of the
                                            Platform.</li>
                                        <li><strong>Advertising Cookies:</strong> These cookies are used to deliver
                                            advertisements
                                            relevant to your interests based on your browsing activity on the Platform
                                            and other websites.</li>
                                    </ul>
                                </div>
                            </div>

                            <h4 class="mb-20">3. Third-Party Cookies</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">3.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We may also use third-party cookies,
                                    such as those provided by analytics services or advertisers, to collect information
                                    about your browsing activity on the Platform and other websites. These third parties
                                    may use cookies to deliver targeted advertisements or analyze website usage
                                    statistics.</div>
                            </div>

                            <h4 class="mb-20">4. Managing Cookies</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">4.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">You have the ability to accept or
                                    decline cookies. Most web browsers automatically accept cookies, but you can usually
                                    modify your browser settings to decline cookies if you prefer. However, please note
                                    that disabling cookies may affect your ability to access certain features of the
                                    Platform.
                                </div>
                            </div>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">4.2.</div>
                                <div class="box font-md mb-20 color-text-paragraph">You can also delete cookies stored
                                    on your device at any time. Please refer to your browser's help documentation for
                                    instructions on how to manage cookies.
                                </div>
                            </div>

                            <h4 class="mb-20">5. Changes to this Cookie Policy</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">5.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">We may update this Cookie Policy
                                    from time to time to reflect changes in our practices or legal requirements. We will
                                    notify you of any material changes to this Cookie Policy by posting the updated
                                    policy on the Platform or by other means of communication.</div>
                            </div>

                            <h4 class="mb-20">6. Contact Us</h4>

                            <div class="cont">
                                <div class="box font-md mb-20 color-text-paragraph">6.1.</div>
                                <div class="box font-md mb-20 color-text-paragraph">f you have any questions or concerns
                                    about this Cookie Policy or our use of cookies, please contact us at
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
