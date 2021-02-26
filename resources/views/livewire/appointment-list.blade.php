<div>
    <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/dashboard"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Overview</a>
                </li>
            </ol>
        </nav>
        <h1 class="page-title mr-sm-auto">
            Appointments <small class="badge">{{$appointments->count()}} Total</small>
        </h1>
    </header>

    <div class="card card-fluid">
        <div class="table-responsive">

            <table class="table">
                <thead class="thead-light">
                <tr>
                    @if(not(Auth::user()->isAdmin()))
                        <th style="min-width:200px"> Participant</th>
                        <th> Date</th>
                        @else
                        <th style="min-width:200px"> Date</th>
                    @endif

                    <th> Time</th>
                    <th> Status</th>
                    <th> Rating</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($appointments as $appointment)
                    <tr>
                        @if(not(Auth::user()->isAdmin()))
                            <td>
                                <span class="btn-account">
                                    <span class="user-avatar user-avatar-md">
                                    <img src="{{asset($appointment->participant()->avatar)}}" alt="">
                                    </span>
                                    <span class="account-summary">
                                        <span class="account-name">{{$appointment->participant()->name}}</span>
                                        <span class="account-description">{{$appointment->participant()->role}}</span>
                                    </span>
                                </span>
                            </td>
                        @endif

                        <td> {{\App\Helpers\UserReadable::sessionDate($appointment->start_date, Auth::User()->timezone)->format('d M, Y')}}</td>
                        <td> {{\App\Helpers\UserReadable::sessionDate($appointment->start_date, Auth::User()->timezone)->format('h:i A')}}</td>
                        <td>
                            @if($appointment->status == 'Pending')
                                <span class="badge badge-info">{{$appointment->status}}</span>
                            @elseif($appointment->status == 'Completed')
                                <span class="badge badge-success">{{$appointment->status}}</span>
                            @elseif($appointment->status == 'Cancelled')
                                <span class="badge badge-danger">{{$appointment->status}}</span>
                            @else
                                <span class="badge badge-warning">{{$appointment->status}}</span>
                            @endif
                        </td>
                        <td>
                            @include('partials.global.rating-display', ['rating' => $appointment->stars])
                        </td>
                        <td class="align-middle text-right">
                           @if(($appointment->status == 'Pending' || $appointment->status == 'Active') && not(Auth::user()->isAdmin()) && $appointment->meetingAllowed())
                                <a class="btn btn-sm btn-success mr-2"
                                href="{{route('attend-meeting', ['id' => $appointment->id, 'token'=> $appointment->accessToken()])}}">
                                    Connect
                                </a>
                            @endif
                            <a href="{{route('appointment-show', [$appointment->id])}}" class="btn btn-icon btn-secondary" title="Show Details"><span class="mdi
                            mdi-clipboard-edit-outline
                            lead"></span> <span
                                    class="sr-only">Details</span></a>
                        </td>
                    </tr>
                @empty
                    <div id="notfound-state" class="empty-state">
                        <!-- .empty-state-container -->
                        <div class="empty-state-container">
                            <div class="state-figure">
                                <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt="" style="max-width: 300px">
                            </div>
                            <h3 class="state-header"> No Content, Yet. </h3>
                            <p class="state-description lead text-muted"> No appointments found to show. </p>
                        </div>
                    </div>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function (){
            $("#nav-item-appointments").addClass("active");
        })
    </script>
</div>
