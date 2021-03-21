@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Document List') }}
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

                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="subject" class="form-label font-weight-bold">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="category" class="form-label font-weight-bold">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="applicability" class="form-label font-weight-bold">Applicability</label>
                                    <select class="form-control" id="applicability" name="applicability">
                                        <option value="">Select Applicability</option>
                                        @foreach($applicabilities as $a)
                                            <option value="{{ $a->id }}">{{ $a->applicability_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="document_type" class="form-label font-weight-bold">Document Type</label>
                                    <select class="form-control" id="document_type" name="document_type">
                                        <option value="">Select Document Type</option>
                                        @foreach($document_types as $dt)
                                            <option value="{{ $dt->id }}">{{ $dt->document_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="reference_code" class="form-label font-weight-bold">Reference Code</label>
                                    <select class="form-control" id="reference_code" name="reference_code">
                                        <option value="">Select Reference Code</option>
                                        @foreach($reference_nos as $reference_no)
                                            <option value="{{ $reference_no->reference_code }}">{{ $reference_no->reference_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mb-3">
                                    <span class="btn btn-success mt-4" id="search_btn" onclick="getFilteredDocuments()">SEARCH</span>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mt-3">
                                    <div class="loader" style="display: none;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
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
                                <tbody id="tbody_id">
                                    @foreach($documents as $k => $d)
                                        <tr>
                                            <td class="text-center">{{ $k+1 }}</td>
                                            <td class="text-center">{{ $d->subject }}</td>
                                            <td class="text-center">{{ $d->category_name }}</td>
                                            <td class="text-center">{{ $d->applicability_name }}</td>
                                            <td class="text-center">{{ $d->document_type_name }}</td>
                                            <td class="text-center">{{ $d->reference_code }}</td>
                                            <td class="text-center">{{ $d->max_version }}</td>
                                            <td class="text-center">{{ $d->remarks }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary" href="{{ url('/view_document/'.$d->max_id) }}" target="_blank" title="VIEW">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                @if(Auth::user()->access_level == 0)
                                                    <a class="btn btn-sm btn-secondary" target="_blank" href="{{ asset('storage/app/public/uploads/'.$d->document_url) }}" title="DETAIL LIST">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                @endif

                                                <a class="btn btn-sm btn-warning" href="{{ url('/document_detail_list/'.$d->reference_code.'/'.$d->category_id) }}" title="DETAIL LIST">
                                                    <i class="fa fa-list"></i>
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

    <script type="text/javascript">
        $('select').select2();
        
        function getFilteredDocuments() {
            var subject = $("#subject").val();
            var category = $("#category").val();
            var applicability = $("#applicability").val();
            var document_type = $("#document_type").val();
            var reference_code = $("#reference_code").val();

            $("#tbody_id").empty();

            $(".loader").css('display', 'block');

            $.ajax({
                url: "{{ route("get_filtered_documents") }}",
                type:'POST',
                data: {_token:"{{csrf_token()}}", subject: subject, category: category, applicability: applicability, document_type: document_type, reference_code: reference_code},
                dataType: "html",
                success: function (data) {

                    $("#tbody_id").append(data);
                    $(".loader").css("display", "none");

                }
            });

        }
    </script>
@endsection
