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
            My Therapists <small class="badge">{{$therapists->count()}} Total</small>
        </h1>
    </header>

    @if(not_null($therapists) && $therapists->count() > 0)
        <div class="card card-fluid">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th style="min-width:200px"> Therapist</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Pending</th>
                        <th class="text-center">Cancelled</th>
                        <th> Rating</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($therapists as $therapist)
                        <tr>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <span class="btn-account">
                                    <span class="user-avatar user-avatar-md">
                                    <img src="{{asset($therapist->avatar)}}" alt="">
                                    </span>
                                    <span class="account-summary">
                                        <span class="account-name">{{$therapist->name}}</span>
                                        <span class="account-description">{{$therapist->license->experience}}</span>
                                    </span>
                                </span>
                                </div>
                            </td>
                            <td class="text-center">{{$therapist->therapistAppointments->count()}}</td>
                            <td class="text-center">{{$therapist->therapistAppointments->where('status', 'Pending')->count()}}</td>
                            <td class="text-center">{{$therapist->therapistAppointments->where('status', 'Cancelled')->count()}}</td>
                            <td>
                                @include('partials.global.rating-display', ['rating' => $therapist->rating()])
                            </td>
                            <td class="align-middle text-right">
                                <a class="btn btn-sm btn-subtle-primary" href="{{route('booking-calendar', [$therapist->id])}}">Book Again</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div id="notfound-state" class="empty-state">
            <!-- .empty-state-container -->
            <div class="empty-state-container">
                <div class="state-figure">
                    <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt="" style="max-width: 300px">
                </div>
                <h3 class="state-header"> No Content, Yet. </h3>
                <p class="state-description lead text-muted"> No therapists found to show. </p>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:load', function (){
            $("#nav-item-myTherapists").addClass("active");
        })
    </script>
</div>
