<p align="center"><img src="https://raw.githubusercontent.com/iteks/art/master/logo-packages/laravel-openai.svg" width="400" alt="Laravel OpenAI"></p>

<p align="center">
<a href="https://packagist.org/packages/iteks/laravel-openai"><img src="https://img.shields.io/packagist/dt/iteks/laravel-openai" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/iteks/laravel-openai"><img src="https://img.shields.io/packagist/v/iteks/laravel-openai" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/iteks/laravel-openai"><img src="https://img.shields.io/packagist/l/iteks/laravel-openai" alt="License"></a>
</p>

**Laravel OpenAI** is a powerful and user-friendly package designed to seamlessly integrate OpenAI's advanced AI capabilities into your Laravel applications. This package simplifies interaction with the OpenAI API, offering an elegant interface to quickly leverage various AI models for chat, embeddings, and more. With intuitive configuration through environment variables and smooth integration via a dedicated Laravel service provider, **Laravel OpenAI** ensures you can get started with OpenAI endpoints swiftly and efficiently. Enhance your Laravel applications by harnessing the power of OpenAI's AI models with this versatile and easy-to-use client.

A community-maintained package, Offered by <a href="https://github.com/iteks/">iteks</a>, Developed by <a href="https://github.com/jeramyhing/">jeramyhing</a>.

## Get Started

> **Requires <a href="https://php.net/releases/" target="_blank">PHP 8.1+</a>**

Install **Laravel OpenAI** via the <a href="https://getcomposer.org/" target="_blank">Composer</a> package manager:

```bash
composer require iteks/laravel-openai
```

Set your OpenAI API key and other configurations in your `.env` file:

```env
OPENAI_API_KEY=
OPENAI_ORGANIZATION=
```

## Usage

For API calls, required parameters should be passed directly to the Facade methods without wrapping them in an array. Optional parameters can be included as an associative array at the end. Each method's documentation includes a link to the official API reference for further details.

```php
// Example of a required parameter
$response = OpenAi::chat('Your message here');

// Example with optional parameters
$response = OpenAi::chat('Your message here', ['temperature' => 0.7, 'max_tokens' => 150]);
```

- [ENDPOINTS](#endpoints)
    - [Audio](#audio)
        - [Create speech](#create-speech)
        - [Create transcription](#create-transcription)
        - [Create translation](#create-translation)
    - [Chat](#chat)
        - [Create chat completion](#create-chat-completion)
    - [Embeddings](#embeddings)
        - [Create embeddings](#create-embeddings)
    - [Fine-tuning](#fine-tuning)
        - [Create fine-tuning job](#create-fine-tuning-job)
        - [List fine-tuning jobs](#list-fine-tuning-jobs)
        - [List fine-tuning events](#list-fine-tuning-events)
        - [List fine-tuning checkpoints](#list-fine-tuning-checkpoints)
        - [Retrieve fine-tuning job](#retrieve-fine-tuning-job)
        - [Cancel fine-tuning](#cancel-fine-tuning)
    - [Batch](#batch)
        - [Create batch](#create-batch)
        - [Retrieve batch](#retrieve-batch)
        - [Cancel batch](#cancel-batch)
        - [List batch](#list-batch)
    - [Files](#files)
        - [Upload file](#upload-file)
        - [List files](#list-files)
        - [Retrieve file](#retrieve-file)
        - [Delete file](#delete-file)
        - [Retrieve file content](#retrieve-file-content)
    - [Images](#images)
        - [Create image](#create-image)
        - [Create image edit](#create-image-edit)
        - [Create image variation](#create-image-variation)
    - [Models](#models)
        - [List models](#list-models)
        - [Retrieve model](#retrieve-model)
        - [Delete a fine-tuned model](#delete-a-fine-tuned-model)
    - [Moderations](#moderations)
        - [Create moderation](#create-moderation)
- [ASSISTANTS](#assistants)
    - [Assistants (Beta v2)](#assistants-1)
        - [Create assistant](#create-assistant)
        - [List assistants](#list-assistants)
        - [Retrieve assistant](#retrieve-assistant)
        - [Modify assistant](#modify-assistant)
        - [Delete assistant](#delete-assistant)
    - [Threads (Beta v2)](#threads)
        - [Create thread](#create-thread)
        - [Retrieve thread](#retrieve-thread)
        - [Modify thread](#modify-thread)
        - [Delete thread](#delete-thread)
    - [Messages (Beta v2)](#messages)
        - [Create message](#create-message)
        - [List messages](#list-messages)
        - [Retrieve message](#retrieve-message)
        - [Modify message](#modify-message)
        - [Delete message](#delete-message)
    - [Runs (Beta v2)](#runs)
        - [Create run](#create-run)
        - [Create thread and run](#create-thread-and-run)
        - [List runs](#list-runs)
        - [Retrieve run](#retrieve-run)
        - [Modify run](#modify-run)
        - [Submit tool outputs to run](#submit-tool-outputs-to-run)
        - [Cancel a run](#cancel-a-run)
    - [Run Steps (Beta v2)](#run-steps)
        - [List run steps](#list-run-steps)
        - [Retrieve run step](#retrieve-run-step)
    - [Vector Stores (Beta v2)](#vector-stores)
        - [Create vector store](#create-vector-store)
        - [List vector stores](#list-vector-stores)
        - [Retrieve vector store](#retrieve-vector-store)
        - [Modify vector store](#modify-vector-store)
        - [Delete vector store](#delete-vector-store)
    - [Vector Store Files (Beta v2)](#vector-store-files)
        - [Create vector store file](#create-vector-store-file)
        - [List vector store files](#list-vector-store-files)
        - [Retrieve vector store file](#retrieve-vector-store-file)
        - [Delete vector store file](#delete-vector-store-file)
    - [Vector Store File Batches (Beta v2)](#vector-store-file-batches)
        - [Create vector store file batch](#create-vector-store-file-batch)
        - [Retrieve vector store file batch](#retrieve-vector-store-file-batch)
        - [Cancel vector store file batch](#cancel-vector-store-file-batch)
        - [List vector store files in a batch](#list-vector-store-files-in-a-batch)
- [LEGACY](#legacy)
    - [Completions](#completions)
        - [Create completion](#create-completion)

## ENDPOINTS

### Audio

#### Create speech
Generates audio from the input text.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/audio/createSpeech)

```php
OpenAi::audio()->createSpeech('tts-1', 'The quick brown fox jumped over the lazy dog.', 'alloy');
```

[top](#usage)

#### Create transcription
Transcribes audio into the input language.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/audio/createTranscription)

```php
OpenAi::audio()->createTranscription(fopen('@/path/to/file/audio.mp3', 'r'), 'whisper-1');
```

[top](#usage)

#### Create translation
Translates audio into English.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/audio/createTranslation)

```php
OpenAi::audio()->createTranslation('@/path/to/file/german.m4a', 'whisper-1');
```

[top](#usage)

### Chat

#### Create chat completion
Creates a model response for the given chat conversation.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/chat/create)

```php
OpenAi::chat()->create(
    [
        ['role' => 'system', 'content' => 'You are a helpful assistant.',],
        [ 'role' => 'user', 'content' => 'Hello!', ],
    ],
    'gpt-4o'
);
```

[top](#usage)

### Embeddings

#### Create embeddings
Creates an embedding vector representing the input text.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/embeddings/create)

```php
OpenAi::embeddings()->create(
    'The food was delicious and the waiter...',
    'text-embedding-ada-002',
    ['encoding_format' => 'float']
);
```

[top](#usage)

### Fine-tuning

#### Create fine-tuning job
Creates a fine-tuning job which begins the process of creating a new model from a given dataset.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/fine-tuning/create)

```php
OpenAi::fineTuning()->create('gpt-3.5-turbo', 'file-BK7bzQj3FfZFXr7DbL6xJwfo');
```

[top](#usage)

#### List fine-tuning jobs
List your organization's fine-tuning jobs.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/fine-tuning/list)

```php
OpenAi::fineTuning()->list();
```

[top](#usage)

#### List fine-tuning events
Get status updates for a fine-tuning job.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/fine-tuning/list-events)

```php
OpenAi::fineTuning()->listEvents('ftjob-abc123');
```

[top](#usage)

#### List fine-tuning checkpoints
List checkpoints for a fine-tuning job.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/fine-tuning/list-checkpoints)

```php
OpenAi::fineTuning()->listCheckpoints('ftjob-abc123');
```

[top](#usage)

#### Retrieve fine-tuning job
Get info about a fine-tuning job.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/fine-tuning/retrieve)

```php
OpenAi::fineTuning()->retrieve('ft-AF1WoRqd3aJAHsqc9NY7iL8F');
```

[top](#usage)

#### Cancel fine-tuning
Immediately cancel a fine-tune job.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/fine-tuning/cancel)

```php
OpenAi::fineTuning()->cancel('ftjob-abc123');
```

[top](#usage)

### Batch

#### Create batch
Creates and executes a batch from an uploaded file of requests.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/batch/create)

```php
OpenAi::batch()->create('file-abc123', '/v1/chat/completions', '24h');
```

[top](#usage)

#### Retrieve batch
Retrieves a batch.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/batch/retrieve)

```php
OpenAi::batch()->retrieve('batch_abc123');
```

[top](#usage)

#### Cancel batch
Cancels an in-progress batch.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/batch/cancel)

```php
OpenAi::batch()->cancel('batch_abc123');
```

[top](#usage)

#### List batch
List your organization's batches.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/batch/list)

```php
OpenAi::batch()->list();
```

[top](#usage)

### Files

#### Upload file
Upload a file that can be used across various endpoints. Individual files can be up to 512 MB, and the size of all files uploaded by one organization can be up to 100 GB.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/files/create)

```php
OpenAi::files()->create(fopen('@mydata.jsonl', 'r'), 'fine-tune');
```

[top](#usage)

#### List files
Returns a list of files that belong to the user's organization.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/files/list)

```php
OpenAi::files()->list();
```

[top](#usage)

#### Retrieve file
Returns information about a specific file.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/files/retrieve)

```php
OpenAi::files()->retrieve('file-abc123');
```

[top](#usage)

#### Delete file
Delete a file.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/files/delete)

```php
OpenAi::files()->delete('file-abc123');
```

[top](#usage)

#### Retrieve file content
Returns the contents of the specified file.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/files/retrieve-contents)

```php
OpenAi::files()->retrieveContents('file-abc123');
```

[top](#usage)

### Images

#### Create image
Creates an image given a prompt.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/images/create)

```php
OpenAi::images()->create(
    'A cute baby sea otter',
    [
        'model' => 'dall-e-3',
        'n' => 1,
        'size' => '1024x1024',
    ]
);
```

[top](#usage)

#### Create image edit
Creates an edited or extended image given an original image and a prompt.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/images/createEdit)

```php
OpenAi::images()->createEdit(
    'fopen('@otter.png', 'r')',
    'A cute baby sea otter wearing a beret',
    [
        'mask' => '@mask.png',
        'n' => 2,
        'size' => '1024x1024',
    ]
);
```

[top](#usage)

#### Create image variation
Creates a variation of a given image.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/images/createVariation)

```php
OpenAi::images()->createVariation(
    'fopen('@otter.png', 'r')',
    [
        'n' => 2,
        'size' => '1024x1024',
    ]
);
```

[top](#usage)

### Models

#### List models
Lists the currently available models, and provides basic information about each one such as the owner and availability.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/models/list)

```php
OpenAi::models()->list();
```

[top](#usage)

#### Retrieve model
Retrieves a model instance, providing basic information about the model such as the owner and permissioning.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/models/retrieve)

```php
OpenAi::models()->retrieve('gpt-3.5-turbo-instruct');
```

[top](#usage)

#### Delete a fine-tuned model
Delete a fine-tuned model. You must have the Owner role in your organization to delete a model.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/models/delete)

```php
OpenAi::models()->delete('ft:gpt-3.5-turbo:acemeco:suffix:abc123');
```

[top](#usage)

### Moderations

#### Create moderation
Classifies if text is potentially harmful.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/moderations/create)

```php
OpenAi::moderations()->create('I want to kill them.');
```

[top](#usage)

## ASSISTANTS

### Assistants

#### Create assistant
Create an assistant with a model and instructions.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/assistants/createAssistant)

```php
OpenAi::assistants()->create(
    'gpt-4-turbo',
    [
        'instructions' => 'You are a personal math tutor. When asked a question, write and run Python code to answer the question.',
        'name' => 'Math Tutor',
        'tools' => [['type' => 'code_interpreter']],
    ]
);
```

[top](#usage)

#### List assistants
Returns a list of assistants.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/assistants/listAssistants)

```php
OpenAi::assistants()->list();
```

[top](#usage)

#### Retrieve assistant
Retrieves an assistant.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/assistants/getAssistant)

```php
OpenAi::assistants()->retrieve('asst_abc123');
```

[top](#usage)

#### Modify assistant
Modifies an assistant.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/assistants/modifyAssistant)

```php
OpenAi::assistants()->modify(
    'asst_idcmCPkquyQbqOpdJOEb6wCO',
    [
        'instructions' => 'You are an HR bot, and you have access to files to answer employee questions about company policies. Always response with info from either of the files.',
        'tools' => [['type' => 'file_search']],
        'model' => 'gpt-4-turbo',
    ]
);
```

[top](#usage)

#### Delete assistant
Delete an assistant.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/assistants/deleteAssistant)

```php
OpenAi::assistants()->delete('asst_abc123');
```

[top](#usage)

### Threads

#### Create thread
Create a thread.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/threads/createThread)

```php
OpenAi::threads()->create();
```

[top](#usage)

#### Retrieve thread
Retrieves a thread.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/threads/getThread)

```php
OpenAi::threads()->retrieve('thread_abc123');
```

[top](#usage)

#### Modify thread
Modifies a thread.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/threads/modifyThread)

```php
OpenAi::threads()->modify(
    'thread_abc123',
    [
        'metadata' => [
            'modified' => 'true',
            'user' => 'abc123',
        ],
    ]
);
```

[top](#usage)

#### Delete thread
Delete a thread.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/threads/deleteThread)

```php
OpenAi::threads()->delete('thread_abc123');
```

[top](#usage)

### Messages

#### Create message
Create a message.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/messages/createMessage)

```php
OpenAi::messages()->create(
    'thread_abc123',
    'user',
    'How does AI work? Explain it in simple terms.'
);
```

[top](#usage)

#### List messages
Returns a list of messages for a given thread.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/messages/listMessages)

```php
OpenAi::messages()->list('thread_abc123');
```

[top](#usage)

#### Retrieve message
Retrieves a message.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/messages/getMessage)

```php
OpenAi::messages()->retrieve('thread_abc123', 'msg_abc123');
```

[top](#usage)

#### Modify message
Modifies a message.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/messages/modifyMessage)

```php
OpenAi::messages()->modify(
    'thread_abc123',
    'msg_abc123',
    [
        'metadata' => [
            'modified' => 'true',
            'user' => 'abc123',
        ],
    ]
);
```

[top](#usage)

#### Delete message
Deletes a message.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/messages/deleteMessage)

```php
OpenAi::messages()->delete('thread_abc123', 'msg_abc123');
```

[top](#usage)

### Runs

#### Create run
Create a run.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/runs/createRun)

```php
OpenAi::runs()->create('thread_abc123', 'asst_abc123');
```

[top](#usage)

#### Create thread and run
Create a thread and run it in one request.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/runs/createThreadAndRun)

```php
OpenAi::runs()->createThreadAndRun(
    'asst_abc123',
    [
        'messages' => [
            [
                'role' => 'user',
                'content' => 'Explain deep learning to a 5 year old.',
            ],
        ],
    ]
);
```

[top](#usage)

#### List runs
Returns a list of runs belonging to a thread.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/runs/listRuns)

```php
OpenAi::runs()->list('thread_abc123');
```

[top](#usage)

#### Retrieve run
Retrieves a run.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/runs/getRun)

```php
OpenAi::runs()->retrieve('thread_abc123', 'run_abc123');
```

[top](#usage)

#### Modify run
Modifies a run.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/runs/modifyRun)

```php
OpenAi::runs()->modify(
    'thread_abc123',
    'run_abc123',
    [
        'metadata' => [
            'user' => 'user_abc123',
        ],
    ]
);
```

[top](#usage)

#### Submit tool outputs to run
When a run has the status: "requires_action" and required_action.type is submit_tool_outputs, this endpoint can be used to submit the outputs from the tool calls once they're all completed.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/runs/submitToolOutputs)

```php
OpenAi::runs()->submitToolOutputs(
    'thread_abc123',
    'run_abc123',
    [
        0 => [
            'tool_call_id' => 'call_001',
            'output' => '70 degrees and sunny.',
        ],
    ]
);
```

[top](#usage)

#### Cancel a run
Cancels a run that is in_progress.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/runs/cancelRun)

```php
OpenAi::runs()->cancel('thread_abc123', 'run_abc123');
```

[top](#usage)

### Run Steps

#### List run steps
Returns a list of run steps belonging to a run.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/run-steps/listRunSteps)

```php
OpenAi::runSteps()->list('thread_abc123', 'run_abc123');
```

[top](#usage)

#### Retrieve run step
Retrieves a run step.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/run-steps/getRunStep)

```php
OpenAi::runSteps()->retrieve('thread_abc123', 'run_abc123', 'step_abc123');
```

[top](#usage)

### Vector Stores

#### Create vector store
Create a vector store.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores/create)

```php
OpenAi::vectorStores()->create(['name' => 'Support FAQ']);
```

[top](#usage)

#### List vector stores
Returns a list of vector stores.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores/list)

```php
OpenAi::vectorStores()->list();
```

[top](#usage)

#### Retrieve vector store
Retrieves a vector store.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores/retrieve)

```php
OpenAi::vectorStores()->retrieve('vs_abc123');
```

[top](#usage)

#### Modify vector store
Modifies a vector store.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores/modify)

```php
OpenAi::vectorStores()->modify('vs_abc123', ['name' => 'Support FAQ']);
```

[top](#usage)

#### Delete vector store
Delete a vector store.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores/delete)

```php
OpenAi::vectorStores()->delete('vs_abc123');
```

[top](#usage)

### Vector Store Files

#### Create vector store file
Create a vector store file by attaching a File to a vector store.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-files/createFile)

```php
OpenAi::vectorStoreFiles()->create('vs_abc123', 'file-abc123');
```

[top](#usage)

#### List vector store files
Returns a list of vector store files.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-files/listFiles)

```php
OpenAi::vectorStoreFiles()->list('vs_abc123');
```

[top](#usage)

#### Retrieve vector store file
Retrieves a vector store file.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-files/getFile)

```php
OpenAi::vectorStoreFiles()->retrieve('vs_abc123', 'file-abc123');
```

[top](#usage)

#### Delete vector store file
Delete a vector store file. This will remove the file from the vector store but the file itself will not be deleted. To delete the file, use the delete file endpoint.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-files/deleteFile)

```php
OpenAi::vectorStoreFiles()->delete('vs_abc123', 'file-abc123');
```

[top](#usage)

### Vector Store File Batches

#### Create vector store file batch
Create a vector store file batch.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-file-batches/createBatch)

```php
OpenAi::vectorStoreFileBatches()->create(
    'vs_abc123',
    [
        'file_ids' => [
            'file-abc123',
            'file-abc456',
        ],
    ]
);
```

[top](#usage)

#### Retrieve vector store file batch
Retrieves a vector store file batch.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-file-batches/getBatch)

```php
OpenAi::vectorStoreFileBatches()->retrieve('vs_abc123', 'vsfb_abc123');
```

[top](#usage)

#### Cancel vector store file batch
Cancel a vector store file batch. This attempts to cancel the processing of files in this batch as soon as possible.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-file-batches/cancelBatch)

```php
OpenAi::vectorStoreFileBatches()->cancel('vs_abc123', 'vsfb_abc123');
```

[top](#usage)

#### List vector store files in a batch
Returns a list of vector store files in a batch.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/vector-stores-file-batches/listBatchFiles)

```php
OpenAi::vectorStoreFileBatches()->list('vs_abc123', 'vsfb_abc123');
```

[top](#usage)

## LEGACY

### Completions

#### Create completion
Creates a completion for the provided prompt and parameters.
[See official documentation for all options.](https://platform.openai.com/docs/api-reference/completions/create)

```php
OpenAi::completions()->create(
    'gpt-3.5-turbo-instruct',
    'Say this is a test',
    [
        'max_tokens' => 7,
        'temperature' => 0,
    ]
);
```

[top](#usage)
