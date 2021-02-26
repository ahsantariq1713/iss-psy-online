<div>
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/dashboard"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                </li>
            </ol>
        </nav>
        <!-- page title -->
        <h1 class="page-title mr-sm-auto">Therapists <small class="badge">{{ $therapists->count() }} Total</small></h1>
    </header>
    <div>
        {{-- <div class="d-flex justify-content-start mb-2">
            <div wire:ignore class="mr-2">
                <label>Search by</label>
                <select id="search.param" class="form-control" data-toggle="select2">
                    <option value="id">Id</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="timezone">Time Zone</option>
                </select>
            </div>
            <div wire:ignore class="mr-2">
                <label>Sort By</label>
                <select id="search.sortBy" class="form-control" data-toggle="select2">
                    <option value="name">Name</option>
                    <option value="pricing">Price</option>
                    <option value="experienceYears">Experience</option>
                </select>
            </div>
            <div wire:ignore class="mr-2">
                <label>Sort Mode</label>
                <select id="search.sortMode" class="form-control" data-toggle="select2">
                    <option value="asc">Ascending</option>
                    <option value="desc">Decending</option>
                </select>
            </div>
            <div wire:ignore class="mr-2">
                <label>Profile Status</label>
                <select id="search.status" class="form-control" data-toggle="select2">
                    <option value="">All</option>
                    <option value="Pending">Incomplete</option>
                    <option value="Approved">Approved</option>
                    <option value="Disapproved">Approved</option>
                    <option value="Under Review">Under Review</option>
                </select>
            </div>
        </div> --}}
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start">
                <div class="dropdown">
                    <button class="btn btn-secondary mr-2" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Search by {{$search['param']}} <span class="fa fa-caret-down"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right stop-propagation" style="">
                        <div class="dropdown-arrow"></div>
                        <h6 class="dropdown-header"> Search By </h6>
                        {{-- <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="param" value="id"
                                wire:model.lazy="search.param">
                            <span class="custom-control-label">Id</span>
                        </label> --}}
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="param" value="name"
                                wire:model.lazy="search.param">
                            <span class="custom-control-label">Name</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="param" value="email"
                                wire:model.lazy="search.param">
                            <span class="custom-control-label">Email</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="param" value="timezone"
                                wire:model.lazy="search.param">
                            <span class="custom-control-label">Timezone</span>
                        </label>
                    </div>
                </div>
                <div class="mr-2 ">
                    <input type="text" class="form-control " placeholder="Find by {{ $search['param'] }}"
                        wire:model.debounce.500ms='search.input'>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="dropdown">
                    <button class="btn btn-secondary mr-2" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Sort by {{ $search['sortBy'] }} <span class="fa fa-caret-down"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right stop-propagation" style="">
                        <div class="dropdown-arrow"></div>
                        <h6 class="dropdown-header"> Sort By </h6>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="sortBy" value="name"
                                wire:model.lazy="search.sortBy">
                            <span class="custom-control-label">Name</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="sortBy" value="pricingHCol"
                                wire:model.lazy="search.sortBy">
                            <span class="custom-control-label">Pricing</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="sortBy" value="experienceYearsHCol"
                                wire:model.lazy="search.sortBy">
                            <span class="custom-control-label">Experience</span>
                        </label>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary mr-2" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Sort order {{$search['sortMode']}} <span class="fa fa-caret-down"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right stop-propagation" style="">
                        <div class="dropdown-arrow"></div>
                        <h6 class="dropdown-header"> Sort Mode </h6>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="sortMode" value="asc"
                                wire:model.lazy="search.sortMode">
                            <span class="custom-control-label">Ascending</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="sortMode" value="desc"
                                wire:model.lazy="search.sortMode">
                            <span class="custom-control-label">Descending</span>
                        </label>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary mr-2" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{$search['status'] == '' ? 'All Profiles' : $search['status']}} <span class="fa fa-caret-down"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right stop-propagation" style="">
                        <div class="dropdown-arrow"></div>
                        <h6 class="dropdown-header"> Profile Status </h6>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="status" value=""
                                wire:model.lazy="search.status">
                            <span class="custom-control-label">All</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="status" value="Pending"
                                wire:model.lazy="search.status">
                            <span class="custom-control-label">Incomplete</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="status" value="Under Review"
                                wire:model.lazy="search.status">
                            <span class="custom-control-label">Under Review</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="status" value="Approved"
                                wire:model.lazy="search.status">
                            <span class="custom-control-label">Approved</span>
                        </label>
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="status" value="Disapproved"
                                wire:model.lazy="search.status">
                            <span class="custom-control-label">Disapproved</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">

            @if ($therapists->count() <= 0)
            <div id="notfound-state" class="empty-state">
                <!-- .empty-state-container -->
                <div class="empty-state-container">
                    <div class="state-figure">
                        <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}"
                            alt="" style="max-width: 300px">
                    </div>
                    <h3 class="state-header"> No Content. </h3>
                    <p class="state-description lead text-muted"> No record found to show. </p>
                </div>
            </div>
            @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th> Therapist </th>
                            <th> Timezone </th>
                            <th> Pricing </th>
                            <th> Experience </th>
                            <th> Profile Status </th>
                            <th> Account Status </th>
                            <th class="text-right"> Rating </th>
                            <th style="width:100px; min-width:100px;"> &nbsp; </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($therapists as $therapist)
                            <tr>
                                <td class="d-flex">
                                    <a href="#" class="tile tile-img mr-2"><img class="img-fluid"
                                            src="{{asset($therapist->avatar)}}" alt="Card image cap"></a>
                                    <a href="#">{{$therapist->name}}  <p class="m-0 small text-muted">{{$therapist->email}}</p></a>
                                </td>
                                <td class="align-middle">{{$therapist->timezone}}</td>
                                <td class="align-middle">${{(int)$therapist->pricingHCol}} per Hr. </td>
                                <td class="align-middle">{{$therapist->experienceYearsHCol}} Years</td>
                                <td class="align-middle">{{$therapist->profileLog->status}}</td>
                                <td class="align-middle">{{$therapist->active ? 'Active' : 'Blocked'}}</td>
                                <td class="align-middle text-right"> @include('partials.global.rating-display', ['rating' => $therapist->rating()])</td>
                                <td class="align-middle text-right">
                                    <a href="{{ route('admin.therapist-view', [$therapist->id]) }}" class="btn btn-sm btn-icon btn-secondary"><i
                                            class="mdi mdi-clipboard-edit-outline"></i>
                                        <span class="sr-only">Show</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>


    <script>
        function applyFilter() {
            alert($('#search-param').val())
            @this.set('search.param', $('#search-param').val())
            @this.set('search.input', $('#search-input').val())
            @this.set('search.sortBy', $('#search-sortBy').val())
            @this.set('search.srotMode', $('#search-srotMode').val())
            @this.set('search.srotMode', $('#search-srotMode').val())
            @this.set('search.status', $('#search-status').val())
            window.livewire.emit('applyFilter');
        }

    </script>
</div>
