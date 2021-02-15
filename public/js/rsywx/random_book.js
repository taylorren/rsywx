function refresh_random_book()
{
    var uri = 'https://api.rsywx.com/book/random/1';
    //var uri = 'https://api/book/random/1';
    fetch(uri).then(function (res) {
        return res.json();
    }).then(function (json) {
        var book = json.data[0];

        $('#rbt').html("《" + book.title + "》");
        $('#rbt').attr("href", "/book/" + book.bookid + ".html");
        $('#rba').html(book.author);
        $('#rba').attr("href", "/book/author/" + book.author);
        $('#rbr').html(book.region);
        $('#rba').attr("href", "/book/author/" + book.author);
        $('#rbp').html(book.purchdate);
        $('#rvc').html(book.vc);
        $("#rvd").html(book.lvt);
        var img = "https://api.rsywx.com/book/image/" + book.bookid + "/" + book.author + "/" + book.title + "/600";

        $("#rvi").attr("src", img);
        $("#rvi2").attr("href", img);
    });
}