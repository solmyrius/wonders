<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>World Wonders</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        }

        #map-wrp {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }

        #map {
            position: relative;
            width: 72%;
			float: left;
			height: 100%;
        }

        #wonder-list {
            position: relative;
            width: 28%;
			float: right;
			height: 100%;
			overflow-y: scroll;
			background-color: #071e2d;
        }

		.wonder-item{
			height: 55px;
			display: flex;
			padding: 6px 9px;
			cursor: pointer;
			color: #eee;
			background-color: transparent;
			transition:0.5s;
		}

		.wonder-item:hover{
			color: #333;
			background-color: #ffffff;
		}

		.wonder-item-inner{
			border-bottom: 1px #444 solid;
			width: 100%;
		}

		.wonder-item-title{
			font-size: 15px;
			font-weight: bold;
		}

		.wonder-img{
			max-width: 220px;
			margin: 10px auto 0 auto;
			display: block;
		}

		.wonder-title{
			font-size: 15px;
			font-weight: bold;
			margin: 6px 0;
		}

		.wonder-wiki a{
			color: #0645ad;
			text-decoration: none;
		}

		.wonder-wiki a:hover{
			color: #0645ad;
			text-decoration: underline;
		}

		@media only screen and (max-width: 600px){

			#map {
				width: 100%;
				float: none;
				height: 400px;
			}
			#wonder-list {
				width: 100%;
				float: none;
				height: auto;
			}
		}
    </style>
</head>
<body>
    <div id="map-wrp">
	    <div id="map"></div>
	    <div id="wonder-list">
			<?php
				$data = json_decode(file_get_contents('dataset.json'));
				foreach($data->features as $item){

					echo '<div class="wonder-item" data-id="'.$item->properties->id.'" data-lat="'.$item->geometry->coordinates[1].'" data-lng="'.$item->geometry->coordinates[0].'">';
					echo '<div class="wonder-item-inner">';
					echo '<div class="wonder-item-title">'.$item->properties->title.'</div>';
					echo '</div>';
					echo '</div>';
				}
			?>
		</div>
    </div>
    <script src="main.js"></script>
</body>
</html>