

function loadContent(page) {
    $.ajax({
        url: page + '.php',
        type: 'GET',
        success: function(response) {
            $('#loadContent').html(response);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
} 

