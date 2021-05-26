<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class Order extends BaseController
{

    public function viewCreateOrder()
    {
        $mdlCategory  = new CategoryModel();
        $mdlProduct = new ProductModel();
        dd($mdlProduct->getInfoProductsListOrder($_SESSION['list_order']));
        return view('admin/contents/order/view_createorder', [
            'categories' => $mdlCategory->findAll()
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
            return redirect()->back()->with('validate_form_client', $this->validator->getErrors())->withInput();
        }

        //TOMAR LOS VALORES RECIBIDOS
        $product = $this->request->getPostGet('products-select');
        if (!$whitout_ingredients = $this->request->getPostGet('ingredients-div')) {
            $whitout_ingredients = array();
        }
        d($this->request->getPostGet());
        d($whitout_ingredients);
        $quantity = $this->request->getPostGet('quantity');
        $newItem = [
            [
                'id' => time(),
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
    public function cart(){
        dd($_SESSION['list_order']);
    }
}
