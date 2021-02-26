<div>
    <div class="form-group" wire:ignore>
        <div class="d-flex justify-content-between">
            <label for="specialisms" class="h6">I Need Help With</label>
            <div>
                <a href="javascript:void(0)" class="text-decoration-none" wire:loading.attr='disabled' onclick='triggerSearch()'>
                    <span class="spinner-border spinner-border-sm  mr-1" wire:loading.delay></span>
                     APPLY FILTER
                </a>
            </div>
        </div>
        <select id="specialisms" data-toggle="select2" multiple data-size="10">
            @foreach($categories as $category)
            <optgroup label="{{$category->name}}">
                @foreach($category->specialisms as $specialism)
                <option value="{{$specialism->id}}" {{collect($specialisms)->contains($specialism->id) ? 'selected' : ''}}>{{$specialism->name}}</option>
                @endforeach
            </optgroup>
            @endforeach
        </select>
    </div>
    <div class="form-group" wire:ignore>
        <div class="d-flex justify-content-between">
            <label for="specialisms" class="h6">Languages</label>
        </div>
        <select id="languages" class="form-control form-control-lg" data-toggle="select2" data-allow-clear="true" multiple>
            @foreach (\App\Models\Language::all() as $language)
            <option value="{{ $language->id }}"
                {{ collect($languages)->contains($language->id) ? 'selected' : '' }}>
                {{ $language->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group mt-3">
        <label for="genders" class="h6">Gender</label>
        <div>
            <div class="custom-control custom-control-inline custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="ckb1" value="Male"
                    wire:model.defer="genders">
                <label class="custom-control-label" for="ckb1">Male</label>
            </div>
            <div class="custom-control custom-control-inline custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="ckb2" value="Female"
                    wire:model.defer="genders">
                <label class="custom-control-label" for="ckb2">Female</label>
            </div>
            <div class="custom-control custom-control-inline custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="ckb3" value="Other"
                    wire:model.defer="genders">
                <label class="custom-control-label" for="ckb3">Other</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="genders" class="h6">Sort by Pricing</label>
        <div class="d-flex justify-content-start">
            <div class="custom-control custom-radio mr-3">
                <input type="radio" class="custom-control-input" name="rdGroup2" id="rd4" checked
                    wire:model.defer="priceSort" value="asc"> <label class="custom-control-label" for="rd4">Low to
                    High</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="rdGroup2" id="rd5"
                    wire:model.defer="priceSort" value="desc"> <label class="custom-control-label" for="rd5">High to
                    Low</label>
            </div>
        </div>
    </div>
    <script>
        function triggerSearch(){
                @this.set('specialisms', $('#specialisms').val());
                @this.set('languages', $('#languages').val());
            }
    </script>
</div>
