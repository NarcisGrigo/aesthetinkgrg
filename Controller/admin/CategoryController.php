<?php
/**
 * Summary of namespace Controller
 */
namespace Controller\Admin;

use Model\Entity\Category;
use Model\Repository\CategoryRepository;
use Form\CategoryHandleRequest;
use Controller\BaseController;

/**
 * Summary of CategoryController
 */
class CategoryController extends BaseController
{
    private CategoryRepository $categoryRepository;
    private CategoryHandleRequest $form;
    private Category $category;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository;
        $this->form = new CategoryHandleRequest;
        $this->category = new Category;
    }

    public function list()
    {
        $categorys = $this->categoryRepository->findAll($this->category);

        $this->render("category/index.html.php", [
            "h1" => "Users list",
            "categorys" => $categorys
        ]);
    }

    public function new()
    {
        $category = $this->category;
        $this->form->handleInsertForm($category);

        if ($this->form->isSubmitted() && $this->form->isValid()) {

            $this->categoryRepository->insertCategory($category);
            return redirection(addLink("home"));
        }

        $errors = $this->form->getEerrorsForm();
        return $this->render("category/form.html.php", [
            "h1" => "Ajouter un nouvel utilisateur",
            "category" => $category,
            "errors" => $errors,
        ]);
    }

    /**
     * Summary of show
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        if ($id) {
            if (is_numeric($id)) {

                $category = $this->category;
            } else {
                $this->setMessage("danger", "Error 404 : this page does not exist");
            }
        } else {
            $this->setMessage("danger", "Erreur 403 : you do not have acces to this URL");
            redirection(addLink("category", "list"));
        }

        $this->render("category/show.html.php", [
            "category" => $category,
            "h1" => "Categories file"
        ]);
    }
    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (!empty($id) && is_numeric($id)) {

            /**
             * @var Category
             */
            $category = $this->categoryRepository->findById($this->category, $id);

            $this->form->handleEditForm($category);

            if ($this->form->isSubmitted() && $this->form->isValid()) {

                $this->categoryRepository->updateCategory($category);

                return redirection(addLink("home"));
            }

            $errors = $this->form->getEerrorsForm();
            return $this->render("category/form.html.php", [
                "h1" => "Update de l'utilisateur n° $id",
                "category" => $category,
                "errors" => $errors,
            ]);
        }
        return redirection("/errors/404.php");
    }

    public function delete($id)
    {
        if (!empty($id) && is_numeric($id)) {

            /**
             * @var Category
             */
            $category = $this->categoryRepository->findById($this->category, $id);

            if (!empty($category)) {
                $this->categoryRepository->setIsDeletedTrueById($category);
            } else {
                $this->setMessage("danger", "ERREUR 404 : the requested page does not exist");
            }
        } else {
            $this->setMessage("danger", "ERREUR 404 : the requested page does not exist");
        }

        $this->render("category/form.html.php", [
            "h1" => "Deleting the category n°$id ?",
            "category" => $category,
            "mode" => "deleting"
        ]);
    }


}