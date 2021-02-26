<div>

    <div class="page-section mt-5 pt-5">
        <form wire:submit.prevent="update" class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.academic_title">Academic Title</label>
                </div>
                <input class="form-control form-control-lg @error('license.academic_title') is-invalid @enderror"
                    id="license.academic_title" type="text" wire:model.defer="license.academic_title">
                @error('license.academic_title')
                <span class="invalid-feedback">{{$errors->first('license.academic_title')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.experience">Discipline</label>
                </div>
                <div wire:ignore class="m-0 p-0">
                    <select class="form-control form-control-lg @error('license.experience') is-invalid @enderror"
                        data-toggle="select2" id="license-experience" wire:model="license.experience">
                        <option value=null disabled selected>--SELECT DISCIPLINE</option>
                        <option>Abnormal Psychology</option>
                        <option>Anomalistic Psychology</option>
                        <option>Behavioral Genetics Psychology</option>
                        <option>Biological Psychology</option>
                        <option>Clinical Psychology</option>
                        <option>Cognitive Psychology</option>
                        <option>Community Psychology</option>
                        <option>Comparative Psychology</option>
                        <option>Consulting Psychology</option>
                        <option>Counseling Psychology</option>
                        <option>Developmental Psychology</option>
                        <option>Differential Psychology</option>
                        <option>Educational Psychology</option>
                        <option>Environmental Psychology</option>
                        <option>Evolutionary Psychology</option>
                        <option>Forensic Psychology</option>
                        <option>Health Psychology</option>
                        <option>Industrial-Organizational Psychology</option>
                        <option>Legal Psychology</option>
                        <option>Moral Psychology</option>
                        <option>Media Psychology</option>
                        <option>Occupational health Psychology</option>
                        <option>Personality Psychology</option>
                        <option>Quantitative Psychology</option>
                        <option>Religion/spirituality Psychology</option>
                        <option>School Psychology</option>
                        <option>Social Psychology</option>
                    </select>
                </div>
                @error('license.experience')
                <span class="small text-danger">{{$errors->first('license.experience')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.type">License Type</label>
                </div>
                <input class="form-control form-control-lg @error('license.type') is-invalid @enderror"
                    id="license.type" type="text" wire:model.defer="license.type">
                @error('license.type')
                <span class="invalid-feedback">{{$errors->first('license.type')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.reference">Reference #</label>
                </div>
                <input class="form-control form-control-lg @error('license.reference') is-invalid @enderror"
                    id="license.reference" type="text" wire:model.defer="license.reference">
                @error('license.reference')
                <span class="invalid-feedback">{{$errors->first('license.reference')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-end">
                    @include('partials.global.download-button',['obj' => $this->license, 'property' => 'license_doc'])
                </div>
                <div class="fileinput-dropzone @error('license_doc') border-danger @enderror mb-2">
                    <span wire:loading.remove wire:target="license_doc">
                        @if($license_doc)
                        <span><i class="mdi mdi-attachment"></i> File Attached <br><span class="small text-muted">Click
                                to reattach document</span></span>
                        @else
                        <i class="mdi mdi-upload"></i> Upload License Document
                        @endif
                    </span>
                    <div wire:loading.delay wire:target="license_doc">
                        <span class="spinner-border spinner-border-sm text-gray"></span> Uploading ...
                    </div>
                    <input id="fileupload-dropzone" type="file" wire:model.lazy="license_doc">
                </div>
                @error('license_doc')
                <span class="text-danger small"><i class="fa fa-warning"></i> {{$errors->first('license_doc')}}</span>
                @enderror
            </div>
            <livewire:setup-specialisms />
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="myLanguages">Languages You Know</label>
                </div>
                <div wire:ignore class="m-0 p-0">
                    <select id="myLanguages" class="form-control form-control-lg  @error('myLanguages') is-invalid @enderror" data-toggle="select2" data-allow-clear="true" multiple>
                        @foreach ($languages as $language)
                        <option value="{{ $language->id }}"
                            {{ collect($myLanguages)->contains($language->id) ? 'selected' : '' }}>
                            {{ $language->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('myLanguages')
                <span class="small text-danger">{{$errors->first('myLanguages')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="license.about">Describe yourself as a Therapist</label>
                <textarea class="form-control  @error('license.about') is-invalid @enderror" id="license.about" rows="8"
                    wire:model.lazy="license.about">{{$license->about}}</textarea>
                @error('license.about')
                <span class="invalid-feedback">{{$errors->first('license.about')}}</span>
                @enderror
                <div class="d-flex justify-content-between">
                    <p class="text-muted m-0 mt-1">It will be displayed on your public profile.</p>
                    <span class="mt-1">
                        <span
                            class="{{(strlen($license->about) > 149 && strlen($license->about) < 500 ) ? 'text-success' : 'text-danger'}}">
                            {{strlen($license->about)}}
                        </span>
                        /500
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.video_url">Introduction Video URL</label>
                </div>
                <input class="form-control form-control-lg @error('license.video_url') is-invalid @enderror"
                    id="license.video_url" type="text" wire:model.defer="license.video_url" placeholder="optional">
                @error('license.video_url')
                <span class="invalid-feedback">{{$errors->first('license.video_url')}}</span>
                @enderror
                <p class="text-muted m-0 mt-1">We recommend to upload your introduction video to youtube and share the
                    url to boost your sells.</p>
            </div>
            <div class="form-group d-flex justify-content-end mt-2">
                @if(not_null($license->id))
                <a href="/professional-profile/education" class="btn btn-secondary">Next</a>
                @endif
                <button type="submit" class="btn btn-primary ml-2" wire:target="update" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="update"></span>
                    Save and Next
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('livewire:load', () => {
            $('#license-experience').on('select2:select', e => @this.set('license.experience', e.params.data.text));
            $('#myLanguages').on('select2:select', e => @this.set('myLanguages',  $('#myLanguages').val()));
            $('#myLanguages').on('select2:unselect', e => @this.set('myLanguages',  $('#myLanguages').val()));
        });
    </script>
</div>
