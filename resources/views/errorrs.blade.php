@if($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(isset( $custom_error))
    <div class="alert alert-danger">
        <ul class="list-unstyled">
                <li>{{ $custom_error }}</li>
        </ul>
    </div>
@endif


