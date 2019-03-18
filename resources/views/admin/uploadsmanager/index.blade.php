@extends('admin.layouts.master')

@section('content')

    <div class="dropzone" id="dropzoneFileUpload">
        <div class="dz-message" data-dz-message>
            <span>Click or Drop files here to upload</span>
        </div>
    </div>



    <div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12">
                <h2>Uploaded files:</h2>
            </div>
        </div>
        <div class="row uploaded">
            @if(isset($files) && count($files) > 0 )
                @foreach($files as $file)

                    @include('admin.uploadsmanager.parts.file',['file' => $file])

                @endforeach
            @endif
        </div>
    </div>
    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Press <strong>ctrl+C</strong> to copy url</h4>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="text" id="selectedUrl" value="Test"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('javascript')
    <link rel="stylesheet" href="{{ asset('css/dropzone/dropzone.min.css') }}"/>
    <style>
        .thumb{
            margin-top: 20px;
        }
        .uploaded{
            margin-bottom: 100px;
        }
    </style>
    <script src="{{ asset('js/dropzone/dropzone.min.js') }}"></script>
    <script>
        var baseUrl = "{{ url('/') }}";
    </script>
    <script type="text/javascript" src="{{ URL::asset('js/dropzone/dropimage.js') }}"></script>
@endsection