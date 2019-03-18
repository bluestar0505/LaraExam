var removeThis = function(_this){

    // .thumb
    var url = $(_this).parent('.thumb').find('a.thumbnail > img.img-responsive').attr('src');


    console.log('delete',url);

    if(typeof url != 'undefined') {

        var check = confirm('Are you sure you wanna delete item?');

        if(check) {
            $.ajax({
                url: baseUrl + "/admin/dropzone/delete",
                type: "POST",
                data: {url: url},
                success: function (result) {

                    if (result.ok)  $(_this).parent('.thumb').remove();
                    if (result.not) alert('File not found!');

                },
                error: function () {
                    alert('Failed to delete');
                }
            });
        }

    }


}

var copyUrl = function(_this){

    var url = $(_this).parent('.thumb').find('a.thumbnail > img.img-responsive').attr('src');
    showModal(url);
}


var showModal = function(url){
    $('#myModal').modal('show');
    var input = $("#selectedUrl");

    input.val(url)
    setTimeout(function(){
        input.focus().select();
    },200);

}


$(function(){

    var csrfToken = $('meta[name="_token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': csrfToken
        }
    });

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#dropzoneFileUpload", {
        url: baseUrl+"/admin/dropzone/upload",
        params: {
            _token: csrfToken
        },
        init: function() {
            this.on("success", function(file, response) {
                console.log('success',response);

                if(response && response.uploads){

                    for(var i in response.uploads){

                        console.log('found', i);
                        $(".uploaded").append(response.uploads[i]);


                    }



                }

                //var input = "<input type='hidden' name='images[]' value='"+response.id+"' />";
                //$(".images-input").append(input);






            });
            this.on("complete", function(file,response){
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var _this = this;
                    // Remove all files
                    _this.removeAllFiles();
                }
            });
            this.on("reject", function(file,response){
                console.log('reject',response);
            });
        }
    });
    Dropzone.options.dropzoneFileUpload = {
        paramName: 'file', // The name that will be used to transfer the file
        maxFilesize: 5, // MB
        addRemoveLinks: true,
    };




});