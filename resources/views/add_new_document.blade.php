@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create Document') }}

                        <div class="btn-toolbar float-right">
                            <a class="btn btn-primary mr-1" href="{{ url('documents') }}" title="Document List">
                                <i class="fa fa-list"></i> Document List
                            </a>
                        </div>
                    </div>

                    <form action="{{ url('/save_document') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                        @endif

                        @if(Session::has('failed_msg'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('failed_msg') }}</p>
                        @endif

                        @if(count($errors))
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category <span style="color: red">*</span></label>
                                        <select class="form-control" name="category" id="category" required="required">
                                            <option value="">Select Category</option>
                                            @foreach($categories AS $c)
                                                <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="applicability" class="form-label">Applicability <span style="color: red">*</span></label>
                                        <select class="form-control" name="applicability" id="applicability" required="required" onchange="getApplicabilityShortName();">
                                            <option value="">Select Applicability</option>
                                            @foreach($applicabilities AS $a)
                                                <option value="{{ $a->id }}">{{ $a->applicability_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="applicability_short_name" name="applicability_short_name" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="document_type" class="form-label">Document Type <span style="color: red">*</span></label>
                                        <select class="form-control" name="document_type" id="document_type" required="required" onchange="getDocumentTypeShortName();">
                                            <option value="">Select Document Type</option>
                                            @foreach($document_types AS $d)
                                                <option value="{{ $d->id }}">{{ $d->document_type_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="document_type_short_name" name="document_type_short_name" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Select PDF File <span style="color: red">*</span></label>
                                        <input type="file" class="form-control" name="file" id="file" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="departments" class="form-label">Department <span style="color: red">*</span></label>
                                        <select class="form-control" multiple="multiple" name="departments[]" id="departments" required="required" data-placeholder="Departments...">
                                            @foreach($departments AS $dp)
                                                <option value="{{ $dp->id }}">{{ $dp->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarks </label>
                                        <input type="text" class="form-control" name="remarks" id="remarks" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('select').select2();

        function getApplicabilityShortName() {
            var applicability = $( "#applicability option:selected" ).text();

            var applicability_code = applicability.substring(0,3);      // Taking 3 Characters from applicability Name
            $("#applicability_short_name").val(applicability_code.toUpperCase());       // Converting to Uppercase
        }

        function getDocumentTypeShortName() {
            var document_type = $( "#document_type option:selected" ).text();

            var document_type_code = document_type.substring(0,3);      // Taking 3 Characters from applicability Name
            $("#document_type_short_name").val(document_type_code.toUpperCase());       // Converting to Uppercase
        }

    </script>

@endsection
