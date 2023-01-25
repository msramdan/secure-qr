<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import data from '@src/geojson/gadm41_IDN_2.json'

const props = defineProps(['datas']);

let map = ref()
const colors = ref([
    { total: 1000, color: '#dc2626' },
    { total: 500, color: '#16a34a' },
    { total: 1, color: '#ca8a04' }
])

function camelToFlat(camel) {
    return camel.replace(/([a-z])([A-Z])/g, '$1 $2')
}

function getFeatureData(state) {
    return props.datas.find(data => camelToFlat(state) == data.city)
}

onMounted(() => {
    map = L.map('map', {
        center: [-0.789275, 117.921327],
        zoom: 5,
        minZoom: 5,
    });

    let tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

	function highlightFeature(e) {
		const layer = e.target;

		layer.setStyle({
			weight: 3,
			color: '#666',
			// fillOpacity: 1
		});

		layer.bringToFront();

		info.update(layer.feature.properties);
	}

	function resetHighlight(e) {
		geojson.resetStyle(e.target);
		info.update();
	}

	function zoomToFeature(e) {
		map.fitBounds(e.target.getBounds(), {
            maxZoom: 10
        });
	}

	function getColor(total) {
		return total > 1000 ? '#dc2626' :
			total > 500  ? '#16a34a' :
			total >= 1  ? '#ca8a04' : 'transparent';
	}

	function style(feature) {
        let totalScan = 0
        const currentFeature = props.datas.find(data => camelToFlat(feature.properties.NAME_2) == data.city)
        if( currentFeature ) totalScan = currentFeature.totalScan
		return {
			weight: 2,
			opacity: 1,
			color: 'white',
			dashArray: '3',
			fillOpacity: 0.7,
			fillColor: getColor(totalScan)
		};
	}

    const geojson = L.geoJson(data, {
        style,
        onEachFeature: function (feature, layer) {
            const data = getFeatureData(feature.properties.NAME_2)
            if( data ) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight,
                    click: zoomToFeature
                }),
                layer.bindPopup(`<b>${camelToFlat(feature.properties.NAME_2)}, ${camelToFlat(feature.properties.NAME_1)}</b><br/><br/>${data.totalScan} total scan`, {
                    direction: 'center'
                })
            }
        }
    }).addTo(map);


	const info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    info.update = function (props) {
        let contents = 'Hover sebuah kota'
        if( props ) {
            const data = getFeatureData(props.NAME_2)
            contents = `<b>${camelToFlat(props.NAME_2)}, ${camelToFlat(props.NAME_1)}</b><br />${data.totalScan} total scan`;
        }
        this._div.innerHTML = `<h4>Total Scan Labelin</h4>${contents}`;
    };

    info.addTo(map);

	const legend = L.control({position: 'bottomright'});

    legend.onAdd = function (map) {
        const div = L.DomUtil.create('div', 'info legend');
        const featureColors = colors.value.reverse();
        const labels = [];
        let from, to;

        for (let i = 0; i < featureColors.length; i++) {
            from = featureColors[i].total;
            to = featureColors[i + 1] ? featureColors[i + 1].total : '';

            labels.push(`<div class="mb-1"><i style="background: ${featureColors[i].color};"></i> ${from}${to ? ` &ndash; ${to}` : '+'}</div>`);
        }

        div.innerHTML = labels.join('');
        return div;
    };

    legend.addTo(map);
});

onBeforeUnmount(() => {
    map.remove();
});

</script>

<template>
    <div class="card-dashboard mb-8">
        <h2 class="card-title-dashboard">Map Persebaran Produk Scan</h2>
        <div id="map" class="w-full h-[31rem] rounded-lg z-0"></div>
    </div>
</template>

<style>
    .info {
        padding: 6px 8px;
        font: 14px/16px Arial,
        Helvetica, sans-serif;
        background: white;
        background: rgba(255,255,255,0.8);
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        border-radius: 5px;
    }
    .info h4 {
        margin: 0 0 5px;
        color: #777;
    }
    .legend {
        text-align: left;
        line-height: 18px;
        color: #555;
    }
    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
</style>
