<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Throwable;
use Illuminate\Validation\Rule;

/**
 * Controlador de productos
 */
class ProductController extends Controller
{
    /**
     * Vista con el listado de productos (vista de administrador)
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        return view('product.list')
        ->with("products", Product::orderBy('name')->paginate(20))
        ->with("categories", Category::orderBy('name')->get());
    }

    /**
     * Vista de creación de producto
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('product.create')
        ->with("categories", Category::orderBy('name')->get());
    }

    /**
     * Crea un producto a partir del formulario de la petición POST
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function createPost()
    {
        $data = request()->validate([
            'productCategory' => 'required',
            'productName' => ['required', 'unique:products,name'],
            'productDescription' => 'required',
            'productPrice' => ['required', 'min:0'],
            'productStock' => ['required', 'min:0'],
            'productImage' => 'required',
        ], [
            'productCategory.required' => 'El campo categoría es obligatorio',
            'productName.required' => 'El campo nombre es obligatorio',
            'productName.unique' => 'Ya existe un producto con ese nombre',
            'productDescription.required' => 'El campo descripción es obligatorio',
            'productPrice.required' => 'El campo precio es obligatorio',
            'productStock.required' => 'El campo stock es obligatorio',
            'productImage.required' => 'El campo imagen es obligatorio',
        ]);

        Product::create([
            'category_id' => $data['productCategory'],
            'name' => $data['productName'],
            'description' => $data['productDescription'],
            'price' => $data['productPrice'],
            'stock' => $data['productStock'],
            'image' => $data['productImage'],
        ]);

        return redirect()->route('productList');
    }

    /**
     * Vista de edición de producto
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Product $product)
    {
        return view('product.edit')
        ->with("product", $product)
        ->with("categories", Category::orderBy('name')->get());
    }

    /**
     * Edita un producto a partir del formulario de la petición PUT
     * @param \App\Models\Product $product
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function editPut(Product $product)
    {
        $data = request()->validate([
            'productCategory' => 'required',
            'productName' => ['required', Rule::unique('products','name')->ignore($product->id)],
            'productDescription' => 'required',
            'productPrice' => ['required', 'min:0'],
            'productStock' => ['required', 'min:0'],
            'productImage' => 'required',
        ], [
            'productCategory.required' => 'El campo categoría es obligatorio',
            'productName.required' => 'El campo nombre es obligatorio',
            'productName.unique' => 'Ya existe un producto con ese nombre',
            'productDescription.required' => 'El campo descripción es obligatorio',
            'productPrice.required' => 'El campo precio es obligatorio',
            'productStock.required' => 'El campo stock es obligatorio',
            'productImage.required' => 'El campo imagen es obligatorio',
        ]);

        $product->update([
            'category_id' => $data['productCategory'],
            'name' => $data['productName'],
            'description' => $data['productDescription'],
            'price' => $data['productPrice'],
            'stock' => $data['productStock'],
            'image' => $data['productImage'],
        ]);

        return redirect()->route('productList');
    }

    /**
     * Borra un producto a partir de la petición DELETE
     * @param \App\Models\Product $product
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function delete(Product $product){
        try{
            $product->delete();
        }catch(Throwable $e){
            return back()->withErrors([
                'delete' => 'No se ha podido borrar el producto',
            ]);
        }
        
        return redirect()->route('productList');
    }

    /**
     * Vista de listado de productos por categoría (vista de usuario)
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\View\View
     */
    public function listByCategory(Category $category){
        return view('product.listByCategory')
        ->with("category", $category)
        ->with("products", Product::where('category_id','=', $category->id)->orderBy('name')->paginate(20))
        ->with("categories", Category::orderBy('name')->get());
    }
}
