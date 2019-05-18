@extends('layouts.template')
@section('title', 'Employee List')

@section('content')
    <h4 class="heading_a uk-margin-bottom">Employee List</h4>
    <div class="md-card uk-margin-medium-bottom">
        <div class="md-card-content">
            <div class="dt_colVis_buttons"></div>
            <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="30%">Name</th>
                    <th width="20%">Contact No</th>
                    <th width="35%">Address</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($employees)>0)
                @foreach($employees as $row)
                    <tr>
                        <td>{{ $row['name'] }}</td>
                        <td>{{ $row['contact_no'] }}</td>
                        <td>{{ $row['address'] }}</td>
                        <td>
                            <a href="{{ route('employee.edit', $row['id']) }}" class="md-btn md-btn-twitter md-btn-mini md-btn-icon" title="Edit"><i class="uk-icon-edit uk-icon-small"></i></a>&nbsp;&nbsp;
                            <a href="javascript:void(0);" title="Delete" data-id="{{$row['id']}}" class="md-btn md-btn-danger md-btn-mini md-btn-icon deleteRecord"><i class="uk-icon-trash uk-icon-small"></i></a>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr><td colspan="4" class="uk-text-center">No record found</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
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
                            url: "employee/"+rowId,
                            type: 'DELETE',
                            data: {
                                "id": rowId,
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data){
                                if(data.status == 'success'){
                                    Swal.fire( 'Deleted!',  data.msg, 'success' )
                                }else{
                                    Swal.fire( 'Not Deleted!', data.msg, 'error' )
                                }
                            }
                        });
                    }
                })
            }
        });
    </script>
@endpush