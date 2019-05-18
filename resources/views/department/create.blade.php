@extends('layouts.template')

@section('title', 'Add Department')

@section('content')
    <h3 class="heading_b uk-margin-bottom">Create New Department</h3>

    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="department_add" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('department.store') }}">
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="name">Name<span class="req"> * </span></label>
                            <input type="text" name="name" value="{{old('name')}}" class="md-input" required/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="price">Price<span class="req"> * </span></label>
                            <input type="number" name="price" min="0.10" data-parsley-min="0" step=".01" value="{{old('price')}}" class="md-input" required/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1">
                        <div class="parsley-row">
                            <label for="message">Note</label>
                            <textarea class="md-input" name="note" cols="10" rows="4">{{old('note')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">Save</button>
                        <a href="{{ route('department.index') }}" class="md-btn md-btn-danger uk-align-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/form_validation.js') }}"></script>
@endpush