<?php

namespace Form;

use Service\Session as Session;
use Model\Entity\Product;
use Model\Repository\ProductRepository;

class ProductHandleRequest extends BaseHandleRequest
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository;
    }

    public function handleInsertForm(Product $product)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];
            // Checking the validity of the form
            if (empty($title)) {
                $errors[] = "The name cannot be empty";
            }
            if (strlen($title) < 4) {
                $errors[] = "The name must have at least 4 characters";
            }
            if (strlen($title) > 20) {
                $errors[] = "The name cannot have more than 20 characters";
            }

            if (!strpos($reference, " ") === false) {
                $errors[] = "Spaces are not allowed for reference";
            }

            if (!(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Please select an image to upload to continue.";
            }
            // Does the reference already exist in the database?

            // $productExists = $this->productRepository->checkProductExist([$reference]);
            $productExists = $this->productRepository->findByAttributes($product, ['reference' => $reference]);

            if ($productExists) {
                $errors[] = "The reference already exists, please choose a new one";
            }
            if (!is_numeric($price)) {
                $errors[] = "The price must have a numerical value";
            }
            if (empty($price)) {
                $errors[] = "Price cannot be empty";
            }
            if (!is_numeric($stock)) {
                $errors[] = "The stock must have a numerical value";
            }
            if (empty($stock)) {
                $errors[] = "Stock cannot be empty";
            }
            if (empty($cat_id)) {
                $errors[] = "Category cannot be empty";
            }

            if (empty($errors)) {
                $product->setTitle($title);
                $product->setDescription($description ?? null);
                $product->setReference($reference);
                $product->setPrice($reference);
                $product->setPrice($price);
                $product->setStock($stock);
                $product->setcategoryId($cat_id);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
    public function handleEditForm(Product $product)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];
            // Checking the validity of the form
            if (empty($title)) {
                $errors[] = "Name cannot be empty";
            }
            if (strlen($title) < 4) {
                $errors[] = "The name must have at least 4 characters";
            }
            if (strlen($title) > 20) {
                $errors[] = "The name cannot have more than 20 characters";
            }

            if (!strpos($reference, " ") === false) {
                $errors[] = "Spaces are not allowed for reference";
            }

            if (!(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Please select an image to upload to continue.";
            }
            // Does the reference already exist in the database?

            // $productExists = $this->productRepository->checkProductExist([$reference]);
            $productExists = $this->productRepository->findByAttributes($product, ['reference' => $reference]);

            if ($productExists) {
                $errors[] = "The reference already exists, please choose a new one";
            }
            if (!is_numeric($price)) {
                $errors[] = "The price must have a numerical value";
            }
            if (empty($price)) {
                $errors[] = "Price cannot be empty";
            }
            if (!is_numeric($stock)) {
                $errors[] = "The stock must have a numerical value";
            }
            if (empty($stock)) {
                $errors[] = "Stock cannot be empty";
            }
            if (empty($cat_id)) {
                $errors[] = "Category cannot be empty";
            }

            if (empty($errors)) {
                $product->setTitle($title);
                $product->setDescription($description ?? null);
                $product->setReference($reference);
                $product->setPrice($reference);
                $product->setPrice($price);
                $product->setStock($stock);
                $product->setcategoryId($cat_id);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}