<div>
    <header class="page-title-bar mt-3">
        <div class="row text-center text-sm-left">
            <div class="col-sm-auto col-12 mb-2">
                <div class="has-badge has-badge-bottom">
                    <img src="{{ asset("$auth->avatar") }}" class="rounded-circle" height="90" width="90" />
                </div>
            </div>
            <div class="col">
                <h1 class="page-title"> {{$auth->name}} </h1>
                <p class="mb-0">{{$auth->email}}</p>
                <p class="text-muted">{{$auth->role}}</p>
            </div>
        </div>
        <div class="nav-scroller border-bottom ">
            <div class="nav nav-tabs">
                <a class="nav-link active" href="/dashboard">Overview</a>
            </div>
        </div>
    </header>
    <div class="page-section">
        <div class="row mb-4">
           <div class="col-12">
            <h5 class="mb-3">Therapist Profiles</h5>
           </div>
            <div class="col">
                <a href="{{url('/admin-portal/therapists?profileStatus=Pending')}}" class="text-decoration-none text-dark">
                    <div class="metric metric-bordered bg-white">
                        <h2 class="metric-label"> Incomplete </h2>
                        <p class="metric-value h1">
                            <span class="value">{{$thCount["incomplete"]}}</span>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{url('/admin-portal/therapists?profileStatus=Under Review')}}" class="text-decoration-none text-dark">
                    <div class="metric metric-bordered bg-white">
                        <h2 class="metric-label"> Under Review </h2>
                        <p class="metric-value h1">
                            <span class="value">{{$thCount["underReview"]}}</span>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{url('/admin-portal/therapists?profileStatus=Approved')}}" class="text-decoration-none text-dark">
                    <div class="metric metric-bordered bg-white">
                        <h2 class="metric-label"> Approved </h2>
                        <p class="metric-value h1">
                            <span class="value">{{$thCount["approved"]}}</span>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{url('/admin-portal/therapists?profileStatus=Disapproved')}}" class="text-decoration-none text-dark">
                    <div class="metric metric-bordered bg-white">
                        <h2 class="metric-label"> Disapproved </h2>
                        <p class="metric-value h1">
                            <span class="value">{{$thCount["disapproved"]}}</span>
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
             <h5 class="mb-3">Clients</h5>
            </div>
             <div class="col">
                 <a href="" class="text-decoration-none text-dark">
                     <div class="metric metric-bordered bg-white">
                         <h2 class="metric-label"> Total </h2>
                         <p class="metric-value h1">
                             <span class="value">{{$clCount["total"]}}</span>
                         </p>
                     </div>
                 </a>
             </div>
             <div class="col">
                 <a href="" class="text-decoration-none text-dark">
                     <div class="metric metric-bordered bg-white">
                         <h2 class="metric-label"> New This Week </h2>
                         <p class="metric-value h1">
                             <span class="value">{{$clCount["newThisWeek"]}}</span>
                         </p>
                     </div>
                 </a>
             </div>
         </div>
    </div>
</div>
