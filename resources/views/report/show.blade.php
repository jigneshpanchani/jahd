@extends('layouts.template')
@section('title', $title)

@section('content')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('js/new/jquery.dataTables.min.css') }}"/>--}}
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-5-6">
            <h4 class="heading_a uk-margin-bottom">{{ $title }}</h4>
        </div>
        <div class="uk-width-medium-1-6 uk-text-right">
            <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon" href="{{ route('report') }}"><i class="uk-icon-arrow-circle-left"></i> Back</a>
        </div>
    </div>

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
                        @if($search['employee_id'] != 'ALL' && $search['employee_id'] > 0)
                            <th width="15%">Date</th>
                        @endif
                    </tr>
                    </thead>

                    @if(count($result)>0)
                    <tfoot>
                    <tr>
                        <th>Page Total<br>(Total)</th>
                        <th></th>
                        <th></th>
                        <th class="sumP">0</th>
                        <th class="sumQ">0</th>
                        <th class="sumT">0</th>
                        <th class="sumW">0</th>
                        <th class="sumS">0</th>
                        @if($search['employee_id'] != 'ALL' && $search['employee_id'] > 0)
                            <th></th>
                        @endif
                    </tr>
                    </tfoot>
                    @endif

                    <tbody>
                    @if(count($result)>0)
                        @foreach($result as $row)
                            <tr>
                                <td>{{ $row->employee_name }}</td>
                                <td>{{ $row->department_name }}</td>
                                <td>{{ $row->zone_name }}</td>
                                <td>{{ number_format((float)$row->price, 2, '.', '') }}</td>
                                <td>{{ number_format($row->quantity) }}</td>
                                <td>{{ number_format($row->total) }}</td>
                                <td>{{ number_format($row->withdrawal) }}</td>
                                <td>{{ number_format(($row->total - $row->withdrawal)) }}</td>
                                @if($search['employee_id'] != 'ALL' && $search['employee_id'] > 0)
                                    <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="9" class="uk-text-center">No record found</td></tr>
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

    <!--  sum() js -->
    <script src="{{ asset('assets/js/pages/sum().js') }}"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            var table = $('#dt_tableExport').DataTable();
            calculateTotal();
            $('#dt_tableExport').on( 'draw.dt', function () {
                calculateTotal();
            });
            function calculateTotal() {
                var arr = { '3':'P', '4':'Q', '5':'T', '6':'W', '7':'S' };
                $.each(arr, function (key, value){
                    let pageTotal = table.column( key, {'page': 'current'}).data().sum();
                    let total = table.column( key ).data().sum();
                    let display = currencyFormat(pageTotal)+' <br>('+currencyFormat(total)+')';
                    $('.sum'+value).html(display);
                });
            }
            function currencyFormat(total) {
                return total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
            }
        });
    </script>
@endpush