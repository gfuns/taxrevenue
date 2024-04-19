<div class="nested-comment-wraper">
    <div class="nested-comment">
        @php
            $commentReplies = \App\Models\PostComments::where('comment_id', $com->id)->get();
        @endphp
        @foreach ($commentReplies as $reply)
            <div id="cusReply-{{ $reply->id }}" style="margin: 0px; padding:0px">
                <div class="auth-info">
                    <a href="/forum/user-profile/{{ $reply->customer_id }}">
                        <div class="user-thumb">
                            <img src="{{ isset($reply->customer->photo) ? $reply->customer->photo : asset('proforum/images/avatar.png') }}"
                                alt="avatar">
                        </div>
                        <p class="post-by">
                            <span>{{ $reply->customer->first_name . ' ' . $reply->customer->last_name }}</span>
                        </p>
                    </a>
                    <i class="fa-solid fa-circle"></i>
                    <p class="time-status">
                        {{ date_format($reply->created_at, 'j M, Y') }}
                    </p>
                </div>
                <div class="comment-text">
                    <p id="cusTxt-{{ $reply->id }}">{{ $reply->comment }}</p>
                    <div class="comment-card-footer">
                        <ul class="user-actn">
                            <li>
                                <div class="comment-voting vote-qty">
                                    <button class="vote-qty__increment comment_vote  fa-regular "
                                        data-comment-id="{{ $reply->id }}" data-comment-vote="1">
                                        <i class="fa-circle-up  fa-regular "></i>
                                    </button>
                                    <span class="vote-qty__value total_comment_vote{{ $reply->id }}"
                                        data-comment-id="{{ $reply->id }}">{{ $com->likes }}</span>
                                    <button class="vote-qty__decrement comment_vote "
                                        data-comment-id="{{ $reply->id }}" data-comment-vote="0">
                                        <i class="fa-regular fa-circle-down  fa-regular "></i>
                                    </button>
                                </div>
                            </li>
                            <li>
                                <div class="actn-dropdown-box">
                                    <button class="actn-dropdown-btn">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="actn-dropdown option">
                                        <ul>
                                            @if (Auth::user() && Auth::user()->id == $reply->customer_id)
                                                <li class="edit_comment editReply"
                                                    data-reply-id = "{{ $reply->id }}"
                                                    data-reply = "{{ $reply->comment }}" style="cursor: pointer;">
                                                    <button class="usr-ctn-btn edit_button">
                                                        <i class="fa-solid fa-pencil"></i>
                                                        <span>Edit</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="delete_reply delete_button"
                                                        data-comment="{{ $reply->id }}"
                                                        data-post="{{ $post->id }}" style="cursor: pointer;">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                        <span>Delete</span>
                                                    </button>

                                                </li>
                                            @endif
                                            <li>
                                                <button class="me-3 report_comment_button"
                                                    data-post-id="{{ $post->id }}"
                                                    data-comment-id="{{ $reply->id }}"><i
                                                        class="fa-regular fa-flag"></i>
                                                    <span>Report</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>



                </div>
            </div>

            @if (Auth::user())
                <div class="">
                    <div id="cusFrm-{{ $reply->id }}" class="reply-in-replay" style="display: none">
                        <div class="auth-info">
                            <a href="#">
                                <div class="user-thumb">
                                    <img src="{{ isset(Auth::user()->photo) ? Auth::user()->photo : asset('proforum/images/avatar.png') }}"
                                        alt="avatar">
                                </div>
                                <p class="post-by">
                                    <span>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                                </p>
                            </a>
                        </div>
                        <div class="comment-text">
                            <form>
                                <div class="form-group">
                                    <input type="text" name="post_id" hidden="" value="{{ $post->id }}"
                                        id="post_id">
                                    <input type="text" name="comment_id" hidden="" value="{{ $reply->id }}"
                                        id="comment_id">
                                    <textarea placeholder="" class="form--control comment-replay-field" name="comment"
                                        onkeypress="editReplyCommentSubmit(this,event)" id="comment">{{ $reply->reply }}</textarea>
                                    <label class="form--label" for="comment">
                                        Edit Your Reply
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
