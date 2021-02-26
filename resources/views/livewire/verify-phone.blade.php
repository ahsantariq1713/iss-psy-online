<div>
    <div class="auth-form auth-form-reflow mt-5">
        <!-- header -->
        <h3 class="mb-2">{{$type}}</h3>
        <p class="text-muted mt-0">{{$message}}</p>
        <p>If you can't access this phone then <a href="/setup-phone/?next={{$next}}&back=/verify-phone/{{$codeid}}?next={{$next}}">change your phone</a></p>
        <!-- secret -->
        <div class="form-group mt-2">
            <div class="form-group">
                <label for="secret" hidden></label>
                <input class="form-control form-control-lg p-5 text-center font-weight-bold @error('secret') is-invalid @enderror"
                       id="secret" maxlength="6" style="font-size:50px" type="text" wire:loading.attr="readonly" wire:loading.class="text-muted"
                       wire:model.defer="secret"
                       wire:target="verify"
                       placeholder="Secret">
                @error('secret')
                <span class="invalid-feedback">{{$errors->first('secret')}}</span>
                @enderror
            </div>
        </div>
        <!-- resend -->
        <p class="text-center">Didn't receive a code?
            <button type="button" class="text-info btn" wire:click="resend" wire:loading.attr="disabled">
                <span>Resend Code</span>
                <span aria-hidden="true" class="spinner-border spinner-border-sm ml-1" role="status" wire:loading.delay wire:target="resend"></span>
            </button>
        </p>
        <!-- verify -->
        <div class="form-group">
            <button class="btn btn-lg btn-block btn-primary" type="button" wire:click="verify" wire:loading.attr="disabled" wire:target="verify">
                <span aria-hidden="true" class="spinner-border spinner-border-sm mr-1" role="status" wire:loading.delay wire:target="verify"></span>
                <span>Continue</span>
            </button>
        </div>
    </div>
    <hr class="mt-4">
</div>
