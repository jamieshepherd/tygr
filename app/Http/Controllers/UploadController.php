<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Issue;

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Blob\Models\Blob;

class UploadController extends Controller {

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

        $connectionString = "DefaultEndpointsProtocol=https;AccountName=".env('AZURE_ACCOUNT_NAME').";AccountKey=".env('AZURE_STORAGE_KEY');
        // Create blob REST proxy.
        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

        try {
            // Get blob.
            $blob = $blobRestProxy->getBlob("attachments", $filename);
            // Get content type
            $contentType = $blob->getProperties()->getContentType();

            // Set header options
            header('Content-Type: '.$contentType);

            // Return blob as file
            echo stream_get_contents($blob->getContentStream());
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
