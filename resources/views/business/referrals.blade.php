@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Referral List')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page Header -->
            <div class="border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Referral List</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Referral List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Tab -->
            <div class="tab-content">

                <!-- Tab Pane -->
                <div class="tab-pane show active" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
                    <!-- Card -->
                    <div class="card">


                        <div class="col-md-8 col-10 ms-4 mt-4">
                            <strong>You can refer users by sharing your referral link or by using your Referral ID:
                                <span class="text-success" style="font-size: 18px; font-weight:bold">
                                    {{ Auth::user()->referral_code }}</span></strong><br>
                            <div class="mb-3 mt-2 input-group">
                                <input type="text" class="form-control readonly"
                                    value="{{ env('APP_URL') }}/register?ref={{ Auth::user()->referral_code }}"
                                    id="link" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" onclick="copyToClipboard()"
                                        type="button" id="button-addon2"><i class="fe fe-copy"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="card-header border-bottom-0">
                            <!-- Form -->
                            <form method="GET" class="d-flex align-items-center">
                                <span class="position-absolute ps-3 search-icon">
                                    <i class="fe fe-search"></i>
                                </span>
                                <input type="search" name="search" value="{{ $search }}"
                                    class="form-control ps-6" placeholder="Search Referrals">
                            </form>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table mb-0 text-nowrap table-hover table-centered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Referral Name</th>
                                        <th>Registration Date</th>
                                        <th>Bonus Earned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($referrals as $referral)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="align-middle sorting_asc_disabled sorting_desc_disabled">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $referral->customer->profile_photo == null ? asset('assets/images/avatar/avatar.webp') : $referral->customer->profile_photo }}"
                                                        alt="" class="rounded-circle avatar-md me-2">
                                                    <h5 class="mb-0">
                                                        {{ $referral->customer->first_name . ' ' . $referral->customer->last_name }}
                                                    </h5>
                                                </div>
                                            </td>
                                            <td>{{ date_format($referral->created_at, 'F jS, Y') }}</td>
                                            <td>&#8358;{{ number_format($referral->bonus_received, 2) }}</td>
                                        </tr>
                                    @endforeach

                                    @if (count($referrals) < 1)
                                        <tr>
                                            <td colspan="4">
                                                <center>No Record Found</center>
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>

                        </div>

                        @if (count($referrals) > 0 && $marker != null)
                            <div class="card-footer">
                                <div class="row g-2 pt-3 ms-4 me-4">
                                    <div class="col-md-9">Showing {{ $marker['begin'] }} to {{ $marker['end'] }}
                                        of
                                        {{ number_format($lastRecord) }} Records</div>

                                    <div class="col-md-3">{{ $referrals->appends(request()->input())->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    document.getElementById("referrals").classList.add('active');
</script>

@endsection

@section('customjs')
<script type="text/javascript">

function copyToClipboard() {
    // Get the text field value
    var textToCopy = document.getElementById("link").value;

    // Create a temporary textarea element
    var textarea = document.createElement("textarea");

    // Set the value of the textarea to the text you want to copy
    textarea.value = textToCopy;

    // Append the textarea to the DOM
    document.body.appendChild(textarea);

    // Select the text in the textarea
    textarea.select();

    // Execute the copy command
    document.execCommand("copy");

    // Remove the textarea from the DOM
    document.body.removeChild(textarea);

    // Optionally, you can provide some feedback to the user
    alert("Referall Link copied to clipboard");
}

</script>
@endsection
