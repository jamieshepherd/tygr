<?php namespace App\Commands;

use App\Commands\Command;
use App\Attachment;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Input;

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Blob\Models\CreateBlobOptions;

class AddAttachmentCommand extends Command implements SelfHandling {

	public $file;
	public $issue;
    public $blobRestProxy;

	/**
	 * Create a new command instance.
	 *
	 * @param  object  $file
	 * @param  int  $issue
	 */
	public function __construct($file, $issue)
	{
		$this->file = $file;
		$this->issue = $issue;

        $connectionString = "DefaultEndpointsProtocol=https;AccountName=".env('AZURE_ACCOUNT_NAME').";AccountKey=".env('AZURE_STORAGE_KEY');
        // Create blob REST proxy.
        $this->blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
    }

    /**
     * Execute the command.
     *
     * @return void
    */
    public function handle()
    {

        $filename = preg_replace('/[^\w-.]/', '', $this->file->getClientOriginalName());

        // make a random file prefix
        $unique = false;
        while(!$unique) {
            $prefix = base_convert(rand(1,100000000),10,36);
            $exists = Attachment::where('filename','=',$prefix.'-'.$filename)->first();
            if(!$exists) $unique = true;
        }

        $filename = $prefix.'-'.$filename;
        $content = fopen($this->file, 'r');

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $ctype = finfo_file($finfo, $this->file);

        try {
            // Set some file options (content type)
            $options = new CreateBlobOptions();
            $options->setBlobContentType($ctype);
            // Create and upload blob to Azure
            $this->blobRestProxy->createBlockBlob("attachments", $filename, $content, $options);
            // Add an attachment entry to the database, assign it our issue id
            $attachment = new Attachment();
            $attachment->issue_id = $this->issue;
            $attachment->filename = $filename;
            $attachment->extension = $this->file->getClientOriginalExtension();
            $attachment->save();
        }
        catch(ServiceException $e){
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/en-us/library/windowsazure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            Log::error($code.": ".$error_message);
        }
    }

}
