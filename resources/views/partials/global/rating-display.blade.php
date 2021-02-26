@php
    $rating = 5 -  $rating;
@endphp
<span class="rating has-readonly">
   @for($i = 1; $i <= 5 ; $i++)
        <label><span class="fa fa-star {{$i <= $rating ? '' : 'text-warning'}}"></span></label>
    @endfor
</span>
