<div>
    <header class="page-title-bar text-center mt-5" wire:ignore>
        <h4 class="font-weight-normal">
            @if(not_null($back))
                <a href="{{$back}}" class="text-black text-decoration-none">
                    <i class="mdi mdi-arrow-left "></i>
                </a>
            @endif
            Setup Basic Info
        </h4>
        <p class="text-muted">Some info may be visible to other people using our services.</p>
    </header>
    <div class="page-section">
        <form wire:submit.prevent="update" class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">
            <div class="form-group">
                <label for="userModel.name">Name</label>
                <input class="form-control form-control-lg @error('userModel.name') is-invalid @enderror" id="userModel.name"
                    type="text" wire:model.defer="userModel.name">
                @error('userModel.name')
                <span class="invalid-feedback">{{$errors->first('userModel.name')}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="userModel.birthday">Birthday</label>
                <input id="userModel.birthday" type="text"
                    class="form-control form-control-lg  @error('userModel.birthday') is-invalid @enderror flatpickr-input"
                    data-toggle="flatpickr" readonly="readonly" wire:model.defer="userModel.birthday">
                @error('userModel.birthday')
                <span class="invalid-feedback">{{$errors->first('userModel.birthday')}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="d-block">Gender</label>
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input form-control-lg" name="userModel.gender" value="Male"
                        id="rd1" wire:model.defer="userModel.gender">
                    <label class="custom-control-label" for="rd1">Male</label>
                </div>
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input" name="userModel.gender" id="rd2" value="Female"
                        wire:model.defer="userModel.gender">
                    <label class="custom-control-label" for="rd2">Female</label>
                </div>
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input" name="userModel.gender" id="rd3" value="Other"
                        wire:model.defer="userModel.gender">
                    <label class="custom-control-label" for="rd3">Other</label>
                </div>
                <br>
                @error('userModel.gender')
                <span class="text-danger small">{{$errors->first('userModel.gender')}}</span>
                @enderror
            </div>
            <div class="form-group d-flex justify-content-end mt-2">
                <div wire:ignore> @if(not_null($back)) <a href="{{$back}}" class="btn btn-secondary mr-2"><i class="mdi mdi-arrow-left"></i> Back</a> @endif</div>
                <div wire:ignore> @if(not_null($skip)) <a href="{{$skip}}" class="btn btn-secondary mr-2"> Skip</a> @endif</div>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay></span>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
