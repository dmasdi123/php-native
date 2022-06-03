// using jquery
$(document).ready(function() {
    $('#keyword').on('keyup', function() {
        $('#contain-table-ajax').load('ajax/comics.php?keyword='+$('#keyword').val());
    });
});

// const keyword = document.getElementById('keyword');
// const searchButton = document.getElementById('search-button');

// const container = document.getElementById('contain-table-ajax');

// keyword.addEventListener('keyup', function() {

//     const xhr = new XMLHttpRequest();

//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             // container.innerHTML = xhr.responseText;
//             container.innerHTML = xhr.responseText;
//         }
//     }

//     xhr.open('GET', 'ajax/comics.php?keyword=' + keyword.value, true);
//     xhr.send();
// });



