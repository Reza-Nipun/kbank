@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Departments') }}

                        <div class="btn-toolbar float-right">
                            <a class="btn btn-success mr-1" href="{{ url('/departments/create') }}" title="Create Department">
                                <i class="fa fa-plus"></i> Department
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DEPARTMENT NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $k => $d)
                                        <tr>
                                            <td>{{ $k+1 }}</td>
                                            <td>{{ $d->department_name }}</td>
                                            <td>{{ $d->department_description }}</td>
                                            <td>{{ ($d->status == 0 ? 'INACTIVE' : 'ACTIVE') }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" href="{!! route('departments.edit', $d->id) !!}" title="Edit">
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
@endsection
