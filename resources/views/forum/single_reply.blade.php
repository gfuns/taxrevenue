<div class="auth-info">
    <a href="/forum/user-profile/{{ $com->customer_id }}">
        <div class="user-thumb">
            <img src="{{ isset($com->customer->photo) ? $com->customer->photo : asset('proforum/images/avatar.png') }}"
                alt="avatar">
        </div>
        <p class="post-by">
            <span>{{ $com->customer->first_name . ' ' . $com->customer->last_name }}</span>
        </p>
    </a>
    <i class="fa-solid fa-circle"></i>
    <p class="time-status">
        {{ date_format($com->created_at, 'j M, Y') }}</p>
</div>
<div class="comment-text">
    <p>{{ $com->comment }}</p>
    <div class="comment-card-footer">
        <ul class="user-actn">
            <li>
                <div class="comment-voting vote-qty">
                    <button
                        class="vote-qty__increment comment_vote  fa-regular "
                        data-comment-id="{{ $com->id }}"
                        data-comment-vote="1">
                        <i class="fa-circle-up  fa-regular "></i>
                    </button>
                    <span
                        class="vote-qty__value total_comment_vote{{ $com->id }}"
                        data-comment-id="{{ $com->id }}">{{ $com->likes }}</span>
                    <button class="vote-qty__decrement comment_vote "
                        data-comment-id="{{ $com->id }}"
                        data-comment-vote="0">
                        <i
                            class="fa-regular fa-circle-down  fa-regular "></i>
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
                            @if (Auth::user() && Auth::user()->id == $com->customer_id)
                                <li class="edit_comment"
                                    style="cursor: pointer;"
                                    onclick="editComment(this);">
                                    <button
                                        class="usr-ctn-btn edit_button">
                                        <i
                                            class="fa-solid fa-pencil"></i>
                                        <span>Edit</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        class="delete_comment delete_button"
                                        data-comment="{{ $com->id }}"
                                        data-post="{{ $post->id }}"
                                        style="cursor: pointer;">
                                        <i
                                            class="fa-solid fa-trash-can"></i>
                                        <span>Delete</span>
                                    </button>

                                </li>
                            @endif
                            <li>
                                <button class="me-3 report_comment_button" data-post-id="{{ $post->id}}" data-comment-id="{{ $com->id }}"><i
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
