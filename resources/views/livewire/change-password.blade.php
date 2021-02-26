<div>
    <header class="page-title-bar text-center mt-5">
        <h4 class="font-weight-normal">
            <a href="/account-settings"><i class="mdi mdi-arrow-left"></i></a>
            Change Your Password
        </h4>
        <p class="text-muted">You must change your password after every 15 days.</p>
    </header>
    <div class="row">
        <form wire:submit.prevent="change" class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-3">
            <div class="form-group">
                <label for="password">Current Password</label>
                <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" type="password" wire:model.debounce.defer="password">
                @error('password')
                <span class="invalid-feedback">{{$errors->first('password')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input class="form-control form-control-lg @error('new_password') is-invalid @enderror" id="new_password" type="password" wire:model.debounce.defer="new_password">
                @error('new_password')
                <span class="invalid-feedback">{{$errors->first('new_password')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" id="password_confirmation" type="password"
                       wire:model.debounce.defer="password_confirmation">
            </div>
            <div class="form-group d-flex justify-content-end">
                <a href="/account-settings" class="btn btn-secondary"> <i class="mdi mdi-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm" wire:loading.delay></span>
                    Change Password
                </button>
            </div>
        </form>
    </div>

</div>
