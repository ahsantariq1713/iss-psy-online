<div>
    <header class="page-title-bar text-center mt-5" wire:ignore>
        <h4 class="font-weight-normal">
            @if(not_null($back))
            <a href="{{$back}}" class="text-black text-decoration-none">
                <i class="mdi mdi-arrow-left "></i>
            </a>
            @endif
            Change Profile Picture
        </h4>
        <p class="text-muted">Only image files of size 2MB are allowed.</p>
    </header>
    <div class="page-section">
        <form wire:submit.prevent="upload" class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
            <div class="d-flex justify-content-start">
                @if($avatar)

                {{-- <img src="{{ asset($avatar->temporaryUrl()) }}" class="rounded-circle" height="100" width="100"> --}}
                @else
                <img src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle" height="100" width="100">
                @endif
                <div class="w-100 ml-4 text-right">
                    <div id="dropzone" class="fileinput-dropzone @error('avatar') border-danger @enderror mb-2">
                        <span wire:loading.remove wire:target="avatar">Click to upload.</span>
                        <div wire:loading.delay wire:target="avatar">
                            <span class="spinner-border spinner-border-sm text-gray"></span> Uploading ...
                        </div>
                        <input id="fileupload-dropzone" type="file" wire:model="avatar">
                    </div>
                    @error('avatar')
                    <span class="text-danger small"><i class="fa fa-warning"></i> {{$errors->first('avatar')}}</span>
                    @enderror
                </div>
            </div>
            {{-- <div class="form-group d-flex justify-content-end mt-2">
                <div wire:ignore> @if(not_null($back)) <a href="{{$back}}" class="btn btn-secondary mr-2"><i
                            class="mdi mdi-arrow-left"></i> Back</a> @endif</div>
                <div wire:ignore> @if(not_null($skip)) <a href="{{$skip}}" class="btn btn-secondary mr-2"> Skip</a>
                    @endif</div>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="upload"></span>
                    Change Picture
                </button>
            </div> --}}
        </form>
    </div>


</div>
