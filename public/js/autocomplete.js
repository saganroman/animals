$(document).ready(function () {

    $("#Input5").change(function () {
        var spID = $("#Input5").val();
        $("#Input3").attr('disabled', false);
        $.ajax({
            type: "GET",
            url: "/getBreedPort/" + spID,
            cache: false,
            success: function (responce) {
                $("#Input3").html(responce);
            }
        });
    });
});
var autocomplete, input;
function initAutocomplete() {

    input = document.getElementById('myIn');
    autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    var place = autocomplete.getPlace();
    document.getElementById('LatLn').value = place.geometry.location;
}

