<div>
    <div class="page-section mt-5 pt-5">
        <form wire:submit.prevent="update" class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">

            <div class="form-group">
                <label for="identity.nat_id">National ID</label>

                <input class="form-control form-control-lg @error('identity.nat_id') is-invalid @enderror" id="identity.nat_id"
                       type="text" wire:model.defer="identity.nat_id">
                @error('identity.nat_id')
                <span class="invalid-feedback">{{$errors->first('identity.nat_id')}}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-end">
                    @include('partials.global.download-button',['obj' => $this->identity, 'property' => 'nat_doc'])

                </div>
                <div class="fileinput-dropzone @error('nat_doc') border-danger @enderror mb-2">
                    <span wire:loading.remove wire:target="nat_doc">
                        @if($nat_doc)
                            <span><i class="mdi mdi-attachment"></i> File Attached <br><span class="small text-muted">Click  to reattach document</span></span>
                        @else
                            <i class="mdi mdi-upload"></i>  Upload National ID Document
                        @endif
                    </span>
                    <div wire:loading.delay wire:target="nat_doc">
                        <span class="spinner-border spinner-border-sm text-gray"></span> Uploading ...
                    </div>
                    <input id="fileupload-dropzone" type="file" wire:model.lazy="nat_doc">
                </div>
                @error('nat_doc')
                <span class="text-danger small"><i class="fa fa-warning"></i> {{$errors->first('nat_doc')}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="identity.passport_no">Passport No</label>

                <input class="form-control form-control-lg @error('identity.passport_no') is-invalid @enderror" id="identity.passport_no"
                       type="text" wire:model.defer="identity.passport_no">
                @error('identity.passport_no')
                <span class="invalid-feedback">{{$errors->first('identity.passport_no')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-end">
                    @include('partials.global.download-button',['obj' => $this->identity, 'property' => 'passport_doc'])
                </div>
                <div class="fileinput-dropzone @error('passport_doc') border-danger @enderror mb-2">
                    <span wire:loading.remove wire:target="passport_doc">
                      @if($passport_doc)
                            <span><i class="mdi mdi-attachment"></i> File Attached <br><span class="small text-muted">Click  to reattach document</span></span>
                        @else
                            <i class="mdi mdi-upload"></i>  Upload Passport Document
                        @endif
                    </span>
                    <div wire:loading.delay wire:target="passport_doc">
                        <span class="spinner-border spinner-border-sm text-gray"></span> Uploading ...
                    </div>
                    <input id="fileupload-dropzone" type="file" wire:model.lazy="passport_doc">
                </div>
                @error('passport_doc')
                <span class="text-danger small"><i class="fa fa-warning"></i> {{$errors->first('passport_doc')}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="identity.drv_license_no">Driver's License No</label>
                <input class="form-control form-control-lg @error('identity.drv_license_no') is-invalid @enderror" id="identity.drv_license_no"
                       type="text" wire:model.defer="identity.drv_license_no">
                @error('identity.drv_license_no')
                <span class="invalid-feedback">{{$errors->first('identity.drv_license_no')}}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-end">
                    @include('partials.global.download-button',['obj' => $this->identity, 'property' => 'drv_license_doc'])
                </div>
                <div class="fileinput-dropzone @error('drv_license_doc') border-danger @enderror mb-2">
                    <span wire:loading.remove wire:target="drv_license_doc">
                          @if($drv_license_doc)
                            <span><i class="mdi mdi-attachment"></i> File Attached <br><span class="small text-muted">Click  to reattach document</span></span>
                        @else
                            <i class="mdi mdi-upload"></i>  Upload  Driver's License Document
                        @endif
                    </span>
                    <div wire:loading.delay wire:target="drv_license_doc">
                        <span class="spinner-border spinner-border-sm text-gray"></span> Uploading ...
                    </div>
                    <input id="fileupload-dropzone" type="file" wire:model.defer="drv_license_doc">
                </div>
                @error('drv_license_doc')
                <span class="text-danger small"><i class="fa fa-warning"></i> {{$errors->first('drv_license_doc')}}</span>
                @enderror
            </div>

            <div class="form-group d-flex justify-content-end mt-2">
                @if(not_null($identity->id))
                    <a href="/professional-profile/license" class="btn btn-secondary">Next</a>
                @endif
                <button type="submit" class="btn btn-primary ml-2" wire:target="update" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="update"></span>
                    Save and Next
                </button>
            </div>
        </form>
    </div>
</div>
