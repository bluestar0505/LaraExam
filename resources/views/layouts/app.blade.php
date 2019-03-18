<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ _t('site-title') }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Work+Sans:300,700" rel="stylesheet">
    <link href="{{ asset('css/jquery.sliderTabs.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">

    
    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> <!-- font-family: 'Roboto', sans-serif;-->

  <style>
.tab-content .list-group-item h4.panel-title > a.collapsed:before {
    content: "+";
    background: #438abb;
    display: inline-block;
    color: white;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    text-align: center;
    line-height: 14px;
    font-size: 14px;
    font-weight: bold;
    border: 2px solid #e0f2ff;
    position: relative;
    top: 1px;
}
</style>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
   

</head>
<!-- oncontextmenu="return false" -->
<body class="{{isset($bodyClass) ? $bodyClass : ''}}" oncontextmenu="return false;">

    

@include('web.parts.loginNav')
<div id="wrapper">
    @yield('content')

    {{--<div class="content">--}}
    {{--</div>--}}
    @include('layouts.footer')
</div>



<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/jquery.sliderTabs.min.js') }}"></script>

<script type="text/javascript">



    // $(document).keydown(function (event) {
    // if (event.keyCode == 123) {
    //     return false;
    // }
    // else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
    //     return false;  //Prevent from ctrl+shift+i
    // }
    // });


    @if(Auth::check())
    $.ajax({
        type: "get",
        url: "/getnotifications",
        success: function (data) {
            $('#notificationsBody .list-group').html('');
            data.forEach(function (arrayItem) {
                var x = arrayItem.notify_text;
                var y = arrayItem.DateCreated;

                $('#notificationsBody .list-group').append('<li class="list-group-item" style="color: black">' + x + '  <span class="label label-primary"> ' + y + '</span></li> ');
            });
            //
        }
    });
    $.ajax({
        type: "get",
        url: "/unseennotifications",
        success: function (data) {
            if (data != 0) {
                $('#total_notifications').text(data);
            }
            //
        }
    });
    $('#notificationLink').click(function () {
        $.ajax({
            type: "get",
            url: "/Updateunseennotifications",
            success: function (data) {
                $('#total_notifications').remove();
            }
        });
    });
    setInterval(function () {
        $.ajax({
            type: "get",
            url: "/CheckUserStatus",
            success: function (data) {
                if (data !== 'true') {
                    window.location.reload();
                }
            },
            error: function (data) {
                window.location.reload();
            }
        });
    }, 10000);//time in millisecond
    @endif

    function updateDefault(opt, url_val) {
        $.ajax({
            type: "get",
            url: "/DefaultTab",
            data: {'default_tab': opt},
            success: function (data) {
                window.location.href = "https://" + window.location.hostname + "/" + url_val;
            }
        });
    }

    function underprogress() {
        swal("We are under Progress!")
    }

    function suggestion() {

        swal({
            title: 'Please leave your suggestion below',
            input: 'textarea',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,


            preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (email === '') {
                            reject('Please do not leave empty')
                        } else {
                            resolve()
                        }
                    }, 2000)
                })
            },

            allowOutsideClick: false
        }).then(function (email) {


            $.ajax({
                type: "get",
                url: "/suggestion",
                data: {'suggestion': email},
                success: function (data) {

                    swal({
                        type: 'success',
                        title: 'Thank you for your suggestion!'
                    })
                }
            });


        })

    }

function reportPaperError() {

        swal({
            showCancelButton: true,
            confirmButtonText: 'Send error!',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Submit',
            reverseButtons: true,
            title: 'Issue with the paper? <br>Tell us where!',
            html:
            '<div style="text-align: left;">' +
                '<div class="form-group">' +
                    '<label for="sel1">Question number:</label>' +
                    '<select class="form-control" name="" id="questionNumber">' +
                    '<option value="1">1</option>' +
                    '<option value="2">2</option>' +
                    '<option value="3">3</option>' +
                    '<option value="4">4</option>' +
                    '<option value="5">5</option>' +
                    '<option value="6">6</option>' +
                    '<option value="7">7</option>' +
                    '<option value="8">8</option>' +
                    '<option value="9">9</option>' +
                    '<option value="10">10</option>' +
                    '<option value="11">11</option>' +
                    '<option value="12">12</option>' +
                    '</select>' +
                '</div>' +
    
                '<div class="form-group">' +
                    '<label for="sel1">Sub-heading 1:</label>' +
                    '<select class="form-control" name="" id="questionLeter">' +
                    '<option value="">Please choose (if any)</option>' +
                    '<option value="a">a</option>' +
                    '<option value="b">b</option>' +
                    '<option value="c">c</option>' +
                    '<option value="d">d</option>' +
                    '<option value="e">e</option>' +
                    '<option value="f">f</option>' +
                    '<option value="g">g</option>' +
                    '<option value="h">h</option>' +
                    '<option value="i">i</option>' +
                    '<option value="j">j</option>' +
                    '<option value="k">k</option>' +
                    '</select>' +
                '</div>' +
                '<div class="form-group">' +
                    '<label for="sel1">Sub-heading 2:</label>' +
                    '<select class="form-control" name="" id="questionVersion">' +
                    '<option value="">Please choose (if any)</option>' +
                    '<option value="i">i</option>' +
                    '<option value="ii">ii</option>' +
                    '<option value="iii">iii</option>' +
                    '<option value="iv">iv</option>' +
                    '<option value="v">v</option>' +
                    '<option value="vi">vi</option>' +
                    '<option value="vii">vii</option>' +
                    '<option value="viii">viii</option>' +
                    '<option value="ix">ix</option>' +
                    '<option value="x">x</option>' +
                    '<option value="xi">xi</option>' +
                    '<option value="xii">xii</option>' +
                    '<option value="xiii">xiii</option>' +
                    '<option value="xiv">xiv</option>' +
                    '<option value="xv">xv</option>' +
                    '</select>' +
                '</div>'+
                '<div class="form-group">' +
                    '<label for="sel1">Error :</label>' +
                    '<select class="form-control" name="" id="questionError">' +
                    '<option value="typo">Typo</option>' +
                    '<option value="incorrect information taken from the question">Incorrect information taken from the question</option>' +
                    '<option value="miscalculation">Miscalculation</option>' +
                    '<option value="lack of detail">Lack of detail</option>' +
                    '<option value="misinformation">Misinformation</option>' +
                    '<option value="other">Other</option>' +
                    '</select>' +
                '</div>' + 
            '</div>',
            focusConfirm: false,
            allowOutsideClick: false
        }).then(function (email) {
            $.ajax({
                type: "get",
                url: "/suggestion/papererror",
                data: {
                    'suggestion': 'Q' + $('#questionNumber').val() +
                    ( $('#questionLeter').val().length > 0 ? ' (' + $('#questionLeter').val()+ ') ' : '' )  +
                    ( $('#questionVersion').val().length > 0 ? ' (' + $('#questionVersion').val()+ ') ' : '' )  +
                    ' from ' + $('#questionName').val() +
                    '. There is a ' +  $('#questionError').val()
                },
                success: function (data) {
                    console.log(data);
                    swal({
                        type: 'success',
                        title: 'Thank you for your feedback!'
                    })
                }
            });
        })

    }

</script>


<script type="text/javascript">
    $(document).ready(function () {
        $("#notificationLink").click(function () {
            $("#notificationContainer").fadeToggle(300);
            $("#notification_count").fadeOut("slow");
            return false;
        });

        $("body").click(function(e) {
            $("#notificationContainer").fadeOut(300);
        });
    });
</script>
<style>

    #nav {
        list-style: none;
        margin: 0px;
        padding: 0px;
    }

    #nav li {
        float: left;
        margin-right: 20px;
        font-size: 14px;
        font-weight: bold;
    }

    #nav li a {
        color: #333333;
        text-decoration: none
    }

    #nav li a:hover {
        color: #006699;
        text-decoration: none
    }

    #notification_li {
        position: relative
    }

    #notificationContainer {
        background-color: #fff;
        border: 1px solid rgba(100, 100, 100, .4);
        -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
        overflow: visible;
        position: absolute;
        top: 60px;
        margin-left: 71px;

        width: 400px;

        display: none;
        right: 0;
        z-index: 99;
    }

    #notificationContainer:before {
        content: '';
        display: block;
        position: absolute;
        width: 0;
        height: 0;
        color: transparent;
        border: 10px solid black;
        border-color: transparent transparent white;
        margin-top: -20px;
        margin-left: 378px;
    }

    #notificationTitle {
        z-index: 1000;
        font-weight: bold;
        padding: 8px;
        font-size: 13px;
        background-color: #ffffff;
        width: 384px;
        border-bottom: 1px solid #dddddd;
    }

    #notificationsBody {
        padding: 0 !important;
        min-height: 300px;
        max-height: 434px;
        overflow: scroll;
    }

    #notificationFooter {
        background-color: #e9eaed;
        text-align: center;
        font-weight: bold;
        padding: 8px;
        font-size: 12px;
        border-top: 1px solid #dddddd;
    }

    #notification_count {
        padding: 3px 7px 3px 7px;
        background: #cc0000;
        color: #ffffff;
        font-weight: bold;
        margin-left: 77px;
        border-radius: 9px;
        position: absolute;
        margin-top: -11px;
        font-size: 11px;
    }
</style>


@yield('javascript')

@include('layouts.google')

@stack('scripts')
</body>
</html>
