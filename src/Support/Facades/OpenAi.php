<?php

declare(strict_types=1);

namespace Iteks\Support\Facades;

use Illuminate\Support\Facades\Facade;
use Iteks\OpenAi\Api\Assistants\Assistants;
use Iteks\OpenAi\Api\Assistants\Messages;
use Iteks\OpenAi\Api\Assistants\Runs;
use Iteks\OpenAi\Api\Assistants\RunSteps;
use Iteks\OpenAi\Api\Assistants\Threads;
use Iteks\OpenAi\Api\Assistants\VectorStoreFileBatches;
use Iteks\OpenAi\Api\Assistants\VectorStoreFiles;
use Iteks\OpenAi\Api\Assistants\VectorStores;
use Iteks\OpenAi\Api\Endpoints\Audio;
use Iteks\OpenAi\Api\Endpoints\Batch;
use Iteks\OpenAi\Api\Endpoints\Chat;
use Iteks\OpenAi\Api\Endpoints\Embeddings;
use Iteks\OpenAi\Api\Endpoints\Files;
use Iteks\OpenAi\Api\Endpoints\FineTuning;
use Iteks\OpenAi\Api\Endpoints\Images;
use Iteks\OpenAi\Api\Endpoints\Models;
use Iteks\OpenAi\Api\Endpoints\Moderations;
use Iteks\OpenAi\Api\Legacy\Completions;

/**
 * @method static Audio audio() Learn how to turn audio into text or text into audio.
 * @method static Chat chat() Given a list of messages comprising a conversation, the model will return a response.
 * @method static Embeddings embeddings() Get a vector representation of a given input that can be easily consumed by machine learning models and algorithms.
 * @method static FineTuning fineTuning() Manage fine-tuning jobs to tailor a model to your specific training data.
 * @method static Batch batch() Create large batches of API requests for asynchronous processing. The Batch API returns completions within 24 hours for a 50% discount.
 * @method static Files files() Files are used to upload documents that can be used with features like Assistants, Fine-tuning, and Batch API.
 * @method static Images images() Given a prompt and/or an input image, the model will generate a new image.
 * @method static Models models() List and describe the various models available in the API. You can refer to the Models documentation to understand what models are available and the differences between them.
 * @method static Moderations moderations() Given some input text, outputs if the model classifies it as potentially harmful across several categories.
 * @method static Assistants assistants() Build assistants that can call models and use tools to perform tasks.
 * @method static Threads threads() Create threads that assistants can interact with.
 * @method static Messages messages() Create messages within threads.
 * @method static Runs runs() Represents an execution run on a thread.
 * @method static RunSteps runSteps() Represents the steps (model and tool calls) taken during the run.
 * @method static VectorStores vectorStores() Vector stores are used to store files for use by the `file_search` tool.
 * @method static VectorStoreFiles vectorStoreFiles() Vector store files represent files inside a vector store.
 * @method static VectorStoreFileBatches vectorStoreFileBatches() Vector store file batches represent operations to add multiple files to a vector store.
 * @method static Completions completions() Given a prompt, the model will return one or more predicted completions along with the probabilities of alternative tokens at each position. Most developer should use our Chat Completions API to leverage our best and newest models.
 */
class OpenAi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'open.ai';
    }
}
