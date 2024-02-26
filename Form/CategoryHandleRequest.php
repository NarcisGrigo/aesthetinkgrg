<?php

namespace Form;

use Service\Session as Session;
use Model\Entity\Category;
use Model\Repository\CategoryRepository;

class CategoryHandleRequest extends BaseHandleRequest
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository;
    }

    public function handleInsertForm(Category $category)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];

            // Checking the validity of the form
            if (empty($type)) {
                $errors[] = "Category type cannot be empty";
            }


            // Does the type already exist in the database?

            $categoryExists = $this->categoryRepository->checkCategoryExists($type);

            //$categoryExists = $this->categoryRepository->findByAttributes($category, ["type" => $type]);

            if ($categoryExists) {
                $errors[] = "The type already exists, please choose a new one";
            }

            if (empty($errors)) {
                $category->setType($type);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
    public function handleEditForm(Category $category)
    {
        if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

            extract($_POST);
            $errors = [];

            // Checking the validity of the form
            if (empty($type)) {
                $errors[] = "Category type cannot be empty";
            }


            // Does the type already exist in the database?

            $categoryExists = $this->categoryRepository->checkCategoryExists($type);

            if ($categoryExists) {
                $errors[] = "The type already exists, please choose a new one";
            }

            if (empty($errors)) {
                $category->setType($type);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }

}