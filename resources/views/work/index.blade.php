@extends('layouts.template')
@section('title', 'Work List')

@section('content')
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-5-6">
            <h4 class="heading_a uk-margin-bottom">Work List</h4>
        </div>
        <div class="uk-width-medium-1-6 uk-text-right">
            <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon" href="{{ route('work.create') }}"><i class="uk-icon-plus-circle"></i> Add</a>
        </div>
    </div>
    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <div class="dt_colVis_buttons"></div>
            <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="25%">Name</th>
                    <th width="20%">Department</th>
                    <th width="10%">Price</th>
                    <th width="10%">Quantity</th>
                    <th width="10%">Total</th>
                    <th width="15%">Date</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($works)>0)
                    @foreach($works as $row)
                        <tr>
                            <td>{{ $row['employee']['name'] }}</td>
                            <td>{{ $row['department']['name'] }}</td>
                            <td>{{ $row['price'] }}</td>
                            <td>{{ $row['quantity'] }}</td>
                            <td>{{ number_format(($row['price'] * $row['quantity']), 2) }}</td>
                            <td>{{ $row['date'] }}</td>
                            <td>
                                <a href="{{ route('work.edit', $row['id']) }}" class="md-btn md-btn-twitter md-btn-mini md-btn-icon" title="Edit"><i class="uk-icon-edit uk-icon-small"></i></a>&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0);" title="Delete" data-id="{{$row['id']}}" class="md-btn md-btn-danger md-btn-mini md-btn-icon deleteRecord"><i class="uk-icon-trash uk-icon-small"></i></a>&nbsp;
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="7" class="uk-text-center">No record found</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- datatables -->
    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- datatables custom integration -->
    <script src="{{ asset('assets/js/custom/datatables/datatables.uikit.min.js') }}"></script>
    <!--  datatables functions -->
    <script src="{{ asset('assets/js/pages/plugins_datatables.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('body').on('click', '.deleteRecord', function () {
                let rowId = $(this).attr('data-id');
                deleteRecord(rowId);
            });
            function deleteRecord(rowId){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "work/"+rowId,
                            type: 'DELETE',
                            data: { "id": rowId, "_token": "{{ csrf_token() }}", },
                            success: function (data){
                                Swal.fire({
                                    title: data.title,
                                    text: data.msg,
                                    type: data.status
                                }).then((result) => {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                })
            }
        });
    </script>
@endpush