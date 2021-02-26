<div class="tab-pane fade" id="pricing-payment" role="tabpanel" aria-labelledby="client-billing-contact-tab">
    <div class="card">
        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title">Pricing</h2>
        </div>
        <div class="card-body" style="padding:0px 10px!important">
            <!-- hourly rate -->
            <div class="row py-2">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Hourly Rate</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    ${{(int)$therapist->pricing->fee}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                </div>
            </div>
            <!-- session fee -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Session Fee</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                      ${{(int)$therapist->pricing->fee}} x {{$therapist->roster->durationHours()}} Hr = ${{$therapist->pricing->therapyFeeUSD()}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>
            <!-- stripe acc # -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Stripe Account #</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->stripe_acc_id}}
                    <p class="m-0 small text-muted">Connected on November 15, 2020</p>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">

                </div>
            </div>

        </div>
    </div>
</div>
