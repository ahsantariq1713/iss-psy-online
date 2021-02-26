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
            Clients <small class="badge">{{$clients->count()}} Total</small>
        </h1>
    </header>
    <div class="card card-fluid">
        <div class="table-responsive">

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th style="min-width:200px"> Client</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                    <tr>
                        <td>
                            <span class="btn-account">
                                <span class="user-avatar user-avatar-md">
                                    <img src="{{asset($client->avatar)}}" alt="">
                                </span>
                                <span class="account-summary">
                                    <span class="account-name">{{$client->name}}</span>
                                    <span class="account-description">{{$client->role}}</span>
                                </span>
                            </span>
                        </td>

                        <td class="align-middle text-right">
                            <a href="{{ route('client-show',$client->id ) }}" class="btn btn-icon btn-secondary"
                                title="Show Details"><span class="mdi
                            mdi-clipboard-edit-outline
                            lead"></span> <span class="sr-only">Details</span></a>
                        </td>
                    </tr>
                    @empty
                    <div id="notfound-state" class="empty-state">
                        <!-- .empty-state-container -->
                        <div class="empty-state-container">
                            <div class="state-figure">
                                <img class="img-fluid" src="{{ asset('assets/images/undraw/undraw_NoContent.svg') }}"
                                    alt="" style="max-width: 300px">
                            </div>
                            <h3 class="state-header"> No Content, Yet. </h3>
                            <p class="state-description lead text-muted"> No clients found to show. </p>
                        </div>
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function (){
            $("#nav-item-clients").addClass("active");
        })
    </script>
</div>
