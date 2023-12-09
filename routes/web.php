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
        Route::post('/account-pin-setup', [BusinessAccountController::class, 'setupAccountPin']);
        Route::post('/update-photo', [BusinessAccountController::class, 'updateProfilePhoto']);
        Route::get('/view-profile', [BusinessAccountController::class, 'viewProfile']);
        Route::post('/update-profile', [BusinessAccountController::class, 'updateProfile']);
        Route::post('/update-password', [BusinessAccountController::class, 'updatePassword']);
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
        Route::get('/utility-transactions', [UtilityController::class, 'utilityTransactions']);
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
