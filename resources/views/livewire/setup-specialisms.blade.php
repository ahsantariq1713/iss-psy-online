<div>
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="license.experience">Specialities</label>
        </div>
        <div wire:ignore class="m-0 p-0">
            <select id="specialism" class="form-control form-control-lg" data-toggle="select2">
                <option value=null>Select Speciality to Add</option>
                @foreach($specialisms as $specialism)
                    <option value="{{$specialism->id}}">{{$specialism->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    @foreach($mySpecialisms->groupBy('specialism_category_id') as $category)
        <div class="card">
            <div class="list-group list-group-flush list-group-bordered mt-2">
                <div class="lead ml-3 mt-3 font-weight-normal">{{explode('/',$category[0]->name)[0]}}</div>
                @foreach($category as $specialism)
                    <label class="list-group-item custom-control custom-checkbox mb-0 d-flex justify-content-between">
                        <span>{{$specialism->name}}</span>
                        <a href="javascript:void(0)" wire:click="delete({{$specialism}})" title="Remove" class="text-danger"><i class="fa fa-close"></i> </a>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach


    <script>
        document.addEventListener('livewire:load', () => {
            $('#specialism').on('select2:select', e => @this.set('specialism', e.params.data.id));

            window.livewire.on('remove-specialism', id => {
                $("#specialism option[value='" + id + "']").remove();
                $("#specialism option[value=]").attr('selected', true);
            })

            window.livewire.on('add-specialism', payload => {
                $("#specialism").append('<option value="' + payload.id + '"> ' + payload.name + ' </option>')
            })
        });
    </script>
</div>
