<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Magento Base URL
    |--------------------------------------------------------------------------
    |
    | The Base URL to the Magento 2 store. Must define http protocol
    | and domain TLD. The root path of the store and not the API path.
    | Example: "https://store.com"
    |
    */
    'base_url' => env('MAGENTO_BASE_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Magento Access Token
    |--------------------------------------------------------------------------
    |
    |  The "Access Token" defined from the Magento 2 application.
    |  Developers can add the "Access Token" in the "Integrations"
    |  section in your Magento 2 administration panel.
    |
    */
    'token' => env('MAGENTO_ACCESS_TOKEN', null),

    /*
    |--------------------------------------------------------------------------
    | Magento Base API Path
    |--------------------------------------------------------------------------
    |
    |  The Magento 2 REST API Base Path. By default, this
    |  is assigned as 'rest'. Developers should only
    |  update this setting if the path has changed.
    |
    */
    'base_path' => env('MAGENTO_BASE_PATH', 'rest'),

    /*
    |--------------------------------------------------------------------------
    | Magento Store Code
    |--------------------------------------------------------------------------
    |
    |  The Magento 2 REST API Store Code By default, this
    |  is assigned to 'all' specifying all magento stores
    |  on requests. Developers may update this to specify
    |  the API around a specific store code.
    |
    */
    'store_code' => env('MAGENTO_STORE_CODE', 'all'),

    /*
    |--------------------------------------------------------------------------
    | Magento API Version
    |--------------------------------------------------------------------------
    |
    |  The Magento 2 REST API Version. By default, Magento 2
    |  sets this to 'V1'. Developers should only update this
    |  setting if the version has changed.
    |
    */
    'version' => env('MAGENTO_API_VERSION', 'V1'),
];
