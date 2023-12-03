<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return redirect("/admin");
});

Route::group([
    'prefix' => 'admin',
], function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('admin.login');

    Route::get('/slopy', [App\Http\Controllers\HomeController::class, 'slopy']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.overview');

    Route::get('/db-backup', [App\Http\Controllers\HomeController::class, 'databaseBackup'])->name('admin.databaseBackup');

    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('admin.profile');

    Route::post('/updateProfile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('admin.updateProfile');

    Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('admin.changePassword');

    Route::post('/updatePassword', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('admin.updatePassword');

    Route::get('/platform-categories/jobs/{id}', [App\Http\Controllers\PlatformSettingsController::class, 'jobListing'])->name('admin.categoryJobListing');

    Route::get('/platform-categories', [App\Http\Controllers\PlatformSettingsController::class, 'platformCategories'])->name('admin.platformCategories');

    Route::post('/store-category', [App\Http\Controllers\PlatformSettingsController::class, 'storeCategory'])->name('admin.storeCategory');

    Route::post('/update-category', [App\Http\Controllers\PlatformSettingsController::class, 'updateCategory'])->name('admin.updateCategory');

    Route::get('/social-handles', [App\Http\Controllers\PlatformSettingsController::class, 'socialHandles'])->name('admin.socialHandles');

    Route::post('/update-social-handles', [App\Http\Controllers\PlatformSettingsController::class, 'udpdateSocialHandles'])->name('admin.udpdateSocialHandles');

    Route::get('/contact-details', [App\Http\Controllers\PlatformSettingsController::class, 'contactDetails'])->name('admin.contactDetails');

    Route::post('/update-contact-details', [App\Http\Controllers\PlatformSettingsController::class, 'udpdateContactDetails'])->name('admin.udpdateContactDetails');

    Route::get('/payment-gateways', [App\Http\Controllers\PlatformSettingsController::class, 'paymentGateways'])->name('admin.paymentGateways');

    Route::post('/updateStripeGateway', [App\Http\Controllers\PlatformSettingsController::class, 'updateStripeGateway'])->name('admin.updateStripeGateway');

    Route::post('/updatePaystackGateway', [App\Http\Controllers\PlatformSettingsController::class, 'updatePaystackGateway'])->name('admin.updatePaystackGateway');

    Route::get('/activate-payment-gateway', [App\Http\Controllers\PlatformSettingsController::class, 'activatePaymentGateway'])->name('admin.activatePaymentGateway');

    Route::get('/roles-and-permissions', [App\Http\Controllers\PlatformSettingsController::class, 'rolesAndPermissions'])->name('admin.rolesAndPermissions');

    Route::post('/store-role', [App\Http\Controllers\PlatformSettingsController::class, 'storeRole'])->name('admin.storeRole');

    Route::post('/update-role', [App\Http\Controllers\PlatformSettingsController::class, 'updateRole'])->name('admin.updateRole');

    Route::get('/manage-permissions/{id}', [App\Http\Controllers\PlatformSettingsController::class, 'managePermissions'])->name('admin.managePermissions');

    Route::get('/grant-feature-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'grantFeaturePermission'])->name('admin.grantFeaturePermission');

    Route::get('/revoke-feature-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'revokeFeaturePermission'])->name('admin.revokeFeaturePermission');

    Route::get('/grant-create-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'grantCreatePermission'])->name('admin.grantCreatePermission');

    Route::get('/revoke-create-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'revokeCreatePermission'])->name('admin.revokeCreatePermission');

    Route::get('/grant-edit-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'grantEditPermission'])->name('admin.grantEditPermission');

    Route::get('/revoke-edit-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'revokeEditPermission'])->name('admin.revokeEditPermission');

    Route::get('/grant-delete-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'grantDeletePermission'])->name('admin.grantDeletePermission');

    Route::get('/revoke-delete-permission/{role}/{feature}', [App\Http\Controllers\PlatformSettingsController::class, 'revokeDeletePermission'])->name('admin.revokeDeletePermission');

    Route::get('/airtime-providers', [App\Http\Controllers\BillPaymentController::class, 'airtimeProviders'])->name('admin.airtimeProviders');

    Route::post('/store-airtime-provider', [App\Http\Controllers\BillPaymentController::class, 'storeAirtimeProvider'])->name('admin.storeAirtimeProvider');

    Route::post('/update-airtime-provider', [App\Http\Controllers\BillPaymentController::class, 'updateAirtimeProvider'])->name('admin.updateAirtimeProvider');

    Route::get('/activate-airtime-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'activateAirtimeProvider'])->name('admin.activateAirtimeProvider');

    Route::get('/deactivate-airtime-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deactivateAirtimeProvider'])->name('admin.deactivateAirtimeProvider');

    Route::get('/delete-airtime-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deleteAirtimeProvider'])->name('admin.deleteAirtimeProvider');

    Route::get('/electricity-providers', [App\Http\Controllers\BillPaymentController::class, 'electricityProviders'])->name('admin.electricityProviders');

    Route::post('/store-electricity-provider', [App\Http\Controllers\BillPaymentController::class, 'storeElectricityProvider'])->name('admin.storeElectricityProvider');

    Route::post('/update-electricity-provider', [App\Http\Controllers\BillPaymentController::class, 'updateElectricityProvider'])->name('admin.updateElectricityProvider');

    Route::get('/activate-electricity-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'activateElectricityProvider'])->name('admin.activateElectricityProvider');

    Route::get('/deactivate-electricity-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deactivateElectricityProvider'])->name('admin.deactivateElectricityProvider');

    Route::get('/delete-electricity-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deleteElectricityProvider'])->name('admin.deleteElectricityProvider');

    Route::get('/cable-providers', [App\Http\Controllers\BillPaymentController::class, 'cableProviders'])->name('admin.cableProviders');

    Route::post('/store-cable-provider', [App\Http\Controllers\BillPaymentController::class, 'storeCableProvider'])->name('admin.storeCableProvider');

    Route::post('/update-cable-provider', [App\Http\Controllers\BillPaymentController::class, 'updateCableProvider'])->name('admin.updateCableProvider');

    Route::get('/activate-cable-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'activateCableProvider'])->name('admin.activateCableProvider');

    Route::get('/deactivate-cable-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deactivateCableProvider'])->name('admin.deactivateCableProvider');

    Route::get('/delete-cable-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deleteCableProvider'])->name('admin.deleteCableProvider');

    Route::get('/data-providers', [App\Http\Controllers\BillPaymentController::class, 'dataProviders'])->name('admin.dataProviders');

    Route::post('/store-data-provider', [App\Http\Controllers\BillPaymentController::class, 'storeDataProvider'])->name('admin.storeDataProvider');

    Route::post('/update-data-provider', [App\Http\Controllers\BillPaymentController::class, 'updateDataProvider'])->name('admin.updateDataProvider');

    Route::get('/activate-data-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'activateDataProvider'])->name('admin.activateDataProvider');

    Route::get('/deactivate-data-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deactivateDataProvider'])->name('admin.deactivateDataProvider');

    Route::get('/delete-data-provider/{id}', [App\Http\Controllers\BillPaymentController::class, 'deleteDataProvider'])->name('admin.deleteDataProvider');

    Route::get('/bill-payment-transactions', [App\Http\Controllers\BillPaymentController::class, 'BillPaymentTransactions'])->name('admin.billPaymentTransactions');

    Route::get('/utility-transactions', [App\Http\Controllers\BillPaymentController::class, 'utilityTransactions'])->name('admin.utilityTransactions');

    Route::get('/customer-subscriptions', [App\Http\Controllers\SubscriptionController::class, 'customerSubscriptions'])->name('admin.customerSubscriptions');

    Route::get('/customer-deposits', [App\Http\Controllers\HomeController::class, 'customerDeposits'])->name('admin.customerDeposits');

    Route::get('/customer-withdrawals', [App\Http\Controllers\HomeController::class, 'customerWithdrawals'])->name('admin.customerWithdrawals');

    Route::get('/subscription-plans', [App\Http\Controllers\SubscriptionController::class, 'subscriptionPlans'])->name('admin.subscriptionPlans');

    Route::post('/store-subscription-plan', [App\Http\Controllers\SubscriptionController::class, 'storeSubscriptionPlan'])->name('admin.storeSubscriptionPlan');

    Route::post('/update-subscription-plan', [App\Http\Controllers\SubscriptionController::class, 'updateSubscriptionPlan'])->name('admin.updateSubscriptionPlan');

    Route::get('/administrators', [App\Http\Controllers\HomeController::class, 'administrators'])->name('admin.administrators');

    Route::post('/storeAdmin', [App\Http\Controllers\HomeController::class, 'storeAdmin'])->name('admin.storeAdmin');

    Route::post('/updateAdmin', [App\Http\Controllers\HomeController::class, 'updateAdmin'])->name('admin.updateAdmin');

    Route::get('/suspend-admin/{id}', [App\Http\Controllers\HomeController::class, 'suspendAdmin'])->name('admin.suspendAdmin');

    Route::get('/activate-admin/{id}', [App\Http\Controllers\HomeController::class, 'activateAdmin'])->name('admin.activateAdmin');

    Route::get('/delete-admin/{id}', [App\Http\Controllers\HomeController::class, 'deleteAdmin'])->name('admin.deleteAdmin');

    Route::get('/businesses', [App\Http\Controllers\BusinessController::class, 'businesses'])->name('admin.businesses');

    Route::get('/business/details/{id}', [App\Http\Controllers\BusinessController::class, 'businessDetails'])->name('admin.businessDetails');

    Route::get('/business/referral-list/{id}', [App\Http\Controllers\BusinessController::class, 'referralList'])->name('admin.businessReferrals');

    Route::get('/business/deposits/{id}', [App\Http\Controllers\BusinessController::class, 'deposits'])->name('admin.businessDeposits');

    Route::get('/business/withdrawals/{id}', [App\Http\Controllers\BusinessController::class, 'withdrawals'])->name('admin.businessWithdrawals');

    Route::get('/business/subscription-history/{id}', [App\Http\Controllers\BusinessController::class, 'subscriptionHistory'])->name('admin.businessSubscriptions');

    Route::get('/business/job-listing/{id}', [App\Http\Controllers\BusinessController::class, 'jobListing'])->name('admin.businessJobListing');

    Route::get('/all-jobs', [App\Http\Controllers\JobListingController::class, 'allJobs'])->name('admin.allJobs');

    Route::get('/customer-jobs', [App\Http\Controllers\JobListingController::class, 'customerJobs'])->name('admin.customerJobs');

    Route::get('/in-house-jobs', [App\Http\Controllers\JobListingController::class, 'inHouseJobs'])->name('admin.inHouseJobs');

    Route::get('/job-details/{id}', [App\Http\Controllers\JobListingController::class, 'jobDetails'])->name('admin.jobDetails');

    Route::get('/job-details/files/{id}', [App\Http\Controllers\JobListingController::class, 'jobAssets'])->name('admin.jobAssets');

    Route::get('/job-details/applications/{id}', [App\Http\Controllers\JobListingController::class, 'jobApplications'])->name('admin.jobApplications');

    Route::get('/new-tutorial', [App\Http\Controllers\TutorialController::class, 'newTutorial'])->name('admin.newTutorial');

    Route::post('/store-tutorial', [App\Http\Controllers\TutorialController::class, 'storeTutorial'])->name('admin.storeTutorial');

    Route::get('/view-tutorials', [App\Http\Controllers\TutorialController::class, 'viewTutorials'])->name('admin.viewTutorials');

    Route::post('/update-tutorial', [App\Http\Controllers\TutorialController::class, 'updateTutorial'])->name('admin.updateTutorial');

    Route::get('/delete-tutorial/{id}', [App\Http\Controllers\TutorialController::class, 'deleteTutorial'])->name('admin.deleteTutorial');

    Route::get('/new-product', [App\Http\Controllers\StoreController::class, 'newProduct'])->name('admin.newProduct');

    Route::post('/store-product', [App\Http\Controllers\StoreController::class, 'storeProduct'])->name('admin.storeProduct');

    Route::get('/view-products', [App\Http\Controllers\StoreController::class, 'viewProducts'])->name('admin.viewProducts');

    Route::post('/update-product', [App\Http\Controllers\StoreController::class, 'updateProduct'])->name('admin.updateProduct');

    Route::get('/delete-product/{id}', [App\Http\Controllers\StoreController::class, 'deleteProduct'])->name('admin.deleteProduct');

    Route::get('/new-blog-post', [App\Http\Controllers\BlogController::class, 'newBlogPost'])->name('admin.newBlogPost');

    Route::post('/store-blog-post', [App\Http\Controllers\BlogController::class, 'storeBlogPost'])->name('admin.storeBlogPost');

    Route::get('/view-blog-posts', [App\Http\Controllers\BlogController::class, 'viewBlogPosts'])->name('admin.viewBlogPosts');

    Route::get('/edit-blog-post/{id}', [App\Http\Controllers\BlogController::class, 'editBlogPost'])->name('admin.editBlogPost');

    Route::post('/update-blog-post', [App\Http\Controllers\BlogController::class, 'updateBlogPost'])->name('admin.updateBlogPost');

    Route::get('/delete-blog-post/{id}', [App\Http\Controllers\BlogController::class, 'deleteBlogPost'])->name('admin.deleteBlogPost');

    Route::get('/new-testimonial', [App\Http\Controllers\TestimonialController::class, 'newTestimonial'])->name('admin.newTestimonial');

    Route::post('/store-testimonial', [App\Http\Controllers\TestimonialController::class, 'storeTestimonial'])->name('admin.storeTestimonial');

    Route::get('/view-testimonials', [App\Http\Controllers\TestimonialController::class, 'viewTestimonials'])->name('admin.viewTestimonials');

    Route::get('/edit-testimonial/{id}', [App\Http\Controllers\TestimonialController::class, 'editTestimonial'])->name('admin.editTestimonial');

    Route::post('/update-testimonial', [App\Http\Controllers\TestimonialController::class, 'updateTestimonial'])->name('admin.updateTestimonial');

    Route::get('/delete-testimonial/{id}', [App\Http\Controllers\TestimonialController::class, 'deleteTestimonial'])->name('admin.deleteTestimonial');

});

Auth::routes();
