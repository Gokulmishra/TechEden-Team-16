function initMap() {
    const bounds = new google.maps.LatLngBounds();
    const markersArray = [];
    const origin1 = { lat: 13.649685291800745, lng: 79.4135645924638 };
    const origin2 = { lat: 13.647299136588511, lng: 79.42640943416572 };

    service.getDistanceMatrix({
            origins: [origin1],
            destinations: [origin2],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false,
        },
        (response, status) => {
            if (status !== "OK") {
                alert("Error was: " + status);
            } else {
                console.log(response.text);
            }
        }
    );
}