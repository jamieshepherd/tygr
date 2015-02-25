<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Commands\DestroyAttachmentCommand;

use Illuminate\Http\Request;
use App\Issue;
use App\Attachment;

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Blob\Models\Blob;

class UploadController extends Controller {

    public $connectionString;
    public $blobRestProxy;

    /**
     * Set up connection string and blobRestProxy
     *
     */
    public function __construct()
    {
        $this->connectionString = "DefaultEndpointsProtocol=https;AccountName=".env('AZURE_ACCOUNT_NAME').";AccountKey=".env('AZURE_STORAGE_KEY');
        // Create blob REST proxy.
        $this->blobRestProxy = ServicesBuilder::getInstance()->createBlobService($this->connectionString);
    }

	/**
	 * Retrieve and display the specified resource from blob storage.
	 *
	 * @param  string  $client
     * @param  string  $stub
     * @param  string  $filename
	 * @return Response
	 */
	public function show($client, $stub, $filename)
	{

        try {
            // Get blob.
            $blob = $this->blobRestProxy->getBlob("attachments", $filename);
            // Get content type
            $contentType = $blob->getProperties()->getContentType();

            // Set header options
            header('Content-Type: '.$contentType);

            // Return blob as file
            echo fpassthru($blob->getContentStream());
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

    /**
	 * Delete the resource from storage
	 *
	 * @param  string  $client
     * @param  string  $stub
     * @param  string  $filename
	 * @return Response
	 */
	public function delete($client, $stub, $id)
	{
        $attachment = Attachment::find($id);
        if(isset($_GET['confirm']) && $_GET['confirm'] == true) {
            // Delete the resource
			$this->dispatch(new DestroyAttachmentCommand($attachment));

            \Session::flash('message', 'The attachment has been queued for deletion');
			return redirect('projects/'.$client.'/'.$stub.'/issues');
        }

        return view ('uploads.delete')->with('attachment', $attachment);
    }

}
