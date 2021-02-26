<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left mr-5">
            <h5 class="font-weight-normal">Experience</h5>
            <p class="text-muted">Therapists with a higher level of academic qualifications and/or experience tend to
                attract more clients.</p>
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{asset('assets/images/undraw/undraw_done_a34v.svg')}}" height="120" alt="">
        </div>
    </div>
    <div class="d-none d-md-block d-lg-block">
        <div class="d-flex justify-content-between px-4 py-3">
            <div class="row w-75">
                <div class="col rem text-muted">
                    Designation
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5 rem text-muted">Location/Institute</div>
                <div class="col-sm-12 col-md-3 col-lg-3 rem text-muted">Duration</div>
            </div>
        </div>
    </div>
    @foreach($experiences as $experience)
    <a href="javascript:void(0)" class="cli d-flex justify-content-between border-top px-4 py-3"
        wire:click="edit({{$experience->id}})">
        <div class="row w-75">
            <div class="col rem">
                {{$experience->designation}}
            </div>
            <div class="col-sm-12 col-md-5 col-lg-5 rem">{{$experience->location}}</div>
            <div class="col-sm-12 col-md-3 col-lg-3 rem">{{$experience->start}} - {{$experience->end}}</div>
        </div>
        <div class="text-muted text-right rem">
            <i class="fa fa-chevron-right"></i>
        </div>
    </a>
    @endforeach
    <a href="javascript:void(0)" class="cli d-flex justify-content-between border-top px-4 py-3" wire:click="add">
        <div class="row w-75">
            <div class="col rem font-weight-bold text-success">New Experience</div>
        </div>
        <div class="text-success text-right rem"><i class="fa fa-plus"></i></div>
    </a>

    <form wire:submit.prevent="save" wire:ignore.self id="entity-modal" class="modal" tabindex="-1" role="dialog"
        data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title">Experience</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="experience.designation">Designation</label>
                        <input
                            class="form-control form-control-lg @error('experience.designation') is-invalid @enderror"
                            id="experience.designation" type="text" wire:model.defer="experience.designation">
                        @error('experience.designation')
                        <span class="invalid-feedback">{{$errors->first('experience.designation')}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="experience.location">Location</label>
                        <input class="form-control form-control-lg @error('experience.location') is-invalid @enderror"
                            id="experience.location" type="text" wire:model.defer="experience.location">
                        @error('experience.location')
                        <span class="invalid-feedback">{{$errors->first('experience.location')}}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="experience.start">Start Year</label>
                            <input class="form-control form-control-lg @error('experience.start') is-invalid @enderror"
                                id="experience.start" type="text" wire:model.defer="experience.start">
                            @error('experience.start')
                            <span class="invalid-feedback">{{$errors->first('experience.start')}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="experience.end">End Year</label>
                            <input class="form-control form-control-lg @error('experience.end') is-invalid @enderror"
                                id="experience.end" type="text" wire:model.defer="experience.end">
                            @error('experience.end')
                            <span class="invalid-feedback">{{$errors->first('experience.end')}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-danger" {{$this->new ? 'disabled' : ''}}
                        wire:loading.attr="disabled" wire:click="delete">
                        <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="delete"></span>
                        Delete
                    </button>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                            <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="save"></span>
                            Save Experience
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
