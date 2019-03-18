@include('admin.partials.header')
@include('admin.partials.topbar')
<div class="clearfix"></div>
<div class="page-container">

    @include('admin.partials.sidebar')

    <div class="page-content-wrapper">
        <div class="page-content">


            <div class="row">
                <div class="col-md-12">

                    @if (Session::has('message'))
                        <div class="note note-info">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>

        </div>
    </div>
</div>

<div class="scroll-to-top"
     style="display: none;">
    <i class="fa fa-arrow-up"></i>
</div>
@include('admin.partials.javascripts')

@yield('javascript')
@include('admin.partials.footer')


<script>

    $(document).ready(function () {

        $('#toto').multiselect({
            maxHeight: 400
        });

        $('#addNotify').click(function () {


            $.ajax({
                type: "get",
                url: "/addnotify",
                data: $('#createNotification').serialize(),
                success: function (data) {
                    window.location.href = "https://" + window.location.hostname + "/admin/notify";

                }
            });


        });


    });

    function deletesuggestion(s_val) {
        if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {

            $.ajax({
                type: "get",
                url: "/deletesuggestion",
                data: {'id': s_val},
                success: function (data) {

                    window.location.reload();

                }
            });
        }

    }

    function deletenotification(s_val) {
        if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {

            $.ajax({
                type: "get",
                url: "/deletenotification",
                data: {'id': s_val},
                success: function (data) {

                    window.location.reload();

                }
            });
        }

    }

</script>



