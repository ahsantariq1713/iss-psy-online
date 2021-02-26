<div>

   <form wire:submit.prevent="resetPassword" class="auth-form">
    <h5>Set New Password</h5>
    <p class="text-muted">Type your new password for your account associated with email {{$email}} </p>


    <div class="form-group">
        <div class="form-label-group">
            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" wire:model.defer="password">
            <label for="password">Password</label>
            @error('password')
            <span class="invalid-feedback">{{$errors->first('password')}}</span>
            @enderror
        </div>
    </div>

     <div class="form-group">
        <div class="form-label-group">
            <input class="form-control" id="password_confirmation" type="password" wire:model.defer="password_confirmation">
            <label for="password_confirmation">Confirm Password</label>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-block btn-lg btn-primary font-weight-bold" wire:loading.attr="disabled" wire:target='resetPassword'>
            <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="resetPassword"></span>
           Reset Password
        </button>
    </div>

</form>
</div>
