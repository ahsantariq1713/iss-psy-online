<div>
    <!-- register form -->
    <form wire:submit.prevent="register" class="auth-form">
        <h5>Register Account</h5>
        <p class="text-muted">Please enter following details to create account.</p>
        <!-- full name -->
        <div class="form-group">
            <label for="user.name">Full Name</label>
            <input class="form-control form-control-lg @error("user.name") is-invalid @enderror" id="user.name" type="text"
                   wire:model.defer="user.name">
            @error("user.name")
            <span class="invalid-feedback">{{$errors->first("user.name")}}</span>
            @enderror
        </div>
        <!-- email -->
        <div class="form-group">
            <label for="user.email">Email Address</label>
            <input class="form-control form-control-lg @error("user.email") is-invalid @enderror" id="user.email" type="email"
                   wire:model.debounce.500ms="user.email">
            @error("user.email")
            <span class="invalid-feedback">{{$errors->first("user.email")}}</span>
            @enderror
        </div>
        <!-- password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control form-control-lg @error("password") is-invalid @enderror" id="password" type="password"
                   wire:model.lazy="password">
            @error("password")
            <span class="invalid-feedback">{{$errors->first("password")}}</span>
            @enderror
        </div>
        <!-- birthday -->
        <div class="form-group">
            <label for="user.birthday">Birthday</label>
            <input id="user.birthday" type="text"
                   class="form-control form-control-lg  @error("user.birthday") is-invalid @enderror flatpickr-input"
                   data-toggle="flatpickr" readonly="readonly" wire:model.defer="user.birthday">
            @error("user.birthday")
            <span class="invalid-feedback">{{$errors->first("user.birthday")}}</span>
            @enderror
        </div>
        <!-- gender -->
        <div class="form-group">
            <label class="d-block">Gender</label>
            <div class="custom-control custom-control-inline custom-radio">
                <input type="radio" class="custom-control-input form-control-lg" name="user.gender" value="Male"
                       id="rd1" wire:model.defer="user.gender">
                <label class="custom-control-label" for="rd1">Male</label>
            </div>
            <div class="custom-control custom-control-inline custom-radio">
                <input type="radio" class="custom-control-input" name="user.gender" id="rd2" value="Female"
                       wire:model.defer="user.gender">
                <label class="custom-control-label" for="rd2">Female</label>
            </div>
            <div class="custom-control custom-control-inline custom-radio">
                <input type="radio" class="custom-control-input" name="user.gender" id="rd3" value="Other"
                       wire:model.defer="user.gender">
                <label class="custom-control-label" for="rd3">Other</label>
            </div>
            <br>
            @error("user.gender")
            <span class="text-danger small">{{$errors->first("user.gender")}}</span>
            @enderror
        </div>
        <!-- account type -->
        <h6>Account Type</h6>
        <div class="form-group">
            <div class="custom-control custom-control-inline custom-radio">
                <input class="custom-control-input" id="rd4" type="radio" name="type" value="dGhlcmFwaXN0" wire:model.defer="type">
                <label class="custom-control-label" for="rd4">Therapist Account</label>
            </div>
            <div class="custom-control custom-control-inline custom-radio">
                <input class="custom-control-input" id="rd5" name="type" type="radio" value="Y2xpZW50" wire:model.defer="type">
                <label class="custom-control-label" for="rd5">Patient Account</label>
            </div>
            @error("type")
            <p class="text-danger small">Please select your account type.</p>
            @enderror
        </div>
        <!-- privacy policy -->
        <p class="text-muted "> By creating an account you agree to the <a target="_blank" href="/terms-of-service">Terms of Use</a> and <a target="_blank" href="/privacy-policy">Privacy Policy</a>. </p>
        <!-- subscribed newsletter -->
        <div class="form-group text-center">
            <div class="custom-control custom-control-inline custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="user.subscribed_newsletter" value="1"
                       wire:model.defer="user.subscribed_newsletter">
                <label class="custom-control-label" for="user.subscribed_newsletter">Subscribe for news letter</label>
            </div>
        </div>
        <!-- submit -->
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-lg btn-primary font-weight-bold" wire:loading.attr="disabled">
                <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="register"></span>
                Create Account
            </button>
        </div>
    </form>
    <!-- region injector -->
    @include("partials.global.country-region-injector")
</div>
