<?php

class Core
{
    public function start($uri, $getParams) {
        $uriData = $this->parseUrl($uri);
        $controller = ucfirst($uriData["controllerName"])."Controller";
        $method = $uriData["methodName"];
        $args = count($getParams) > 0 ? $getParams :  array("params" => null);
        if (class_exists($controller) && method_exists($controller, $method)) {
            call_user_func_array(array(new $controller, $method), $args);
            http_response_code(200);
        } else {
            echo "Página não encontrada (404)";
            http_response_code(404);
        }

    }

    private function parseUrl($url) {
        $url_info = parse_url($url);
        $path = $url_info["path"];
        $array = explode('/', $path);
        $calls = array_slice($array, 2);
        if (count($calls) == 0 || $calls[0] == "") {
            return array("controllerName" => "Home", "methodName" => "index");
        } else {
            $controllerName = $calls[0];
            return array("controllerName" => $controllerName, "methodName" => $calls[1] ?? "index");
        }
    }
}