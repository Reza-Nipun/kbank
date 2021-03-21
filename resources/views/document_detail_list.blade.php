@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Document Detail List') }}
                        @if(Auth::user()->status == 1)
                            @if(Auth::user()->access_level == 0)
                                <div class="btn-toolbar float-right">
                                    <a class="btn btn-success mr-1" href="{{ url('/add_document') }}" title="Assign Task">
                                        <i class="fa fa-plus"></i> Document
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Applicability</th>
                                    <th class="text-center">Document Type</th>
                                    <th class="text-center">Reference Code</th>
                                    <th class="text-center">Version</th>
                                    <th class="text-center">Remakrs</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $k => $d)
                                        <tr>
                                            <td class="text-center">{{ $k+1 }}</td>
                                            <td class="text-center">{{ $d->subject }}</td>
                                            <td class="text-center">{{ $d->category_name }}</td>
                                            <td class="text-center">{{ $d->applicability_name }}</td>
                                            <td class="text-center">{{ $d->document_type_name }}</td>
                                            <td class="text-center">{{ $d->reference_code }}</td>
                                            <td class="text-center">{{ $d->version }}</td>
                                            <td class="text-center">{{ $d->remarks }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary" href="{{ url('/view_document/'.$d->id) }}" target="_blank" title="VIEW">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if(Auth::user()->access_level == 0)
                                                <a class="btn btn-sm btn-secondary" target="_blank" href="{{ asset('storage/app/public/uploads/'.$d->document_url) }}" title="DETAIL LIST">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="{{ url('/delete_document_by_id/'.$d->id) }}" title="DELETE" onclick="return confirm('Are you sure to delete the document?');">
                                                    <i class="fa fa-archive"></i>
                                                </a>
                                                @endif
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
