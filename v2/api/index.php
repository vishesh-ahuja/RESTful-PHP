<?php
	include('initialize.php');
	$method = $_SERVER['REQUEST_METHOD'];
	$response['status'] = 200;
	$response['method'] = $method;
	$uri = $_SERVER['REQUEST_URI'];
	$uri = explode('/', $uri);
	for($i=0; $i<=2; $i++) {
		$ele = array_shift($uri);
	}
	if($method=="GET") {
		if(empty($uri)) {

		} else {
			$ele = array_shift($uri);
			if($ele=="orders" && (empty($uri) || empty($uri[0]))) {
				$orders = Myorders::find_all();
				$response['data'] = $orders;
			} else {
				$id = array_shift($uri);
				if(ctype_digit($id) && empty($uri)) {
					$order = Myorders::find_by_id($id);
					if(empty($order)) {
						$response['data'] = "Not found";
						$response['status'] = 404;
					} else
						$response['data'] = $order;
				}
			}

		}

	} elseif($method=="POST") {
		
		$order = Myorders::make($_POST['name']);
		$order->save();
		$response['data'] = "Saved";
		//echo json_encode($response);

	} elseif($method=="PUT") {

	} elseif($method=="DELETE") {

	} else {
		$response['data'] = "Invalid Method";
		$response['status'] = 404;
	}
	echo json_encode($response);
?>