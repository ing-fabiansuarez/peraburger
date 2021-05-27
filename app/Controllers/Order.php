<?php

namespace App\Controllers;

use App\Entities\Order as EntitiesOrder;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class Order extends BaseController
{

    public function createOrder()
    {
        if(empty($_SESSION['list_order'])){
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'No hay productos en el carrito de compras.'
            ]);
        }
        if (!$this->validate(
            [
                'typeshipping' => 'required',
                'cedula' => 'required|is_natural',
                'name' => 'required',
                'adress' => 'required',
                'barrio' => 'required',
                'domi' => 'required|is_natural',
                'price_domi' => 'required|decimal',
                'whatsapp' => 'required|is_natural'  
            ]
        )) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Tuvimos problemas al recibir los datos del pedido.'
            ]);
        }


        //datos recibidos del formulario
        $typeshipping_id_typeshipping =$this->request->getPostGet('typeshipping');
        $client_id_client = $this->request->getPostGet('cedula');
        $name = $this->request->getPostGet('name');
        $surname = $this->request->getPostGet('surname');
        $adress = $this->request->getPostGet('adress');
        $barrio = $this->request->getPostGet('barrio');
        $domicilio_id_domicilio = $this->request->getPostGet('domi');
        $price_domi = $this->request->getPostGet('price_domi');
        $whatsapp_domicilio = $this->request->getPostGet('whatsapp');
        $observations_order = $this->request->getPostGet('observation');

        //datos Necesarios para crear el pedido
        $employee = '1098823092';
        $REFERENCE = date("Y") . '-' . date("m") . '-' . date("d") . '-' . time();

        //FATA VERIFICAR SI EL DOMICILIARIO EXITE
        //FALTA VERFICAR SI EXITE EL CLIENTE

        $domicilio = [
            'id_domicilio'=>$REFERENCE,
            'address_domicilio'=>$adress,
            'neighborhood_domicilio'=>$barrio,
            'domiciliary_id_domiciliary'=>$domicilio_id_domicilio,
            'price_domicilio'=>$price_domi,
            'whatsapp_domicilio'=>$whatsapp_domicilio
        ];

        $new_order = new EntitiesOrder([
            'id_order'=> $REFERENCE,
            'typeshipping_id_typeshipping'=> $typeshipping_id_typeshipping,
            'observations_order'=> $observations_order,
            'employee_id_employee'=> $employee,
            'domicilio_id_domicilio'=> $domicilio_id_domicilio,
            'client_id_client'=> $client_id_client
        ]);
        $new_order->setTypeshipping_id_typeshipping();

        d($new_order);





       // d($this->request->getPostGet());
        echo "estamos dentro";
    }

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
