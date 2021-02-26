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
            My Spending
        </h1>
    </header>

    @if(not_null($appointments) && $appointments->count() > 0)
    <div class="card card-fluid">
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th style="min-width:200px"> Payment Date</th>
                        <th>Appointment Ref.</th>
                        <th class="align-middle text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td>
                            {{$appointment->created_at->setTimeZone(Auth::user()->timezone)->format('d M, Y')}}
                        </td>
                        <td>
                            <p class="m-0 p-0">{{$appointment->participant()->name}}</p>
                            <small class="text-muted m-0 p-0">Appointment # {{$appointment->id}}</small>
                        </td>
                        <td class="align-middle text-right">
                            ${{$appointment->amount}}
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
                <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}" alt=""
                    style="max-width: 300px">
            </div>
            <h3 class="state-header"> No Content, Yet. </h3>
            <p class="state-description lead text-muted"> No resource found to show. </p>
        </div>
    </div>
    @endif
    <script>
        document.addEventListener('livewire:load', function (){
            $("#nav-item-my-spending").addClass("active");
        })
    </script>
</div>
