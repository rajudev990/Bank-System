@extends('admin.layouts.app')

@section('title')
Withdraw List
@endsection

@section('content')
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">

                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Withdraw List</h3>
                        @can('create withdraw')
                        <a href="{{ route('admin.withdraw.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Add </a>
                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>User</th>
                                    <th>Account Name</th>
                                    <th>Withdraw Date</th>
                                    <th>Amount</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                @can('view withdraw')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user?->name }}</td>
                                    <td>
                                        @if($item->account_name == 1)
                                        Bank
                                        @elseif($item->account_name == 2)
                                        Bkash
                                        @elseif($item->account_name == 3)
                                        Nagad
                                        @elseif($item->account_name == 4)
                                        PayPal
                                        @elseif($item->account_name == 5)
                                        Rocket
                                        @elseif($item->account_name == 6)
                                        Upay
                                        @elseif($item->account_name == 7)
                                        SureCash
                                        @else
                                        Unknown
                                        @endif
                                    </td>
                                    <td>{{ $item->withdraw_date }}</td>
                                    <td>{{ $item->amount }}</td>

                                    <td class="text-center">
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="status-toggle"
                                                data-id="{{ $item->id }}"
                                                {{ $item->status == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    
                                    <td class="text-center">
                                        @can('edit withdraw')
                                        <a href="{{ route('admin.withdraw.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete withdraw')
                                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.withdraw.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @csrf @method('DELETE')
                                        </form>
                                        <a href="#" class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                                @endcan
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function() {

        // Event delegation দিয়ে status toggle handle করা
        $(document).on('change', '.status-toggle', function() {
            let checkbox = $(this);
            let id = checkbox.data('id');
            let status = checkbox.is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.withdraw.status.update') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    status: status
                },
                success: function(res) {
                    Swal.fire({
                        icon: res.status == 1 ? 'success' : 'warning',
                        title: res.status == 1 ? 'Status has been activated.' : 'Status has been deactivated.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'There was a problem updating the status.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    checkbox.prop('checked', !status); // rollback
                }
            });
        });
        
    });
</script>
@endsection