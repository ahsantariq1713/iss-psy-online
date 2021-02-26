<div>
    <div class="page-section mt-5 pt-5">
        <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">

            @if(session('error'))
                <div class="alert alert-danger py-4 px-4">
                    <h5 class="text-danger">Stripe Error</h5>
                    <p class="m-0 p-0 mb-3">Something went wrong while connecting your stripe account. Please try again or contact us.</p>
                </div>
            @else
                @if(not($profileLog->payment))
                    <div class="alert alert-info px-4">
                        <p class="m-0 p-0">You will need a Stripe account to receive your session fees.</p>
                    </div>
                @else
                    <div class="alert alert-success py-4 px-4">
                        <p class="m-0 p-0">Your account is set up to receive your session fees from your clients.</p>
                    </div>
                @endif
            @endif


            <p>We use <a href="">Stripe</a> to transfer your client payments to you because it is secure, safe and regulation-compliant. Similar to Paypal, Stripe is one of the
                world's leading card payment providers, trusted by over 100,000+ businesses in 100+ countries.</p>
            <p>Your client's session fees will be taken online by Stripe before their appointments. This means that you do not need to manage invoicing or chasing late
                payments.</p>

            @if(not($profileLog->payment))
                <h4 class="mt-4">Create or Connect Existing Account</h4>
                <p> Creating a Stripe account to get paid is free, safe and setup only takes a few minutes. You can also connect your existing Stripe account. Once you are done,
                    you will be brought back to this page.</p>

                <form wire:submit.prevent="connect" method="post" class="d-flex justify-content-lg-start">
                    <button type="submit" class="btn btn-link p-0"><img src="{{asset('assets/images/site/stripe.png')}}" height="33" width="193" alt="Connect With Stripe"></button>
                    <div class="pt-1 pl-2">
                        <span wire:loading.delay  wire:target="connect" class="spinner-border spinner-border-sm" style="height:25px!important;width:25px!important"></span>
                    </div>
                </form>

                <p class="mt-4">You just need your bank details and website address or just use the globaldoctorsonline.com address, since you will be joining this website. Stripe
                    needs this
                    information to perform the checks required under the UK Government's money laundering regulations.</p>
            @endif

            <h4 class="mt-4 mb-3">FAQ's</h4>
            <div class="panel-group" id="accordion">
                <div class="card px-3 pt-3 pb-2 mb-1" style="border-left: 5px solid lightgray">
                    <p class="m-0 pb-1"><a class="text-decoration-none text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapse1">When will I be paid?</a></p>
                    <div id="collapse1" class="collapse">
                        <p>When a client pays for their session with you, the balance of the fee paid is transferred to your Stripe account at least 48 hours beforehand
                            automatically, minus Psychologists Onine commission. Stripe then transfer these funds to your bank account once they have cleared. Cleared funds
                            normally reach your bank account 7 days after the client payment is made.</p>
                    </div>
                </div>
                <div class="card px-3 pt-3 pb-2 mb-1" style="border-left: 5px solid lightgray">
                    <p class="m-0 pb-1"><a class="text-decoration-none text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Why do Stripe ask me to
                            authorise the ability to take payments from my account?</a></p>
                    <div id="collapse2" class="collapse">
                        <p>To allow for a situation where a client session is cancelled and they are due a refund, Stripe need to be able to process this refund by withdrawing
                            the client's funds back to their account. This is the only time this would occur. Stripe need to confirm that, in this event, your account is set up
                            to manage this.</p>
                    </div>
                </div>
                <div class="card px-3 pt-3 pb-2 mb-5" style="border-left: 5px solid lightgray">
                    <p class="m-0 pb-1"><a class="text-decoration-none text-dark" data-toggle="collapse" data-parent="#accordion" href="#collapse3">What do I get paid?</a></p>
                    <div id="collapse3" class="collapse">
                        <p>Psychologists Onine commission is applied to each successful client referral. You receive the amount paid by your client net the Psychologists Onine
                            commission due on the payment.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
