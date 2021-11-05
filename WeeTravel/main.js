var filter = document.getElementById('filter');
var contentList = document.getElementById('content-list');

filter.addEventListener('keyup', filterContent);

function filterContent(e) {
    var text = e.target.value.toLowerCase();
    var titles = contentList.getElementsByTagName('h2');

    Array.from(titles).forEach(function(title) {
        var contetnTitle = title.textContent;
        if (contetnTitle.toLowerCase().indexOf(text) != -1) {
            title.parentElement.style.display = 'block';
        } else {
            title.parentElement.style.display = 'none';
        }
    });
}