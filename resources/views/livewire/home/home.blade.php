
<div>
    <link rel="stylesheet" href="{{asset('assets/css/pages/home.css')}}">
    <script src="{{asset('assets/js/pages/home.js')}}"></script>
    @include('livewire.home.video')
    @include('livewire.home.intro')
    @include('partials.site.divider')
    @include('livewire.home.hiw')
    @include('livewire.home.pricing')
    @include('livewire.home.testimonial')
</div>
