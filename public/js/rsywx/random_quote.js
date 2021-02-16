function refresh_qotd()
{
    var uri = 'https://api.rsywx.com/misc/qotd';
    //var uri = 'http://api/misc/qotd';
    fetch(uri).then(function (res) {
        return res.json();
    }).then(function (json) {
        var quote = json.data;
        
        $('#rqq').html(quote.quote);
        $('#rqq').attr('title', quote.quote);
        $('#rqs').html(quote.source);    
    });
}