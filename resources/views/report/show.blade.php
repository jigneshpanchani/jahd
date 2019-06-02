@extends('layouts.template')
@section('title', 'Work Report')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('js/new/jquery.dataTables.min.css') }}"/>
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-5-6">
            <h4 class="heading_a uk-margin-bottom">Work Report</h4>
        </div>
        <div class="uk-width-medium-1-6 uk-text-right">
            <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon" href="{{ route('report') }}"><i class="uk-icon-arrow-circle-left"></i> Back</a>
        </div>
    </div>
    {{--<span calss="msg">From {{ $search['start_date'] }} to {{ $search['start_date'] }} </span>--}}
    <div class="md-card uk-margin-medium-bottom">
            <div class="md-card-content">
                <div class="dt_colVis_buttons"></div>
                <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th width="15%">Employee</th>
                        <th width="10%">Department</th>
                        <th width="10%">Zone</th>
                        <th width="10%">Price</th>
                        <th width="10%">Quantity</th>
                        <th width="10%">Total</th>
                        <th width="10%">Withdrawal</th>
                        <th width="10%">Salary</th>
                        @if($search['employee_id'] != 'All' && $search['employee_id'] > 0)
                            <th width="15%">Date</th>
                        @endif
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Page Total<br>(Total)</th>
                        <th></th>
                        <th></th>
                        <th>0</th>
                        <th>0</th>
                        <th>0</th>
                        <th>0</th>
                        <th>0</th>
                        @if($search['employee_id'] != 'All' && $search['employee_id'] > 0)
                            <th></th>
                        @endif
                    </tr>
                    </tfoot>
                    <tbody>
                    @if(count($result)>0)
                        @foreach($result as $row)
                            <tr>
                                <td>{{ $row->employee_name }}</td>
                                <td>{{ $row->department_name }}</td>
                                <td>{{ $row->zone_name }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->quantity }}</td>
                                <td>{{ $row->total }}</td>
                                <td>{{ $row->withdrawal }}</td>
                                <td>{{ $row->salary }}</td>
                                @if($search['employee_id'] != 'All' && $search['employee_id'] > 0)
                                    <td>{{ $row->date }}</td>
                                @endif
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

{{--@push('scripts')
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

    <script type="text/javascript">
        $(document).ready( function () {

            var table = $('#dt_tableExport').DataTable({
                dom: 'Bflrtip',
                buttons: [
                    {'extend': 'csvHtml5', exportOptions : {
                            modifier : {
                                // DataTables core
                                order : 'index',  // 'current', 'applied', 'index',  'original'
                                page : 'all',      // 'all',     'current'
                                search : 'applied'     // 'none',    'applied', 'removed'
                            }
                        }},
                    {'extend': 'excelHtml5', 'exportOptions': {'columns': ':visible'}, 'charset': 'utf-8', 'bom': true, footer: true},
                    {'extend': 'pdfHtml5', 'bom': true, footer: true, bShowAll: true}
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        pageTotal +' ( '+ total +' )'
                    );
                },
            });

        });
    </script>
@endpush--}}

@push('scripts')
    <script src="{{ asset('js/new/jquery-1.11.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/new/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/new/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/new/vfs_fonts.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/new/datatables.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready( function () {

            var table = $('#dt_tableExport').DataTable({
                dom: 'Bflrtip',
                buttons: [
                    {'extend': 'print', 'footer': true},
                    {'extend': 'excelHtml5', 'footer': true},
                    {'extend': 'pdfHtml5', 'footer': true}
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    totalP = api.column( 3 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    totalQ = api.column( 4 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    totalT = api.column( 5 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    totalW = api.column( 6 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    totalS = api.column( 7 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );

                    // Total over this page
                    pageTotalP = api.column( 3, { page: 'current'} ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    pageTotalQ = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    pageTotalT = api.column( 5, { page: 'current'} ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    pageTotalW = api.column( 6, { page: 'current'} ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                    pageTotalS = api.column( 7, { page: 'current'} ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );

                    // Update footer
                    $( api.column( 3 ).footer() ).html( pageTotalP +'<br>('+ totalP +')' );
                    $( api.column( 4 ).footer() ).html( pageTotalQ +'<br>('+ totalQ +')' );
                    $( api.column( 5 ).footer() ).html( pageTotalT +'<br>('+ totalT +')' );
                    $( api.column( 6 ).footer() ).html( pageTotalW +'<br>('+ totalW +')' );
                    $( api.column( 7 ).footer() ).html( pageTotalS +'<br>('+ totalS +')' );
                },
            });

        });
    </script>
@endpush