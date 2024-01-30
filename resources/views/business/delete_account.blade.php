@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Delete Account')


<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            {{-- <div class="border-bottom pb-3 d-md-flex align-items-center justify-content-between mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Delete Account</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Delete Account</li>
                        </ol>
                    </nav>
                </div>
                <!-- button -->
            </div> --}}
        </div>
    </div>
    <div class="py-6">
        <!-- row -->
        <div class="row">
            <div class="offset-xl-3 col-xl-6 col-md-12 col-12">
                <!-- card -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Delete your account</h3>
                        <p class="mb-0">Delete or Close your account permanently.</p>
                    </div>
                    <!-- Card body -->
                    <div class="card-body p-4">
                        <span class="text-danger h4">Warning</span>
                        <p>
                            If you delete your account, all your job listings will be de-listed and you
                            will lose access forever.
                        </p>
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            style="cursor: pointer">Delete My Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="deleteModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="modal-title" id="updateSignatureModalLabel">Delete Account</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <!-- form -->
                        <div>
                            <div class="mb-5">
                                <div class="mb-3">
                                    <p>Are you sure you want to delete your account? Please consider the following
                                        before proceeding:</p>
                                    <p><b>All Jobs De-listed:</b> If you delete your account, all the jobs
                                        associated with it will be de-listed, and you will no longer have access to them.</p>
                                   <p><b>Access Permanently Lost:</b> Once your account is deleted, you will lose
                                        access to it forever.</p>
                                    <p><b>Account Retention Period:</b> <br />
                                        After initiating the account deletion process, your account
                                        will be held for up to 30 days before it is completely deleted from our system.
                                        During this 30-day window, you have the option to recover your account by
                                        reaching out to our support team.</p>
                                    <p>Please proceed with caution, as account deletions are irreversible and will
                                        result in the consequences mentioned above. If you have any questions or concerns, feel
                                        free to contact our support team for assistance.</p>
                                </div>
                            </div>

                            <div class="">

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <a href="{{ route('business.processAccountDeletion') }}"
                                        onClick="this.disabled=true; this.innerHTML='Deleting account, please wait...';"><button
                                            type="button" class="btn btn-danger ms-2">Delete Account</button></a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>



<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("deleteAccount").classList.add('active');
</script>

@endsection
