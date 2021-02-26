<?php

use Illuminate\Support\Facades\Route;

include_once 'stripe.php';

Route::get('/artisan/{command}', function ($command) {
    \Illuminate\Support\Facades\Artisan::call($command);
    dd('done => ' . $command);
});

//visit home page
Route::get('/', \App\Http\Livewire\Home::class)->name('home');

//search for therapists
Route::get('/search', \App\Http\Livewire\Search::class)->name('search');

//see more about therapist
Route::get('/more-about-therapist/{id}', \App\Http\Livewire\SearchTherapistsDetails::class)->name('more-about-therapist');

//book therapist
Route::group(['middleware' => ['email.verified', 'role:client']], function () {
    Route::get('/booking-calendar/{id}', \App\Http\Livewire\BookingCalendar::class)->name('booking-calendar');
});

//access account
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', \App\Http\Livewire\Login::class)->name('login');
    Route::get('/register', \App\Http\Livewire\Register::class)->name('register');
    Route::get('/forgot-password', \App\Http\Livewire\ForgotPassword::class)->name('forgot-password');
    Route::get('/verify-password-reset-code/{id}', \App\Http\Livewire\VerifyPasswordResetCode::class)->name('verify-password-reset-code');
    Route::get('/reset-password', \App\Http\Livewire\ResetPassword::class)->name('reset-password');
});

//routes for all roles
Route::group(['middleware' => ['auth']], function () {
    //verification
    Route::get('/verify-email/{verificationCode}', \App\Http\Livewire\VerifyEmail::class)->name('verify-email');
    Route::get('/verify-phone/{verificationCode}', \App\Http\Livewire\VerifyPhone::class)->name('verify-phone');

    //dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else  if (auth()->user()->isTherapist()) {
            return redirect()->route('therapist.dashboard');
        }else{
           return redirect()->route('client.dashboard');
        }
    })->name('dashboard');

    //account settings
    Route::get('/account-settings', \App\Http\Livewire\AccountSettings::class)->name('account-settings')->middleware('auth');
    Route::get('/setup-profile-picture', \App\Http\Livewire\SetupProfilePicture::class)->name('setup-profile-picture');
    Route::get('/setup-basic-info', \App\Http\Livewire\SetupBasicInfo::class)->name('setup-basic-info');
    Route::get('/setup-email', \App\Http\Livewire\SetupEmail::class)->name('setup-email');
    Route::get('/setup-phone', \App\Http\Livewire\SetupPhone::class)->name('setup-phone');
    Route::get('/change-password', \App\Http\Livewire\ChangePassword::class)->name('change-password');
    Route::get('/setup-emergency-phone', \App\Http\Livewire\SetupEmergencyPhone::class)->name('setup-emergency-phone')->middleware('role:client');

    // //verified and unverified therapists viewed by Administrator
    // Route::get('/therapists', \App\Http\Livewire\Therapists::class)->name('therapists')->middleware(['role:Administrator']);
    // Route::get('/approval-requests', \App\Http\Livewire\ApprovalRequests::class)->name('approval-requests')->middleware(['role:Administrator']);

    //appointment
    Route::get('/appointments', \App\Http\Livewire\AppointmentList::class)->name('appointments');
    Route::get('/appointment-show/{id}', \App\Http\Livewire\AppointmentShow::class)->name('appointment-show');

    //my therapists
    Route::get('my-therapists', \App\Http\Livewire\MyTherapistsList::class)->name('my-therapists')->middleware('role:Client');
    Route::get('my-spending', \App\Http\Livewire\MySpending::class)->name('my-spending')->middleware('role:Client');

    Route::get('my-clients', \App\Http\Livewire\ClientsList::class)->name('my-clients')->middleware('role:Therapist');
    Route::get('clients', \App\Http\Livewire\ClientsList::class)->name('clients')->middleware('role:Administrator');
    Route::get('client-show/{id}', \App\Http\Livewire\ClientShow::class)->name('client-show');

    //support tickets
    Route::get('/support-tickets', \App\Http\Livewire\SupportTickets::class)->name('support-tickets');
    Route::get('/support-ticket-details/{id}', \App\Http\Livewire\SupportTicketShow::class)->name('support-ticket-details');
});


//administartor
Route::group(['prefix' => 'admin-portal', 'middleware' => ['auth', 'role:Administrator']], function () {
    //admin dashboard
    Route::get('/dashboard', \App\Http\Livewire\AdminDashboard::class)->name('admin.dashboard');

    //admin therapists
    Route::get('/therapists', \App\Http\Livewire\AdminTherapists::class)->name('admin.therapists');
    Route::get('/therapist-details/{therapistId}', \App\Http\Livewire\AdminTherapistView::class)->name('admin.therapist-view');

    //admin clients
    // Route::get('/clients', \App\Http\Livewire\AdminClients::class)->name('admin.clients');
    // Route::get('/client-details/{clientId}', \App\Http\Livewire\AdminClientView::class)->name('admin.client-view');
});

//therapist
Route::group(['prefix' => 'therapist-portal', 'middleware' => ['auth', 'role:Therapist']], function () {
    Route::get('/dashboard', \App\Http\Livewire\UserDashboard::class)->name('therapist.dashboard');
    //therapist recommendations
    Route::get('/recommendations', \App\Http\Livewire\Recommendations::class)->name('therapist.recommendations');
    //professional profile setup
    Route::get('/professional-profile/{page}', \App\Http\Livewire\ProProfileSettings::class)->name('therapist.professional-profile')->middleware('email.verified');
});


//client
Route::group(['prefix' => 'client-portal', 'middleware' => ['auth', 'role:Client']], function () {
    Route::get('/dashboard', \App\Http\Livewire\UserDashboard::class)->name('client.dashboard');
    //therapist recommendations
    Route::get('/recommendations', \App\Http\Livewire\Recommendations::class)->name('client.recommendations');
});


//Route::get('/conversation-show/{id}', \App\Http\Livewire\ConversationShow::class)->name('conversation-show');
//Route::get('/conversations', \App\Http\Livewire\ConversationsList::class)->name('conversations');

//attend meeting
Route::get('/attend-meeting/{id}/{token}', \App\Http\Livewire\VideoCall::class)->name('attend-meeting');

//privacy policy
Route::get('/privacy-policy', \App\Http\Livewire\PrivacyPolicy::class)->name('privacy-policy');

//faqas
Route::get('/faqs', \App\Http\Livewire\Faq::class)->name('faqs');

//terms of service
Route::get('/terms-of-service', \App\Http\Livewire\TermsOfService::class)->name('terms-of-service');

//about us
Route::get('/about-us', \App\Http\Livewire\AboutUs::class)->name('about-us');
