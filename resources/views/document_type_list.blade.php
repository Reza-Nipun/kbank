@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Document Type List') }}

                        <div class="btn-toolbar float-right">
                            <a class="btn btn-success mr-1" href="{{ url('/add_document_type') }}" title="Add Document Type">
                                <i class="fa fa-plus"></i> Document Type
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($document_type_list as $k => $d)
                                    <tr>
                                        <td>{{ $k+1 }}</td>
                                        <td>{{ $d->document_type_name }}</td>
                                        <td>{{ $d->document_type_description }}</td>
                                        <td>{{ ($d->status == 0 ? 'INACTIVE' : 'ACTIVE') }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{!! route('edit_document_type', $d->id) !!}" title="Edit">
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
