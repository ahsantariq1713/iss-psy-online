<div>
    <div class="page-section mt-5 pt-5">

        <form wire:submit.prevent="update" class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3">
            <h6>Your Availability</h6>
            <p class="m-0 mb-3">Your clients can book appointments only in between opening and closing time.</p>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.experience">Opening Time</label>
                </div>
                <div wire:ignore class="m-0 p-0">
                    <select class="form-control form-control-lg @error('roster.open') is-invalid @enderror"
                        data-toggle="select2" id="roster-open" wire:model="roster.open">
                        <option>12:00 AM</option>
                        <option>01:00 AM</option>
                        <option>02:00 AM</option>
                        <option>03:00 AM</option>
                        <option>04:00 AM</option>
                        <option>05:00 AM</option>
                        <option>06:00 AM</option>
                        <option>07:00 AM</option>
                        <option>08:00 AM</option>
                        <option>09:00 AM</option>
                        <option>10:00 AM</option>
                        <option>11:00 AM</option>
                        <option>12:00 PM</option>
                        <option>01:00 PM</option>
                        <option>02:00 PM</option>
                        <option>03:00 PM</option>
                        <option>04:00 PM</option>
                        <option>05:00 PM</option>
                        <option>06:00 PM</option>
                        <option>07:00 PM</option>
                        <option>08:00 PM</option>
                        <option>09:00 PM</option>
                        <option>10:00 PM</option>
                        <option>11:00 PM</option>
                    </select>
                </div>
                @error('roster.open')
                <span class="small text-danger">{{$errors->first('roster.open')}}</span>
                @enderror
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.experience">Closing Time</label>
                </div>
                <div wire:ignore class="m-0 p-0">
                    <select class="form-control form-control-lg @error('roster.close') is-invalid @enderror"
                        data-toggle="select2" id="roster-close" wire:model="roster.close">
                        <option>12:00 AM</option>
                        <option>01:00 AM</option>
                        <option>02:00 AM</option>
                        <option>03:00 AM</option>
                        <option>04:00 AM</option>
                        <option>05:00 AM</option>
                        <option>06:00 AM</option>
                        <option>07:00 AM</option>
                        <option>08:00 AM</option>
                        <option>09:00 AM</option>
                        <option>10:00 AM</option>
                        <option>11:00 AM</option>
                        <option>12:00 PM</option>
                        <option>01:00 PM</option>
                        <option>02:00 PM</option>
                        <option>03:00 PM</option>
                        <option>04:00 PM</option>
                        <option>05:00 PM</option>
                        <option>06:00 PM</option>
                        <option>07:00 PM</option>
                        <option>08:00 PM</option>
                        <option>09:00 PM</option>
                        <option>10:00 PM</option>
                        <option>11:00 PM</option>
                    </select>
                </div>
                @error('roster.close')
                <span class="small text-danger">{{$errors->first('roster.close')}}</span>
                @enderror
            </div>


            <h6 class="mt-4">Appointment Settings</h6>
            <p class="m-0 mb-3">The system will automatically generate appointment sessions available for clients to
                book.</p>
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.experience">Appointment Duration</label>
                </div>
                <div wire:ignore class="m-0 p-0">
                    <select class="form-control form-control-lg @error('roster.duration') is-invalid @enderror"
                        data-toggle="select2" id="roster-duration" wire:model="roster.duration">
                        {{-- <option value="30">Half Hour</option> --}}
                        <option value="60">1 Hour</option>
                        <option value="90">1.5 Hours</option>
                        <option value="120">2 Hours</option>
                    </select>
                </div>
                @error('roster.duration')
                <span class="small text-danger">{{$errors->first('roster.duration')}}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <label for="license.experience">Break</label>
                </div>
                <div wire:ignore class="m-0 p-0">
                    <select class="form-control form-control-lg @error('roster.break') is-invalid @enderror"
                        data-toggle="select2" id="roster-break" wire:model="roster.break">
                        <option value="15">15 Minutes</option>
                        <option value="30">30 Minutes</option>
                        <option value="45">45 Minutes</option>
                        <option value="60">1 Hour</option>
                        <option value=90>1.5 Hours</option>
                        <option value="120">2 Hours</option>
                    </select>
                </div>
                @error('roster.break')
                <span class="small text-danger">{{$errors->first('roster.break')}}</span>
                @enderror
            </div>

            <h6 class="mt-4">Working Days</h6>
            <p class="m-0 mb-3">Clients can book you in working days only.</p>
            <div class="card shadow-none border border-top-0">
                @foreach($days as $day)
                <div class="d-flex justify-content-between border-top px-4 py-3">
                    <div class="rem">{{strtoupper($day)}}</div>
                    <div>
                        <label class="switcher-control">
                            <input type="checkbox" class="switcher-input" {{$roster[$day] ? 'checked' : ''}}
                                id="roster-{{$day}}">
                            <span class="switcher-indicator"></span>
                        </label>
                        <script>
                            document.addEventListener('livewire:load',function(){
                                $("#roster-{{$day}}").on("change",function (e) {
                                    @this.set('roster.{{$day}}', $("#roster-{{$day}}").is(':checked') ? 1 : 0);
                                })
                            });
                        </script>
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
            $('#roster-open').on('select2:select', e => @this.set('roster.open', e.params.data.text));
            $('#roster-close').on('select2:select', e => @this.set('roster.close', e.params.data.text));

            $('#roster-duration').on('select2:select', e => @this.set('roster.duration', e.params.data.id));
            $('#roster-break').on('select2:select', e => @this.set('roster.break', e.params.data.id));
        });
    </script>
</div>
