@extends('admin.layouts.app')

@section('title')
Create Account
@endsection


@section('content')



<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">Create Account</h3>
                        @can('view account')

                        <a href="{{ route('admin.deposit.index') }}" class="btn btn-success float-right"><i class="fa fa-angle-left"> Back</i></a>

                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <form id="quickForm" method="POST" action="{{route('admin.deposit.update',$data->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="card-body row">
                            <div class="form-group col-lg-6">
                                <label>User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                    @foreach($user as $item)
                                    <option value="{{$item->id}}" {{$data->user_id ==$item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-lg-6">
                                <label> Deposite Date </label>
                                <input value="{{$data->deposit_date}}" type="date" name="deposit_date" class="form-control @error('deposit_date') is-invalid @enderror">
                            </div>

                            <div class="form-group col-lg-12">
                                <label> Amount</label>
                                <input value="{{$data->amount}}" type="number" name="amount" class="form-control @error('amount') is-invalid @enderror">
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{$data->status ==1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$data->status ==0 ? 'selected' : ''}}>Deactive</option>
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