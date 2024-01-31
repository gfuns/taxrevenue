@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Buy Cable Subscription')
<style>
    /* Style your cards as needed */
    .selected-card {
        border: 1px solid #21a184;
    }
</style>

<!-- Content -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-1 h2 fw-bold">Buy Cable Subscription</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Utilities</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Buy Cable Subscription</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h4>Please select your preferred provider to get started</h4>
        @foreach ($cableProviders as $index => $ap)
            <div class="col-lg-3 col-md-12 col-6 mb-3" style="cursor: pointer">
                <div id="{{ $ap->service_id }}"
                    class="card card-hover {{ $provida->id === $ap->id ? 'selected-card' : '' }}"
                    onclick="retrieveBouquet(this.id)">
                    <div class="d-flex justify-content-between align-items-center p-4 text-truncate">
                        <div class="d-flex">
                            <img src="{{ $ap->biller_logo }}" alt="" class="avatar-md">
                            <div class="ms-3 pt-1">
                                <h4 class="mb-1">
                                    {{ $ap->biller }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <p>&nbsp;</p>
        <h4>Cable Bouquet & Smart Card (IUC) Number to subscribe</h4>
        <p>Enter the Smart Card (IUC) Number of your decoder and select your preferred {{ $provida->biller }} bouquet.</p>
    </div>
    <div class="">
        <!-- card body -->
        <div class="card-body">
            <!-- form -->
            <form method="post" action="{{ route('business.cablePurchasePreview') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- form group -->
                    <div class="mb-3 col-md-12 col-12">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Bouquet <span class="text-danger">*</span></label>
                            <select id="plans" name="bouquet" class="@error('bouquet') is-invalid @enderror"
                                data-width="100%" required onchange="setAmount(this)">
                                @php
                                    $bouquets = \App\Models\CableProvider::retrieveCablePlans($provida->service_id);
                                @endphp
                                @if ($bouquets != null)
                                    <option value="">Select Your {{ $provida->biller }}
                                        Bouquet
                                    </option>
                                    @foreach ($bouquets as $plan)
                                        <option value="{{ $plan->name }}" data-amount="{{ $plan->variation_amount }}"
                                            data-variation="{{ $plan->variation_code }}">
                                            {{ $plan->name }}</option>
                                    @endforeach
                                @else
                                    <option value="">Failed To Load {{ $provida->biller }}
                                        Bouquet</option>
                                @endif
                            </select>

                            @error('bouquet')
                                <span class="" role="alert">
                                    <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 col-md-12 col-12">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Smart Card (IUC) Number <span class="text-danger">*</span></label>
                            <input type="text" name="iuc_number" value="{{ old('smart_card_number') }}"
                                class="form-control @error('iuc_number') is-invalid @enderror"
                                placeholder="Enter Smart Card (IUC) Number" required>
                            @error('iuc_number')
                                <span class="" role="alert">
                                    <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input id="biller" name="biller" class="form-control" type="hidden"
                        value="{{ $provida->biller }}" required />
                    <input id="cost" name="subscription_fee" class="form-control" type="hidden" value=""
                        required />
                    <input id="variation" name="variation" class="form-control" type="hidden" value=""
                        required />

                    <div class="col-12">
                        <button class="btn btn-primary" type="button"
                            onClick="this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Proceed
                            &nbsp;<i class="bi bi-arrow-right"></i></button>

                    </div>
                </div>
            </form>
        </div>
    </div>


</section>

<script type="text/javascript">
    document.getElementById("navBillPayments").classList.add('show');
    document.getElementById("cable").classList.add('active');
</script>
@endsection


@section('customjs')

<script type="text/javascript">
    function retrieveBouquet(id) {
        var url = {{ Js::from(env('APP_URL') . '/business/cable/plans/') }} + id;
        window.location.href = url;
    }

    function setAmount(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var amount = selectedOption.getAttribute('data-amount');
            var variation = selectedOption.getAttribute('data-variation');
            document.getElementById('cost').value = amount;
            document.getElementById('variation').value = variation;
        }
</script>

@endsection
