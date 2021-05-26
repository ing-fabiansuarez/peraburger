<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class Order extends BaseController
{
    public function viewCreateOrderFinish()
    {

        if (empty($_SESSION['list_order'])) {
            return view('errors/cli/error_verification');
        }
        $mdlProduct = new ProductModel();
        return view('admin/contents/order/view_createorderfinish', [
            'list_order' => $mdlProduct->getInfoProductsListOrder($_SESSION['list_order'])
        ]);
    }

    public function viewCreateOrder()
    {
        $mdlCategory  = new CategoryModel();
        $mdlProduct = new ProductModel();
        if (empty($_SESSION['list_order'])) {
            return view('admin/contents/order/view_createorder', [
                'categories' => $mdlCategory->findAll()
            ]);
        }
        return view('admin/contents/order/view_createorder', [
            'categories' => $mdlCategory->findAll(),
            'list_order' => $mdlProduct->getInfoProductsListOrder($_SESSION['list_order'])
        ]);
    }

    public function addProductToListOrder()
    {
        //VERIFICACION DE LOS VALORES RECIBIDOS
        if (!$this->validate(
            [
                'products-select' => 'required|is_not_unique[product.id_product]',
                'quantity' => 'required|is_natural',
            ]
        )) {
            return redirect()->back();
        }

        //TOMAR LOS VALORES RECIBIDOS
        $product = $this->request->getPostGet('products-select');
        if (!$whitout_ingredients = $this->request->getPostGet('ingredients-div')) {
            $whitout_ingredients = array();
        }
        d($this->request->getPostGet());
        d($whitout_ingredients);
        $quantity = $this->request->getPostGet('quantity');
        $item = time() . '-';
        $newItem = [
            $item => [
                'id' => $item,
                'product'  => $product,
                'quantity'     => $quantity,
                'whitout_ingredients'     => $whitout_ingredients
            ]
        ];
        if (isset($_SESSION['list_order'])) {
            $this->session->push('list_order', $newItem);
        } else {
            $this->session->set('list_order', $newItem);
        }
        return redirect()->route('view_createorder');
    }

    public function deleteProductToListOrder()
    {
        if (!$this->validate(
            [
                'id' => 'required',
            ]
        )) {
            return view('errors/cli/error_verification');
        }
        $list_products = $_SESSION['list_order'];
        if (empty($list_products)) {
            return view('errors/cli/error_verification');
        } else {
            $id_to_delete = $this->request->getPostGet('id');
            unset($_SESSION['list_order'][$id_to_delete]);
            return redirect()->route('view_createorder');
        }
    }

    public function cart()
    {
        dd($_SESSION['list_order']);
    }
    public function d()
    {
        $this->session->destroy();
    }
}
