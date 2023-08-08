$('[data-js=searchParam]').on('input', function () {
    $('#articlesSearchBlock').remove()
    $('.fl-as-products-container').css('overflow-y', 'hidden')

    let searchParam = $('[data-js=searchParam]').val();
    let searchFields = [
        "title",
        "description",
        "link"
    ]
    let headers = {
        "Content-Type": "application/json"
    }

    if ($('#customSearchAuth').val().length > 0) {
        headers['Authorization'] = $('#customSearchAuth').val()
    }

    if ($('[data-js=searchParam]').val().length > 2) {
        let settings = {
            "url": $('#customSearchURL').val() + '/_search',
            "method": "POST",
            "timeout": 0,
            "headers": headers,
            crossDomain: true,
            dataType: "json",
            "data": JSON.stringify({
                "query": {
                    "query_string": {
                        "query": "*" + searchParam + "*",
                        "fields": searchFields
                    }
                }
            }),
        };

        $.ajax(settings).done(function (data) {
            if (data.hits && data.hits.hits.length > 0) {
                $('.fl-as-products-container').css('overflow-y', 'scroll').css('height', '40rem').css('flex-direction', 'column')
                $('#articlesSearchBlock').remove()

                let articlesSearchBlock = '<div id="articlesSearchBlock"></div>'
                $('.fl-as-below-product').after(articlesSearchBlock);
                $('#articlesSearchBlock').append(
                    '<h3 class="fl-as-result-info-text">' +
                    $('#customSearchNavTitle').val() +
                    ' <strong>\' ' + searchParam + ' \'</strong> ' +
                    '( <strong> ' +data.hits.hits.length + ' </strong>' +
                    $('#customSearchNavSubTitle').val() +
                    ' )' +
                    '</h3>'
                );

                for (let i = 0; i < data.hits.hits.length; i++) {
                    let item = data.hits.hits[i]._source
                    let content =
                        '<div class="pr-productTiles pr-productTiles__wrap" style="display: inline-flex; width: 30%; height: 30rem;">\n' +
                        '<div class="pr-productTiles__top">\n' +
                        '<div class="pr-productTiles__imgBlock">\n' +
                        '<span style="font-size: 12px; position: absolute; left: 0;">' + new Date(item.pubDate).toDateString() + '</span>' +
                        '<img class="pr-productTiles__imgBlock-img" style="padding-top: .5rem;" src="' + item.enclosure['@attributes'].url + '" draggable="false"> \n' +
                        '</div>\n' +
                        '<strong class="title">\n' +
                        item.title + '\n' +
                        '</strong> \n' +
                        '<p style="max-height: 8rem; text-overflow: clip; overflow: hidden; word-wrap: break-word;">' +
                        item.description +
                        '</p>' +
                        '<a href="' + item.link + '" class="fl-item-url" style="position: absolute; bottom: 1rem; right: 1rem;">' +
                        $('#customSearchLinkTitle').val() +
                        '</a>' +
                        '</div>\n' +
                        '</div>'
                    $('#articlesSearchBlock').append(content);
                }
            }
        });
    }
});
