<div>
    <header class="page-title-bar text-center mt-5" wire:ignore>
        <h4 class="font-weight-normal">
            @if(not_null($back))
                <a href="{{$back}}" class="text-black text-decoration-none">
                    <i class="mdi mdi-arrow-left "></i>
                </a>
            @endif
            Email Setup
        </h4>
        <p class="text-muted">Type carefully! We will use this email to send verification code.</p>
    </header>
    <div class="row">
        <form wire:submit.prevent="change" class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-3">
            <div class="form-group">
                <label for="currentEmail">Current Email</label>
                <input class="form-control form-control-lg" id="currentEmail" type="text" readonly value="{{Auth::user()->email}}">
            </div>
            @if(is_null(Auth::user()->email_verified_at))
                <div class="alert alert-secondary d-flex justify-content-between">
                    <div>
                        <h6 class="mb-0">Email Verification Pending</h6>
                        <p class="m-0">Your current email is not verified!</p>
                    </div>
                    <a href="{{Auth::user()->emailVerificationLink()}}?back=/account-settings" class="btn  btn-secondary">Verify Email</a>
                </div>
            @endif
            <h6 class="mt-4">Change Your Email</h6>
            <p>Type carefully! We will use this email to send verification code.</p>
            <div class="form-group">
                <label for="email">New Email</label>
                <input class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" type="text"
                       wire:model.debounce.500ms="email">
                @error('email')
                <span class="invalid-feedback">{{$errors->first('email')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Current Password</label>
                <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" type="password"
                       wire:model.defer="password">
            </div>
            <div class="form-group d-flex justify-content-end">
                <div wire:ignore> @if(not_null($back)) <a href="{{$back}}" class="btn btn-secondary mr-2"><i class="mdi mdi-arrow-left"></i> Back</a> @endif</div>
                <div wire:ignore> @if(not_null($skip)) <a href="{{$skip}}" class="btn btn-secondary mr-2"> Skip</a> @endif</div>
                <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="change"></span>
                    Change Email
                </button>
            </div>
        </form>
    </div>

</div>
