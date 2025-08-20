@extends('individual.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Return Filing Details')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Return Filing Details </h1>
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
                                Return Filing Details
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
                                        <th class="betty" colspan="8"> ASSESSMENT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if ($assessment->status == 'awaiting assessment')
                                                Your Filing is awaiting assessment. You will be communicated as soon as an assement is made and approved for your filing.
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        {{-- <div class="pt-4 table-responsive">

                            <button type="button" class="btn btn-outline-success w-40 me-5">ACCEPT ASSEMENT AND MAKE
                                PAYMENT</button>
                            <button type="button" class="btn btn-outline-success w-40" style="float: right">RAISE AN
                                OBJECTION</button>

                        </div> --}}

                    </div>

                </div>
            </div>



        </div>
    </div>
</section>



<script type="text/javascript">
    document.getElementById("returns").classList.add('show');
    // document.getElementById("filed").classList.add('active');
</script>


@endsection
