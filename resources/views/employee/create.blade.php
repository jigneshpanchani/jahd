@extends('layouts.template')

@section('title', 'Add Employee')

@section('content')
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-5-6">
            <h4 class="heading_a uk-margin-bottom">Create New Employee</h4>
        </div>
        <div class="uk-width-medium-1-6 uk-text-right">
            <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon" href="{{ route('employee.index') }}"><i class="uk-icon-arrow-circle-left"></i> List</a>
        </div>
    </div>
    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="employee_add" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('employee.store') }}">
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <select id="department_id" name="department_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Zone" required>
                            <option value="">Select Zone & Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ ($department->id==old('department_id'))?'selected':'' }}>{{ $department->zone->name.' ('.$department->name.')'}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="name">Full Name<span class="req"> * </span></label>
                            <input type="text" name="name" value="{{old('name')}}" class="md-input" required/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="uk-form-row parsley-row">
                            <label for="contact_no">Contact No.</label>
                            <input type="text" name="contact_no" value="{{old('contact_no')}}" class="md-input"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-2">
                        <div class="parsley-row">
                            <label for="address">Address</label>
                            <textarea class="md-input" name="address" cols="10" rows="4">{{old('address')}}</textarea>
                        </div>
                    </div>
                    <div class="uk-width-1-2">
                        <div class="parsley-row">
                            <label for="note">Extra Note</label>
                            <textarea class="md-input" name="note" cols="10" rows="4">{{old('note')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">Save</button>
                        <a href="{{ route('employee.index') }}" class="md-btn md-btn-danger uk-align-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/form_validation.js') }}"></script>
@endpush