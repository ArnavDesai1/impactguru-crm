<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\User::where('email', 'admin@gmail.com')->update(['role' => 'admin']);
echo "✓ User admin@gmail.com promoted to admin!\n";
