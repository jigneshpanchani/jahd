@extends('layouts.template')
@section('title', 'Department List')

@section('content')
    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-medium-5-6">
            <h4 class="heading_a uk-margin-bottom">Department List</h4>
        </div>
        <div class="uk-width-medium-1-6 uk-text-right">
            <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light md-btn-icon" href="{{ route('department.create') }}"><i class="uk-icon-plus-circle"></i> Add</a>
        </div>
    </div>
    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <table id="dt_default" class="uk-table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="30%">Zone</th>
                    <th width="30%">Name</th>
                    <th width="30%">Price(Rs)</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>

                <tbody>
                @if(count($departments)>0)
                @foreach($departments as $row)
                    <tr>
                        <td>{{ $row['zone']->name }}</td>
                        <td>{{ $row['name'] }}</td>
                        <td>{{ $row['price'] }}</td>
                        <td>
                            <a href="{{ route('department.edit', $row['id']) }}" title="Edit" class="md-btn md-btn-twitter md-btn-mini md-btn-icon"><i class="uk-icon-edit uk-icon-small"></i></a>&nbsp;
                            <a href="javascript:void(0);" title="Delete" data-id="{{$row['id']}}" class="md-btn md-btn-danger md-btn-mini md-btn-icon deleteRecord"><i class="uk-icon-trash uk-icon-small"></i></a>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr><td colspan="3" class="uk-text-center">No record found</td></tr>
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
                        url: "department/"+rowId,
                        type: 'DELETE',
                        data: {
                            "id": rowId,
                            "_token": "{{ csrf_token() }}",
                        },
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