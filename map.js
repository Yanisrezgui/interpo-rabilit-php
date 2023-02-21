const coordinates = JSON.parse(localStorage.getItem("coordinates"));
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

L.marker([coordinates.lat, coordinates.lon], {icon: userIcon}).addTo(map);
