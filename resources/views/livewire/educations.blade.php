<div class="card shadow-none border">
    <div class="d-flex justify-content-between p-4">
        <div class="left mr-5">
            <h5 class="font-weight-normal">Education</h5>
            <p class="text-muted">Please add your education.</p>
        </div>
        <div class="right d-lg-block d-md-block d-none">
            <img src="{{asset('assets/images/undraw/undraw_Graduation_ktn0.svg')}}" height="120"
                 alt="">
        </div>
    </div>
    <div class="d-none d-md-block d-lg-block">
        <div class="d-flex justify-content-between px-4 py-3">
            <div class="row w-75">
                <div class="col rem text-muted">
                    Degree
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5 rem text-muted">Institute</div>
                <div class="col-sm-12 col-md-2 col-lg-2 rem text-muted">Year</div>
            </div>
        </div>
    </div>
    @foreach($educations as $education)
        <a href="javascript:void(0)" class="cli d-flex justify-content-between border-top px-4 py-3" wire:click="edit({{$education->id}})">
            <div class="row w-75">
                <div class="col rem">
                    {{$education->degree}}
                    <p class="small m-0">{{$education->specialization}}</p>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5 rem">{{$education->institute}}</div>
                <div class="col-sm-12 col-md-2 col-lg-2 rem">{{$education->year}}</div>
            </div>
            <div class="text-muted text-right rem">
                <i class="fa fa-chevron-right"></i>
            </div>
        </a>
    @endforeach
    <a href="javascript:void(0)" class="cli d-flex justify-content-between border-top px-4 py-3" wire:click="add">
        <div class="row w-75">
            <div class="col rem font-weight-bold text-success">New Education</div>
        </div>
        <div class="text-success text-right rem"><i class="fa fa-plus"></i></div>
    </a>

    <form wire:submit.prevent="save" wire:ignore.self id="entity-modal" class="modal" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title">Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="education.degree">Degree</label>
                        <input class="form-control form-control-lg @error('education.degree') is-invalid @enderror" id="education.degree" type="text"
                               wire:model.defer="education.degree">
                        @error('education.degree')
                        <span class="invalid-feedback">{{$errors->first('education.degree')}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="education.specialization">Specialization</label>
                        <input class="form-control form-control-lg @error('education.specialization') is-invalid @enderror" id="education.specialization" type="text"
                               wire:model.defer="education.specialization">
                        @error('education.specialization')
                        <span class="invalid-feedback">{{$errors->first('education.specialization')}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="education.institute">Institute</label>
                        <input class="form-control form-control-lg @error('education.institute') is-invalid @enderror" id="education.institute" type="text"
                               wire:model.defer="education.institute">
                        @error('education.institute')
                        <span class="invalid-feedback">{{$errors->first('education.institute')}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="education.year">Completion Year</label>
                        <input class="form-control form-control-lg @error('education.year') is-invalid @enderror" id="education.year" type="text"
                               wire:model.defer="education.year">
                        @error('education.year')
                        <span class="invalid-feedback">{{$errors->first('education.year')}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-danger" {{$this->new ? 'disabled' : ''}} wire:loading.attr="disabled"  wire:click="delete">
                        <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="delete"></span>
                        Delete
                    </button>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                            <span class="spinner-border spinner-border-sm" wire:loading.delay wire:target="save"></span>
                            Save Education
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
