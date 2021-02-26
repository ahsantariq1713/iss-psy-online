<div>
    <div>
        <form wire:submit.prevent="send" class="auth-form">
            <h5>Forgot Password</h5>
            <p class="text-muted">Please enter your email address to get password reset code.</p>
            <div class="form-group">
                <div class="form-label-group">
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" wire:model.defer="email">
                    <label for="email">Email Address</label>
                    @error('email')
                    <span class="invalid-feedback">{{$errors->first('email')}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-lg btn-primary font-weight-bold" wire:loading.attr="disabled" wire:target='send'>
                    <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="send"></span>
                    Send Password Reset Code
                </button>
            </div>
        </form>
    </div>
</div>
