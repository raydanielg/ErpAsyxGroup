<?php
$files = [
    'database/seeders/DefultSetting.php',
    'database/seeders/EmailTemplatesSeeder.php',
    'database/seeders/DatabaseSeeder.php',
    'database/seeders/DemoUserSeeder.php',
];

$count = 0;
foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    // Remove any BOM
    $clean = ltrim($content, "\xEF\xBB\xBF");
    // Also remove any leading whitespace before <?php
    $clean = preg_replace('/^\s*<\?php/', '<?php', $clean);
    if ($clean !== $content) {
        file_put_contents($file, $clean);
        $count++;
        echo "Fixed: $file\n";
    }
}

// Also scan other seeders
foreach (glob('database/seeders/*.php') as $file) {
    $content = file_get_contents($file);
    $clean = ltrim($content, "\xEF\xBB\xBF");
    $clean = preg_replace('/^\s*<\?php/', '<?php', $clean);
    if ($clean !== $content) {
        file_put_contents($file, $clean);
        $count++;
        echo "Fixed: $file\n";
    }
}

echo "Total fixed: $count\n";
