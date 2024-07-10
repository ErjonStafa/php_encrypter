<?php

return [
    /**
     * All the files are evaluated by base_path() function
     *
     * @see base_path()
     */
    'paths' => [
        // Massive encryption by paths. Please comment after encryption
        'app',
        'database',
        'routes'
    ],
    'files' => [
        // Encrypt specific files. Please comment after encryption
    ],
    'excluded_files' => [
        // Files to not include when encrypting
        'app/Console/Kernel.php',
        'app/Exceptions/Handler.php',
        'app/Http/Kernel.php',
        'app/Http/Middleware/Authenticate.php',
        'app/Http/Middleware/EncryptCookies.php',
        'app/Http/Middleware/PreventRequestsDuringMaintenance.php',
        'app/Http/Middleware/RedirectIfAuthenticated.php',
        'app/Http/Middleware/TrimStrings.php',
        'app/Http/Middleware/TrustHosts.php',
        'app/Http/Middleware/TrustProxies.php',
        'app/Http/Middleware/ValidateSignature.php',
        'app/Http/Middleware/VerifyCsrfToken.php',
        'app/Providers/AppServiceProvider.php',
        'app/Providers/AuthServiceProvider.php',
        'app/Providers/BroadcastServiceProvider.php',
        'app/Providers/EventServiceProvider.php',
        'app/Providers/RouteServiceProvider.php',
    ]
];
