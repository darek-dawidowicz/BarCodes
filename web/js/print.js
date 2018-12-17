$(function () {
    $('body').on('click', 'button.printPDF', function () {
        var cid = $(this).data('cid');
        var win = window.open('/printPDF/' + cid, '_blank');

        if (win) { //Browser has allowed it to be opened
            win.focus();
        } else { //Browser has blocked it
            alert('Please allow popups for this website');
        }
    });

    $('body').on('click', 'button.printImage', function () {
        var cid = $(this).data('cid');
        var win = window.open('/printImage/' + cid, '_blank');

        if (win) { //Browser has allowed it to be opened
            win.focus();
        } else { //Browser has blocked it
            alert('Please allow popups for this website');
        }
    });
});