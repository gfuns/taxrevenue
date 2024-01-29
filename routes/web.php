<?php

use App\Http\Controllers\FrontEndController;
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

Route::get('/', [FrontEndController::class, 'index']);

Route::get('/find-jobs', [FrontEndController::class, 'findJobs']);

Route::get('/job/details/{slug}', [FrontEndController::class, 'jobDetails']);

Route::get('/job-categories/{slug}', [FrontEndController::class, 'jobsByCategory']);

Route::get('/job-categories', [FrontEndController::class, 'jobsCategories']);

Route::get('/artisans', [FrontEndController::class, 'artisans']);

Route::get('/artisan/details/{slug}', [FrontEndController::class, 'artisanDetails']);

Route::get('/businesses', [FrontEndController::class, 'businesses']);

Route::get('/business/details/{slug}', [FrontEndController::class, 'businessDetails']);

Route::get('/resources/blog', [FrontEndController::class, 'blogPosts']);

Route::get('/resources/blog/{slug}', [FrontEndController::class, 'blogDetails']);

Route::get('/resources/tutorial-videos', [FrontEndController::class, 'tutorialVideos']);

Route::get('/mini-store', [FrontEndController::class, 'miniStore']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/verify-email', [App\Http\Controllers\OnboardingController::class, 'verifyEmail'])->name("verifyEmail");

Route::get('/send-verification-mail', [App\Http\Controllers\OnboardingController::class, 'sendVerificationMail'])->name("sendVerificationMail");

Route::post('/initiate-password-reset', [App\Http\Controllers\OnboardingController::class, 'initiatePasswordReset'])->name("initiatePasswordReset");

Route::get('/password-reset-confirmation', [App\Http\Controllers\OnboardingController::class, 'pwdResetConfirmation'])->name("pwdResetConfirmation");

Route::post('/password-reset-verification', [App\Http\Controllers\OnboardingController::class, 'passwordResetVerification'])->name("passwordResetVerification");

Route::get('/new-password', [App\Http\Controllers\OnboardingController::class, 'newPassword'])->name("newPassword");

Route::post('/create-new-password', [App\Http\Controllers\OnboardingController::class, 'createNewPassword'])->name("createNewPassword");

Route::get('/account-selection', [App\Http\Controllers\OnboardingController::class, 'accountSelection'])->name("accountSelection");

Route::get('/select-account/{accountType}', [App\Http\Controllers\OnboardingController::class, 'selectAccountType'])->name("selectAccount");

Route::group([
    'middleware' => ['emailverified'],
], function ($router) {

    Route::get('/business/dashboard', [App\Http\Controllers\Business\HomeController::class, 'dashboard'])->name('business.dashboard');

    Route::get('/artisan/dashboard', [App\Http\Controllers\Artisan\HomeController::class, 'dashboard'])->name('artisan.dashboard');

});

Route::group([
    'middleware' => ['emailverified'],
], function ($router) {
    Route::post('/select-account-type', [OnboardingController::class, 'selectAccountType']);

    Route::group([
        'prefix' => 'business',
        'middleware' => 'validatebusiness',

    ], function ($router) {

        Route::get('/view-profile', [App\Http\Controllers\Business\HomeController::class, 'viewProfile'])->name("business.viewProfile");

        Route::get('/change-password', [App\Http\Controllers\Business\HomeController::class, 'changePassword'])->name("business.changePassword");

        Route::post('/update-profile', [App\Http\Controllers\Business\HomeController::class, 'updateProfile'])->name("business.updateProfile");

        Route::post('/update-password', [App\Http\Controllers\Business\HomeController::class, 'updatePassword'])->name("business.updatePassword");

        Route::get('/business-profile', [App\Http\Controllers\Business\HomeController::class, 'businessProfile'])->name("business.businessProfile");

        Route::post('/update-business-profile', [App\Http\Controllers\Business\HomeController::class, 'updateBusinessProfile'])->name("business.updateBusinessProfile");

        Route::get('/notification-settings', [App\Http\Controllers\Business\HomeController::class, 'notificationSettings'])->name("business.notificationSettings");

        Route::get('/notification/unsubscribe-all', [App\Http\Controllers\Business\HomeController::class, 'unsubscribeAllNotifications'])->name("business.unsubscribeAllNotifications");

        Route::get('/toggleAllNotificationSettings', [App\Http\Controllers\Business\HomeController::class, 'toggleAllNotificationSettings'])->name('business.toggleAllNotificationSettings');

        Route::get('/toggleSpecificNotificationSettings', [App\Http\Controllers\Business\HomeController::class, 'toggleSpecificNotificationSettings'])->name('business.toggleSpecificNotificationSettings');

        Route::get('/security', [App\Http\Controllers\Business\HomeController::class, 'security'])->name("business.security");

        Route::post('/select2FA', [App\Http\Controllers\Business\HomeController::class, 'select2FA'])->name("business.select2FA");

        Route::post('/enableGA', [App\Http\Controllers\Business\HomeController::class, 'enableGA'])->name("business.enableGA");

        Route::post('/selectWithdrawalConfirmation', [App\Http\Controllers\Business\HomeController::class, 'selectWithdrawalConfirmation'])->name("business.selectWithdrawalConfirmation");

        Route::get('/referrals', [App\Http\Controllers\Business\ReferralController::class, 'referrals'])->name("business.referrals");

        Route::get('/utility-transactions', [App\Http\Controllers\Business\UtilityController::class, 'utilityTransactions'])->name("business.utilityTransactions");

        Route::get('/job-listing', [App\Http\Controllers\Business\JobListingController::class, 'jobListings'])->name("business.jobListing");

        Route::get('/job/details/{id}', [App\Http\Controllers\Business\JobListingController::class, 'jobDetails'])->name("business.jobDetails");

        Route::get('/job/assets/{id}', [App\Http\Controllers\Business\JobListingController::class, 'jobAssets'])->name("business.jobAssets");

        Route::get('/job/applications', [App\Http\Controllers\Business\JobListingController::class, 'allJobApplications'])->name("business.allJobApplications");

        Route::get('/job/applications/{id}', [App\Http\Controllers\Business\JobListingController::class, 'jobApplications'])->name("business.jobApplications");

        Route::get('/application/details/{id}', [App\Http\Controllers\Business\JobListingController::class, 'applicationDetails'])->name("business.applicationDetails");

        Route::get('/application/approve/{id}', [App\Http\Controllers\Business\JobListingController::class, 'approveApplication'])->name("business.approveApplication");

        Route::get('/application/reject/{id}', [App\Http\Controllers\Business\JobListingController::class, 'rejectApplication'])->name("business.rejectApplication");

        Route::get('/application/archive/{id}', [App\Http\Controllers\Business\JobListingController::class, 'archiveJobApplications'])->name("business.archiveJobApplications");

        Route::get('/buy-airtime', [App\Http\Controllers\Business\UtilityController::class, 'buyAirtime'])->name("business.buyAirtime");

        Route::get('/buy-airtime/preview/{id}', [App\Http\Controllers\Business\UtilityController::class, 'airtimePreview'])->name("business.airtimePreview");

        Route::get('/airtime-purchase/wallet/{id}', [App\Http\Controllers\Business\UtilityController::class, 'walletAirtimePurchase'])->name("business.walletAirtimePurchase");

        Route::post('airtimePurchasePreview', [App\Http\Controllers\Business\UtilityController::class, 'airtimePurchasePreview'])->name("business.airtimePurchasePreview");

        Route::get('/buy-data', [App\Http\Controllers\Business\UtilityController::class, 'buyData'])->name("business.buyData");

        Route::get('/buy-data/preview/{id}', [App\Http\Controllers\Business\UtilityController::class, 'dataPreview'])->name("business.dataPreview");

        Route::get('/data/plans/{provider}', [App\Http\Controllers\Business\UtilityController::class, 'retrieveDataPlans'])->name('business.data.plans');

        Route::post('dataPurchasePreview', [App\Http\Controllers\Business\UtilityController::class, 'dataPurchasePreview'])->name("business.dataPurchasePreview");

        Route::get('/data-purchase/wallet/{id}', [App\Http\Controllers\Business\UtilityController::class, 'walletDataPurchase'])->name("business.walletDataPurchase");

        Route::get('/buy-cable', [App\Http\Controllers\Business\UtilityController::class, 'buyCable'])->name("business.buyCable");

        Route::get('/cable/plans/{provider}', [App\Http\Controllers\Business\UtilityController::class, 'retrieveCablePlans'])->name('business.cable.plans');

        Route::post('cablePurchasePreview', [App\Http\Controllers\Business\UtilityController::class, 'cablePurchasePreview'])->name("business.cablePurchasePreview");

        Route::get('/buy-cable/preview/{id}', [App\Http\Controllers\Business\UtilityController::class, 'cablePreview'])->name("business.cablePreview");

        Route::get('/cable-purchase/wallet/{id}', [App\Http\Controllers\Business\UtilityController::class, 'walletCablePurchase'])->name("business.walletCablePurchase");

        Route::get('/buy-electricity', [App\Http\Controllers\Business\UtilityController::class, 'buyElectricity'])->name("business.buyElectricity");

        Route::post('electricityPurchasePreview', [App\Http\Controllers\Business\UtilityController::class, 'electricityPurchasePreview'])->name("business.electricityPurchasePreview");

        Route::get('/buy-electricity/preview/{id}', [App\Http\Controllers\Business\UtilityController::class, 'electricityPreview'])->name("business.electricityPreview");

        Route::get('/electricity-purchase/wallet/{id}', [App\Http\Controllers\Business\UtilityController::class, 'walletElectricityPurchase'])->name("business.walletElectricityPurchase");

        Route::post('/add-milestone', [App\Http\Controllers\Business\JobListingController::class, 'addProjectMilestone'])->name("business.addProjectMilestone");

        Route::post('/update-milestone', [App\Http\Controllers\Business\JobListingController::class, 'updateProjectMilestone'])->name("business.updateProjectMilestone");

        Route::get('/jobs/initialize', [App\Http\Controllers\Business\JobListingController::class, 'initializeNewJob'])->name("business.initializeNewJob");

        Route::get('/jobs/new', [App\Http\Controllers\Business\JobListingController::class, 'newJobListing'])->name("business.newJobListing");

        Route::post('/jobs/save', [App\Http\Controllers\Business\JobListingController::class, 'storeJobListing'])->name("business.storeJobListing");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        Route::post('/account-pin-setup', [BusinessAccountController::class, 'setupAccountPin']);
        Route::post('/update-photo', [BusinessAccountController::class, 'updateProfilePhoto']);
        Route::get('/view-notification-settings', [BusinessAccountController::class, 'viewNotificationSettings']);
        Route::post('/update-notification-settings', [BusinessAccountController::class, 'updateNotificationSettings']);
        Route::get('/view-business-details', [BusinessAccountController::class, 'viewBusinessDetails']);
        Route::post('/update-business-details', [BusinessAccountController::class, 'updateBusinessDetails']);
        Route::post('/update-logo', [BusinessAccountController::class, 'updateBusinessLogo']);
        Route::post('/delete-account', [BusinessAccountController::class, 'deleteAccount']);
        Route::get('/view-notifications', [NotificationController::class, 'viewNotifications']);
        Route::post('/delete-notification', [NotificationController::class, 'deleteNotification']);
        Route::post('/clear-notifications', [NotificationController::class, 'clearNotifications']);
        Route::get('/view-referrals', [ReferralController::class, 'viewReferrals']);
        Route::get('/referral-link', [ReferralController::class, 'referralLink']);
        Route::get('/referral-stats', [ReferralController::class, 'referralStats']);
        Route::get('/referral-details', [ReferralController::class, 'referralDetails']);
        Route::get('/wallet-balances', [WalletController::class, 'walletBalances']);
        Route::get('/view-referral-points', [WalletController::class, 'viewReferralPoints']);
        Route::get('/view-arete-balance', [WalletController::class, 'viewAreteBalance']);
        Route::get('/view-referral-transactions', [WalletController::class, 'viewReferralTransactions']);
        Route::get('/view-arete-transactions', [WalletController::class, 'viewAreteTransactions']);
        Route::get('/view-arete-wallet-transactions', [WalletController::class, 'viewAreteTransactions']);
        Route::post('/initiate-card-addition', [WalletController::class, 'initiateCardAddition']);
        Route::post('/add-new-card', [WalletController::class, 'addNewCard']);
        Route::get('/view-stored-cards', [WalletController::class, 'viewStoredCards']);
        Route::post('/delete-card', [WalletController::class, 'deleteCard']);
        Route::get('/card-transactions', [WalletController::class, 'viewCardTransactions']);
        Route::post('/fund-arete-wallet', [WalletController::class, 'fundAreteWallet']);
        Route::get('/bank-list', [WalletController::class, 'bankList']);
        Route::post('/validate-bank-account', [WalletController::class, 'validateBankAccount']);
        Route::post('/withdraw-funds', [WalletController::class, 'withdrawFunds']);
        Route::get('/view-contact-list', [ChatController::class, 'viewContactList']);
        Route::post('/search-contact-list', [ChatController::class, 'searchContactList']);
        Route::post('/initialize-chat', [ChatController::class, 'initializeChat']);
        Route::post('/new-chat', [ChatController::class, 'newChat']);
        Route::get('/chat-conversations', [ChatController::class, 'chatConversations']);
        Route::post('/delete-chat', [ChatController::class, 'deleteChat']);
        Route::post('/delete-conversation', [ChatController::class, 'deleteConversation']);
        Route::get('/airtime-providers', [UtilityController::class, 'airtimeProviders']);
        Route::post('/initiate-airtime-purchase', [UtilityController::class, 'initiateAirtimePurchase']);
        Route::post('/buy-airtime', [UtilityController::class, 'buyAirtime']);
        Route::get('/data-providers', [UtilityController::class, 'dataProviders']);
        Route::get('/data-plans', [UtilityController::class, 'dataPlans']);
        Route::post('/initiate-data-purchase', [UtilityController::class, 'initiateDataPurchase']);
        Route::post('/buy-data', [UtilityController::class, 'buyData']);
        Route::get('/electricity-providers', [UtilityController::class, 'electricityProviders']);
        Route::post('/initiate-electricity-purchase', [UtilityController::class, 'initiateElectricityPurchase']);
        Route::post('/buy-electricity-units', [UtilityController::class, 'buyElectricity']);
        Route::get('/cable-providers', [UtilityController::class, 'cableProviders']);
        Route::get('/cable-plans', [UtilityController::class, 'cablePlans']);
        Route::post('/initiate-cable-purchase', [UtilityController::class, 'initiateCablePurchase']);
        Route::post('/buy-cable-subscription', [UtilityController::class, 'buyCable']);
        Route::get('/subscription-plans', [SubscriptionController::class, 'subscriptionPlans']);
        Route::get('/active-subscription', [SubscriptionController::class, 'activeSubscription']);
        Route::post('/subscribe', [SubscriptionController::class, 'subscribe']);
        Route::post('/set-auto-renewal', [SubscriptionController::class, 'setAutoRenewal']);
        Route::group([
            'middleware' => 'businessprofileupdated',
        ], function ($router) {
            Route::get('/generate-tracking-code', [JobsController::class, 'generateTrackingCode']);
            Route::post('/create-new-job', [JobsController::class, 'createNewJob']);
            Route::post('/update-job-details', [JobsController::class, 'updateJobDetails']);
            Route::get('/view-jobs', [JobsController::class, 'viewJobs']);
            Route::get('/filter-jobs', [JobsController::class, 'filterJobs']);
            Route::get('/view-job-details', [JobsController::class, 'viewJobDetails']);
            Route::post('/delete-job', [JobsController::class, 'deleteJob']);
            Route::post('/upload-project-assets', [JobsController::class, 'uploadProjectAssets']);
            Route::post('/delete-project-asset', [JobsController::class, 'deleteProjectAsset']);

        });
    });

    Route::group([
        'prefix' => 'artisan',
        'middleware' => 'validateartisan',
    ], function ($router) {
        Route::post('/update-photo', [ArtisanAccountController::class, 'updateProfilePhoto']);
        Route::get('/view-profile', [ArtisanAccountController::class, 'viewProfile']);
        Route::post('/update-profile', [ArtisanAccountController::class, 'updateProfile']);
        Route::post('/update-password', [ArtisanAccountController::class, 'updatePassword']);
        Route::get('/view-notifications', [NotificationController::class, 'viewNotifications']);
        Route::post('/delete-notification', [NotificationController::class, 'deleteNotification']);
        Route::post('/clear-notifications', [NotificationController::class, 'clearNotifications']);

        Route::group([
            'middleware' => 'artisanprofileupdated',
        ], function ($router) {
            Route::get('/view-referrals', [ReferralController::class, 'viewReferrals']);
            Route::get('/referral-link', [ReferralController::class, 'referralLink']);
            Route::get('/referral-stats', [ReferralController::class, 'referralStats']);
            Route::get('/referral-details', [ReferralController::class, 'referralDetails']);
            Route::get('/view-contact-list', [ChatController::class, 'viewContactList']);
            Route::post('/search-contact-list', [ChatController::class, 'searchContactList']);
            Route::post('/initialize-chat', [ChatController::class, 'initializeChat']);
            Route::post('/new-chat', [ChatController::class, 'newChat']);
            Route::get('/chat-conversations', [ChatController::class, 'chatConversations']);
            Route::post('/delete-chat', [ChatController::class, 'deleteChat']);
            Route::post('/delete-conversation', [ChatController::class, 'deleteConversation']);
            Route::get('/wallet-balances', [WalletController::class, 'walletBalances']);
            Route::get('/view-referral-points', [WalletController::class, 'viewReferralPoints']);
            Route::get('/view-arete-balance', [WalletController::class, 'viewAreteBalance']);
            Route::get('/view-referral-transactions', [WalletController::class, 'viewReferralTransactions']);
            Route::get('/view-arete-transactions', [WalletController::class, 'viewAreteTransactions']);
            Route::get('/view-arete-wallet-transactions', [WalletController::class, 'viewAreteTransactions']);
            Route::post('/initiate-card-addition', [WalletController::class, 'initiateCardAddition']);
            Route::post('/add-new-card', [WalletController::class, 'addNewCard']);
            Route::get('/view-stored-cards', [WalletController::class, 'viewStoredCards']);
            Route::post('/delete-card', [WalletController::class, 'deleteCard']);
            Route::get('/card-transactions', [WalletController::class, 'viewCardTransactions']);
            Route::post('/fund-arete-wallet', [WalletController::class, 'fundAreteWallet']);
            Route::get('/bank-list', [WalletController::class, 'bankList']);
            Route::post('/validate-bank-account', [WalletController::class, 'validateBankAccount']);
            Route::post('/withdraw-funds', [WalletController::class, 'withdrawFunds']);
            Route::get('/airtime-providers', [UtilityController::class, 'airtimeProviders']);
            Route::post('/initiate-airtime-purchase', [UtilityController::class, 'initiateAirtimePurchase']);
            Route::post('/buy-airtime', [UtilityController::class, 'buyAirtime']);
            Route::get('/data-providers', [UtilityController::class, 'dataProviders']);
            Route::get('/data-plans', [UtilityController::class, 'dataPlans']);
            Route::post('/initiate-data-purchase', [UtilityController::class, 'initiateDataPurchase']);
            Route::post('/buy-data', [UtilityController::class, 'buyData']);
            Route::get('/electricity-providers', [UtilityController::class, 'electricityProviders']);
            Route::post('/initiate-electricity-purchase', [UtilityController::class, 'initiateElectricityPurchase']);
            Route::post('/buy-electricity-units', [UtilityController::class, 'buyElectricity']);
            Route::get('/cable-providers', [UtilityController::class, 'cableProviders']);
            Route::get('/cable-plans', [UtilityController::class, 'cablePlans']);
            Route::post('/initiate-cable-purchase', [UtilityController::class, 'initiateCablePurchase']);
            Route::post('/buy-cable-subscription', [UtilityController::class, 'buyCable']);
            Route::get('/utility-transactions', [UtilityController::class, 'utilityTransactions']);
            Route::post('/add-portfolio', [PortfolioController::class, 'addPortfolio']);
            Route::get('/get-portfolio', [PortfolioController::class, 'getPortfolio']);
            Route::post('/delete-portfolio', [PortfolioController::class, 'deletePortfolio']);
        });

    });

});
