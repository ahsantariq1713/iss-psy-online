<div>
    <header class="page-title-bar text-center mt-5">
        <h4 class="font-weight-normal">
            <a href="/account-settings" class="text-black text-decoration-none">
                <i class="mdi mdi-arrow-left "></i>
            </a>
            Setup Emergency Contact
        </h4>
        <p class="text-muted">We will use this phone to help you in any case of emergency.
        </p>
    </header>
    <div class="row">
        <form wire:submit.prevent="change" class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-3">
            <div class="form-group mt-2">
                <div class="form-group">
                    <label for="ephone.relation">Relation</label>
                    <input class="form-control form-control-lg @error('ephone.relation') is-invalid @enderror"
                        id="ephone.relation" type="text" wire:model.defer="ephone.relation">
                    @error('ephone.relation')
                    <span class="invalid-feedback">{{$errors->first('ephone.relation')}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country">Country Code</label>
                   <div wire:ignore>
                       <select class="form-control form-control-lg @error('ephone.code') is-invalid @enderror"
                               id="ephone-code" wire:model="ephone.code" data-toggle="select2">
                           <option value=null disabled selected>--SELECT COUNTRY CODE--</option>
                           @foreach($countries as $country)
                               <option value="{{$country->code}}">{{$country->short}} - {{$country->name}}
                                   (+{{$country->code}})</option>
                           @endforeach
                       </select>
                   </div>
                    @error('ephone.code')
                    <span class="small text-danger">{{$errors->first('ephone.code')}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="ephone.phone">Phone</label>
                <input class="form-control form-control-lg @error('ephone.phone') is-invalid @enderror"
                    id="ephone.phone" type="text" wire:model.defer="ephone.phone">
                @error('ephone.phone')
                <span class="invalid-feedback">{{$errors->first('ephone.phone')}}</span>
                @enderror
                <small class="text-muted">Please provide your valid ephone.phone number without leading
                    0.</small>
            </div>

            <div class="form-group d-flex justify-content-end">
                <a href="/account-settings" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="change"></span>
                    Save Contact
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('livewire:load', () => {
            $('#ephone-code').on('select2:select', e => @this.set('ephone.code', e.params.data.id));
        });
    </script>

</div>
