<?php

namespace App\Controllers;

use App\Entities\Order as EntitiesOrder;
use App\Models\CategoryModel;
use App\Models\ClientModel;
use App\Models\DetailorderModel;
use App\Models\DomicilioModel;
use App\Models\IngredientModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\RecipeModel;
use App\Models\TypeshippingModel;
use App\Models\WhitoutingredientModel;
use Exception;

class Order extends BaseController
{
    public function viewLoadOrder($REF)
    {
        $mdlClient = new ClientModel();
        $mdlOrder = new OrderModel();
        $mdlDetailOrder = new DetailorderModel();
        $mdlTypeshipping = new TypeshippingModel();
        $mdlDomicilio = new DomicilioModel();


        return view('admin/contents/order/view_order', [
            'order' => $order = $mdlOrder->find($REF),
            'list_of_products' => $mdlDetailOrder->getListOrderByReference($REF),
            'client' => $mdlClient->find($order->client_id_client),
            'typeshipping' => $mdlTypeshipping->find($order->typeshipping_id_typeshipping),
            'domi' => $mdlDomicilio->find($REF)
        ]);
    }

    public function createOrder()
    {
        if (empty($_SESSION['list_order'])) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'No hay productos en el carrito de compras.'
            ]);
        }

        $typeshipping_id_typeshipping = $this->request->getPostGet('typeshipping');

        if (empty($typeshipping_id_typeshipping)) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'No recibimos el tipo de envio.'
            ]);
        }

        $employee = session()->cedula_employee;
        $REFERENCE = date("Y-m-d") . '-' . time();
        $name = $this->request->getPostGet('name');
        $surname = $this->request->getPostGet('surname');
        $observations_order = $this->request->getPostGet('observation');


        switch ($typeshipping_id_typeshipping) {
            case 1:
                if (!$this->validate(
                    [
                        'typeshipping' => 'required',
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

                $adress = $this->request->getPostGet('adress');
                $barrio = $this->request->getPostGet('barrio');
                $domiciliario = $this->request->getPostGet('domi');
                $price_domi = $this->request->getPostGet('price_domi');
                $whatsapp_domicilio = $this->request->getPostGet('whatsapp');
                $turn_machine = null;
                $domicilio = $REFERENCE;

                $new_domicilio = [
                    'id_domicilio' => $REFERENCE,
                    'address_domicilio' => $adress,
                    'neighborhood_domicilio' => $barrio,
                    'domiciliary_id_domiciliary' => $domiciliario,
                    'price_domicilio' => $price_domi,
                    'whatsapp_domicilio' => $whatsapp_domicilio
                ];

                $mdlDomicilio = new DomicilioModel();

                try {
                    $mdlDomicilio->insert($new_domicilio);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', [
                        'title' => 'Alerta!',
                        'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion del domicilio. <br>Excepción capturada:' .  $e->getMessage()
                    ]);
                }
                break;

            case 2:
                if (!$this->validate(
                    [
                        'typeshipping' => 'required',
                        'name' => 'required',
                        'turn_machine' => 'required|is_natural',
                    ]
                )) {
                    return redirect()->back()->with('error', [
                        'title' => 'Alerta!',
                        'body' => 'Tuvimos problemas al recibir los datos del pedido.'
                    ]);
                }
                $turn_machine = $this->request->getPostGet('turn_machine');
                $domicilio = 1;

                break;
            default:
                return redirect()->back()->with('error', [
                    'title' => 'Alerta!',
                    'body' => 'El tipo de envio no esta programado.'
                ]);
                break;
        }

        $mdlClient = new ClientModel();

        try {
            $mdlClient->insert([
                'id_client' => $REFERENCE,
                'name_client' => $name,
                'surname_client' => $surname
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Ocurrio un error con el modelo, al tratar de insertar El cliente. <br>Excepción capturada:' .  $e->getMessage()
            ]);
        }

        $new_order = new EntitiesOrder([
            'id_order' => $REFERENCE,
            'typeshipping_id_typeshipping' => $typeshipping_id_typeshipping,
            'darlyturn_order' => '',
            'turnmachine_order' => '',
            'observations_order' => $observations_order,
            'date_order' => '',
            'hour_order' => '',
            'consecutive_order' => '',
            'employee_id_employee' => $employee,
            'domicilio_id_domicilio' => $domicilio,
            'client_id_client' => $REFERENCE,
            'state_id_state' => 1,
        ]);
        $new_order->setTimeCreation();
        $new_order->setConsecutiveOfAllOrders();
        $new_order->setDarlyTurn();
        $new_order->setTurnMachine($turn_machine);

        $mdlOrder = new OrderModel();
        try {
            $mdlOrder->insert($new_order);
        } catch (Exception $e) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion de la nueva orden. <br>Excepción capturada:' .  $e->getMessage()
            ]);
        }
        //d($new_order);
        //HASTA AQUI SE A CREADO TODO DE LA NUEVA ORDEN BIEN

        $mdlDetailOrder = new DetailorderModel();
        $mdlProducts = new ProductModel();
        $mdlRecipe = new RecipeModel();
        $mdlWhitout = new WhitoutingredientModel();
        $mdlIngredint = new IngredientModel();

        $allproducts = $mdlProducts->getInfoProductsListOrder($_SESSION['list_order']);
        //d($allproducts);
        //d($_SESSION['list_order']);

        foreach ($allproducts as $producttoadd) {
            $newproduct = [
                'id_detailorder' => '',
                'product_id_product' => $producttoadd['id_product'],
                'order_id_order' => $REFERENCE,
                'quantity_detailorder' => $producttoadd['quantity'],
                'priceunit_detailorder' => $producttoadd['price_product']
            ];
            try {
                $id = $mdlDetailOrder->insert($newproduct);
            } catch (Exception $e) {
                return redirect()->back()->with('error', [
                    'title' => 'Alerta!',
                    'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion de cada uno de los productos del carrito. <br>Excepción capturada:' .  $e->getMessage()
                ]);
            }

            foreach ($producttoadd['whitout_ingredients'] as $whitout) {
                $new_whit_out = [
                    'detailorder_id_detailorder' => $id,
                    'recipe_id_recipe' => $mdlRecipe->where('product_id_product', $producttoadd['id_product'])->where('ingredient_id_ingredient', $whitout['id_ingredient'])->first()['id_recipe'],
                    'discount_hasnot' => $mdlIngredint->find($whitout['id_ingredient'])['price_ingredient']
                ];
                try {
                    $mdlWhitout->insert($new_whit_out);
                } catch (Exception $e) {
                    return redirect()->back()->with('error', [
                        'title' => 'Alerta!',
                        'body' => 'Ocurrio un error con el modelo, al tratar de insertar la informacion de los ingredientes que el cliente no quiere. <br>Excepción capturada:' .  $e->getMessage()
                    ]);
                }
            }
        }
        //return redirect().route_to('view_load_order',$REFERENCE);
        echo $REFERENCE;
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
