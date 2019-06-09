@extends('layouts.template')
@section('title', 'Remove Oldest Work Record')

@section('content')
    <h3 class="heading_a uk-margin-bottom">Remove Oldest Work Record</h3>
    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="department_add" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('work.remove') }}">
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-large-1-4">
                        <div class="uk-input-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" name="start_date" id="start_date" value="{{old('start_date')}}" class="md-input"
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}" required/>
                        </div>
                    </div>
                    <div class="uk-width-large-1-4">
                        <div class="uk-input-group">
                            <label for="end_date">End Date</label>
                            <input type="text" name="end_date" id="end_date" value="{{old('end_date')}}" class="md-input"
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}" required/>
                        </div>
                    </div>
                    <div class="uk-width-large-1-6 uk-text-right">
                        <button type="submit" class="md-btn md-btn-primary">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
