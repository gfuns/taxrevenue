

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset("proforum/assets/common/js/jquery-3.7.1.min.js") }}"></script>
    <script src="{{ asset("proforum/assets/common/js/bootstrap.bundle.min.js") }}"></script>
    <!-- Bootstrap Js -->
    <script src="{{ asset("proforum/assets/presets/default/js/bootstrap.min.js") }}"></script>

    <!-- Odometer js -->
    <script src="{{ asset("proforum/assets/presets/default/js/odometer.min.js") }}"></script>
    <!-- Viewport js -->
    <script src="{{ asset("proforum/assets/presets/default/js/viewport.jquery.js") }}"></script>
    <!-- Emoji -->
    <script src="{{ asset("proforum/assets/presets/default/js/emojione.min.js") }}"></script>
    <!-- Appear -->
    <script src="{{ asset("proforum/assets/presets/default/js/jquery.appear.min.js") }}"></script>

    <!-- Appear -->
    <script src="{{ asset("proforum/assets/presets/default/js/glightbox.min.js") }}"></script>

    <script src="{{ asset("proforum/assets/admin/js/select2.min.js") }}"></script>


    <script src="{{ asset("proforum/assets/common/js/ckeditor.js") }}"></script>


    <!-- main js -->
    <script src="{{ asset("proforum/assets/presets/default/js/main.js") }}"></script>





    <script>
        "use strict"

        function search(object) {
            var searchValue = $(object).val();
            var appendClass = $('.search-result-box');
            if (searchValue != '') {
                $.ajax({
                    type: "POST",
                    url: "https://preview.wstacks.com/proforum/search",
                    data: {
                        search: searchValue,
                        _token: 'lNE0tG3JLtarqbnmMDT8ti3UStxbsx2loTKMrNOu'
                    },
                    success: function(data) {

                        if (data.data != '') {
                            var html = '';
                            $.each(data.data, function(key, item) {
                                var title = slugify(item.title);
                                html +=
                                    `<a href="https://preview.wstacks.com/proforum/details/${item.id}/${title}" class="search-result-list"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="title">${item.title}</h6>
                                        </div>
                                        <p class="subtitle">${item.content.substring(0, 105)} .....</p>
                                    </a>`;
                            })
                            appendClass.removeClass('d-none').html(html);
                        } else {
                            var html =
                                `
                                    <div class="no-data">
                                        <p>No data found </p>
                                    </div>
                                `;
                            appendClass.removeClass('d-none').html(html);
                        }


                    },
                    error: function(data, status, error) {
                        $.each(data.responseJSON.errors, function(key,
                            item) {
                            Toast.fire({
                                icon: 'error',
                                title: item
                            })
                        });
                    }
                });
            } else {
                appendClass.addClass('d-none');
            }
            return false;
        }

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        }
    </script>
    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "https://preview.wstacks.com/proforum/change/" + $(this).val();
            });
        });
    </script>
    <script>
        (function($) {
            "use strict"
            $(".post_vote").on('click', function() {
                var auth = {{Js::from($authStatus)}};
                if (auth) {
                    var url = '{{ route('forum.votePost') }}';
                    var token = '{{ csrf_token() }}';
                    var id = $(this).data("post-id");
                    var vote = $(this).data("post-vote");
                    var data = {
                        post_id: id,
                        vote: vote,
                        _token: token
                    }
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: function(data) {
                            $(".total_post_vote" + id).find('h6').text(data);
                        },
                        error: function(data, status, error) {
                            $.each(data.responseJSON.errors, function(key, item) {
                                Toast.fire({
                                    icon: 'error',
                                    title: item
                                })
                            });

                        }
                    });
                } else {
                    window.location.href = "{{ route("login") }}";
                }
            });

            $(".bookmark-button").on('click', function() {
                var auth = {{Js::from($authStatus)}};
                if (auth) {
                    var url = '{{ route('forum.bookmarkPost') }}';
                    var token = '{{ csrf_token() }}';
                    var id = $(this).data("post-id");
                    var this_data = $(this);
                    var data = {
                        post_id: id,
                        _token: token
                    }
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        success: function(data) {
                            if (data.status && data.bookmarktype == "saved") {
                                this_data.addClass("active-bookmark");
                                var icon = this_data.find("i");
                                if (icon.hasClass("fa-solid")) {
                                    icon.removeClass("fa-solid")
                                        .addClass("fa-regular");
                                } else {
                                    icon.removeClass("fa-regular")
                                        .addClass("fa-solid");
                                }
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                })
                            } else {
                                this_data.removeClass("active-bookmark");
                                var icon = this_data.find("i");
                                if (icon.hasClass("fa-solid")) {
                                    icon.removeClass("fa-solid")
                                        .addClass("fa-regular");
                                } else {
                                    icon.removeClass("fa-regular")
                                        .addClass("fa-solid");
                                }
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                })
                            }
                        },
                        error: function(data, status, error) {
                            $.each(data.responseJSON.errors, function(key, item) {
                                Toast.fire({
                                    icon: 'error',
                                    title: item
                                })
                            });
                        }
                    });
                } else {
                    $(".toast-container").addClass('d-none');
                    window.location.href =  "{{ route("login") }}";
                }
            });

            $(".report_button").on('click', function() {
                var auth = {{Js::from($authStatus)}};
                if (auth) {
                    var id = $(this).data("post-id");
                    $(".set-modal-post-id").val(id);
                    $(".report_modal").modal('show');
                } else {
                    window.location.href = "{{ route("login") }}";
                }
            });

            $("form#report_form").on('submit', function(event) {
                event.preventDefault();
                var reason = $(".reason").val();
                var id = $(".set-modal-post-id").val();
                var url = '{{ route('forum.reportPost') }}';
                var token = '{{ csrf_token() }}';
                var this_data = $(this);
                var data = {
                    reason: reason,
                    post_id: id,
                    _token: token
                }
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(data) {
                        $(".report_modal").modal('hide');
                        $(".reason").val('');
                        Toast.fire({
                            icon: data.status,
                            title: data.message
                        })
                    },
                    error: function(data, status, error) {
                        $.each(data.responseJSON.errors, function(key,
                            item) {
                            Toast.fire({
                                icon: 'error',
                                title: item
                            })
                        });
                    }
                });
            })
        })(jQuery);
    </script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                "use strict";
                if ($(".trumEdit1")[0]) {
                    ClassicEditor
                        .create(document.querySelector('.trumEdit1'))
                        .then(editor => {
                            window.editor = editor;
                        });
                }

                if ($(".trumEdit2")[0]) {
                    ClassicEditor
                        .create(document.querySelector('.trumEdit2'))
                        .then(editor => {
                            window.editor = editor;
                        });
                }
            });

        })(jQuery);

        function feedInput() {
            $('#postExampleModal').modal('show');
        }

        function jobFeedInput() {
            $('#jobPostExampleModal').modal('show');
        }

        function eventFeedInput() {
            $('#eventPostExampleModal').modal('show');
        }
    </script>

    <script>
        var ENDPOINT = "https://preview.wstacks.com/proforum";
        var page = 1;
        /*------------------------------------------
        Call on Scroll
        --------------------------------------------*/
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                infinteLoadMore(page);
            }
        });

        /*------------------------------------------
        call infinteLoadMore
        --------------------------------------------*/
        function infinteLoadMore(page) {
            $.ajax({
                    url: ENDPOINT + "?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    if (response.html == '') {
                        $('.auto-load').html("<h5>No Data Found.</h5>");
                        return;
                    }

                    $('.auto-load').hide();
                    $(".forum-card-wraper").append(response.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {

                });
        }
    </script>


    <script src="https://preview.wstacks.com/proforum/assets/common/js/sweetalert2.min.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>





    <script>
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "https://preview.wstacks.com/proforum/change/" + $(this).val();
            });

            var inputElements = $('input,select');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $('.policy').on('click', function() {
                $.get('https://preview.wstacks.com/proforum/cookie/accept', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {

                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }

            });

        })(jQuery);
    </script>


    <script>
        "use strict";
        if ($(".trumEdit")[0]) {
            ClassicEditor
                .create(document.querySelector('.trumEdit'))
                .then(editor => {
                    window.editor = editor;
                });
        }
    </script>
    <div class="ck-body-wrapper">
        <div class="ck ck-reset_all ck-body ck-rounded-corners" dir="ltr">
            <div class="ck ck-balloon-panel ck-balloon-panel_arrow_nw ck-balloon-panel_with-arrow"
                style="top: 0px; left: 0px;">
                <div class="ck ck-balloon-rotator" z-index="-1">
                    <div class="ck-balloon-rotator__navigation ck-hidden"><button class="ck ck-button ck-off"
                            type="button" tabindex="-1"
                            aria-labelledby="ck-editor__aria-label_e43ec73c6a9d200852d32fe5595c1591a"
                            data-cke-tooltip-text="Previous" data-cke-tooltip-position="s"><svg
                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                viewBox="0 0 20 20">
                                <path
                                    d="M11.463 5.187a.888.888 0 1 1 1.254 1.255L9.16 10l3.557 3.557a.888.888 0 1 1-1.254 1.255L7.26 10.61a.888.888 0 0 1 .16-1.382l4.043-4.042z">
                                </path>
                            </svg><span class="ck ck-button__label"
                                id="ck-editor__aria-label_e43ec73c6a9d200852d32fe5595c1591a">Previous</span></button><span
                            class="ck-balloon-rotator__counter"></span><button class="ck ck-button ck-off"
                            type="button" tabindex="-1"
                            aria-labelledby="ck-editor__aria-label_e9fe1c738cd47adc50633287eec36d4cd"
                            data-cke-tooltip-text="Next" data-cke-tooltip-position="s"><svg
                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                viewBox="0 0 20 20">
                                <path
                                    d="M8.537 14.813a.888.888 0 1 1-1.254-1.255L10.84 10 7.283 6.442a.888.888 0 1 1 1.254-1.255L12.74 9.39a.888.888 0 0 1-.16 1.382l-4.043 4.042z">
                                </path>
                            </svg><span class="ck ck-button__label"
                                id="ck-editor__aria-label_e9fe1c738cd47adc50633287eec36d4cd">Next</span></button>
                    </div>
                    <div class="ck-balloon-rotator__content"></div>
                </div>
            </div>
            <div class="ck-fake-panel ck-hidden" style="top: 0px; left: 0px; width: 0px; height: 0px;"></div>
        </div>
        <div class="ck ck-reset_all ck-body ck-rounded-corners" dir="ltr">
            <div class="ck ck-balloon-panel ck-balloon-panel_arrow_nw ck-balloon-panel_with-arrow"
                style="top: 0px; left: 0px;">
                <div class="ck ck-balloon-rotator" z-index="-1">
                    <div class="ck-balloon-rotator__navigation ck-hidden"><button class="ck ck-button ck-off"
                            type="button" tabindex="-1"
                            aria-labelledby="ck-editor__aria-label_e7bc51499500a43ffdaa6150b87d4c0b7"
                            data-cke-tooltip-text="Previous" data-cke-tooltip-position="s"><svg
                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                viewBox="0 0 20 20">
                                <path
                                    d="M11.463 5.187a.888.888 0 1 1 1.254 1.255L9.16 10l3.557 3.557a.888.888 0 1 1-1.254 1.255L7.26 10.61a.888.888 0 0 1 .16-1.382l4.043-4.042z">
                                </path>
                            </svg><span class="ck ck-button__label"
                                id="ck-editor__aria-label_e7bc51499500a43ffdaa6150b87d4c0b7">Previous</span></button><span
                            class="ck-balloon-rotator__counter"></span><button class="ck ck-button ck-off"
                            type="button" tabindex="-1"
                            aria-labelledby="ck-editor__aria-label_e4532648fa82a5025f0c9495201c0f477"
                            data-cke-tooltip-text="Next" data-cke-tooltip-position="s"><svg
                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                viewBox="0 0 20 20">
                                <path
                                    d="M8.537 14.813a.888.888 0 1 1-1.254-1.255L10.84 10 7.283 6.442a.888.888 0 1 1 1.254-1.255L12.74 9.39a.888.888 0 0 1-.16 1.382l-4.043 4.042z">
                                </path>
                            </svg><span class="ck ck-button__label"
                                id="ck-editor__aria-label_e4532648fa82a5025f0c9495201c0f477">Next</span></button>
                    </div>
                    <div class="ck-balloon-rotator__content"></div>
                </div>
            </div>
            <div class="ck-fake-panel ck-hidden" style="top: 0px; left: 0px; width: 0px; height: 0px;"></div>
        </div>
        <div class="ck ck-reset_all ck-body ck-rounded-corners" dir="ltr">
            <div class="ck ck-balloon-panel ck-balloon-panel_arrow_nw ck-balloon-panel_with-arrow"
                style="top: 0px; left: 0px;">
                <div class="ck ck-balloon-rotator" z-index="-1">
                    <div class="ck-balloon-rotator__navigation ck-hidden"><button class="ck ck-button ck-off"
                            type="button" tabindex="-1"
                            aria-labelledby="ck-editor__aria-label_e195022c994e5b4c0fadefa745ccf751a"
                            data-cke-tooltip-text="Previous" data-cke-tooltip-position="s"><svg
                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                viewBox="0 0 20 20">
                                <path
                                    d="M11.463 5.187a.888.888 0 1 1 1.254 1.255L9.16 10l3.557 3.557a.888.888 0 1 1-1.254 1.255L7.26 10.61a.888.888 0 0 1 .16-1.382l4.043-4.042z">
                                </path>
                            </svg><span class="ck ck-button__label"
                                id="ck-editor__aria-label_e195022c994e5b4c0fadefa745ccf751a">Previous</span></button><span
                            class="ck-balloon-rotator__counter"></span><button class="ck ck-button ck-off"
                            type="button" tabindex="-1"
                            aria-labelledby="ck-editor__aria-label_e3b4a8116d95b640b678757aeedebfd53"
                            data-cke-tooltip-text="Next" data-cke-tooltip-position="s"><svg
                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                viewBox="0 0 20 20">
                                <path
                                    d="M8.537 14.813a.888.888 0 1 1-1.254-1.255L10.84 10 7.283 6.442a.888.888 0 1 1 1.254-1.255L12.74 9.39a.888.888 0 0 1-.16 1.382l-4.043 4.042z">
                                </path>
                            </svg><span class="ck ck-button__label"
                                id="ck-editor__aria-label_e3b4a8116d95b640b678757aeedebfd53">Next</span></button>
                    </div>
                    <div class="ck-balloon-rotator__content"></div>
                </div>
            </div>
            <div class="ck-fake-panel ck-hidden" style="top: 0px; left: 0px; width: 0px; height: 0px;"></div>
        </div>
    </div>




    <div id="tldx-toast-container"></div>
    <style data-styled="active" data-styled-version="5.3.11"></style>
    <div id="tldx-webext-container"></div>
