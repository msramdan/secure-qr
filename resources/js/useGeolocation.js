import { onMounted, ref } from 'vue'
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import geojson from '@src/geojson/gadm41_IDN_2.json'

export function useGeolocation() {
    const coord = ref([0, 0])

    const successCallback = (position) => {
        coord.value = [position.coords.latitude, position.coords.longitude]
    };

    const errorCallback = (error) => {
        console.log(error);
    };

    const camelToFlat = (camel) => {
        return camel.replace(/([a-z])([A-Z])/g, '$1 $2')
    }

    const getUserLocation = () => {
        let position = { coord: coord.value, city: '', province: '' }

        L.geoJson(geojson, {
            onEachFeature: function(feature, layer) {
                let m1 = L.marker(coord.value.reverse());
                const exist = feature.geometry.coordinates.some(poly => {
                    let polygon = L.polygon(poly);
                    // return polygon.getBounds().contains(m1.getLatLng())
                    return polygon.contains(m1.getLatLng())
                })

                if( exist ) {
                    position.city = camelToFlat(feature.properties.NAME_2)
                    position.province = camelToFlat(feature.properties.NAME_1)
                    return;
                }
            }
        });

        return position
    }

    onMounted(() => {
        if (!navigator.geolocation) {
            console.log('Geolocation API not supported by this browser.');
        } else {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback)
        }
    })

    return getUserLocation
}
