		var p, l;
        mapboxgl.accessToken = 'pk.eyJ1Ijoic2VyZ2VuYW1vIiwiYSI6ImNsNmU0dXBucTA0NnIzaW9ycGIxM2h6NjEifQ.PL6OR7pFq_gELDaeKC-wAw';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/sergenamo/cl6e2a8lc001v14pgnwo4bqab',
            zoom: 2,
            center: [5, 30],
            pitch: 5
        });

		function show_popup(item){

			var url = 'https://en.wikipedia.com' + item.properties.url;

			if (typeof(p)!='undefined'){
				p.remove();
			}

			p = new mapboxgl.Popup({})
				.setLngLat(item.geometry.coordinates)
				.setHTML(`<div class="wonder-pop"><img class="wonder-img" src="${item.properties.img}" /><p class="wonder-title">${item.properties.title}</p><p class="wonder-wiki"><a href="${url}" target=_blank>${url}</a></div>`)
				.addTo(map);
		}

		map.on('load', function(){

			map.addSource('my-wonders-source', {
				type: 'vector',
				url: 'mapbox://sergenamo.cl6h0gqi6032p29qd3px6qp0l-8vdd2'
			});
			l = map.addLayer({
				'id': 'my-wonders',
				'type': 'symbol',
				'source': 'my-wonders-source',
				'source-layer': 'wonders',
			});

			console.log(l);

			map.on('mouseover', 'wonders', function(e){

				jQuery('canvas').css('cursor','pointer');
			});

			map.on('mouseout', 'wonders', function(e){

				jQuery('canvas').css('cursor','');
			});

			map.on('click', 'wonders', function(e){

				const feature = e.features[0];
				show_popup(feature);
			});
		});

		jQuery(document).ready(function(){

			jQuery('.wonder-item').on('click', function(){

				j = jQuery(this);

				map.flyTo({center: [j.data('lng'), j.data('lat')],	essential: true});
				jQuery.ajax({
					'method':'GET',
					'url':'https://puzyrkov.com/wonders/wonder.php?id='+j.data('id')
					}).done(function(data){
						show_popup(JSON.parse(data));
					});
			})
		});
