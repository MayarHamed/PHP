<?php

require('MySQLHandler.php');
$handler = new MySQLHandler();

if ($handler->connect()) {

    $method = $_SERVER['REQUEST_METHOD'];
    $url_pieces = explode("/", $_SERVER["REQUEST_URI"]);
    $resource = isset($url_pieces[2]) ? $url_pieces[2] : "";
    $id = isset($url_pieces[3]) ? $url_pieces[3] : 0;

    if ($resource == 'items') {
        switch ($method) {
            case 'GET':
                $getItemById = $handler->get_record_by_id($id);
                if ($getItemById) {
                    $getItemById = $getItemById[0];
                } else {
                    $getItemById = ['error' => "Resource dosn't exist"];
                    http_response_code(404);
                }
                echo json_encode($getItemById);
                break;

            case 'POST':
                $newItem = json_decode(file_get_contents("php://input"), true);
                $handler->save($newItem);
                echo json_encode($newItem);
                break;

            case 'PUT':
                $item = $handler->get_record_by_id($id);
                $handler->connect();
                if ($item) {
                    $updatedItem = json_decode(file_get_contents("php://input"), true);
                    $handler->update($updatedItem, $id);
                    echo json_encode(["message" => "item updated"]);
                } else {
                    $err = ["error" => "Resource dosn't exist"];
                    echo json_encode($err);
                    http_response_code(404);
                }
                break;

            case 'DELETE':
                $item = $handler->get_record_by_id($id);
                $handler->connect();
                if ($item) {
                    $handler->delete($id);
                    echo json_encode(["message" => "item deleted "]);
                } else {
                    $err = ["error" => "item doesn't exist"];
                    echo json_encode($err);
                    http_response_code(404);
                }
                break;

            default:
                $err = ["error" => "method not allowed!"];
                echo json_encode($err);
                http_response_code(405);
                break;
        }
    } else {
        $err = ['error' => "Resource dosn't exist"];
        echo json_encode($err);
        http_response_code(404);
    }
} else {
    $err = ['error' => "internal server error!"];
    echo json_encode($err);
    http_response_code(500);
}