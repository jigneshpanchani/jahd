@extends('layouts.template')

@section('title', 'Add Work')

@section('content')
    <h3 class="heading_b uk-margin-bottom">Add Employee Work</h3>

    <div class="md-card">
        <div class="md-card-content large-padding">
            <form name="work-add" id="form_validation" class="uk-form-stacked" method="post" action="{{ route('work.store') }}">
                {{ csrf_field() }}
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-3">
                        <div class="parsley-row">
                            <label for="val_date">Working Date</label>
                            <input type="text" name="date" id="val_date" class="md-input" value="{{old('date')}}" 
                                   data-parsley-americandate
                                   data-parsley-americandate-message="This value should be a valid date (YYYY-MM-DD)"
                                   data-uk-datepicker="{format:'YYYY-MM-DD'}"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <select id="employee_id" name="employee_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Employee" required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ ($emp->id==old('employee_id'))?'selected':'' }}>{{ $emp->name }}</option>
                            @endforeach
                        </select>
                        {{--<span class="uk-form-help-block">With Employee</span>--}}
                    </div>
                    <div class="uk-width-medium-1-2">
                        <select id="department_id" name="department_id" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Select Department" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ ($dept->id==old('department_id'))?'selected':'' }}>{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-4">
                        <div class="parsley-row">
                            <label for="withdrawal">Withdrawal</label>
                            <input type="number" name="withdrawal" min="0" data-parsley-min="0" value="{{ (old('withdrawal')) ? old('withdrawal') : 0 }}" class="md-input"/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-4">
                        <div class="parsley-row">
                            <label for="salary">Salary</label>
                            <input type="number" name="salary" min="0" data-parsley-min="0" value="{{ (old('salary')) ? old('salary') : 0 }}" class="md-input"/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-6">
                        <div class="parsley-row">
                            <label for="price">Price</label>
                            <input type="text" name="price" value="{{old('price')}}" class="md-input price" disabled />
                            <input type="hidden" name="price" value="{{old('price')}}" class="price" />
                        </div>
                    </div>
                    <div class="uk-width-medium-1-6">
                        <div class="parsley-row">
                            <label for="quantity">Quantity<span class="req"> * </span></label>
                            <input type="number" name="quantity" min="1" data-parsley-min="1" value="{{old('quantity')}}" required class="md-input quantity"/>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-6">
                        <div class="parsley-row">
                            <label for="total">Total</label>
                            <input type="text" name="total" value="{{old('total')}}" class="md-input total" disabled/>
                            <input type="hidden" name="total" value="{{old('total')}}" class="total"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-1-1">
                        <div class="parsley-row">
                            <label for="note">Note</label>
                            <textarea class="md-input" name="note" cols="10" rows="4">{{old('note')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">Save</button>
                        <a href="{{ route('work.index') }}" class="md-btn md-btn-danger uk-align-right">Cancel</a>
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
            $('body').on('change', '#department_id', function () {
                let departmentId = $(this).val();
                $.ajax({
                    url: "{{ route('get.price') }}",
                    method:'post',
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "departmentId": departmentId
                    },
                    success: function( data ) {
                        $('.price').val(data);
                        $('.price').trigger('change');
                        calculateTotal();
                    }
                });
            });
            $('body').on('change', '.quantity', function () {
                calculateTotal();
            });
            $('body').on('keyup', '.quantity', function () {
                calculateTotal();
            });
            function calculateTotal(){
                setTotal();
                let price = $('.price').val();
                let qnt = $('.quantity').val();
                if(qnt > 0 && price > 0){
                    let total = parseFloat(price) * parseFloat(qnt);
                    setTotal(total);
                }
            }
            function setTotal(total=0.00) {
                $('.total').val(total.toFixed(2));
                $('.total').trigger('change');
            }
        });
    </script>
@endpush