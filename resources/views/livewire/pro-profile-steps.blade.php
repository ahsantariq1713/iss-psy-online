<div>
    <ol class="progress-list mb-0 mb-sm-4">
        <li class="{{ $profileLog->identity ? 'success' : ''}} {{ ($active == 'identity'? 'active' : '') }}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/identity'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'identity'? 'text-primary font-weight-bold' : ''}}">Identity</span>
        </li>
        <li class="{{ $profileLog->license ? 'success' : ''}} {{ ($active == 'license'? 'active' : '')}}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/license'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'license'? 'text-primary font-weight-bold' : ''}}">Practitioner License</span>
        </li>
        <li class="{{ $profileLog->education ? 'success' : ''}} {{ ($active == 'education'? 'active' : '')}}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/education'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'education'? 'text-primary font-weight-bold' : ''}}">Education</span>
        </li>
        <li class="{{ $profileLog->experience ? 'success' : ''}} {{ ($active == 'experience'? 'active' : '')}}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/experience'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'experience'? 'text-primary font-weight-bold' : ''}}">Experience
                </span>
        </li>
        <li class="{{ $profileLog->roster ? 'success' : ''}} {{ ($active == 'roster'? 'active' : '')}}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/roster'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'roster'? 'text-primary font-weight-bold' : ''}}"> Roster</span>
        </li>
        <li class="{{ $profileLog->sessions ? 'success' : ''}} {{ ($active == 'sessions'? 'active' : '')}}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/sessions'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'sessions'? 'text-primary font-weight-bold' : ''}}">Sessions</span>
        </li>
        <li class="{{ $profileLog->pricing ? 'success' : ''}} {{ ($active == 'pricing'? 'active' : '')}}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/pricing'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'pricing'? 'text-primary font-weight-bold' : ''}}">Pricing</span>
        </li>
        <li class="{{ $profileLog->payment ? 'success' : ''}} {{ ($active == 'payment'? 'active' : '')}}">
            <button type="button" onclick="window.location.href='/therapist-portal/professional-profile/payment'">
                <span class="progress-indicator"></span></button>
            <span
                class="progress-label d-none d-sm-inline-block {{$active == 'payment'? 'text-primary font-weight-bold' : ''}}">Payment Setup</span>
        </li>
    </ol>
</div>
