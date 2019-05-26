@extends('layouts.template')

@section('title', 'Edit Zone')

@section('content')
    <h3 class="heading_b uk-margin-bottom">Edit Zone Detail</h3>

    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="zone_edit" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('zone.update', $result['id']) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="name">Name<span class="req"> * </span></label>
                            <input type="text" name="name" value="{{ (!empty($result['name'])) ? $result['name'] : old('name') }}" class="md-input" required/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="note">Note</label>
                            <textarea class="md-input" name="note" cols="10" rows="4">{{ (!empty($result['note'])) ? $result['note'] : old('note') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">Update</button>
                        <a href="{{ route('zone.edit', $result['id']) }}" class="md-btn md-btn-danger uk-align-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/form_validation.js') }}"></script>
@endpush