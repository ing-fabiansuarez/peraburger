<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\RecipeModel;

class Product extends BaseController
{
	public function ajaxProductOfCategory()
	{
		$modelProduct = new ProductModel();
		$categories = $modelProduct->where('category_id_category', $this->request->getPostGet('category'))->orderBy('name_product', 'ASC')->findAll();
		$cadena = "<select class='custom-select' name='city' required>
        ";
		foreach ($categories as $category) {
			$cadena = $cadena . '<option value="' . $category['id_product'] . '">' . $category['name_product'] . '</option>';
		}
		echo $cadena . "</select>";
		return true;
	}
	public function ajaxProductRecipe()
	{
		$modelRecipe = new RecipeModel();
		$categories = $modelRecipe->where('category_id_category', $this->request->getPostGet('category'))->orderBy('name_product', 'ASC')->findAll();
		$cadena = "<select class='custom-select' name='city' required>
        ";
		foreach ($categories as $category) {
			$cadena = $cadena . '<option value="' . $category['id_product'] . '">' . $category['name_product'] . '</option>';
		}
		echo $cadena . "</select>";
		return true;
	}
}
