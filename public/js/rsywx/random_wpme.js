function refresh_wpme()
{
    var uri = 'https://api.rsywx.com/misc/wpme';
    //var uri = 'http://api/misc/qotd';
    
    fetch(uri).then(function (res) {
       
        return res.json();
    }).then(function (json) {
        var wpme = json.data;
        $('#rwd').html(wpme.word);
        $('#rwd').attr('title', wpme.desc);
        $('#rwr').html(wpme.root);
        $('#rww').attr('href', "/wpme/"+wpme.word);
    });
}