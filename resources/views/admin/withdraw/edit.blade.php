@extends('admin.layouts.app')

@section('title')
Update Withdraw
@endsection

@section('content')
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Update Withdraw</h3>

                        @can('view withdraw')
                        <a href="{{ route('admin.withdraw.index') }}" class="btn btn-success float-right"><i class="fa fa-angle-left"> Back</i></a>
                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <form id="quickForm" method="POST" action="{{route('admin.withdraw.update',$data->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="card-body row">
                            <div class="form-group col-lg-6">
                                <label>User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                    @foreach($user as $item)
                                    <option value="{{$item->id}}" {{$data->user_id==$item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group col-lg-6">
                                <label>Select Account<span class="text-danger">*</span></label>
                                <select name="account_name" id="account_name" class="form-control @error('account_name') is-invalid @enderror">
                                    <option value="1" {{$data->account_name==1 ? 'selected' : ''}}>Bank</option>
                                    <option value="2" {{$data->account_name==2 ? 'selected' : ''}}>Bkash</option>
                                    <option value="3" {{$data->account_name==3 ? 'selected' : ''}}>Nagad</option>
                                    <option value="4" {{$data->account_name==4 ? 'selected' : ''}}>PayPal</option>
                                    <option value="5" {{$data->account_name==5 ? 'selected' : ''}}>Rocket</option>
                                    <option value="6" {{$data->account_name==6 ? 'selected' : ''}}>Upay</option>
                                    <option value="7" {{$data->account_name==7 ? 'selected' : ''}}>SureCash</option>
                                </select>
                                @error('account_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Withdraw Date</label>
                                <input value="{{$data->withdraw_date}}" type="date" name="withdraw_date" id="withdraw_date" class="form-control @error('withdraw_date') is-invalid @enderror">
                            </div>

                            <div class="form-group col-lg-6">
                                <label> Amount</label>
                                <input value="{{$data->amount}}" type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror">
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{$data->status==1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$data->status==0 ? 'selected' : ''}}>Deactive</option>
                                </select>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Update</button>
                        </div>
                    </form>

                    <!-- /.card-body -->
                </div>


            </div>
        </div>

    </div>
</section>


@endsection