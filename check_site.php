<?php
// 1. Check database
$db = new PDO('sqlite:database/database.sqlite');
$landing = $db->query("SELECT value FROM settings WHERE key='landingPageEnabled' LIMIT 1")->fetchColumn();
echo "landingPageEnabled=$landing\n";

// 2. Update if needed
if ($landing !== 'off') {
    $db->exec("UPDATE settings SET value='off' WHERE key='landingPageEnabled'");
    echo "FIXED: landingPageEnabled -> off\n";
}

// 3. Check if server responding
echo "Done.\n";
