@extends('layouts.template')

@section('title', 'Edit Employee')

@section('content')
    <h3 class="heading_b uk-margin-bottom">Edit Employee Detail</h3>

    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="employee_edit" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('employee.update', $result['id']) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="name">Full Name<span class="req"> * </span></label>
                            <input type="text" name="name" value="{{ (!empty($result['name'])) ? $result['name'] : old('name') }}" required class="md-input"/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="aadhar_card_no">Aadhar No</label>
                            <input type="number" name="aadhar_card_no" value="{{ (!empty($result['aadhar_card_no'])) ? $result['aadhar_card_no'] : old('aadhar_card_no') }}" class="md-input"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="val_birth">Birth Date</label>
                            <input type="text" name="dob" id="val_birth" value="{{ (!empty($result['dob'])) ? $result['dob'] : old('dob') }}" class="md-input"
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}"/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="uk-form-row parsley-row">
                            <label for="contact_no">Contact No.</label>
                            <input type="text" name="contact_no" value="{{ (!empty($result['contact_no'])) ? $result['contact_no'] : old('contact_no') }}" class="md-input"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-2">
                        <div class="parsley-row">
                            <label for="address">Address</label>
                            <textarea required class="md-input" name="address" cols="10" rows="4">{{ (!empty($result['address'])) ? $result['address'] : old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="uk-width-1-2">
                        <div class="parsley-row">
                            <label for="note">Extra Note</label>
                            <textarea class="md-input" name="note" cols="10" rows="4">{{ (!empty($result['note'])) ? $result['note'] : old('note') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">Update</button>
                        <a href="{{ route('employee.edit', $result['id']) }}" class="md-btn md-btn-danger uk-align-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/form_validation.js') }}"></script>
@endpush