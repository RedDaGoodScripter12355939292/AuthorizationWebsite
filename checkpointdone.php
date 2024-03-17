<?php

// Read the Lua file containing authorized HWIDs
$authorizedHWIDs = file_get_contents("AuthorizedFree.lua");

// Extract HWID from the GET parameters
$hwid = $_GET['hwid'];

// Check if the HWID is present in the Lua file
if (strpos($authorizedHWIDs, $hwid) !== false) {
    // HWID is authorized
    // Redirect to the authorization completed page
    header("Location: https://authorization.checkpointdoneblood.com/");
    exit;
} else {
    // HWID is not authorized
    echo "You are not authorized.";
}
?>
