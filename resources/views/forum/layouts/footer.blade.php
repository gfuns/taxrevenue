<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('proforum/assets/common/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('proforum/assets/common/js/bootstrap.bundle.min.js') }}"></script>
<!-- Bootstrap Js -->
<script src="{{ asset('proforum/assets/presets/default/js/bootstrap.min.js') }}"></script>

<!-- Odometer js -->
<script src="{{ asset('proforum/assets/presets/default/js/odometer.min.js') }}"></script>
<!-- Viewport js -->
<script src="{{ asset('proforum/assets/presets/default/js/viewport.jquery.js') }}"></script>
<!-- Emoji -->
<script src="{{ asset('proforum/assets/presets/default/js/emojione.min.js') }}"></script>
<!-- Appear -->
<script src="{{ asset('proforum/assets/presets/default/js/jquery.appear.min.js') }}"></script>

<!-- Appear -->
<script src="{{ asset('proforum/assets/presets/default/js/glightbox.min.js') }}"></script>

<script src="{{ asset('proforum/assets/admin/js/select2.min.js') }}"></script>


<script src="{{ asset('assets/js/vendors/editor.js') }}"></script>


<!-- main js -->
<script src="{{ asset('proforum/assets/presets/default/js/main.js') }}"></script>

@include('sweetalert::alert')



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
            var auth = {{ Js::from($authStatus) }};
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
                window.location.href = "{{ route('forum.login') }}";
            }
        });

        // comment votes
        $(document).on('click', '.comment_vote', function() {
            var auth = {{ Js::from($authStatus) }};
            if (auth) {
                var url = '{{ route('forum.voteComment') }}';
                var token = '{{ csrf_token() }}';
                var id = $(this).data("comment-id");

                var data = {
                    comment_id: id,
                    vote: $(this).data("comment-vote"),
                    _token: token
                }
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(data) {
                        $(".total_comment_vote" + id).text(data);
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
                window.location.href = "{{ route('forum.login') }}";
            }
        })

        $(".bookmark-button").on('click', function() {
            var auth = {{ Js::from($authStatus) }};
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
                window.location.href = "{{ route('forum.login') }}";
            }
        });

        $(".report_button").on('click', function() {
            var auth = {{ Js::from($authStatus) }};
            if (auth) {
                var id = $(this).data("post-id");
                $(".set-modal-post-id").val(id);
                $(".report_modal").modal('show');
            } else {
                window.location.href = "{{ route('forum.login') }}";
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




        // report comment button
        $(document).on('click', '.report_comment_button', function() {
            var auth = {{ Js::from($authStatus) }};
            if (auth) {
                var comment_id = $(this).data("comment-id");
                var post_id = $(this).data("post-id");
                $(".set-comment-modal_post-id").val(post_id);
                $(".set-comment-modal_comment-id").val(comment_id);
                $(".comment_report_modal").modal('show');
            } else {
                window.location.href = "{{ route('forum.login') }}";
            }

        });

        // report comment
        $("form#comment_report_form").on('submit', function(event) {
            event.preventDefault();
            var reason = $(".comment_reason").val();
            var post_id = $(".set-comment-modal_post-id").val();
            var comment_id = $(".set-comment-modal_comment-id").val();
            var url = '{{ route('forum.reportComment') }}';
            var token = '{{ csrf_token() }}';
            var data = {
                reason: reason,
                comment_id: comment_id,
                post_id: post_id,
                _token: token
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    $(".comment_report_modal").modal('hide');
                    $(".comment_report_modal").find('form')[0].reset();
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

        // delete comment
        $(document).on('click', '.delete_comment', function() {
            const actn_dropdown = $(this).closest('.actn-dropdown').removeClass(
                'is-open-actn-dropdown');
            const dataCommentId = $(this).data('comment');
            const dataPostId = $(this).data('post');
            const thisTag = $(this);
            var url = '{{ route('forum.deleteComment') }}';
            var token = '{{ csrf_token() }}';
            var data = {
                post_id: dataPostId,
                comment_id: dataCommentId,
                _token: token
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    var nestedComment = thisTag.closest('.comment-card-footer')
                        .closest('.comment-text').closest('.nested-comment');
                    if (nestedComment.length == 0) {
                        // that means its single comment
                        var singleComment = thisTag.closest('.comment-card-footer')
                            .parent('.comment-text').parent('.single-comment')
                            .remove();
                        var oldCountComment = parseInt($('#postCommentCount')
                            .text());
                        $('#postCommentCount').text(oldCountComment - data
                            .commentDeleteCount + " " + "Comments");

                    } else {

                        var allNestedComment = thisTag.closest(
                            '.comment-card-footer').parents(
                            '.nested-comment');

                        replyCommentCountDelete(thisTag, data,
                            allNestedComment);

                        var type = 'delete';
                        postCommentCount(data, type);
                        nestedComment.closest('.nested-comment-wraper').remove();
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
        })


        // delete reply
        $(document).on('click', '.delete_reply', function() {
            const actn_dropdown = $(this).closest('.actn-dropdown').removeClass(
                'is-open-actn-dropdown');
            const dataCommentId = $(this).data('comment');
            const dataPostId = $(this).data('post');
            const thisTag = $(this);
            var url = '{{ route('forum.deleteReply') }}';
            var token = '{{ csrf_token() }}';
            var data = {
                post_id: dataPostId,
                comment_id: dataCommentId,
                _token: token
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    $('#cusReply-' + data.id).remove();
                    var type = 'delete';
                    postCommentCount(data, type);



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


        // delete reply
        $(document).on('click', '.editReply', function() {
            $('[id*=cusFrm]').css('display', 'none');
            $('.replay-comment-field').removeClass('show-comment-field');
            $('.actn-dropdown').removeClass('is-open-actn-dropdown');

            var recordId = $(this).data('reply-id');
            var comment = $(this).data('reply');
            //alert(comment);

            var editFormTextarea = $('#cusFrm-' + recordId).find('textarea');
            editFormTextarea.val(comment);
            editFormTextarea.attr('data-action', 'edit');

            // Find the corresponding edit form div based on the record ID
            var editFormDiv = $('#cusFrm-' + recordId);

            // Toggle the display of the edit form div
            editFormDiv.toggle();
        })

    })(jQuery);





    // Single comment create
    function singleCommentSubmit(object) {
        const dataReply = $(object).data('reply');
        const dataEdit = $(object).data('edit');
        if (dataReply != 'reply' && dataEdit != 'edit') {
            $(object).attr('data-comment', 'comment');
        }
        if (event.which == 13 && $(object).data('comment') == 'comment') {
            var url = '{{ route('forum.submitComment') }}';
            var token = '{{ csrf_token() }}';
            var data = {
                post_id: $(object).siblings('input[name=post_id]').val(),
                parent_comment_id: $(object).siblings('input[name=parent_comment_id]').val(),
                comment: $(object).val(),
                _token: token,
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    var SingleCommentReply = $(object).closest(".single-comment-replay");
                    SingleCommentReply.before(`
                                <div class="single-comment">
                                    ${data.html}
                                </div>
                            `);
                    $(object).val('');
                    $(object).removeAttr('data-comment');

                    var type = "create";
                    postCommentCount(data, type)
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
            return false;
        }
    }

    // Reply comment create
    function replyComment(object, event) {
        var auth = {{ Js::from($authStatus) }};
        if (auth) {
            $('[id*=cusFrm]').css('display', 'none');
            var allReplayCommentField = $('.replay-comment-field').removeClass('show-comment-field');
            var findTextarea = $(object).closest(".comment-card-footer").siblings(".replay-comment-field-reply").find(
                    'form')
                .find("textarea[name=comment]");
            findTextarea.attr('data-action', 'reply');
            findTextarea.val('');
            var nestedCommentWrapper = $(object).closest('.comment-card-footer').siblings('.replay-comment-field')
                .parents(
                    '.nested-comment-wraper');
            if (nestedCommentWrapper.length < 3) {
                $(object).closest(".comment-card-footer").siblings(".replay-comment-field-reply").toggleClass(
                    "show-comment-field");
            }
        } else {
            window.location.href = "{{ route('forum.login') }}";
        }

    }

    // Reply comment submit
    function ReplyCommentSubmit(object, event) {
        if (event.which == 13 && $(object).data('action') === 'reply') {
            var url = '{{ route('forum.replyComment') }}';
            var token = '{{ csrf_token() }}';
            var data = {
                post_id: $(object).siblings('input[name=post_id]').val(),
                comment_id: $(object).siblings('input[name=comment_id]').val(),
                comment: $(object).val(),
                _token: token
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    var nestedCommentWrapper = $(object).closest(".replay-comment-field").parents(
                        '.nested-comment-wraper');
                    if (nestedCommentWrapper.length < 4) {
                        $(object).closest(".replay-comment-field").append(`
                                    <div class="nested-comment-wraper">
                                        <div class="nested-comment">
                                            ${data.html}
                                        </div>
                                    </div>
                                `);
                    }

                    $(object).val('');
                    $(object).closest(".replay-comment-field").toggleClass("show-comment-field");

                    var allNestedComment = $(object).closest(
                        '.replay-comment-field-reply');
                    replyCommentCountCreate(allNestedComment);
                    var type = 'create';
                    postCommentCount(data, type);

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
        }

        if (event.which == 13 && $(object).data('action') === 'edit') {

            var data = {
                comment_id: $(object).siblings('input[name=comment_id]').val(),
                comment: $(object).val(),
                _token: 'ODQI3NYgY2T1tcYso0BNg84lH18rTsLxNNWYbe7L'
            }
            $.ajax({
                type: "POST",
                url: "https://preview.wstacks.com/proforum/comment-edit",
                data: data,
                success: function(data) {
                    var commentText = $(object).closest('.replay-comment-field').parent('.comment-text')
                        .find('p').first();

                    commentText.text(data.comment.comment);

                    $(object).closest(".replay-comment-field").toggleClass("show-comment-field");
                    $(object).removeAttr('data-edit');

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
        }
    }


    // Edit comment create
    function editComment(object) {
        $('[id*=cusFrm]').css('display', 'none');
        var allReplayCommentField = $('.replay-comment-field').removeClass('show-comment-field');

        const actn_dropdown = $(object).closest('.actn-dropdown').removeClass('is-open-actn-dropdown');
        const data = $(object).closest('.comment-text').find('p').first().text();
        const findTextarea = $(object).closest('.comment-card-footer').siblings(".replay-comment-field-edit").find(
                'form')
            .find('textarea[name=comment]');
        findTextarea.val(data);
        findTextarea.focus();
        findTextarea.attr('data-action', 'edit');

        $(object).closest('.comment-card-footer').siblings(".replay-comment-field-edit").toggleClass(
            "show-comment-field");

    }


    function editReplyCommentSubmit(object, event) {
        if (event.which == 13 && $(object).data('action') === 'edit') {
            var url = '{{ route('forum.updateComment') }}';
            var token = '{{ csrf_token() }}';
            var data = {
                comment_id: $(object).siblings('input[name=comment_id]').val(),
                comment: $(object).val(),
                _token: token
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    var commentText = $(object).closest('.replay-comment-field').parent('.comment-text')
                        .find('p').first();
                    commentText.text(data.comment.comment);

                    $(object).closest(".replay-comment-field").toggleClass("show-comment-field");
                    $(object).removeAttr('data-edit');

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
        }
    }

    function editCommentReplySubmit(object, event) {
        if (event.which == 13 && $(object).data('action') === 'edit') {

            var url = '{{ route('forum.updateComment') }}';
            var token = '{{ csrf_token() }}';
            var data = {
                comment_id: $(object).siblings('input[name=comment_id]').val(),
                comment: $(object).val(),
                _token: token
            }
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data) {
                    document.getElementById("custxt-" + data.id).innerHTML = data.comment.comment;

                    var editFormTextarea = $('#cusFrm-' + data.id).find('textarea');
                    editFormTextarea.val('');


                    // Find the corresponding edit form div based on the record ID
                    var editFormDiv = $('#cusFrm-' + data.id);

                    // Toggle the display of the edit form div
                    editFormDiv.toggle();




                    // $(object).closest(".replay-comment-field").toggleClass("show-comment-field");
                    // $(object).removeAttr('data-edit');



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
        }
    }


    function replyCommentCountCreate(allNestedComment) {
        $.each(allNestedComment.parents('.nested-comment'), function(index,
            value) {
            // reply-comment (comment reply) count create

            $(value).children('.comment-text').children(
                '.comment-card-footer').children(
                '.user-actn').find(
                '.nestedCommentsCount').text(parseInt($(
                    value).children('.comment-text')
                .children('.comment-card-footer')
                .children('.user-actn').find(
                    '.nestedCommentsCount').text()) + 1 + " " + "Replies");
        });

        // single-comment (comment reply) count create
        allNestedComment.parents(
                '.single-comment').children('.comment-text')
            .children('.comment-card-footer').children('.user-actn')
            .find('.nestedCommentsCount').text(parseInt(allNestedComment.parents(
                        '.single-comment').children('.comment-text')
                    .children('.comment-card-footer').children(
                        '.user-actn').find('.nestedCommentsCount')
                    .text()) + 1 + " " +
                "Replies");
    }

    // Reply-comment (comment count) delete
    function replyCommentCountDelete(thisTag, data, allNestedComment) {
        $.each(allNestedComment, function(index,
            value) {
            // reply-comment (comment reply) count delete
            $(value).children('.comment-text').children(
                '.comment-card-footer').children(
                '.user-actn').find(
                '.nestedCommentsCount').text(parseInt($(
                        value).children('.comment-text')
                    .children('.comment-card-footer')
                    .children('.user-actn').find(
                        '.nestedCommentsCount').text()
                ) - data.commentDeleteCount + " " +
                "Replies");
        });
        // single-comment (comment reply) count delete
        thisTag.closest(
                '.comment-card-footer').parents(
                '.single-comment').children('.comment-text')
            .children('.comment-card-footer').children('.user-actn')
            .find('.nestedCommentsCount').text(parseInt(thisTag
                    .closest(
                        '.comment-card-footer').parents(
                        '.single-comment').children('.comment-text')
                    .children('.comment-card-footer').children(
                        '.user-actn').find('.nestedCommentsCount')
                    .text()) - data.commentDeleteCount + " " +
                "Replies");
    }


    // single-comment (comment count) create or delete
    function postCommentCount(data, type) {
        if (type == "create") {
            //that single-comment (comment count) create
            var postCommentCount = $('#postCommentCount').text();
            postCommentCount = postCommentCount.replace(/\s/g, "");
            postCommentCount = parseInt(postCommentCount) + 1;
            $('#postCommentCount').text(number_format_short(postCommentCount));
        } else {
            //that single-comment (comment count) delete
            var postCommentCount = $('#postCommentCount').text();
            postCommentCount = postCommentCount.replace(/\s/g, "");
            postCommentCount = parseInt(postCommentCount) - data.commentDeleteCount;
            $('#postCommentCount').text(number_format_short(postCommentCount));
        }

    }
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

    function addTopic() {
        $('#topicExampleModal').modal('show');
    }

    function jobFeedInput() {
        $('#jobPostExampleModal').modal('show');
    }

    function eventFeedInput() {
        $('#eventPostExampleModal').modal('show');
    }
</script>



<script type="text/javascript">
    CKEDITOR.replace('editor1');
</script>


<script>
    var ENDPOINT = "localhost:8000/forum";
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
            window.location.href = "https://areteplanet.com/forum/change/" + $(this).val();
        });

        var inputElements = $('input,select');
        $.each(inputElements, function(index, element) {
            element = $(element);
            element.closest('.form-group').find('label').attr('for', element.attr('name'));
            element.attr('id', element.attr('name'))
        });

        $('.policy').on('click', function() {
            $.get('"https://areteplanet.com/forum/cookie/accept', function(response) {
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


    // Number formate
    function number_format_short(postCommentCount) {
        var n_format;
        var suffix = '';
        if (postCommentCount >= 0 && postCommentCount < 1000) {
            // 1 - 999
            n_format = Math.floor(postCommentCount);
            suffix = '';
        } else if (postCommentCount >= 1000 && postCommentCount < 1000000) {
            // 1k-999k
            n_format = Math.floor(postCommentCount / 1000);
            $suffix = 'K+';
        } else if (postCommentCount >= 1000000 && postCommentCount < 1000000000) {
            // 1m-999m
            n_format = Math.floor(postCommentCount / 1000000);
            $suffix = 'M+';
        } else if (postCommentCount >= 1000000000 && postCommentCount < 1000000000000) {
            // 1b-999b
            n_format = Math.floor(postCommentCount / 1000000000);
            $suffix = 'B+';
        } else if (postCommentCount >= 1000000000000) {
            // 1t+
            n_format = Math.floor(postCommentCount / 1000000000000);
            $suffix = 'T+';
        }
        return n_format + suffix + " " + "Comments";
    }


    function imageDelete(object) {
        var url = '{{ route('forum.userDeleteImage') }}';
        var token = '{{ csrf_token() }}';
        var id = $(object).data("image-id");
        var data = {
            id: id,
            _token: token
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function(data) {
                if (data.status == 'success') {
                    $(object).parent(".post-img-wrap").parent('.image-card').remove();
                    $(object).remove();
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
    }


    $('#category').select2({
        dropdownParent: $('#postExampleModal')
    });

    $('#topic').select2({
        dropdownParent: $('#postExampleModal')
    });

    $(document).ready(function() {
        $('#fcategory').select2();
    });

    $(document).ready(function() {
        $('#ftopic').select2();
    });
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
