import './bootstrap';
import 'flowbite';
import jQuery from 'jquery';
import 'leaflet/dist/leaflet.css';
window.$ = jQuery;

import L from "leaflet";

import 'leaflet/dist/leaflet.css';

// Import the Leaflet MapTiler Plugin
import "@maptiler/leaflet-maptilersdk";

const map = L.map('map', {
  center: L.latLng(11.2362713,125.0027962),
  zoom: 18,
  minZoom: 16,
});
const marker = new L.Marker([11.2362713,125.0027962]);
marker.addTo(map);
// Create a MapTiler Layer inside Leaflet
const mtLayer = new L.MaptilerLayer({
  // Get your free API key at https://cloud.maptiler.com
  apiKey: "SzJ2avCx9hg50x3Sptce",
}).addTo(map);



document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

