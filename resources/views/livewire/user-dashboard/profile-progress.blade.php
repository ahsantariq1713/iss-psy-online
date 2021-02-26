<div class="card">
    <div class="card-body">
        <div class="card-body">
            <h4 class="card-title ml-3 mt-3">Profile Progress</h4>
            <ul class="timeline timeline-dashed-line">
                <li class="timeline-item">
                    <div class="timeline-figure">
                        <span class="tile tile-circle tile-xs bg-success"><i class="fa fa-check"></i></span>
                    </div>
                    <div class="timeline-body">
                        <h6 class="timeline-heading">Your Basic Info </h6>
                    </div>
                </li>
                <!-- email verification -->
                <li class="timeline-item">
                    <div class="timeline-figure">
                    <span class="tile tile-circle tile-xs {{not_null($user->email_verified_at) ? 'bg-success' : '' }}">
                        @if(not_null($user->email_verified_at))
                            <i class="fa fa-check"></i>
                        @endif
                    </span>
                    </div>
                    <div class="timeline-body">
                        <a href="{{is_null($user->email_verified_at) ? $user->emailVerificationLink() . '?next=/dashboard' : 'javascript:void(0)' }}"
                           class="timeline-heading text-black h6 {{is_null($user->email_verified_at) ? '' : 'text-decoration-none cursor-text' }}">
                            {{is_null($user->email_verified_at) ? 'Verify Email' : 'Email Verified'}}
                        </a>
                    </div>
                </li>
                <!-- phone verification -->
                <li class="timeline-item">
                    <div class="timeline-figure">
                    <span class="tile tile-circle tile-xs {{not_null($user->phone_verified_at) ? 'bg-success' : '' }}">
                        @if(not_null($user->phone_verified_at))
                            <i class="fa fa-check"></i>
                        @endif
                    </span>
                    </div>
                    <div class="timeline-body">
                        <a href="{{is_null($user->phone_verified_at) ? $user->phoneVerificationLink() . '?back=/dashboard' : 'javascript:void(0)' }}"
                           class="timeline-heading text-black h6 {{is_null($user->phone_verified_at) ? '' : 'text-decoration-none cursor-text' }}">
                            {{is_null($user->phone_verified_at) ? 'Setup SMS Notifications' : 'Phone Number Verified'}}
                        </a>
                    </div>
                </li>
                <!-- upload profile picture -->
                <li class="timeline-item">
                    <div class="timeline-figure">
                    <span
                        class="tile tile-circle tile-xs {{$user->avatar != 'assets/images/users/default.png' ? 'bg-success' : '' }}">
                        @if($user->avatar != 'assets/images/users/default.png')
                            <i class="fa fa-check"></i>
                        @endif
                    </span>
                    </div>
                    <div class="timeline-body">
                        <a href="{{$user->avatar == 'assets/images/users/default.png' ? '/setup-profile-picture' . '?back=/dashboard' : 'javascript:void(0)' }}"
                           class="timeline-heading text-black h6 {{$user->avatar == 'assets/images/users/default.png' ? '' : 'text-decoration-none cursor-text' }}">
                            {{$user->avatar == 'assets/images/users/default.png' ? 'Upload Profile Picture' : 'Profile Picture Uploaded'}}
                        </a>
                    </div>
                </li>
                <!-- setup emergency phone only for client -->
                @if($user->isClient())
                    <li class="timeline-item">
                        <div class="timeline-figure">
                    <span class="tile tile-circle tile-xs {{not_null($user->emergencyPhone) ? 'bg-success' : '' }}">
                        @if(not_null($user->emergencyPhone))
                            <i class="fa fa-check"></i>
                        @endif
                    </span>
                        </div>
                        <div class="timeline-body">
                            <a href="{{ is_null($user->emergencyPhone) ? '/setup-emergency-phone' : 'javascript:void(0)' }}"
                               class="timeline-heading text-black h6 {{is_null($user->emergencyPhone)? '' : 'text-decoration-none cursor-text' }}">
                                {{not_null($user->emergencyPhone)  ? 'Emergency Phone is Setup' : 'Setup Emergency Phone'}}
                            </a>
                        </div>
                    </li>
                @endif
                <!-- setup professional profile only for therapist -->
                @if($user->isTherapist())
                    <li class="timeline-item">
                        <div class="timeline-figure">
                    <span class="tile tile-circle tile-xs {{$user->proProfileRequirementsSatisfied() ? 'bg-success' : '' }}">
                        @if($user->proProfileRequirementsSatisfied() )
                            <i class="fa fa-check"></i>
                        @endif
                    </span>
                        </div>
                        <div class="timeline-body">
                            <a href="{{ not($user->proProfileRequirementsSatisfied()) ? route('therapist.professional-profile', ['identity']) : 'javascript:void(0)' }}"
                               class="timeline-heading text-black h6 {{not($user->proProfileRequirementsSatisfied())? '' : 'text-decoration-none cursor-text' }}">
                                {{$user->proProfileRequirementsSatisfied() ? 'Professional Profile Complete' : 'Setup Professional Profile'}}
                            </a>
                        </div>
                    </li>

                @endif
            </ul>
            <!-- submit professional profile only for therapist -->
            @if($user->isTherapist())
                <livewire:submit-pro-profile/>
            @endif
        </div>
    </div>
</div>
