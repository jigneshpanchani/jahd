@extends('layouts.template')
@section('title', 'Employee Report')

@section('content')
    <h4 class="heading_a uk-margin-bottom">Employee Report</h4>

    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="report" class="uk-form-stacked" method="post" action="{{route('report')}}">
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-4">
                        <select id="employee_id" name="employee_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Employee" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ ($emp->id==old('employee_id'))?'selected':'' }}>{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="uk-width-large-1-4">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                            <label for="start_date">Start Date</label>
                            <input type="text" name="start_date" id="val_birth" value="" class="md-input"
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}"/>
                        </div>
                    </div>
                    <div class="uk-width-large-1-4">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                            <label for="end_date">End Date</label>
                            <input type="text" name="end_date" id="val_birth" value="" class="md-input"
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}"/>
                        </div>
                    </div>
                    <div class="uk-width-large-1-4">
                        <button type="submit" class="md-btn md-btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <h3 class="heading_b uk-margin-bottom">Employee Detail</h3>

            <?php if(isset($employee)){ ?>

            <div class="md-card">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text">
                        Name : {{$employee->name}}
                    </h3>
                </div>
                <div class="md-card-content large-padding">
                    <div class="uk-grid uk-grid-divider uk-grid-medium">
                        <div class="uk-width-large-1-2">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-large-1-3">
                                    <span class="uk-text-muted uk-text-small">Product Name</span>
                                </div>
                                <div class="uk-width-large-2-3">
                                    <span class="uk-text-large uk-text-middle"><a href="ecommerce_product_details.html#">Galaxy S6 edge</a></span>
                                </div>
                            </div>
                            <hr class="uk-grid-divider">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-large-1-3">
                                    <span class="uk-text-muted uk-text-small">Manufacturer</span>
                                </div>
                                <div class="uk-width-large-2-3">
                                    <span class="uk-text-large uk-text-middle">Samsung</span>
                                </div>
                            </div>
                            <hr class="uk-grid-divider">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-large-1-3">
                                    <span class="uk-text-muted uk-text-small">Serial Number</span>
                                </div>
                                <div class="uk-width-large-2-3">
                                    SM-G925TZKFTMB
                                </div>
                            </div>
                            <hr class="uk-grid-divider">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-large-1-3">
                                    <span class="uk-text-muted uk-text-small">Internal Memory</span>
                                </div>
                                <div class="uk-width-large-2-3">
                                    64GB
                                </div>
                            </div>
                            <hr class="uk-grid-divider">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-large-1-3">
                                    <span class="uk-text-muted uk-text-small">Color</span>
                                </div>
                                <div class="uk-width-large-2-3">
                                    Black
                                </div>
                            </div>
                            <hr class="uk-grid-divider uk-hidden-large">
                        </div>
                        <div class="uk-width-large-1-2">
                            <p>
                                <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Tags</span>
                                <span class="uk-badge uk-badge-success">LTE</span>
                                <span class="uk-badge uk-badge-primary">Quad HD</span>
                                <span class="uk-badge uk-badge-success">Android™ 5.0</span>
                                <span class="uk-badge uk-badge-success">64GB</span>
                            </p>
                            <hr class="uk-grid-divider">
                            <p>
                                <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Description</span>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam necessitatibus suscipit velit voluptatibus! Ab accusamus ad adipisci alias aliquid at atque consectetur, dicta dignissimos, distinctio dolores esse fugiat iste laborum libero magni maiores maxime modi nemo neque, nesciunt nisi nulla optio placeat quas quia quibusdam quis saepe sit ullam!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
@endsection