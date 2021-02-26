<div>
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    @if(Auth::user()->isAdmin())
                    <a href="/clients"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                    @else
                    <a href="/my-clients"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                    @endif
                </li>
            </ol>
        </nav>
        <h1 class="page-title mr-sm-auto">
            Cleint Details
        </h1>
    </header>
    <div>
        <div class="d-flex justify-content-between px-3 py-3">
            <div>
                <h2 id="client-billing-contact-tab" class="card-title mb-0 pb-0"> {{$client->name}} </h2>
                <span class="text-muted">Client</span>
            </div>
            <img class="rounded-circle" src="{{asset($client->avatar)}}" height="100" width="100" alt="">
        </div>
        <div class="card card-fluid">
            <div class="list-group list-group-flush list-group-bordered">
                @if(Auth::user()->isAdmin())
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Email</span>
                    <span>{{$client->email}}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Phone</span>
                    <span>{{$client->phone}}</span>
                </div>
                @endif
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Gender</span>
                    <span>{{$client->gender}}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Birthday</span>
                    <span>{{$client->birthday}}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Location</span>
                    <span>{{$client->country}}</span>
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Time Zone</span>
                    <span>{{$client->timezone}}</span>
                </div>
                <li class="list-group-header">Emergency Contact</li>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Phone</span>
                    @if(not_null($client->emergencyPhone))
                    <span>{{$client->emergencyPhone->phone}}</span>
                    @else
                    <small class="text-muted">Not Available</small>
                    @endif
                </div>
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span class="text-muted">Relation</span>
                    @if(not_null($client->emergencyPhone))
                    <span>{{$client->emergencyPhone->relation}}</span>
                    @else
                    <small class="text-muted">Not Available</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function (){
            $("#nav-item-clients").addClass("active");
        })
    </script>
</div>
