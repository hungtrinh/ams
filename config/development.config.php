<?php

return array(
    // Development time modules
    'modules' => array(
        'ZFTool',
        'ZendDeveloperTools',
        'SanSessionToolbar',
        'AistGitTools',
        'Jhu\ZdtLoggerModule',
        'ZfSnapEventDebugger',
    ),

    'module_listener_options' => array(
        // Turn off caching
        'config_cache_enabled'     => false,
        'module_map_cache_enabled' => false,
    ),
);
