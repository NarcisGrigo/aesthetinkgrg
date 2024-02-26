<?php

namespace Service;

use Service\Session as Session;

class ImageHandler
{
    public static function handelPhoto($entity)
    {
        $fileType = ["jpg", "jpeg", "png", "gif", "svg", "webp"];
        // Location where you want to save the file
        $target_dir = UPLOAD_productsS_IMG;
        // Construct a unique file name by appending a timestamp to the original name
        $originalFileName = basename($_FILES["photo"]["name"]);
        $timestamp = time(); // Use current timestamp
        $uniqueFileName = $timestamp . "_" . $originalFileName;
        $target_file = $target_dir . $uniqueFileName;
        // Get the image type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a JPEG image
        if (!in_array($imageFileType, $fileType)) {
            Session::addMessage("errors", "Only JPEG, png, gif and svg images are allowed.");
        } else {
            // Check image size (e.g. 1MB)
            if ($_FILES["photo"]["size"] > 1000000) {
                Session::addMessage("errors", "The image is too large. The maximum size allowed is 1 MB.");
            } else {
                // Move the uploaded file to the target directory
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
                $entity->setPhoto($uniqueFileName);
                Session::addMessage("succes", "The image has been successfully uploaded.");
            }
        }
    }
}