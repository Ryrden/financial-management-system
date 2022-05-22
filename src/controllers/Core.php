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
        $array = explode('/', $url);
        $calls = array_slice($array, 3, 2);
        if (count($calls) == 0 || $calls[0] == "") {
            return array("controllerName" => "Home", "methodName" => "index");
        } else if (count($calls) == 1) {
            $controllerName = $calls[0];
            return array("controllerName" => $controllerName, "methodName" => "index");
        } else {
            $controllerName = $calls[0];
            $methodNameWithGetParams = $calls[1];
            $getFirstWordPattern = '/^([\w\-]+)/';
            preg_match($getFirstWordPattern, $methodNameWithGetParams, $matches);
            $methodName = $matches ? $matches[0] : "index";
            return array("controllerName" => $controllerName, "methodName" => $methodName);
        }
    }
}