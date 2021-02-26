<div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="client-billing-contact-tab">
    <div class="card">
        <div class="card-header pb-0 bg-light">
            <h2 id="client-billing-contact-tab m-0" class="card-title"> Education </h2>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> Degree </th>
                        <th> Specialization </th>
                        <th> Institute </th>
                        <th> Year </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($therapist->educations as $education)
                    <tr>
                        <td class="align-middle"> {{$education->degree}} </td>
                        <td class="align-middle"> {{$education->specialization}}</td>
                        <td class="align-middle"> {{$education->institute}} </td>
                        <td class="align-middle"> {{$education->year}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
