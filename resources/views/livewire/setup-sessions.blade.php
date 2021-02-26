<div>
    <div class="page-section mt-5 pt-5">

        <form wire:submit.prevent="update" class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
            <h6>Manage Working Hours</h6>
            <p class="m-0 mb-3">You can disable sessions in working hours.</p>
            <div class="form-group d-none d-md-block d-lg-block">
                @foreach($this->activeDays as $day)
                <div class="custom-control custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input" name="day" value="{{strtolower($day)}}"
                        id="rd-{{$day}}" wire:model="day">
                    <label class="custom-control-label" for="rd-{{$day}}">{{strtoupper($day)}}</label>
                </div>
                @endforeach
            </div>
            <div wire:ignore class="m-0 p-0 d-lg-none d-md-none mb-3">
                <select class="form-control form-control-lg" data-toggle="select2" id="day" wire:model="day">
                    @foreach($this->activeDays as $day)
                    <option>{{strtoupper($day)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="card shadow-none border border-top-0">
                @foreach($sessions as $session)
                <div class="d-flex justify-content-between border-top px-4 py-3">
                    <div class="rem">{{$session->readable()}}</div>
                    <div>
                        <label class="switcher-control">
                            <input type="checkbox" class="switcher-input" {{$session->active?'checked': ''}}
                                id="{{$session->id}}" wire:click="toggle('{{$session->id}}')">
                            <span class="switcher-indicator"></span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>


            <div class="form-group d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary ml-2" wire:loading.attr="disabled">
                    <span class="spinner-border spinner-border-sm mr-1" wire:loading.delay wire:target="update"></span>
                    Save and Next
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('livewire:load', () => {
            $('#day').on('select2:select', e => @this.set('day', e.params.data.text));
        });
    </script>
</div>
