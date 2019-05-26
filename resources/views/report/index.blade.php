@extends('layouts.template')
@section('title', 'Employee Report')

@section('content')
    <h3 class="heading_a uk-margin-bottom">Work Report</h3>
    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="department_add" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('report.generate') }}">
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <div class="uk-form-row parsley-row">
                            {{--<span class="icheck-inline"><h3 class="heading_a">Select type :</h3></span>--}}
                            <span class="icheck-inline">
                                <input type="radio" name="radio_type" id="radio_type_1" class="type_id" value="Z" data-md-icheck required/>
                                <label for="radio_type_1" class="inline-label">Zone wise</label>
                            </span>
                            <span class="icheck-inline">
                                <input type="radio" name="radio_type" id="radio_type_2" class="type_id" value="E" data-md-icheck required/>
                                <label for="radio_type_2" class="inline-label">Employee wise</label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-3 zone_list" style="display: none;">
                        <select id="zone_id" name="zone_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Zone">
                            <option value="">Select Zone</option>
                            @foreach($zones as $zone)
                                <option value="{{ $zone->id }}" {{ ($zone->id==old('zone_id'))?'selected':'' }}>{{ $zone->name }}</option>
                            @endforeach
                            <option value="ALL">ALL</option>
                        </select>
                    </div>
                    <div class="uk-width-medium-1-3 emp_list" style="display: none;">
                        <select id="employee_id" name="employee_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Employee">
                            <option value="">Select Employee</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ ($emp->id==old('employee_id'))?'selected':'' }}>{{ $emp->name }}</option>
                            @endforeach
                            <option value="ALL">ALL</option>
                        </select>
                    </div>
                    <div class="uk-width-large-1-4">
                        <div class="uk-input-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" name="start_date" id="val_birth" value="{{old('start_date')}}" class="md-input"
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}"/>
                        </div>
                    </div>
                    <div class="uk-width-large-1-4">
                        <div class="uk-input-group">
                            <label for="end_date">End Date</label>
                            <input type="text" name="end_date" id="val_birth" value="{{old('end_date')}}" class="md-input"
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}"/>
                        </div>
                    </div>
                    <div class="uk-width-large-1-6 uk-text-right">
                        <button type="submit" class="md-btn md-btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/form_validation.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').on('ifChecked', '.type_id', function () {
                let typeId = $(this).val();
                if(typeId == 'E'){
                    $('.emp_list').show();
                    $('.zone_list').hide();
                }else if(typeId == 'Z'){
                    $('.zone_list').show();
                    $('.emp_list').hide();
                }else{
                    $('.zone_list').hide();
                    $('.emp_list').hide();
                }
            });
        });
    </script>
@endpush