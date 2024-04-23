@if (Auth::user())
    <!-- right side -->
    <div class="col-lg-3">
        <aside class="rightside-bar">
            <div class="user-profile-box">
                <div class="user-profile-meta">
                    <div class="user-thumb mb-1">
                        <img src="{{ isset(Auth::user()->photo) ? Auth::user()->photo : asset('proforum/images/avatar.png') }}"
                            alt="user-avatar" />
                    </div>
                    <div class="user-content">
                        <h6 class="user-name">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h6>
                        <p class="user-join-date">{{ date_format(Auth::user()->created_at, 'jS F, Y') }}</p>
                    </div>
                </div>

                <div class="community-item-wraper">
                    <div class="community-item">
                        <div class="item-status">
                            <h5 class="count">{{ Auth::user()->posts->count() }}</h5>
                            <h6 class="item-status-title">Total Posts</h6>
                        </div>
                        <div class="item-status">
                            <h5 class="count">{{ Auth::user()->comments->count() }}</h5>
                            <h6 class="item-status-title">Total Comments</h6>
                        </div>
                    </div>
                    <div class="community-item">
                        <div class="item-status">
                            <h5 class="count">{{ Auth::user()->topics->count() }}</h5>
                            <h6 class="item-status-title">Total Topics</h6>
                        </div>
                        <div class="item-status">
                            <h5 class="count">{{ Auth::user()->replies->count() }}</h5>
                            <h6 class="item-status-title">Total Replies</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="popular-topics-box">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title">My Topics</h5>
                            <a style="cursor:pointer" onclick="addTopic()" class="btn btn--sm"><i
                                    class="fa-solid fa-plus"></i></a>
                        </div>

                        <div class="popular-card-wraper">
                            @php

                                $userTopics = \App\Models\ForumTopics::where("customer_id", Auth::user()->id)->get();

                            @endphp
                            @foreach ($userTopics as $ut)

                                <div class="popular-topics-card">
                                    <div class="topics-card-meta">
                                        <a href="/forum/topic/{{ $ut->id }}/posts" style="display: flex;">
                                            <i class="{{ $ut->icon }} me-2" style="font-size: 18px"></i>
                                            <h6 class="topics-card-title">{{ $ut->topic }} </h6>
                                        </a>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="/forum/topic/{{ $ut->id }}/posts"><i
                                                    class="las la-comments"></i>
                                                <p>{{ $ut->posts->count() }} Posts</p>
                                            </a>
                                        </li>

                                        <li class="text-end">
                                            <a href="/forum/topic/{{ $ut->id }}/posts"><i
                                                    class="las la-calendar"></i>
                                                <p>Created: {{ date_format($ut->created_at, 'jS M, Y') }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <hr class="popular-topics-hr">
                            @endforeach

                        </div>

                        @if (count($userTopics) < 1)
                            <p>No topic has been added</p>
                        @endif
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <!-- right side /-->
@else
    <!-- right side -->
    <div class="col-lg-3">
        <aside class="rightside-bar">
            <div class="community-state-box">
                <h5>Community State</h5>
                <div class="community-item-wraper">
                    <div class="community-item">
                        <div class="item-status mb-3">
                            <span class="count odometer odometer-auto-theme"
                                data-count="{{ number_format($postsThisMonth, 0) }}">
                                <div class="odometer-inside"><span class="odometer-digit"><span
                                            class="odometer-digit-spacer">8</span><span
                                            class="odometer-digit-inner"><span class="odometer-ribbon"><span
                                                    class="odometer-ribbon-inner"><span
                                                        class="odometer-value">{{ number_format($postsThisMonth, 0) }}</span></span></span></span></span>
                                </div>
                            </span>
                            <h6 class="item-status-title">Posts This Month</h6>
                        </div>
                        <div class="item-status">
                            <span class="count odometer odometer-auto-theme"
                                data-count="{{ number_format($totalTopics, 0) }}">
                                <div class="odometer-inside"><span class="odometer-digit"><span
                                            class="odometer-digit-spacer">8</span><span
                                            class="odometer-digit-inner"><span class="odometer-ribbon"><span
                                                    class="odometer-ribbon-inner"><span
                                                        class="odometer-value">{{ number_format($totalTopics, 0) }}</span></span></span></span></span>
                                </div>
                            </span>
                            <h6 class="item-status-title">Total Topics</h6>
                        </div>
                    </div>
                    <div class="community-item">
                        <div class="item-status mb-3">
                            <span class="count odometer odometer-auto-theme"
                                data-count="{{ number_format($conversations, 0) }}">
                                <div class="odometer-inside"><span class="odometer-digit"><span
                                            class="odometer-digit-spacer">8</span><span
                                            class="odometer-digit-inner"><span class="odometer-ribbon"><span
                                                    class="odometer-ribbon-inner"><span
                                                        class="odometer-value">5</span></span></span></span></span><span
                                        class="odometer-digit"><span class="odometer-digit-spacer">8</span><span
                                            class="odometer-digit-inner"><span class="odometer-ribbon"><span
                                                    class="odometer-ribbon-inner"><span
                                                        class="odometer-value">{{ number_format($conversations, 0) }}</span></span></span></span></span>
                                </div>
                            </span>
                            <h6 class="item-status-title">Conversations</h6>
                        </div>
                        <div class="item-status">
                            <span class="count odometer odometer-auto-theme"
                                data-count="{{ number_format($totalReplies, 0) }}">
                                <div class="odometer-inside"><span class="odometer-digit"><span
                                            class="odometer-digit-spacer">8</span><span
                                            class="odometer-digit-inner"><span class="odometer-ribbon"><span
                                                    class="odometer-ribbon-inner"><span
                                                        class="odometer-value">{{ number_format($totalReplies, 0) }}</span></span></span></span></span>
                                </div>
                            </span>
                            <h6 class="item-status-title">Total Replies</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popular-topics-box">
                <h5>Popular Topics</h5>
                <div class="popular-card-wraper">
                    @php

                        $popularPosts = \Illuminate\Support\Facades\DB::table('forum_posts')
                            ->select('forum_posts.*', DB::raw('COUNT(post_comments.id) as comment_count'))
                            ->leftJoin('post_comments', 'forum_posts.id', '=', 'post_comments.forum_post_id')
                            ->groupBy('forum_posts.id')
                            ->orderByRaw('COUNT(post_comments.id) + forum_posts.views DESC')
                            ->limit(3)
                            ->get();

                    @endphp
                    @foreach ($popularPosts as $pop)
                        @php
                            $pp = \App\Models\ForumPosts::find($pop->id);
                        @endphp

                        <div class="popular-topics-card">
                            <div class="topics-card-meta">
                                <div class="card-auth-info">
                                    <a href="/forum/user/{{ $pp->customer_id }}">
                                        <img src="{{ isset($pp->customer->photo) ? $pp->customer->photo : asset('proforum/images/avatar.png') }}"
                                            alt="avatar">
                                        <p class="post-by">Posted by
                                            <span>{{ substr($pp->customer->first_name . ' ' . $pp->customer->last_name, 0, 7) }}...</span>
                                        </p>
                                    </a>
                                    <i class="fa-solid fa-circle"></i>
                                    <p class="time-status">{{ date_format($pp->created_at, 'j M, Y') }}</p>
                                </div>
                                <a href="/forum/details/{{ $pp->id }}/{{ $pp->slug }}">
                                    <h6 class="topics-card-title">{{ $pp->post_title }} </h6>
                                </a>
                            </div>
                            <ul>
                                <li>
                                    <a href="/forum/details/{{ $pp->id }}/{{ $pp->slug }}"><i
                                            class="las la-comments"></i>
                                        <p>{{ $pp->comments->count() }} Comments</p>
                                    </a>
                                </li>
                                <li>
                                    <i class="las la-eye"></i>
                                    <p>{{ $pp->views }} views</p>
                                </li>
                            </ul>
                        </div>
                        <hr class="popular-topics-hr">
                    @endforeach

                </div>
            </div>
        </aside>
    </div>
@endif
<!-- right side /-->
