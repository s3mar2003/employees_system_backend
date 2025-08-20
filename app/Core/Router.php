<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri, $requestMethod) {
        $uri = trim($uri, '/');
        
        // البحث عن الراوت المناسب بما في ذلك الرواتر ذات المعاملات
        foreach ($this->routes[$requestMethod] as $route => $action) {
            // تحويل الراوت إلى نمط regex للتعرف على المعاملات
            $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>[^/]+)', $route);
            $pattern = "#^$pattern$#";
            
            if (preg_match($pattern, $uri, $matches)) {
                [$controller, $method] = explode('@', $action);
                $controller = "App\\Controllers\\$controller";
                
                // استخراج المعاملات فقط (تجاهل التطابقات الكاملة)
                $params = array_filter($matches, function($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);
                
                (new $controller)->$method(...array_values($params));
                return;
            }
        }
        
        // إذا لم يتم العثور على أي روت
        http_response_code(404);
        echo "404 - Page not found: " . $uri;
    }
}
?>