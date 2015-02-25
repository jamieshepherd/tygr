<?php namespace App\Commands;

use App\Commands\Command;
use App\Attachment;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Input;

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

class DestroyAttachmentCommand extends Command implements SelfHandling {

	public $attachment;
    public $connectionString;
    public $blobRestProxy;

    /**
     * Create a new command instance.
     *
     * @param  object $attachment
     */
	public function __construct(Attachment $attachment)
	{
        $this->attachment = $attachment;

        $this->connectionString = "DefaultEndpointsProtocol=https;AccountName=".env('AZURE_ACCOUNT_NAME').";AccountKey=".env('AZURE_STORAGE_KEY');
        // Create blob REST proxy.
        $this->blobRestProxy = ServicesBuilder::getInstance()->createBlobService($this->connectionString);
    }

    /**
     * Execute the command.
     *
     * @return void
    */
    public function handle()
    {

        try {
            // Delete the blob from Azure
			$this->blobRestProxy->deleteBlob("attachments", $this->attachment->filename);
            // Destroy the database entry
			Attachment::destroy($this->attachment->id);
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
