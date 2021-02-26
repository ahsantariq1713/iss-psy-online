<div>

    <div class="page-section mt-5 pt-5">

        <form wire:submit.prevent="update" class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">
            {{-- <div class="alert alert-info">
                This application is in test mode you will not receive any amount if you give services to clients.
            </div> --}}
            <h6 class="m-0 mb-2">Hourly Fee <span class="text-muted">(USD)</span></h6>
            <div wire:ignore class="m-0 p-0">
                <select class="form-control form-control-lg" data-toggle="select2"
                        id="pricing-fee">
                    @for($i = 35; $i <= 1000; $i+=5)
                        <option {{$pricing->fee == $i ? 'selected':''}}>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="alert alert-primary py-4 px-4 mt-3 border-0">
                <div class="row  font-weight-normal">
                    <div class="col-2 text-muted small ">Hourly Fee</div>
                    <div class="col-3 text-muted small  text-left">Meeting Duration</div>
                    <div class="col text-muted  small text-right">Session Fee</div>
                </div>
                <div class="row h6 font-weight-normal">
                    <div class="col-2 text-black">${{$pricing->fee}}</div>
                    <div class="col-3 text-black text-left">x{{$pricing->user->roster->durationHours()}} Hr.</div>
                    <div class="col text-black text-right"><small class="text-muted">(incl. commission)</small>
                        ${{$pricing->therapyFeeUSD()}}</div>
                </div>
                <hr>
                <h5 class="text-left">You will receive <span class="h2">${{$pricing->therapistReceives()}}</span></h5>
                <p class="mb-2">Our commission (including card payment processing fees) payable to Psychologists Online
                    is:</p>
                <ul class="m-0 p-0 pl-3">
                    <li>{{env('PLATFORM_COMMISSION')}}% for each appointment.</li>
                </ul>
            </div>

            <div class="form-group d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary ml-2" wire:target="update" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="update"></span>
                    Save and Next
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('livewire:load', () => {
            $('#pricing-fee').on('select2:select', e => @this.set('pricing.fee', e.params.data.text)
        )
            ;
        });

    </script>
</div>
