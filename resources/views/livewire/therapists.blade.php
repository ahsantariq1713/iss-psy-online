<div>
    <!-- header -->
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/dashboard"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                </li>
            </ol>
        </nav>
        <!-- page title -->
        <h1 class="page-title mr-sm-auto">Therapists <small class="badge">{{$therapists->count()}} Total</small></h1>
    </header>
    <!-- content has sidebar -->
    <div class="has-sidebar has-sidebar-fluid">
        <!-- backdrop tint -->
        <div class="sidebar-backdrop"></div>
        <!-- search filter -->
        <div class="d-flex justify-content-end mb-3">
            <div class="input-group has-clearable col">
                <label class="input-group-prepend" for="searchClients">
                    <span class="input-group-text">
                        <span class="oi oi-magnifying-glass"></span>
                    </span>
                </label>
                <input type="text" class="form-control" id="searchClients" data-filter=".board .list-group-item"
                       placeholder="Find therapists by name, email or country" wire:model.lazy='search'>
            </div>
        </div>
        <!-- therapist card -->
        <div wire:loading.remove>
            <div class="row">
                @forelse ($therapists as $therapist)
                    <div class="col-sm-12 col-md-6 col-lg-6" id="therapist-{{$therapist['id']}}">
                        <livewire:therapist-card :therapist="$therapist"/>
                    </div>
                @empty
                    <div class="col-12">
                        <div id="notfound-state" class="empty-state">
                            <!-- .empty-state-container -->
                            <div class="empty-state-container">
                                <div class="state-figure">
                                    <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt="" style="max-width: 300px">
                                </div>
                                <h3 class="state-header"> No Content, Yet. </h3>
                                <p class="state-description lead text-muted"> No resources found to show. </p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <!-- loading spinner -->
        <br><br><br>
        <div class="text-center w-100 h-100 my-auto text-muted">
            <div wire:loading.delay>
                <span class="spinner-border spinner-lg" style="height:72px;width:72px"></span>
            </div>
        </div>
        <!-- therapist details side bar -->
        <livewire:therapist-details/>
    </div>

</div>
