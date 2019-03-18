@if(isset($file))
    <div class="col-xs-6 col-sm-4 col-md-3 thumb">
        <a class="thumbnail" href="#">
            <img class="img-responsive" src="{{ \App\UploadsManager::imageUrl($file) }}" alt="" />
        </a>
        <div class="btn btn-info btn-lg" onclick="copyUrl(this)" >Copy url</div>
        <div class="btn btn-danger btn-lg" onclick="removeThis(this)" >Delete</div>
    </div>
@endif