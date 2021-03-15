@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('New Account Requests') }}</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">NAME</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center">ACCESS LEVEL</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($new_requests as $k => $n)
                                        <tr>
                                            <td class="text-center">{{ $k+1 }}</td>
                                            <td class="text-center">{{ $n->name }}</td>
                                            <td class="text-center">{{ $n->email }}</td>
                                            <td class="text-center">{{ ($n->access_level == 0 ? 'Admin' : 'User') }}</td>
                                            <td class="text-center">{{ ($n->status == 2 ? 'Pending' : ($n->status == 1 ? 'Active' : 'Inactive')) }}</td>
                                            <td class="text-center">
                                                <a href="{{ url('/edit_user/'.$n->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection