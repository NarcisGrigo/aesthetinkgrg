<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Entity\Product;
use Form\ProductHandleRequest;
use Model\Repository\ProductRepository;

/**
 * Summary of ProductController
 */
class ProductController extends BaseController
{
    private ProductRepository $productRepository;
    private ProductHandleRequest $form;
    private Product $product;

    public function __construct()
    {
        $this->productRepository = new ProductRepository;
        $this->form = new ProductHandleRequest;
        $this->product = new Product;
    }

    public function list()
    {
        $product = $this->productRepository->findAll($this->product);

        $this->render("product/index.html.php", [
            "h1" => "Products list",
            "products" => $product
        ]);
    }

    public function show($id)
    {
        if (!empty($id) && is_numeric($id)) {
            $pr = new ProductRepository;
            $product = $pr->findById('product', $id);
            if (empty($product)) {
                $this->setMessage("danger", "The product N° $id does not exist");
                redirection(addLink("home"));
            }
            $this->render("product/show.html.php", [
                "product" => $product,
                "h1" => "Products file"
            ]);
        } else {
            error("404.php");
        }
    }
    
}