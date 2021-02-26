<div>
    <div wire:ignore>
        <div class="alert alert-success p-3 m-0 rounded-0 mb-3 w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mb-0">Submit Recommendations</h6>
                    <p class="m-0">Click to mark the appointment as Complete.</p>
                </div>
                <button class="btn btn-sm btn-success mt-2 d-lg-block d-md-block d-none"
                   style="min-width:120px" wire:loading.attr='disabled'  wire:click="markComplete">
                    <span class="spinner-border spinner-border-sm mr-1"  wire:loading.delay wire:target="markComplete"></span>
                    Submit
                </button>
            </div>
            <button class="btn btn-sm btn-success mt-2 d-lg-none d-md-none"

               style="min-width:120px" wire:loading.attr='disabled'  wire:click="markComplete">
                <span class="spinner-border spinner-border-sm mr-1"  wire:loading.delay wire:target="markComplete"></span>
               Submit
            </button>
        </div>
        <textarea class="form-control tiny" id="editor1">{{$appointment->recommendations}}</textarea>
        <script >
            document.addEventListener('livewire:load', function () {
                let ed1 = $('#editor1');
                if (ed1) {
                    ed1.summernote()
                }
            })
        </script>
    </div>
    <div class="text-right mt-2 d-flex justify-content-end">
        <button class="btn btn-primary" wire:loading.attr='disabled'
                onclick="@this.set('recs',$('#editor1').summernote('code'))">
            <span class="spinner-border spinner-border-sm mr-1"  wire:loading.delay wire:target="recs"></span>
            Save Recommendations
        </button>
    </div>
</div>
