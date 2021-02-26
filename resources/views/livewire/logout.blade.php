@if($mode == 'btn-lg')
    <a class="navbar-btn btn btn-danger ml-auto order-lg-2 mr-2 d-none d-lg-block" href="javascript:void(0)" wire:click="logout">Logout</a>
@elseif($mode == 'btn-sm')
    <a class="btn btn-danger mr-2 order-lg-2 d-sm-block d-lg-none d-md-block" href="javascript:void(0)" wire:click="logout">Logout</a>
@else
    <a class="dropdown-item" href="javascript:void(0)" wire:click="logout"><span class="dropdown-icon oi oi-account-logout"></span>Logout</a>
@endif

