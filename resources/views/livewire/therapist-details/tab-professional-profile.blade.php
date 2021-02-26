<div class="tab-pane fade" id="professional-profile" role="tabpanel" aria-labelledby="client-billing-contact-tab">
    <div class="card">

        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title"> Identity </h2>
        </div>

        <div class="card-body" style="padding:0px 10px!important">
            <!-- national id -->
            <div class="row py-2">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">National ID</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->identity->nat_id}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                    @if(not_null($therapist->identity->nat_doc))
                    <livewire:download-doc-button :obj="$therapist->identity" property="nat_doc" />
                    @endif
                </div>
            </div>
            <!-- passport no -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Passport No.</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->identity->passport_no ?? 'NA'}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                    @if(not_null($therapist->identity->passport_doc))
                    <livewire:download-doc-button :obj="$therapist->identity" property="passport_doc" />
                    @endif
                </div>
            </div>
            <!-- driver's license -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Driver's License No.</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->identity->drv_license_no ?? 'NA'}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                    @if(not_null($therapist->identity->drv_license_doc))
                    <livewire:download-doc-button :obj="$therapist->identity" property="drv_license_doc" />
                    @endif
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title"> Practitioner License </h2>
        </div>
        <div class="card-body" style="padding:0px 10px!important">
            <!-- acedemic title -->
            <div class="row py-2">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Academic Title</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->license->academic_title}}. {{$therapist->name}}
                </div>
            </div>
            <!-- experienced in -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Experienced In</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->license->experience}}
                </div>
            </div>
            <!-- experience year -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Experience</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->experienceYears()}} Years
                </div>
            </div>
            <!-- license type -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">License Type</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->license->type}}
                </div>
            </div>
            <!-- license # -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">License #</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    {{$therapist->license->reference}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-md-right text-lg-right">
                    @if(not_null($therapist->license->license_doc))
                    <livewire:download-doc-button :obj="$therapist->license" property="license_doc" />
                    @endif
                </div>
            </div>
            <!-- specialites -->
            <div class="row py-2 border-top">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <span class="font-weight-bold">Specialities</span>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6">
                    @foreach($therapist->specialisms as $specialism)
                    <span class="badge badge-light badge-lg">{{$specialism->name}}</span>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
