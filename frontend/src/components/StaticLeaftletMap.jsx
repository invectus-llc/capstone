import { MapContainer, TileLayer, Marker } from "react-leaflet";

const StaticLeaftletMap = () => {
  const position = [11.2362713, 125.0027962];

  return (
    <MapContainer
      center={position}
      zoom={18}
      minZoom={16}
      className="w-full h-[500px] p-36 z-10 rounded-lg shadow-lg"
    >
      <TileLayer
        url="https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=SzJ2avCx9hg50x3Sptce"
        attribution='&copy; <a href="https://www.maptiler.com/">MapTiler</a> contributors'
      />
      <Marker position={position} />
    </MapContainer>
  );
};

export default StaticLeaftletMap;