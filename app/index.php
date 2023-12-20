<?php
// Get the requested URL path
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove leading and trailing slashes and explode the path into an array
$requestSegments = explode('/', trim($requestPath, '/'));

// Svelte baseDir
$svelteBaseDir = 'svelte';

if ($requestSegments[0] === '_app') {
    $requestPath = '/' . $svelteBaseDir . $requestPath;
}

// Construct the full path to the requested file
$filePath = __DIR__ . $requestPath;

// Check if the file exists
if (file_exists($filePath) && is_file($filePath)) {
    // Determine the MIME type based on the file extension
    $mimeTypes = [
        'html' => 'text/html',
        'js'   => 'application/javascript',
    ];

    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
    $mime = $mimeTypes[$fileExtension] ?? 'text/plain';

    // Set the appropriate Content-Type header
    header("Content-Type: $mime");

    // Serve the file content
    readfile($filePath);

    return;
}

// The first segment is the controller (folder)
$controller = isset($requestSegments[0]) ? $requestSegments[0] : 'home';

// The second segment is the action (file)
$action = isset($requestSegments[1]) ? $requestSegments[1] : 'index';

// Include the corresponding PHP file based on the controller and action
$controllerPath = __DIR__ . "/controllers/$controller/$action.php";

// Check if the file exists
if (file_exists($controllerPath)) {
    // Include the controller file
    require $controllerPath;
} else {
    // Handle 404 error (File not found)
    http_response_code(404);
    echo '404 Not Found';
}
