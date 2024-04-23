<div class="modal fade report_modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="report_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="set-modal-post-id" hidden="" name="id" id="id">
                        <label for="message-text" class="col-form-label">Provide a reason for reporting post:</label>
                        <textarea class="form-control reason" name="reason" id="reason" rows="5" style="resize: none" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="report_sent btn btn-success post-details-report-modal">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="modal fade comment_report_modal" id="exampleModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="comment_report_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="set-comment-modal_post-id" hidden name="post_id">
                        <input type="text" class="set-comment-modal_comment-id" hidden name="comment_id">

                        <label for="message-text" class="col-form-label">Provide a reason for reporting comment:</label>
                        <textarea class="form-control comment_reason" rows="5" name="reason" id="message-text" style="resize:none"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Send</button>

                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="postExampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create A Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('forum.userPostStore') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <input type="text" class="form-control form--control" id="create-recipient-name"
                            name="post_title" placeholder="">
                        <label class="form--label" for="create-recipient-name">Title</label>
                    </div>

                    <div class="form-group mb-4">
                        <select class="form-select form--control" name="category" id="category">
                            <option value="">Select Category (Optional)</option>
                            @foreach (\App\Models\ForumCategories::all() as $fc)
                                <option value="{{ $fc->id }}">{{ $fc->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <select class="form-select form--control" name="topic" id="topic">
                            <option value="">Select Topic (Optional)</option>
                            @foreach (\App\Models\ForumTopics::all() as $ft)
                                <option value="{{ $ft->id }}">{{ $ft->topic }}</option>
                            @endforeach
                        </select>
                    </div>

                    <p class="mb-2">Allowed File Extensions: .jpg, .jpeg, .png (max: <strong> 2MB)</strong></p>
                    <div class="form-group mb-4">
                        <input class="form--control" type="file" name="post_images[]" accept=".png, .jpg, .jpeg"
                            multiple>
                        <label class="form--label">Image</label>
                    </div>

                    <div class="form-group mb-4">
                        <textarea class="form--control trumEdit" placeholder="" name="post_body"></textarea>
                    </div>

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary text-end">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="jobPostExampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Job Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="https://preview.wstacks.com/proforum/user/post/store"
                enctype="multipart/form-data">
                <input type="hidden" name="_token" value="lNE0tG3JLtarqbnmMDT8ti3UStxbsx2loTKMrNOu"
                    autocomplete="off" id="_token">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <div class="row d-none">
                            <input class="form--control d-none" hidden="" placeholder="" name="post_type"
                                value="job" id="post_type">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" class="form-control form--control" id="title" name="title"
                            placeholder="">
                        <label class="form--label" for="title">Title</label>
                    </div>

                    <div class="form-group mb-4">
                        <select class="form-select form--control" name="category" required="" id="category">
                            <option value="">Select Category</option>
                            <option value="1">
                                Sports</option>
                            <option value="2">
                                Tecnology</option>
                            <option value="5">
                                Animation</option>
                            <option value="7">
                                Job</option>
                            <option value="12">
                                News</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <input class="form-control form--control" type="date" name="deadline" id="deadline">
                        <label class="form--label" for="deadline">Deadline</label>
                    </div>

                    <div class="form-group mb-4">
                        <input class="form-control form--control" type="number" placeholder="" name="vacancy"
                            id="vacancy">
                        <label class="form--label" for="vacancy">Vacancy</label>
                    </div>

                    <div class="form-group mb-4">
                        <div class="form-group">
                            <input class="form--control" placeholder="" type="number" name="salary"
                                id="salary">
                            <label class="form--label" for="salary">Salary Range</label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <textarea class="form--control trumEdit1" placeholder="" name="content" id="content" style="display: none;"></textarea>
                        <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr"
                            lang="en" aria-labelledby="ck-editor__label_e1387ed700e5ddd67804957d7325cc2a9"><label
                                class="ck ck-label ck-voice-label"
                                id="ck-editor__label_e1387ed700e5ddd67804957d7325cc2a9">Rich Text
                                Editor</label>
                            <div class="ck ck-editor__top ck-reset_all" role="presentation">
                                <div class="ck ck-sticky-panel">
                                    <div class="ck ck-sticky-panel__placeholder" style="display: none;">
                                    </div>
                                    <div class="ck ck-sticky-panel__content">
                                        <div class="ck ck-toolbar ck-toolbar_grouping" role="toolbar"
                                            aria-label="Editor toolbar">
                                            <div class="ck ck-toolbar__items"><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e76bad3e0062a30b2ab954087bf94e76a"
                                                    aria-disabled="true" data-cke-tooltip-text="Undo (⌘Z)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m5.042 9.367 2.189 1.837a.75.75 0 0 1-.965 1.149l-3.788-3.18a.747.747 0 0 1-.21-.284.75.75 0 0 1 .17-.945L6.23 4.762a.75.75 0 1 1 .964 1.15L4.863 7.866h8.917A.75.75 0 0 1 14 7.9a4 4 0 1 1-1.477 7.718l.344-1.489a2.5 2.5 0 1 0 1.094-4.73l.008-.032H5.042z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e76bad3e0062a30b2ab954087bf94e76a">Undo</span></button><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_ed469d75a2109f7fc1562bdac3ec2194f"
                                                    aria-disabled="true" data-cke-tooltip-text="Redo (⌘Y)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m14.958 9.367-2.189 1.837a.75.75 0 0 0 .965 1.149l3.788-3.18a.747.747 0 0 0 .21-.284.75.75 0 0 0-.17-.945L13.77 4.762a.75.75 0 1 0-.964 1.15l2.331 1.955H6.22A.75.75 0 0 0 6 7.9a4 4 0 1 0 1.477 7.718l-.344-1.489A2.5 2.5 0 1 1 6.039 9.4l-.008-.032h8.927z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_ed469d75a2109f7fc1562bdac3ec2194f">Redo</span></button>
                                                <div class="ck ck-dropdown ck-heading-dropdown"><button
                                                        class="ck ck-button ck-off ck-button_with-text ck-dropdown__button"
                                                        type="button" tabindex="-1"
                                                        aria-labelledby="ck-editor__aria-label_e2ef6e839cee4192226569a080e56fb2d"
                                                        data-cke-tooltip-text="Heading" data-cke-tooltip-position="s"
                                                        aria-haspopup="true" aria-expanded="false"><span
                                                            class="ck ck-button__label"
                                                            id="ck-editor__aria-label_e2ef6e839cee4192226569a080e56fb2d">Paragraph</span><svg
                                                            class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-dropdown__arrow"
                                                            viewBox="0 0 10 10">
                                                            <path
                                                                d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z">
                                                            </path>
                                                        </svg></button>
                                                    <div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se">
                                                        <ul class="ck ck-reset ck-list">
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_paragraph ck-on ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_e78f856bb60365c19011c9fa2c66ed5d8"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_e78f856bb60365c19011c9fa2c66ed5d8">Paragraph</span></button>
                                                            </li>
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_heading1 ck-off ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_ec5209757ddcbd06e878b8bfafc2e6dea"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_ec5209757ddcbd06e878b8bfafc2e6dea">Heading
                                                                        1</span></button></li>
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_heading2 ck-off ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_e8d7f49657ada7fbd8883751c9971926d"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_e8d7f49657ada7fbd8883751c9971926d">Heading
                                                                        2</span></button></li>
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_heading3 ck-off ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_e76e993534c294253e1f140f0b921bc7f"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_e76e993534c294253e1f140f0b921bc7f">Heading
                                                                        3</span></button></li>
                                                        </ul>
                                                    </div>
                                                </div><span class="ck ck-toolbar__separator"></span><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e66dc0a947f4cba8e44c2d03825b7e124"
                                                    aria-pressed="false" data-cke-tooltip-text="Bold (⌘B)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10.187 17H5.773c-.637 0-1.092-.138-1.364-.415-.273-.277-.409-.718-.409-1.323V4.738c0-.617.14-1.062.419-1.332.279-.27.73-.406 1.354-.406h4.68c.69 0 1.288.041 1.793.124.506.083.96.242 1.36.478.341.197.644.447.906.75a3.262 3.262 0 0 1 .808 2.162c0 1.401-.722 2.426-2.167 3.075C15.05 10.175 16 11.315 16 13.01a3.756 3.756 0 0 1-2.296 3.504 6.1 6.1 0 0 1-1.517.377c-.571.073-1.238.11-2 .11zm-.217-6.217H7v4.087h3.069c1.977 0 2.965-.69 2.965-2.072 0-.707-.256-1.22-.768-1.537-.512-.319-1.277-.478-2.296-.478zM7 5.13v3.619h2.606c.729 0 1.292-.067 1.69-.2a1.6 1.6 0 0 0 .91-.765c.165-.267.247-.566.247-.897 0-.707-.26-1.176-.778-1.409-.519-.232-1.31-.348-2.375-.348H7z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e66dc0a947f4cba8e44c2d03825b7e124">Bold</span></button><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e0c3e74d74a759343baa297c9e6051879"
                                                    aria-pressed="false" data-cke-tooltip-text="Italic (⌘I)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m9.586 14.633.021.004c-.036.335.095.655.393.962.082.083.173.15.274.201h1.474a.6.6 0 1 1 0 1.2H5.304a.6.6 0 0 1 0-1.2h1.15c.474-.07.809-.182 1.005-.334.157-.122.291-.32.404-.597l2.416-9.55a1.053 1.053 0 0 0-.281-.823 1.12 1.12 0 0 0-.442-.296H8.15a.6.6 0 0 1 0-1.2h6.443a.6.6 0 1 1 0 1.2h-1.195c-.376.056-.65.155-.823.296-.215.175-.423.439-.623.79l-2.366 9.347z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e0c3e74d74a759343baa297c9e6051879">Italic</span></button><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e37cf9934e4fe9023b6aa194cde349600"
                                                    aria-pressed="false" data-cke-tooltip-text="Link (⌘K)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m11.077 15 .991-1.416a.75.75 0 1 1 1.229.86l-1.148 1.64a.748.748 0 0 1-.217.206 5.251 5.251 0 0 1-8.503-5.955.741.741 0 0 1 .12-.274l1.147-1.639a.75.75 0 1 1 1.228.86L4.933 10.7l.006.003a3.75 3.75 0 0 0 6.132 4.294l.006.004zm5.494-5.335a.748.748 0 0 1-.12.274l-1.147 1.639a.75.75 0 1 1-1.228-.86l.86-1.23a3.75 3.75 0 0 0-6.144-4.301l-.86 1.229a.75.75 0 0 1-1.229-.86l1.148-1.64a.748.748 0 0 1 .217-.206 5.251 5.251 0 0 1 8.503 5.955zm-4.563-2.532a.75.75 0 0 1 .184 1.045l-3.155 4.505a.75.75 0 1 1-1.229-.86l3.155-4.506a.75.75 0 0 1 1.045-.184z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e37cf9934e4fe9023b6aa194cde349600">Link</span></button><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e36bb76908dd4549fc4956eed1b8dc4ff"
                                                    aria-pressed="false" data-cke-tooltip-text="Bulleted List"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0C1 4.784 1.777 4 2.75 4c.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75C1.784 7.5 1 6.723 1 5.75zm6 9c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0c0-.966.777-1.75 1.75-1.75.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75-.966 0-1.75-.777-1.75-1.75z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e36bb76908dd4549fc4956eed1b8dc4ff">Bulleted
                                                        List</span></button><button class="ck ck-button ck-off"
                                                    type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e17353845107edb6f15404120a204f01e"
                                                    aria-pressed="false" data-cke-tooltip-text="Numbered List"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM3.5 3v5H2V3.7H1v-1h2.5V3zM.343 17.857l2.59-3.257H2.92a.6.6 0 1 0-1.04 0H.302a2 2 0 1 1 3.995 0h-.001c-.048.405-.16.734-.333.988-.175.254-.59.692-1.244 1.312H4.3v1h-4l.043-.043zM7 14.75a.75.75 0 0 1 .75-.75h9.5a.75.75 0 1 1 0 1.5h-9.5a.75.75 0 0 1-.75-.75z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e17353845107edb6f15404120a204f01e">Numbered
                                                        List</span></button><span
                                                    class="ck ck-toolbar__separator"></span><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e98815d8d814b19ae97fc8e6877f92a7d"
                                                    aria-disabled="true" data-cke-tooltip-text="Decrease indent"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zm1.618-9.55L.98 9.358a.4.4 0 0 0 .013.661l3.39 2.207A.4.4 0 0 0 5 11.892V7.275a.4.4 0 0 0-.632-.326z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e98815d8d814b19ae97fc8e6877f92a7d">Decrease
                                                        indent</span></button><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_ebd02298639f8ef8812e0fb07a65d7f5c"
                                                    aria-disabled="true" data-cke-tooltip-text="Increase indent"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zM1.632 6.95 5.02 9.358a.4.4 0 0 1-.013.661l-3.39 2.207A.4.4 0 0 1 1 11.892V7.275a.4.4 0 0 1 .632-.326z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_ebd02298639f8ef8812e0fb07a65d7f5c">Increase
                                                        indent</span></button><span
                                                    class="ck ck-toolbar__separator"></span>
                                                <div class="ck ck-dropdown">
                                                    <div class="ck ck-splitbutton ck-dropdown__button"><span
                                                            class="ck-file-dialog-button ck ck-button ck-splitbutton__action"><button
                                                                class="ck ck-button ck-off" type="button"
                                                                tabindex="-1"
                                                                aria-labelledby="ck-editor__aria-label_e7f043be142448eda9a48b2760d9ef0aa"
                                                                data-cke-tooltip-text="Insert image"
                                                                data-cke-tooltip-position="s"><svg
                                                                    class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M6.91 10.54c.26-.23.64-.21.88.03l3.36 3.14 2.23-2.06a.64.64 0 0 1 .87 0l2.52 2.97V4.5H3.2v10.12l3.71-4.08zm10.27-7.51c.6 0 1.09.47 1.09 1.05v11.84c0 .59-.49 1.06-1.09 1.06H2.79c-.6 0-1.09-.47-1.09-1.06V4.08c0-.58.49-1.05 1.1-1.05h14.38zm-5.22 5.56a1.96 1.96 0 1 1 3.4-1.96 1.96 1.96 0 0 1-3.4 1.96z">
                                                                    </path>
                                                                </svg><span class="ck ck-button__label"
                                                                    id="ck-editor__aria-label_e7f043be142448eda9a48b2760d9ef0aa">Insert
                                                                    image</span></button><input class="ck-hidden"
                                                                type="file" tabindex="-1"
                                                                accept="image/jpeg,image/png,image/gif,image/bmp,image/webp,image/tiff"
                                                                multiple="true"></span><button
                                                            class="ck ck-button ck-off ck-splitbutton__arrow"
                                                            type="button" tabindex="-1"
                                                            aria-labelledby="ck-editor__aria-label_e911b5751f52db3a939a647e4d5e45d27"
                                                            data-cke-tooltip-text="Insert image"
                                                            data-cke-tooltip-position="s" aria-haspopup="true"
                                                            aria-expanded="false"><svg
                                                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                                viewBox="0 0 10 10">
                                                                <path
                                                                    d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z">
                                                                </path>
                                                            </svg><span class="ck ck-button__label"
                                                                id="ck-editor__aria-label_e911b5751f52db3a939a647e4d5e45d27">Insert
                                                                image</span></button></div>
                                                    <div
                                                        class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se ck-image-insert__panel">
                                                    </div>
                                                </div>
                                                <div class="ck ck-dropdown"><button
                                                        class="ck ck-button ck-off ck-dropdown__button" type="button"
                                                        tabindex="-1"
                                                        aria-labelledby="ck-editor__aria-label_e96259ce1ea573757c827ec527266e63c"
                                                        data-cke-tooltip-text="Insert table"
                                                        data-cke-tooltip-position="s" aria-haspopup="true"
                                                        aria-expanded="false"><svg
                                                            class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M3 6v3h4V6H3zm0 4v3h4v-3H3zm0 4v3h4v-3H3zm5 3h4v-3H8v3zm5 0h4v-3h-4v3zm4-4v-3h-4v3h4zm0-4V6h-4v3h4zm1.5 8a1.5 1.5 0 0 1-1.5 1.5H3A1.5 1.5 0 0 1 1.5 17V4c.222-.863 1.068-1.5 2-1.5h13c.932 0 1.778.637 2 1.5v13zM12 13v-3H8v3h4zm0-4V6H8v3h4z">
                                                            </path>
                                                        </svg><span class="ck ck-button__label"
                                                            id="ck-editor__aria-label_e96259ce1ea573757c827ec527266e63c">Insert
                                                            table</span><svg
                                                            class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-dropdown__arrow"
                                                            viewBox="0 0 10 10">
                                                            <path
                                                                d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z">
                                                            </path>
                                                        </svg></button>
                                                    <div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se">
                                                    </div>
                                                </div><button
                                                    class="ck ck-button ck-source-editing-button ck-off ck-button_with-text"
                                                    type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_ed7c075b117e198121b9417aeca4f9b59"
                                                    data-cke-tooltip-text="Source" data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m12.5 0 5 4.5v15.003h-16V0h11zM3 1.5v3.25l-1.497 1-.003 8 1.5 1v3.254L7.685 18l-.001 1.504H17.5V8.002L16 9.428l-.004-4.22-4.222-3.692L3 1.5z">
                                                        </path>
                                                        <path
                                                            d="M4.06 6.64a.75.75 0 0 1 .958 1.15l-.085.07L2.29 9.75l2.646 1.89c.302.216.4.62.232.951l-.058.095a.75.75 0 0 1-.951.232l-.095-.058-3.5-2.5V9.14l3.496-2.5zm4.194 6.22a.75.75 0 0 1-.958-1.149l.085-.07 2.643-1.89-2.646-1.89a.75.75 0 0 1-.232-.952l.058-.095a.75.75 0 0 1 .95-.232l.096.058 3.5 2.5v1.22l-3.496 2.5zm7.644-.836 2.122 2.122-5.825 5.809-2.125-.005.003-2.116zm2.539-1.847 1.414 1.414a.5.5 0 0 1 0 .707l-1.06 1.06-2.122-2.12 1.061-1.061a.5.5 0 0 1 .707 0z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_ed7c075b117e198121b9417aeca4f9b59">Source</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ck ck-editor__main" role="presentation">
                                <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline"
                                    lang="en" dir="ltr" role="textbox"
                                    aria-label="Editor editing area: main" contenteditable="true">
                                    <p><br data-cke-filler="true"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary text-end">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="eventPostExampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Events</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="https://preview.wstacks.com/proforum/user/post/store"
                enctype="multipart/form-data">
                <input type="hidden" name="_token" value="lNE0tG3JLtarqbnmMDT8ti3UStxbsx2loTKMrNOu"
                    autocomplete="off" id="_token">
                <div class="modal-body">

                    <div class="form-group mb-4">
                        <div class="row d-none">
                            <input class="form--control d-none" hidden="" placeholder="" name="post_type"
                                value="event" id="post_type">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <input type="text" class="form-control form--control" id="title" name="title"
                            placeholder="">
                        <label class="form--label" for="title">Title</label>
                    </div>

                    <div class="form-group mb-4">
                        <select class="form-select form--control" name="category" required="" id="category">
                            <option value="">Select Category</option>
                            <option value="1">
                                Sports</option>
                            <option value="2">
                                Tecnology</option>
                            <option value="5">
                                Animation</option>
                            <option value="7">
                                Job</option>
                            <option value="12">
                                News</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <input class="form-control form--control" type="number" placeholder="" name="fee"
                            id="fee">
                        <label class="form--label" for="fee">Fees</label>
                    </div>

                    <div class="form-group mb-4">
                        <input class="form-control form--control" type="number" placeholder="" name="participant"
                            id="participant">
                        <label class="form--label" for="participant">Number of Participant</label>
                    </div>

                    <p class="mb-2">Allowed File Extensions: .jpg, .jpeg, .png (max: <strong> 2MB)</strong>
                    </p>
                    <div class="form-group mb-4">
                        <input class="form--control" type="file" name="images[]" accept=".png, .jpg, .jpeg"
                            multiple="" id="images[]">
                        <label class="form--label" for="images[]">Image</label>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-xl-6">
                            <div class="form-group mb-4">
                                <input class="form-control form--control" type="datetime-local" name="start_date"
                                    id="start_date">
                                <label class="form--label" for="start_date">Start Date</label>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-xl-6">
                            <div class="form-group mb-4">
                                <input class="form-control form--control" type="datetime-local" name="end_date"
                                    id="end_date">
                                <label class="form--label" for="end_date">End Date</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <textarea class="form--control trumEdit2" placeholder="" name="content" id="content" style="display: none;"></textarea>
                        <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr"
                            lang="en" aria-labelledby="ck-editor__label_e32a313d9ee292d595e86b6a5533b8fa2"><label
                                class="ck ck-label ck-voice-label"
                                id="ck-editor__label_e32a313d9ee292d595e86b6a5533b8fa2">Rich Text
                                Editor</label>
                            <div class="ck ck-editor__top ck-reset_all" role="presentation">
                                <div class="ck ck-sticky-panel">
                                    <div class="ck ck-sticky-panel__placeholder" style="display: none;">
                                    </div>
                                    <div class="ck ck-sticky-panel__content">
                                        <div class="ck ck-toolbar ck-toolbar_grouping" role="toolbar"
                                            aria-label="Editor toolbar">
                                            <div class="ck ck-toolbar__items"><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e82667477f83cc8e5881de056ff5c93cc"
                                                    aria-disabled="true" data-cke-tooltip-text="Undo (⌘Z)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m5.042 9.367 2.189 1.837a.75.75 0 0 1-.965 1.149l-3.788-3.18a.747.747 0 0 1-.21-.284.75.75 0 0 1 .17-.945L6.23 4.762a.75.75 0 1 1 .964 1.15L4.863 7.866h8.917A.75.75 0 0 1 14 7.9a4 4 0 1 1-1.477 7.718l.344-1.489a2.5 2.5 0 1 0 1.094-4.73l.008-.032H5.042z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e82667477f83cc8e5881de056ff5c93cc">Undo</span></button><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_efb180272aa6b57e32c9c4187bebd78bb"
                                                    aria-disabled="true" data-cke-tooltip-text="Redo (⌘Y)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m14.958 9.367-2.189 1.837a.75.75 0 0 0 .965 1.149l3.788-3.18a.747.747 0 0 0 .21-.284.75.75 0 0 0-.17-.945L13.77 4.762a.75.75 0 1 0-.964 1.15l2.331 1.955H6.22A.75.75 0 0 0 6 7.9a4 4 0 1 0 1.477 7.718l-.344-1.489A2.5 2.5 0 1 1 6.039 9.4l-.008-.032h8.927z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_efb180272aa6b57e32c9c4187bebd78bb">Redo</span></button>
                                                <div class="ck ck-dropdown ck-heading-dropdown"><button
                                                        class="ck ck-button ck-off ck-button_with-text ck-dropdown__button"
                                                        type="button" tabindex="-1"
                                                        aria-labelledby="ck-editor__aria-label_edf70b9012f1fb74888ee630d1840a749"
                                                        data-cke-tooltip-text="Heading" data-cke-tooltip-position="s"
                                                        aria-haspopup="true" aria-expanded="false"><span
                                                            class="ck ck-button__label"
                                                            id="ck-editor__aria-label_edf70b9012f1fb74888ee630d1840a749">Paragraph</span><svg
                                                            class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-dropdown__arrow"
                                                            viewBox="0 0 10 10">
                                                            <path
                                                                d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z">
                                                            </path>
                                                        </svg></button>
                                                    <div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se">
                                                        <ul class="ck ck-reset ck-list">
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_paragraph ck-on ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_e353d18b708a102ce335ab2606f7d1e19"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_e353d18b708a102ce335ab2606f7d1e19">Paragraph</span></button>
                                                            </li>
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_heading1 ck-off ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_e108095ee9621bf9372577fc4f200a52e"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_e108095ee9621bf9372577fc4f200a52e">Heading
                                                                        1</span></button></li>
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_heading2 ck-off ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_ef544562ba5b8465d288962e20ad3163a"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_ef544562ba5b8465d288962e20ad3163a">Heading
                                                                        2</span></button></li>
                                                            <li class="ck ck-list__item"><button
                                                                    class="ck ck-button ck-heading_heading3 ck-off ck-button_with-text"
                                                                    type="button" tabindex="-1"
                                                                    aria-labelledby="ck-editor__aria-label_e7e2d591134d413599b48d105826d839d"
                                                                    data-cke-tooltip-position="s"><span
                                                                        class="ck ck-button__label"
                                                                        id="ck-editor__aria-label_e7e2d591134d413599b48d105826d839d">Heading
                                                                        3</span></button></li>
                                                        </ul>
                                                    </div>
                                                </div><span class="ck ck-toolbar__separator"></span><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_ec231144f8beedffce17c34c31421d5b5"
                                                    aria-pressed="false" data-cke-tooltip-text="Bold (⌘B)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10.187 17H5.773c-.637 0-1.092-.138-1.364-.415-.273-.277-.409-.718-.409-1.323V4.738c0-.617.14-1.062.419-1.332.279-.27.73-.406 1.354-.406h4.68c.69 0 1.288.041 1.793.124.506.083.96.242 1.36.478.341.197.644.447.906.75a3.262 3.262 0 0 1 .808 2.162c0 1.401-.722 2.426-2.167 3.075C15.05 10.175 16 11.315 16 13.01a3.756 3.756 0 0 1-2.296 3.504 6.1 6.1 0 0 1-1.517.377c-.571.073-1.238.11-2 .11zm-.217-6.217H7v4.087h3.069c1.977 0 2.965-.69 2.965-2.072 0-.707-.256-1.22-.768-1.537-.512-.319-1.277-.478-2.296-.478zM7 5.13v3.619h2.606c.729 0 1.292-.067 1.69-.2a1.6 1.6 0 0 0 .91-.765c.165-.267.247-.566.247-.897 0-.707-.26-1.176-.778-1.409-.519-.232-1.31-.348-2.375-.348H7z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_ec231144f8beedffce17c34c31421d5b5">Bold</span></button><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_eba55cfec199c0c255827936543425b61"
                                                    aria-pressed="false" data-cke-tooltip-text="Italic (⌘I)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m9.586 14.633.021.004c-.036.335.095.655.393.962.082.083.173.15.274.201h1.474a.6.6 0 1 1 0 1.2H5.304a.6.6 0 0 1 0-1.2h1.15c.474-.07.809-.182 1.005-.334.157-.122.291-.32.404-.597l2.416-9.55a1.053 1.053 0 0 0-.281-.823 1.12 1.12 0 0 0-.442-.296H8.15a.6.6 0 0 1 0-1.2h6.443a.6.6 0 1 1 0 1.2h-1.195c-.376.056-.65.155-.823.296-.215.175-.423.439-.623.79l-2.366 9.347z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_eba55cfec199c0c255827936543425b61">Italic</span></button><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e0b14b0c07cac9d0a279b9d5949fcfb77"
                                                    aria-pressed="false" data-cke-tooltip-text="Link (⌘K)"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m11.077 15 .991-1.416a.75.75 0 1 1 1.229.86l-1.148 1.64a.748.748 0 0 1-.217.206 5.251 5.251 0 0 1-8.503-5.955.741.741 0 0 1 .12-.274l1.147-1.639a.75.75 0 1 1 1.228.86L4.933 10.7l.006.003a3.75 3.75 0 0 0 6.132 4.294l.006.004zm5.494-5.335a.748.748 0 0 1-.12.274l-1.147 1.639a.75.75 0 1 1-1.228-.86l.86-1.23a3.75 3.75 0 0 0-6.144-4.301l-.86 1.229a.75.75 0 0 1-1.229-.86l1.148-1.64a.748.748 0 0 1 .217-.206 5.251 5.251 0 0 1 8.503 5.955zm-4.563-2.532a.75.75 0 0 1 .184 1.045l-3.155 4.505a.75.75 0 1 1-1.229-.86l3.155-4.506a.75.75 0 0 1 1.045-.184z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e0b14b0c07cac9d0a279b9d5949fcfb77">Link</span></button><button
                                                    class="ck ck-button ck-off" type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e209904344e4e5fe6c116e8b20d812dd2"
                                                    aria-pressed="false" data-cke-tooltip-text="Bulleted List"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0C1 4.784 1.777 4 2.75 4c.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75C1.784 7.5 1 6.723 1 5.75zm6 9c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0c0-.966.777-1.75 1.75-1.75.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75-.966 0-1.75-.777-1.75-1.75z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e209904344e4e5fe6c116e8b20d812dd2">Bulleted
                                                        List</span></button><button class="ck ck-button ck-off"
                                                    type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e62573bcb14a721fa545a691bfcde369f"
                                                    aria-pressed="false" data-cke-tooltip-text="Numbered List"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM3.5 3v5H2V3.7H1v-1h2.5V3zM.343 17.857l2.59-3.257H2.92a.6.6 0 1 0-1.04 0H.302a2 2 0 1 1 3.995 0h-.001c-.048.405-.16.734-.333.988-.175.254-.59.692-1.244 1.312H4.3v1h-4l.043-.043zM7 14.75a.75.75 0 0 1 .75-.75h9.5a.75.75 0 1 1 0 1.5h-9.5a.75.75 0 0 1-.75-.75z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e62573bcb14a721fa545a691bfcde369f">Numbered
                                                        List</span></button><span
                                                    class="ck ck-toolbar__separator"></span><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e2b2de8daacd1c2820f898edf100d32d5"
                                                    aria-disabled="true" data-cke-tooltip-text="Decrease indent"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zm1.618-9.55L.98 9.358a.4.4 0 0 0 .013.661l3.39 2.207A.4.4 0 0 0 5 11.892V7.275a.4.4 0 0 0-.632-.326z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e2b2de8daacd1c2820f898edf100d32d5">Decrease
                                                        indent</span></button><button
                                                    class="ck ck-button ck-disabled ck-off" type="button"
                                                    tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_eba64f9400471dee77add031afd385e83"
                                                    aria-disabled="true" data-cke-tooltip-text="Increase indent"
                                                    data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zM1.632 6.95 5.02 9.358a.4.4 0 0 1-.013.661l-3.39 2.207A.4.4 0 0 1 1 11.892V7.275a.4.4 0 0 1 .632-.326z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_eba64f9400471dee77add031afd385e83">Increase
                                                        indent</span></button><span
                                                    class="ck ck-toolbar__separator"></span>
                                                <div class="ck ck-dropdown">
                                                    <div class="ck ck-splitbutton ck-dropdown__button"><span
                                                            class="ck-file-dialog-button ck ck-button ck-splitbutton__action"><button
                                                                class="ck ck-button ck-off" type="button"
                                                                tabindex="-1"
                                                                aria-labelledby="ck-editor__aria-label_e8ce36684a6eee19adb4a4873f820d895"
                                                                data-cke-tooltip-text="Insert image"
                                                                data-cke-tooltip-position="s"><svg
                                                                    class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                                    viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M6.91 10.54c.26-.23.64-.21.88.03l3.36 3.14 2.23-2.06a.64.64 0 0 1 .87 0l2.52 2.97V4.5H3.2v10.12l3.71-4.08zm10.27-7.51c.6 0 1.09.47 1.09 1.05v11.84c0 .59-.49 1.06-1.09 1.06H2.79c-.6 0-1.09-.47-1.09-1.06V4.08c0-.58.49-1.05 1.1-1.05h14.38zm-5.22 5.56a1.96 1.96 0 1 1 3.4-1.96 1.96 1.96 0 0 1-3.4 1.96z">
                                                                    </path>
                                                                </svg><span class="ck ck-button__label"
                                                                    id="ck-editor__aria-label_e8ce36684a6eee19adb4a4873f820d895">Insert
                                                                    image</span></button><input class="ck-hidden"
                                                                type="file" tabindex="-1"
                                                                accept="image/jpeg,image/png,image/gif,image/bmp,image/webp,image/tiff"
                                                                multiple="true"></span><button
                                                            class="ck ck-button ck-off ck-splitbutton__arrow"
                                                            type="button" tabindex="-1"
                                                            aria-labelledby="ck-editor__aria-label_e4bf084d164cebe19e798dabb69978c16"
                                                            data-cke-tooltip-text="Insert image"
                                                            data-cke-tooltip-position="s" aria-haspopup="true"
                                                            aria-expanded="false"><svg
                                                                class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                                viewBox="0 0 10 10">
                                                                <path
                                                                    d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z">
                                                                </path>
                                                            </svg><span class="ck ck-button__label"
                                                                id="ck-editor__aria-label_e4bf084d164cebe19e798dabb69978c16">Insert
                                                                image</span></button></div>
                                                    <div
                                                        class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se ck-image-insert__panel">
                                                    </div>
                                                </div>
                                                <div class="ck ck-dropdown"><button
                                                        class="ck ck-button ck-off ck-dropdown__button" type="button"
                                                        tabindex="-1"
                                                        aria-labelledby="ck-editor__aria-label_ed5bf9fd1508ba3b749e3d7c2bc545d2b"
                                                        data-cke-tooltip-text="Insert table"
                                                        data-cke-tooltip-position="s" aria-haspopup="true"
                                                        aria-expanded="false"><svg
                                                            class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M3 6v3h4V6H3zm0 4v3h4v-3H3zm0 4v3h4v-3H3zm5 3h4v-3H8v3zm5 0h4v-3h-4v3zm4-4v-3h-4v3h4zm0-4V6h-4v3h4zm1.5 8a1.5 1.5 0 0 1-1.5 1.5H3A1.5 1.5 0 0 1 1.5 17V4c.222-.863 1.068-1.5 2-1.5h13c.932 0 1.778.637 2 1.5v13zM12 13v-3H8v3h4zm0-4V6H8v3h4z">
                                                            </path>
                                                        </svg><span class="ck ck-button__label"
                                                            id="ck-editor__aria-label_ed5bf9fd1508ba3b749e3d7c2bc545d2b">Insert
                                                            table</span><svg
                                                            class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-dropdown__arrow"
                                                            viewBox="0 0 10 10">
                                                            <path
                                                                d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z">
                                                            </path>
                                                        </svg></button>
                                                    <div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se">
                                                    </div>
                                                </div><button
                                                    class="ck ck-button ck-source-editing-button ck-off ck-button_with-text"
                                                    type="button" tabindex="-1"
                                                    aria-labelledby="ck-editor__aria-label_e1af0cf7fc69fecb4b3298912b963977a"
                                                    data-cke-tooltip-text="Source" data-cke-tooltip-position="s"><svg
                                                        class="ck ck-icon ck-reset_all-excluded ck-icon_inherit-color ck-button__icon"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="m12.5 0 5 4.5v15.003h-16V0h11zM3 1.5v3.25l-1.497 1-.003 8 1.5 1v3.254L7.685 18l-.001 1.504H17.5V8.002L16 9.428l-.004-4.22-4.222-3.692L3 1.5z">
                                                        </path>
                                                        <path
                                                            d="M4.06 6.64a.75.75 0 0 1 .958 1.15l-.085.07L2.29 9.75l2.646 1.89c.302.216.4.62.232.951l-.058.095a.75.75 0 0 1-.951.232l-.095-.058-3.5-2.5V9.14l3.496-2.5zm4.194 6.22a.75.75 0 0 1-.958-1.149l.085-.07 2.643-1.89-2.646-1.89a.75.75 0 0 1-.232-.952l.058-.095a.75.75 0 0 1 .95-.232l.096.058 3.5 2.5v1.22l-3.496 2.5zm7.644-.836 2.122 2.122-5.825 5.809-2.125-.005.003-2.116zm2.539-1.847 1.414 1.414a.5.5 0 0 1 0 .707l-1.06 1.06-2.122-2.12 1.061-1.061a.5.5 0 0 1 .707 0z">
                                                        </path>
                                                    </svg><span class="ck ck-button__label"
                                                        id="ck-editor__aria-label_e1af0cf7fc69fecb4b3298912b963977a">Source</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ck ck-editor__main" role="presentation">
                                <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline"
                                    lang="en" dir="ltr" role="textbox"
                                    aria-label="Editor editing area: main" contenteditable="true">
                                    <p><br data-cke-filler="true"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary text-end">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
