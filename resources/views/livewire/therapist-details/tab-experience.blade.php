<div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="client-billing-contact-tab">
    <div class="card">
        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title"> Experience </h2>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> Designation </th>
                        <th> Location / Institute </th>
                        <th> Start Year</th>
                        <th> End Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($therapist->experiences as $experience)
                    <tr>
                        <td class="align-middle"> {{$experience->designation}} </td>
                        <td class="align-middle"> {{$experience->location}}</td>
                        <td class="align-middle"> {{$experience->start}}</td>
                        <td class="align-middle"> {{$experience->end}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
