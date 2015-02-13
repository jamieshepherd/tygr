<div id="table-actions">
    <span><i class="fa fa-check-square-o"></i> <span id="selectedAmount"></span> issues selected</span>
    <!--a href="" class="action" id="resolve">Resolve</a-->
    @if(Auth::user()->rank <= 2)
    <a href="" class="action" id="claim">Claim</a>
    @endif
    @if(Auth::user()->rank == 1)
    <a href="" class="action" id="delete">Delete</a>
    @endif
</div>