<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | The API key for accessing the OpenAI API. This value should be set in
    | your environment file. If not set, the default value will be an empty
    | string.
    |
    */

    'api_key' => env('OPENAI_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Organization ID
    |--------------------------------------------------------------------------
    |
    | The ID of the OpenAI organization associated with the API key. This value
    | should be set in your environment file. If not set, the default value will
    | be an empty string.
    |
    */

    'organization' => env('OPENAI_ORGANIZATION', ''),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The maximum amount of time (in seconds) to wait for a response from the
    | OpenAI API. This value should be set in your environment file. If not set,
    | the default value will be 60 seconds.
    |
    */

    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 60),

    /*
    |--------------------------------------------------------------------------
    | Base URI
    |--------------------------------------------------------------------------
    |
    | The base URI for the OpenAI API. This value should be set in your
    | environment file. If not set, the default value will be
    | 'https://api.openai.com/v1'.
    |
    */

    'base_uri' => env('OPENAI_BASE_URI', 'https://api.openai.com/v1'),

    /*
    |--------------------------------------------------------------------------
    | Beta Endpoints
    |--------------------------------------------------------------------------
    |
    | A list of beta endpoints available for use with the OpenAI API. This value
    | should be set in your environment file. If not set, the default value will
    | be ['assistants', 'threads', 'vector_stores'].
    |
    */

    'beta_endpoints' => explode(',', env('OPENAI_BETA_ENDPOINTS', 'assistants,threads,vector_stores')),
];
