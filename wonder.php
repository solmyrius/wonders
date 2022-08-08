<?php
$id = preg_replace('/[^a-z0-9_]/','',$_GET['id']);

$data = json_decode(file_get_contents('dataset.json'));

foreach($data->features as $item){

	if($item->properties->id == $id){

		print(json_encode($item));
	}
}
?>