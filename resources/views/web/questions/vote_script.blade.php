<script>
    $('.qa-item__vote').on('click', function (e) {
        linkEl = $(this);
        $.get($(this).attr('href'), {status: $(this).data('value')}, function (response) {
            linkEl.parent().parent().find('.points__value').text(response.votes);
        });
        e.preventDefault();
        return false;
    });
</script>