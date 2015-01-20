@if(Session::has('message'))

<div class="notify-box {{ Session::get('notify-type', 'success') }}">
    <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
</div>
</html>

@endif