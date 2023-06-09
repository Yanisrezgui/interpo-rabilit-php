const text = document.getElementById("search-text");
let map = undefined;
let clientMarker = undefined;

const userIcon = L.icon({
    iconUrl: './images/user.png',
    iconSize: [25, 25], // size of the icon
    iconAnchor: [0, 0], // point of the icon which will correspond to marker's location
})

const bikeIcon = new L.Icon({
    iconUrl: "./images/bike.png",
    iconSize: [25, 25],
    iconAnchor: [5, 15],
    popupAnchor: [1, -34],
    shadowSize: [41, 41],
})

async function addressLocation(text) {
    let data = await fetch("https://api-adresse.data.gouv.fr/search/?q=" + text)
        .then((response) => response.json())
        .then((data) => {
            return data
        })
        .catch((error) => {
            console.error('Error:', error);
        })

    return data;
}

const changeView = () => {
    let coordinates = JSON.parse(localStorage.getItem("coordinates"));
    clientMarker.setLatLng([coordinates.lat, coordinates.lon]).update();
    map.setView([coordinates.lat, coordinates.lon]).update();
}

async function apiBike() {
    let data = await fetch("./bikes.json")
        .then((response) => response.json())
        .catch((error) => {
            console.error('Error:', error);
        })

    return data;
}

async function apiAirQuality() {
    let data = await fetch("./airQuality.json")
        .then((response) => response.json())
        .catch((error) => {
            console.error('Error:', error);
        })

    return data;
}

const showBikes = async () => {
    let data = await apiBike();
    data.forEach(element => {
        let bikeMarker = L.marker([element.lat, element.lon], { icon: bikeIcon }).addTo(map);
        bikeMarker.bindPopup(
            "<p>Adresse:"
            + element.address
            + "</p><p>Capacité max:"
            + element.capacity
            + "</p><p>vélos disponible:"
            + element.bikes
            + "</p><p>docks disponible:"
            + element.stands
            + "</p><p>statut:"
            + element.status
        )
    });
}

const showAirQuality = async () => {
    let data = await apiAirQuality();
    data.forEach(element => {
        document.getElementById("air-quality").innerHTML += `Qualité de l'air : ` + element.lib_qual;
    })
}

document.getElementById("search-button").addEventListener("click", async () => {
    const address = await addressLocation(text.value);
    const coordinatesAPI = {
        "lat": address.features[0].geometry.coordinates[1],
        "lon": address.features[0].geometry.coordinates[0]
    }

    localStorage.setItem('coordinates', JSON.stringify(coordinatesAPI));
    changeView();
})

addEventListener("DOMContentLoaded", () => {
    let coordinates = JSON.parse(localStorage.getItem("coordinates"));
    map = L.map('map').setView([coordinates.lat, coordinates.lon], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    clientMarker = L.marker([coordinates.lat, coordinates.lon], { icon: userIcon }).addTo(map);

    showBikes();
    showAirQuality();
})
