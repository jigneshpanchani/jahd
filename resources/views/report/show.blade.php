@extends('layouts.template')
@section('title', 'Work Report')

@section('content')
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-5-6">
            <h4 class="heading_a uk-margin-bottom">Work Report</h4>
        </div>
        <div class="uk-width-medium-1-6">
            <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon" href="{{ route('report') }}"><i class="uk-icon-arrow-circle-left"></i> Back</a>
        </div>
    </div>
    <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="dt_colVis_buttons"></div>
                <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th width="25%">Employee Name</th>
                        <th width="25%">Zone</th>
                        <th width="10%">Date</th>
                        <th width="10%">Department</th>
                        <th width="10%">Price</th>
                        <th width="10%">Quantity</th>
                        <th width="10%">Total</th>
                        <th width="10%">Withdrawal</th>
                        <th width="10%">Salary</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($result)>0)
                        @foreach($result as $row)
                            <tr>
                                <td>{{ $row->employee_name }}</td>
                                <td>{{ $row->zone_name }}</td>
                                <td>{{ $row->date }}</td>
                                <td>{{ $row->department_name }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{ $row->total }}</td>
                                <td>{{ $row->withdrawal }}</td>
                                <td>{{ $row->salary }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5" class="uk-text-center">No record found</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@push('scripts')
    <!-- datatables -->
    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- datatables buttons-->
    <script src="{{ asset('bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
    <script src="{{ asset('assets/js/custom/datatables/buttons.uikit.js') }}"></script>
    <script src="{{ asset('bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-buttons/js/buttons.print.js') }}"></script>

    <!-- datatables custom integration -->
    <script src="{{ asset('assets/js/custom/datatables/datatables.uikit.min.js') }}"></script>

    <!--  datatables functions -->
    <script src="{{ asset('assets/js/pages/plugins_datatables.min.js') }}"></script>
@endpush