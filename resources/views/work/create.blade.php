@extends('layouts.template')

@section('title', 'Select Zone')

@section('content')
    <h3 class="heading_b uk-margin-bottom">Select Zone</h3>
    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="work" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('work.add') }}">
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <div class="uk-form-row parsley-row">
                            @foreach($zones as $zone)
                                <span class="icheck-inline">
                                    <input type="radio" name="zone" id="zone_{{ $zone->id }}" class="zone_id" value="{{ $zone->id }}" data-md-icheck required/>
                                    <label for="zone_{{ $zone->id }}" class="inline-label">{{ $zone->name }}</label>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">Go</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/form_validation.js') }}"></script>
@endpush