@if($user->profileLog->status == \App\Helpers\ProfileLogStatus::UNDER_REVIEW)
    <div class="alert alert-info p-0 text-info">
        <div class="card-body">
            <div class="mt-3 ml-3 pl-2">
                <h6 class="font-weight-normal">Professional Profile Under Review</h6>
                <p class="text-muted small">Your account has been paused while our team reviews it. This usually takes less than 48 hours. We will be in touch soon.</p>
            </div>
        </div>
    </div>
@elseif($user->profileLog->status == \App\Helpers\ProfileLogStatus::DISAPPROVED)
    <div class="alert alert-danger p-0 text-danger">
        <div class="card-body">
            <div class="mt-3 ml-3 pl-2">
                <h6 class="font-weight-normal">Professional Profile Disapproved</h6>
                <p class="text-muted small">Your account isn't approved because you provided data that doesn't comply with our policies. Please submit the profile again.</p>
            </div>
        </div>
    </div>
@elseif($user->profileLog->status == \App\Helpers\ProfileLogStatus::APPROVED)
    <div class="alert alert-success p-0 text-success">
        <div class="card-body">
            <div class="mt-3 ml-3 pl-2">
                <h6 class="font-weight-normal">Account Approved</h6>
                <p class="text-muted small">Your account has been approved, and you can start practicing in your specialized field. </p>
            </div>
        </div>
    </div>
@endif
