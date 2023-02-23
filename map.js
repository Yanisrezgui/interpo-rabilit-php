const text = document.getElementById("search-text");

let coordinates = JSON.parse(localStorage.getItem("coordinates"));
const map = L.map('map').setView([coordinates.lat, coordinates.lon], 15);

const userIcon = L.icon({
    iconUrl: './images/user.png',
    iconSize:     [25, 25], // size of the icon
    iconAnchor:   [0, 0], // point of the icon which will correspond to marker's location
});

L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 19
}).addTo(map);

const clientMarker = L.marker([coordinates.lat, coordinates.lon], {icon: userIcon}).addTo(map);

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

document.getElementById("search-button").addEventListener("click", async () => {
    const address = await addressLocation(text.value);
    const coordinatesAPI = {"lat": address.features[0].geometry.coordinates[1], 
                            "lon": address.features[0].geometry.coordinates[0]}

    localStorage.setItem('coordinates', JSON.stringify(coordinatesAPI));
    changeView();
});

const changeView = () => {
    coordinates = JSON.parse(localStorage.getItem("coordinates"));
    clientMarker.setLatLng([coordinates.lat, coordinates.lon]).update();
    map.setView([coordinates.lat, coordinates.lon]).update();
}
