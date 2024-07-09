<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | The API key used to authenticate requests to the OpenAI API. This key
    | should be kept secret and should not be shared or exposed in client-side
    | code. You can create API keys at a user or service account level. Service
    | accounts are recommended for production systems.
    |
    | API keys can be scoped to one of the following:
    |
    | - Project keys: Provide access to a single project (preferred option).
    |   Generate keys for specific projects to ensure best security practices.
    | - User keys: Legacy keys providing access to all organizations and projects
    |   the user has access to. Transition to project keys is advised.
    |
    | Include your API key in the Authorization HTTP header:
    | Authorization: Bearer OPENAI_API_KEY
    |
    | Set this value in your environment file only.
    |
    */

    'api_key' => env('OPENAI_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Organization ID
    |--------------------------------------------------------------------------
    |
    | The organization ID used to specify which organization is accessed for an API
    | request. This is optional and is mainly used if you belong to multiple
    | organizations or are using legacy user API keys. The organization ID ensures
    | the usage is counted against the specified organization.
    |
    | Include the organization ID in the OpenAI-Organization HTTP header:
    | OpenAI-Organization: ORG_ID
    |
    | Set this value in your environment file.
    |
    */

    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | OpenAI Project ID
    |--------------------------------------------------------------------------
    |
    | The project ID used to specify which project is accessed for an API request.
    | This is optional and is mainly used if you belong to multiple organizations
    | or are using legacy user API keys. The project ID ensures the usage is counted
    | against the specified project.
    |
    | Include the project ID in the OpenAI-Project HTTP header:
    | OpenAI-Project: PROJECT_ID
    |
    | Set this value in your environment file.
    |
    */

    'project_id' => env('OPENAI_PROJECT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Base URI
    |--------------------------------------------------------------------------
    |
    | The base URI for the OpenAI API. This is the root endpoint that your
    | application will use to make API requests. By default, it should point
    | to the main OpenAI API endpoint, but it can be overridden in your
    | environment file if necessary.
    |
    | Set this value in your environment file to ensure that your application
    | uses the correct endpoint for making requests to the OpenAI API.
    | Example: 'https://api.openai.com/v1'
    |
    */

    'base_uri' => env('OPENAI_BASE_URI', 'https://api.openai.com/v1'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The maximum amount of time (in seconds) to wait for a response from the
    | OpenAI API. This value should be set in your environment file. If not set,
    | the default value will be 60 seconds.
    |
    | Set this value in your environment file.
    |
    */

    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 60),

    /*
    |--------------------------------------------------------------------------
    | GPT Models
    |--------------------------------------------------------------------------
    |
    | This configuration allows you to define the GPT models and their versions
    | that you intend to use in your application. By using environment variables,
    | you can easily manage and update the models without changing the code.
    | This is particularly useful given the frequent release of new model versions.
    |
    | For more details on the available models and their capabilities, refer to
    | the official documentation: https://platform.openai.com/docs/models
    |
    */

    'models' => [
        'gpt-4o' => env('OPENAI_GPT_4O'),
        'gpt-4-turbo' => env('OPENAI_GPT_4_TURBO'),
        'gpt-4' => env('OPENAI_GPT_4'),
        'gpt-3.5-turbo' => env('OPENAI_GPT_3_5_TURBO'),
        'dall-e' => env('OPENAI_GPT_DALL_E'),
        'tts' => env('OPENAI_GPT_TTS'),
        'text-embedding' => env('OPENAI_GPT_TEXT_EMBEDDING'),
        'text-moderation' => env('OPENAI_GPT_TEXT_MODERATION'),
        'gpt-base' => env('OPENAI_GPT_BASE'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Beta Endpoints
    |--------------------------------------------------------------------------
    |
    | This configuration allows you to specify which "Assistants" beta endpoints
    | should include the "OpenAI-Beta: assistants=v2" header in the API requests.
    |
    | Currently, there are v2 and v1/legacy endpoints that require this header.
    | This package supports the v2 endpoints, v1/legacy endpoints are not supported.
    |
    | The default value includes ['assistants', 'threads', 'vector_stores'], but
    | you can override it by setting the OPENAI_BETA_ENDPOINTS environment variable
    | to a comma-separated list of endpoints.
    |
    */

    'beta_endpoints' => explode(',', env('OPENAI_BETA_ENDPOINTS', 'assistants,threads,vector_stores')),
];
