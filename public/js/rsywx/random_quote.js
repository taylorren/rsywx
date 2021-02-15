function refresh_qotd()
{
    var uri = 'https://api.rsywx.com/misc/qotd';
    //var uri = 'http://api/misc/qotd';
    fetch(uri).then(function (res) {
        return res.json();
    }).then(function (json) {
        var quote = json.data;
        console.log(quote);
        $('#rqq').html(quote.quote);
        $('#rqs').html(quote.source);    
    });
}