<div>
    <div wire:ignore>
        <textarea class="form-control tiny" id="editor2">{{$appointment->notes}}</textarea>
        <script >
            document.addEventListener('livewire:load', function () {
                let ed2 = $('#editor2');
                if (ed2) {
                    ed2.summernote()
                }
            })
        </script>
    </div>
    <div class="text-right mt-2">
        <button class="btn btn-primary" wire:loading.attr='disabled'
                onclick="@this.set('notes',$('#editor2').summernote('code'))">
            <span class="spinner-border spinner-border-sm mr-1"  wire:loading.delay></span>
            Save Private Notes
        </button>
    </div>
</div>
