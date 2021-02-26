<div>
    <!-- login form -->
    <form wire:submit.prevent="login" class="auth-form">
        <h5>Account Login</h5>
        <p class="text-muted">Please enter your credentials to access your account.</p>
        <!-- email -->
        <div class="form-group">
            <div class="form-label-group">
                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" wire:model.defer="email">
                <label for="email">Email Address</label>
                @error('email')
                <span class="invalid-feedback">{{$errors->first('email')}}</span>
                @enderror
            </div>
        </div>
        <!-- password -->
        <div class="form-group">
            <div class="form-label-group">
                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" wire:model.defer="password">
                <label for="password">Password</label>
                @error('password')
                <span class="invalid-feedback">{{$errors->first('password')}}</span>
                @enderror
            </div>
        </div>
        <!-- remember me -->
        <div class="form-group text-center">
            <div class="custom-control custom-control-inline custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember-me" value="1" wire:model.defer="remember">
                <label class="custom-control-label" for="remember-me">Keep me sign in</label>
            </div>
        </div>
        <!-- submit -->
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-lg btn-primary font-weight-bold" wire:loading.attr="disabled" wire:target='login'>
                <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="login"></span>
                Login
            </button>
        </div>

        <div class="text-center">
            <a class="btn btn-link" href="/forgot-password">Forgot Password</a>
        </div>
    </form>
    <!-- region injector -->
    @include('partials.global.country-region-injector')
</div>
