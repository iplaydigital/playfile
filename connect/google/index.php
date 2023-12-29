<?php
require_once 'vendor/autoload.php';

// Set up Google API credentials
$client = new Google\Client();
$client->setAuthConfig('./credentials.json');
$client->addScope(Google_Service_Slides::PRESENTATIONS);

// Authenticate and create a Slides service
$service = new Google_Service_Slides($client);

// Specify the presentation ID and slide page number
//https://docs.google.com/presentation/d/1BDjpxdCMJFSv6FuhH6mfhVtM09WeES6HMhrYFEnLtAc/edit?usp=sharing


$presentationId = '1BDjpxdCMJFSv6FuhH6mfhVtM09WeES6HMhrYFEnLtAc';
$slidePageNumber = 1;

// Get the current timestamp
$timestamp = date('Y-m-d H:i:s');

// Create a new text box shape with the timestamp
$requests = [
    'createShape' => [
        'objectId' => uniqid(),
        'shapeType' => 'TEXT_BOX',
        'elementProperties' => [
            'pageObjectId' => $service->presentations_pages->get($presentationId, $slidePageNumber)->getObjectId(),
            'size' => [
                'height' => ['magnitude' => 100, 'unit' => 'PT'],
                'width' => ['magnitude' => 400, 'unit' => 'PT'],
            ],
            'transform' => [
                'scaleX' => 1,
                'scaleY' => 1,
                'translateX' => 100,
                'translateY' => 100,
                'unit' => 'PT',
            ],
        ],
    ],
];

// Execute the requests
$batchUpdateRequest = new Google_Service_Slides_BatchUpdatePresentationRequest(['requests' => $requests]);
$service->presentations->batchUpdate($presentationId, $batchUpdateRequest);

// Update the created shape with the timestamp text
$shapeId = $service->presentations->get($presentationId)->getSlides()[0]->getPageElements()[0]->getObjectId();
$requests = [
    'insertText' => [
        'objectId' => $shapeId,
        'insertionIndex' => 0,
        'text' => $timestamp,
    ],
];

// Execute the requests
$batchUpdateRequest = new Google_Service_Slides_BatchUpdatePresentationRequest(['requests' => $requests]);
$service->presentations->batchUpdate($presentationId, $batchUpdateRequest);

?>