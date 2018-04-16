<div id="message">
    @include('flash::message')

    @if($errors->any())
        <div class="alert alert-danger alert-important">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>
            @foreach($errors->all() AS $error)
                <div>{!! $error !!}</div>
            @endforeach
        </div>
    @endif
</div>