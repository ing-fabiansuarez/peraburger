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
				$cadena = $cadena . '<option value="' . $ingredient['id_ingredient'] . '">' . $ingredient['name_ingredient'] . '</option>';
			}

			echo $cadena . "</select>";
			return true;
		}
	}
}
