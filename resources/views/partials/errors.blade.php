<div class="container">
    <ul class="list-group">
        @if($errors->count() > 0)
            @foreach($errors->all() as $error)
                <li class="list-group-item">
                    {{ $error }}
                </li>
            @endforeach
        @endif
    </ul>
</div>