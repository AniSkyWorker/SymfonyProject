addGuitar = function(guitarId) {
    $.ajax({
            type: "POST",
            url: "/" + guitarId + "/add",
            success: function(response) {
                window.location = response;
            }
    });
}

deleteGuitar = function(guitarId) {
    $.ajax({
            type: "POST",
            url: "/" + guitarId + "/delete",
            success: function(response) {
                window.location = response;
            }
    });
}