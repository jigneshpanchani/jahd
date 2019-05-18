@if(\Session::has('success'))

    <div class="uk-alert uk-alert-success" data-uk-alert>
        <a href="components_common.html#" class="uk-alert-close uk-close"></a>
        {{ session('success') }}
    </div>

@elseif(\Session::has('error'))

    <div class="uk-alert uk-alert-danger" data-uk-alert>
        <a href="components_common.html#" class="uk-alert-close uk-close"></a>
        {{ session('error') }}
    </div>

@elseif(\Session::has('warning'))

    <div class="uk-alert uk-alert-warning" data-uk-alert>
        <a href="components_common.html#" class="uk-alert-close uk-close"></a>
        {{ session('warning') }}
    </div>

@elseif(\Session::has('info'))

    <div class="uk-alert uk-alert-info" data-uk-alert>
        <a href="components_common.html#" class="uk-alert-close uk-close"></a>
        {{ session('info') }}
    </div>

@else
    @if($errors->any())
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="components_common.html#" class="uk-alert-close uk-close"></a>
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
@endif