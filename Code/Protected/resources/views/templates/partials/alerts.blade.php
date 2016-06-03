<!-- Current session info -->
@if (Session::has('info'))
<div class="alert alert-custom fade in" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif