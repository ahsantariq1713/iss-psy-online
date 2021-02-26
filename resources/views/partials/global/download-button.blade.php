<div>
    @if(not_null($obj) && $obj[$property])
    <a href="javascript:void(0)" class="text-decoration-none text-primary cursor-pointer mb-2"
        wire:click="export('{{$property}}')">
        <i class="mdi mdi-attachment"></i> Download Document
    </a>
    @endif

</div>
