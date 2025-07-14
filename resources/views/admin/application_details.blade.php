@extends('admin.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Contractor Registrations Details')

<section class="container-fluid p-4">
    <div class="row">
        <!-- Page header -->
        <div class="col-lg-12 col-md-12 col-12">
            <div class="border-bottom pb-3 mb-3 d-md-flex align-items-center justify-content-between">
                <div class="mb-3 mb-md-0">
                    <h1 class="mb-1 h2 fw-bold">Contractor Registrations Details</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Contractor Registrations Details</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card border-0 mb-4">
                <!-- Card header -->
                <div class="card-header d-lg-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-0">Contractor Registration Details
                        </h4>
                    </div>
                </div>


                <div class="p-4 col-md-12">
                    <table class="table table-hover table-centered table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th class="betty" colspan="2"> APPLICATION DETAILS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($company->application_type == 'revalidation')
                                <tr>
                                    <th width="50%">BSPPC Number</th>
                                    <td>{{ $company->bsppc_number }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>CAC Registration Number</th>
                                <td>{{ $company->cac_number }}</td>
                            </tr>
                            <tr>
                                <th>Company Name</th>
                                <td>{{ $company->company_name }}</td>
                            </tr>
                            <tr>
                                <th>Company Address</th>
                                <td>{{ $company->company_address }}</td>
                            </tr>
                            <tr>
                                <th>What Business Do You Seek Registration
                                    For?</th>
                                <td>{{ $company->company_address }}</td>
                            </tr>
                            <tr>
                                <th>Are You Registered With Any Works Registration
                                    Board?</th>
                                <td>{{ ucwords($company->prev_reg) }}</td>
                            </tr>
                            @if ($company->prev_reg == 'yes')
                                <tr>
                                    <th>Which Class?</th>
                                    <td>{{ ucwords($company->prev_reg_class) }}</td>
                                </tr>
                                <tr>
                                    <th>Where?</th>
                                    <td>{{ $company->prev_reg_where }}</td>
                                </tr>
                                <tr>
                                    <th>For What Works?</th>
                                    <td>{{ $company->prev_reg_works }}</td>
                                </tr>
                                <tr>
                                    <th>When?</th>
                                    <td>{{ $company->prev_reg_when }}</td>
                                </tr>
                                <tr>
                                    <th>What Is The Registration Number Of The
                                        Certificate?</th>
                                    <td>{{ $company->prev_reg_no }}</td>
                                </tr>
                                <tr>
                                    <th>Is The Certiticate Of
                                        Registration Still Valid?</th>
                                    <td>{{ ucwords($company->prev_reg_valid) }}</td>
                                </tr>
                                @if ($company->prev_reg == 'no')
                                    <tr>
                                        <th>If Not Why?</th>
                                        <td>{{ ucwords($company->prev_reg_invalid_reason) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Do You Have Experience Or Qualification In the
                                        Field You Wish To Be Registered?</th>
                                    <td>{{ ucwords($company->business_experience) }}</td>
                                </tr>
                                @if ($company->business_experience == 'yes')
                                    <tr>
                                        <th>Give Details Of Your Experience In The
                                            Business</th>
                                        <td>{{ $company->experience_details }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>How Much Capital Do You Have Available For This
                                        Business?</th>
                                    <td>&#8358;{{ number_format($company->business_capital, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Do You Operate A Bank Account For Your
                                        Business?</th>
                                    <td>{{ ucwords($company->operate_bank) }}</td>
                                </tr>
                                @if ($company->operate_bank == 'yes')
                                    <tr>
                                        <th>Bank Name</th>
                                        <td>{{ $company->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bank Branch</th>
                                        <td>{{ $company->bank_branch }}</td>
                                    </tr>
                                    <tr>
                                        <th>Account Number</th>
                                        <td>{{ $company->account_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Postal Code</th>
                                        <td>{{ $company->bank_postal_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Are You Applying For The Upgrading Of Your
                                            Former Registration Certificate?</th>
                                        <td>{{ ucwords($company->upgrade_application) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Application Date:</th>
                                        <td>{{ date_format($company->created_at, 'jS F, Y g:i:sa') }}</td>
                                    </tr>

                                    <tr>
                                        <th>Application Status</th>
                                        <td>
                                            @if ($company->status == 'pending' || $company->status == 'awaiting approval')
                                                <span
                                                    class="badge text-warning bg-light-warning">{{ ucwords($company->status) }}</span>
                                            @elseif($company->status == 'approved')
                                                <span
                                                    class="badge text-success bg-light-success">{{ ucwords($company->status) }}</span>
                                            @else
                                                <span
                                                    class="badge text-danger bg-light-danger">{{ ucwords($company->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($company->status == 'rejected')
                                        <tr>
                                            <th>Reason For Rejection</th>
                                            <td>{{ $company->rejection_reason }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endif
                        </tbody>
                    </table>

                </div>

                @if (count($executedProjects) > 0)
                    <div class="p-4 table-responsive">
                        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                            style="font-size: 14px">
                            <!-- Table Head -->
                            <thead class="table-light">
                                <tr>
                                    <th class="betty" colspan="4"> PAST CONTRACTS EXECUTED</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Awarding Body</th>
                                    <th>Project Description</th>
                                    <th>Contract Sum</th>
                                </tr>
                                @foreach ($executedProjects as $ep)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $ep->awarding_body }}</td>
                                        <td>{{ $ep->contract_description }}</td>
                                        <td>&#8358;{{ number_format($ep->amount, 2) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                @endif

                <!-- Card body -->
                <div class="p-4 table-responsive">
                    <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox"
                        style="font-size: 14px">
                        <!-- Table Head -->
                        <thead class="table-light">
                            <tr>
                                <th class="betty" colspan="3"> UPLOADED COMPANY DOCUMENTS</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Document Title</th>
                                <th>Uploaded Document</th>
                            </tr>
                            @foreach ($documents as $doc)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $doc->docs->document_title }}</td>
                                    <td><a href="{{ $doc->document }}" target="_blank"><button
                                                class="btn btn-success btn-xs">View Document</button></a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                @if (\App\Http\Controllers\MenuController::canEdit(Auth::user()->role_id, 2) == true)
                    <hr />
                    <div class="col-md-8"></div>
                    <!-- button -->
                    <div class="p-4 row col-12 d-flex align-items-center justify-content-between">
                        <div class="col-6">
                            <a href="#" target="_blank"><button class="btn btn-success w-100"
                                    type="button">Approve
                                    Application</button></a>
                        </div>
                        <div class="col-6">
                            <a href="#" target="_blank"><button class="btn btn-danger w-100" type="button">Reject
                                    Application</button></a>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
    </div>

</section>


<script type="text/javascript">
    document.getElementById("companies").classList.add('active');
</script>

@endsection
