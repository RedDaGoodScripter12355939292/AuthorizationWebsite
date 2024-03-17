<?php

// GitHub repository information
$owner = getenv('RedDaGoodScripter12355939292');
$repo = getenv('AuthorizationWebsite');
$path = "AuthorizedFree.lua"; // Replace with the path to your Lua script

// Personal access token
$token = getenv('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');

// New HWID to add
$hwid = $_GET['hwid'];

// Read Lua file from GitHub
$url = "https://raw.githubusercontent.com/$owner/$repo/master/$path";
$options = array(
    'http' => array(
        'header' => "Authorization: token $token",
        'method' => 'GET'
    )
);
$context = stream_context_create($options);
$luaCode = file_get_contents($url, false, $context);

// Add new HWID to authorizedHWIDs table
$newLuaCode = preg_replace('/local authorizedHWIDs = {\s*(.*?)\s*}/s', "local authorizedHWIDs = {\n    $1,\n    \"$hwid\"\n}", $luaCode);

// Commit updated Lua code back to GitHub
$data = array(
    'message' => 'Add HWID',
    'content' => base64_encode($newLuaCode),
    'sha' => sha1($newLuaCode)
);
$url = "https://api.github.com/repos/$owner/$repo/contents/$path";
$options = array(
    'http' => array(
        'header' => "Authorization: token $token",
        'method' => 'PUT',
        'content' => json_encode($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result !== false) {
    echo "HWID added successfully.";

    // You can add additional logic here if needed
} else {
    echo "Error adding HWID.";
}
?>
