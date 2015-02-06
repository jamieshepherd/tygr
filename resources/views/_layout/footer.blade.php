@if(Session::has('message'))

<div class="notify-box {{ Session::get('notify-type', 'success') }}">
    <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
</div>

@endif
@if($errors->any())
    <div class="notify-box error }}">
        <i class="fa fa-times" id="close-notification" onClick="closeNotification()"></i>
        <i class="fa fa-exclamation-triangle"></i> There were errors submitting this form.
    </div>
@endif
</html>