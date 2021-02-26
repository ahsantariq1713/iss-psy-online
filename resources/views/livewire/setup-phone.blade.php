<div>
    <header class="page-title-bar text-center mt-5" wire:ignore>
        <h4 class="font-weight-normal">
            @if(not_null($back))
                <a href="{{$back}}" class="text-black text-decoration-none">
                    <i class="mdi mdi-arrow-left "></i>
                </a>
            @endif
            Phone Setup
        </h4>
    </header>
    <div class="row">
        <form wire:submit.prevent="submit" class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-3">
            <p class="text-muted text-left">
                Please make sure that the phone number you are providing is correct before saving it, as it will be used to send verification codes, appointment reminders, payment confirmations, and links to join confirmed meetings with your preferred therapists.
            </p>
            <p class="text-muted text-left">
                Also note, that we have implemented this system to make your experience more efficient, secure and convenient, and that no refunds will be applicable if notifications sent from Psychologists Online are not arriving to you, due to having provided the incorrect personal information.
            </p>
            @if(not_null(Auth::user()->phone))
                <div class="form-group">
                    <label for="currentPhone">Current Phone</label>
                    <input class="form-control form-control-lg" id="currentPhone" type="text" readonly value="{{Auth::user()->phone}}">
                </div>

                @if(is_null(Auth::user()->phone_verified_at))
                    <div class="alert alert-secondary d-flex justify-content-between">
                        <div>
                            <h6 class="mb-0">Phone Number Verification Pending</h6>
                            <p class="m-0">Your current phone number is not verified!</p>
                        </div>
                        <a href="{{Auth::user()->phoneVerificationLink()}}?back=/account-settings" class="btn  btn-secondary">Verify Phone</a>
                    </div>
                @endif

                <h6 class="mt-4">Change Your Phone Number</h6>
            @endif
            <p>Type carefully! We will use this code number to send verification code.</p>
            <div class="form-group">
                <label for="code">Country Code</label>
                <div wire:ignore>
                    <select class="form-control form-control-lg"
                            id="code"  data-toggle="select2">
                        @foreach($countries as $viewCountry)
                            <option value="{{$viewCountry->code}}">
                                {{$viewCountry->short}} - {{$viewCountry->name}}(+{{$viewCountry->code}})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="phone">{{ not_null(Auth::user()->phone) ?   'Your Phone Number' : 'New Phone Number'}}</label>
                <input class="form-control form-control-lg @error('phone') is-invalid @enderror" id="phone" type="text"
                       wire:model.defer="phone">
                @error('phone')
                <span class="invalid-feedback">{{$errors->first('phone')}}</span>
                @enderror
            </div>
            @if(not_null(Auth::user()->phone))
                <div class="form-group">
                    <label for="password">Current Password</label>
                    <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" type="password"
                           wire:model.defer="password">
                </div>
            @endif
            <div class="form-group d-flex justify-content-end">
                <div wire:ignore> @if(not_null($back)) <a href="{{$back}}" class="btn btn-secondary mr-2"><i class="mdi mdi-arrow-left"></i> Back</a> @endif</div>
                <div wire:ignore> @if(not_null($skip)) <a href="{{$skip}}" class="btn btn-secondary mr-2"> Skip</a> @endif</div>
                <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="submit"></span>
                    {{ not_null(Auth::user()->phone) ?   'Change Phone' : 'Continue'}}
                </button>
            </div>
        </form>
    </div>


    @include('partials.global.country-region-injector')
    <script>
        document.addEventListener('livewire:load', () => {
            window.livewire.on('selectCountry', (countryCode) => {
                $('#code').val(countryCode);
                $('#code').trigger('change');
            })
            $('#code').on('select2:select', e => @this.set('code', e.params.data.id));
        });
    </script>

</div>
