<script src="//geoip-js.com/js/apis/geoip2/v2.1/geoip2.js" type="text/javascript"></script>
<script>
    document.addEventListener('livewire:load', () => {
        @this.set('timezone', Intl.DateTimeFormat().resolvedOptions().timeZone);
        // geoip2.country((result) => {
        //     window.livewire.emit('countryFetched');
        //     @this.set('country', result.registered_country.names['en']);
        // },() => console.error('auto region finder not working'));
    });
</script>
