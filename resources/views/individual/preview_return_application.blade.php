@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Preview Return Filing Details')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Preview Return Filing Details </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('individual.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Preview Return Filing Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="py-6">
        <!-- row -->
        <div class="row">

            <div class=" col-xl-12 col-md-12 col-12">
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th class="betty" colspan="4"> INCOME SOURCE DECLARATION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>
                                            <table cellpadding="6" style="color:black">
                                                <tr>
                                                    <td colspan="4"><b>Period: Year {{ $return->period }}</b></td>
                                                </tr>
                                                <tr style="vertical-align: top">
                                                    <td rowspan="4">(i)</td>
                                                    <td rowspan="4">Employment</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Salary</td>
                                                    <td>&#8358;{{ number_format($income->salary, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Allowances</td>
                                                    <td>&#8358;{{ number_format($income->allowances, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Commissions, Bonuses,
                                                        Gratuities, etc</td>
                                                    <td>&#8358;{{ number_format($income->commissions, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="5%">(ii)</td>
                                                    <td colspan="2" width="50%">Trade,
                                                        Business, Profession, Vocation, etc</td>
                                                    <td>&#8358;{{ number_format($income->trade, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>(iii)</td>
                                                    <td colspan="2">Consolidated Gross Income</td>
                                                    <td>&#8358;{{ number_format($income->consolidated_income, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b>Total Income Declared:</b></td>
                                                    <td><b>&#8358;{{ number_format($income->total, 2) }}</b></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>


                        <div class="pt-4 pb-3 table-responsive">
                            <table class="table table-bordered mb-0 text-nowrap table-hover" style="font-size: 14px">
                                <!-- Table Head -->
                                <thead class="table-light">
                                    <tr>
                                        <th class="betty" colspan="8"> INCOME AND TAX FOR PREVIOUS YEARS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Period</th>
                                        <th>Income Declared</th>
                                        <th>Tax Paid</th>
                                        <th>Status</th>
                                        <th>Uploaded Document</th>
                                    </tr>
                                    @php
                                        $sno = 1;
                                    @endphp
                                    @foreach ($previousReturns as $pr)
                                        <tr>
                                            <td>{{ $sno++ }}</td>
                                            <td>{{ $pr->period }}</td>
                                            <td>&#8358;{{ number_format($pr->income, 2) }}</td>
                                            <td>&#8358;{{ number_format($pr->tax_paid, 2) }}</td>
                                            <td>
                                                @if ($pr->status == 'paid')
                                                    <span class="badge text-success bg-light-success">Verified</span>
                                                @else
                                                    <span class="badge text-warning bg-light-warning">Unverified</span>
                                                @endif
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach

                                    @foreach ($uploadedDocuments as $ud)
                                        <tr>
                                            <td>{{ $sno++ }}</td>
                                            <td>Year {{ $ud->period }}</td>
                                            <td>&#8358;{{ number_format($ud->income, 2) }}</td>
                                            <td>&#8358;{{ number_format($ud->tax_paid, 2) }}</td>
                                            <td><span class="badge text-warning bg-light-warning">Unverified</span>
                                            </td>
                                            <td><a href="{{ $ud->document }}" target="_blank"><button class="btn btn-outline-success btn-sm">View Document</button></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                        <div class="pt-4 table-responsive">
                            <table class="table table-bordered">
                                <form method="post" action="{{ route("individual.submitReturnApplication") }}">
                                    @csrf

                                    <tbody>
                                        <h5 style="font-weight: bold">PENALTY FOR DEFAULT</h5>
                                        <p style="color:black"><b><u>Please Note:</u></b> that in accordance with the
                                            relevant laws, making false statement and returns or unlawful to pay tax
                                            will attract up to five (5) years imprisonment.</p>

                                        <h5 style="font-weight: bold" class="pt-3">TAX PAYER DECLARATION</h5>

                                        <div class="ms-1 mb-5 form-check">
                                            <input type="checkbox" class="form-check-input" id="declaration"
                                                name="declaration" value="yes" required>
                                            <label class="form-check-label" for="declaration"><span
                                                    style="color:black">I hereby declare that
                                                    the information supplied contains a true and correct statement of
                                                    the amount of
                                                    my income from all sources. Given under my hand digitally this day
                                                    <b>{{ date_format(now(), 'jS F, Y') }}</b>.</span></label>
                                        </div>
                                    </tbody>

                                    <input id="myid" type="hidden" name="return_id" value="{{ $return->id }}"
                                        class="form-control" required>

                                    <button type="submit" class="btn btn-outline-success w-100">Submit Filing For
                                        Assessment</button>

                                </form>

                            </table>
                        </div>

                    </div>

                </div>
            </div>



        </div>
    </div>
</section>



<script type="text/javascript">
    document.getElementById("returns").classList.add('show');
    document.getElementById("filed").classList.add('active');
</script>


@endsection
