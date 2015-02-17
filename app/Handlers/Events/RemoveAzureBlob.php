<?php namespace App\Handlers\Events;

use App\Events\AttachmentWasDeleted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

class RemoveAzureBlob {

    public $connectionString;
    public $blobRestProxy;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $connectionString = "DefaultEndpointsProtocol=https;AccountName=".env('AZURE_ACCOUNT_NAME').";AccountKey=".env('AZURE_STORAGE_KEY');
        // Create blob REST proxy.
        $this->blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
	}

	/**
	 * Handle the event.
	 *
	 * @param  AttachmentWasDeleted  $event
	 * @return void
	 */
	public function handle(AttachmentWasDeleted $event)
	{

        try {
            // Delete container.
            $this->blobRestProxy->deleteBlob("attachments", "myblob");
        }
        catch(ServiceException $e){
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            \Log::error($code.": ".$error_message);
        }
	}

}
