@if(Session::has('message'))

<div class="notify-box {{ Session::get('notify-type', 'success') }}" onClick="closeNotification(this)">
    <i class="fa fa-times" id="close-icon"></i>
    <i class="fa fa-info-circle"></i> {{ Session::get('message') }}
</div>

@endif
@if($errors->any())
    <div class="notify-box error }}" onClick="closeNotification(this)">
        <i class="fa fa-times" id="close-icon"></i>
        <i class="fa fa-exclamation-triangle"></i> There were errors submitting this form.
    </div>
@endif
</html>
