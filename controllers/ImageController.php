<?php

require_once 'helpers/FileUploadHelper.php';
require_once 'models/image.php';
require_once 'validation/validator.php';

class ImageController
{

    private $fileUploadHelper;
    private $image;

    public function __construct()
    {
        $this->image = new image;
        $this->fileUploadHelper = new FileUploadHelper;
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!Validator::validateRequiredFile($_FILES['image'])) {
                echo json_encode(['status' => 'error', 'message' => 'Image are required.']);
                http_response_code(400);
                return;
            }

            $fileName = $this->fileUploadHelper->upload($_FILES['image']);

            if (isset($fileName)) {
                $imageId = $this->image->add([
                    'name' => $fileName
                ]);

                echo json_encode([
                    'id' => $imageId,
                    'status' => 'success',
                    'message' => 'File uploaded successfully.'
                ]);
            }

        }
    }

    public function download()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imageUrl = filter_input(INPUT_POST, 'imageUrl', FILTER_SANITIZE_URL);

            if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                $imageContent = file_get_contents($imageUrl);
                if ($imageContent !== false) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: image/jpeg');
                    header('Content-Disposition: attachment; filename="downloaded_image.jpg"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . strlen($imageContent));
                    echo $imageContent;
                    exit;
                } else {
                    http_response_code(500);
                    echo 'Failed to download image.';
                }
            } else {
                http_response_code(400);
                echo 'Invalid URL.';
            }
        } else {
            http_response_code(405);
            echo 'Method Not Allowed';
        }
    }
}
