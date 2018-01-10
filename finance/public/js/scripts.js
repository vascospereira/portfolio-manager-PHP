/**
 * scripts.js
 *
 * Global JavaScript, if any.
 */

function quote() {
    var url = 'quote.php?symbol=' + $('#symbol').val()
    $.getJSON(url, function(share) {
        $('#price').html('A share of ' + share.name + ' (' + share.symbol + ')' + ' costs <strong>$' + share.price + '</strong>');
        $('#symbol').val(''); //clear the form
    });
}

