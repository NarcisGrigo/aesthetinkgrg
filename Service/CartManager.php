<?php

namespace Service;

use Model\Repository\ProductRepository;

/**
 * Summary of ProductController
 */
class CartManager
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository;
    }

    public function addCart($id)
    {
        $quantity = $_GET["qte"] ?? 1;
        $pr = $this->productRepository;
        $product = $pr->findById('product', $id);

        if (!isset($_SESSION["cart"]))
            $_SESSION["cart"] = [];

        $cart = $_SESSION["cart"]; // we retrieve what is in the cart in session

        $productDejaDanscart = false;
        foreach ($cart as $indice => $value) {
            if ($product->getId() == $value["product"]->getId()) {
                $cart[$indice]["quantity"] += $quantity;
                $productDejaDanscart = true;
                break;  // to exit the foreach loop
            }
        }

        if (!$productDejaDanscart) {
            $cart[] = ["quantity" => $quantity, "product" => $product];  // we add a value to the cart => $cart is an array of array
        }

        $_SESSION["cart"] = $cart;  // I put $cart back in the session, at the index 'cart'

        $nb = 0;
        foreach ($cart as $value) {
            $nb += $value["quantity"];
        }
        $_SESSION["nombre"] = $nb;
        return $nb;
    }
}