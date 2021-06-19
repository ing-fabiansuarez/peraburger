<?php

namespace App\Controllers;

use App\Models\AdditionproductModel;
use App\Models\DomiciliaryModel;
use App\Models\ProductModel;
use App\Models\RecipeModel;

class Ajax extends BaseController
{
	public function ajaxProductOfCategory()
	{
		$modelProduct = new ProductModel();
		$categories = $modelProduct->where('category_id_category', $this->request->getPostGet('category'))->orderBy('name_product', 'ASC')->findAll();
		$cadena = "";
		foreach ($categories as $category) {
			$cadena = $cadena . '<option value="' . $category['id_product'] . '">' . $category['name_product'] . '</option>';
		}
		echo $cadena . "";
		return true;
	}
	public function ajaxProductRecipe()
	{
		if (empty($product = $this->request->getPostGet('product'))) {
			echo "no pudo acceder";
			return false;
		} else {
			$modelRecipe = new RecipeModel();
			$ingredients = $modelRecipe->getIngredientsOfProduct($product);

			$cadena = "<select class='custom-select' name='ingredients-select' required>
			";
			foreach ($ingredients as $ingredient) {
				$cadena = $cadena . '<option value="' . $ingredient['id_ingredient'] . '">' . $ingredient['name_ingredient'] .' - $ '.number_format($ingredient['price_ingredient']). '</option>';
			}

			echo $cadena . "</select>";
			return true; 
		}
	}

	public function ajaxAdditionsProduct()
	{
		if (empty($product = $this->request->getPostGet('product'))) {
			echo "no pudo acceder";
			return false;
		} else {
			$modelAdditionsProduct = new AdditionproductModel();
			$additions = $modelAdditionsProduct->getAdditionsOfProduct($product);

			$cadena = "<select class='custom-select' name='additions-select' required>
			";
			foreach ($additions as $addition) {
				$cadena = $cadena . '<option value="' . $addition['id_addition'] . '">' . $addition['name_addition'] . ' + $ '.number_format($addition['price_addition']). '</option>';
			}

			echo $cadena . "</select>";
			return true;
		}
	}

	public function ajaxFormTypeShipping()
	{
		$mdlDomi = new DomiciliaryModel();
		$domiciliaries = $mdlDomi->findAll();
		$cadena1 =
			"<div class='row'>
				
				<div class='col-sm-4'>
					<div class='form-group'>
						<label>Nombre *</label>
						<input name='name' type='text' class='form-control' placeholder='Nombre *' required>
					</div>
				</div>
				<div class='col-sm-4'>
					<div class='form-group'>
						<label>Apellido</label>
						<input name='surname' type='text' class='form-control' placeholder='Apellido'>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-3'>
					<div class='form-group'>
						<label>Direcci&oacute;n *</label>
						<input name='adress' type='text' class='form-control' placeholder='Dirección *' required>
					</div>
				</div>
				<div class='col-sm-3'>
					<div class='form-group'>
						<label>Barrio *</label>
						<input name='barrio' type='text' class='form-control' placeholder='Barrio *' required>
					</div>
				</div>
				<div class='col-sm-3'>
					<div class='form-group'>
						<label>Domiciliario</label>
						<select name='domi' class='form-control' required>
						";
		foreach ($domiciliaries as $domiciliary) {
			$cadena1 .= "<option value='" . $domiciliary['id_domiciliary'] . "'>" . $domiciliary['name_domiciliary'] . ' ' . $domiciliary['surname_domiciliary'] . "</option>";
		}

		$cadena1 .= "
						</select>
					</div>
				</div>
				<div class='col-sm-3'>
					<div class='form-group'>
						<label>Valor *</label>
						<input name='price_domi' type='number' class='form-control' placeholder='Valor domi*' required>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-4'>
					<div class='form-group'>
						<label>WhatsApp *</label>

						<div class='input-group'>
							<div class='input-group-prepend'>
								<span class='input-group-text'><i class='fas fa-phone'></i></span>
							</div>
							<input name='whatsapp' type='number' class='form-control' required>
						</div>
					</div>
				
				</div>
				<div class='col-sm-8'>
					<div class='form-group'>
						<label>Observaci&oacute;n</label>
						<textarea name='observation' class='form-control' rows='2' placeholder='Observaciones adicionales ...'></textarea>
					</div>
				</div>
			</div>
			<div class='text-center'>
				<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-default'>
					CREAR PEDIDO
				</button>
			</div>
			<div class='modal fade' id='modal-default'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h4 class='modal-title'>Deseas crear el nuevo pedido?</h4>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
						</div>
						<div class='modal-body'>
							<p><strong>Se creara el nuevo pedido</strong></p>
						</div>
						<div class='modal-footer justify-content-between'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
							<button type='submit' class='btn btn-primary'>Si, crear</button>
						</div>
					</div>
				</div>
			</div>";

		$cadena2 =
			"<div class='row'>
			<div class='col-sm-6'>
				<div class='form-group'>
					<label>Nombre *</label>
					<input name='name' type='text' class='form-control' placeholder='Nombre *' required>
				</div>
			</div>
			<div class='col-sm-6'>
				<div class='form-group'>
					<label>Apellido</label>
					<input name='surname' type='text' class='form-control' placeholder='Apellido'>
				</div>
			</div>
			</div>
			<div class='row'>
				<div class='col-sm-4'>
					<div class='form-group'>
						<label>Turno *</label>
						<input name='turn_machine' type='number' class='form-control' placeholder='Turno' required>
					</div>
				</div>

				<div class='col-sm-8'>
					<div class='form-group'>
						<label>Observaci&oacute;n</label>
						<textarea name='observation' class='form-control' rows='3' placeholder='Observaciones adicionales ...'></textarea>
					</div>
				</div>
			</div>
			<div class='text-center'>
				<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-default'>
					CREAR PEDIDO
				</button>
			</div>
			<div class='modal fade' id='modal-default'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h4 class='modal-title'>Deseas crear el nuevo pedido?</h4>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
						</div>
						<div class='modal-body'>
							<p><strong>Se creara el nuevo pedido</strong></p>
						</div>
						<div class='modal-footer justify-content-between'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
							<button type='submit' class='btn btn-primary'>Si, crear</button>
						</div>
					</div>
				</div>
			</div>";

		switch ($this->request->getPostGet('type')) {
			case 1:
				echo $cadena1;
				break;
			case 2:
				echo $cadena2;
				break;
		}

		return true;
	}
}
