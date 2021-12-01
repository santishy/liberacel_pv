<?php

namespace App\Http\Controllers;

use App\Events\TransactionComplete;
use App\Http\Resources\ProductResource;
use App\Http\Traits\HasTransaction;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;

class ProductController extends Controller
{
    use HasTransaction;
    public function index()
    {
        $this->authorize('view', new Product());
        if (request()->wantsJson()) {
            return ProductResource::collection(Product::with('category')->applyFilters()->paginate(21));
        }
        $categories = Category::all();
        return view('products.index', compact('categories'));
    }
    public function create()
    {
        $this->authorize('create', new Product());

        $categories = Category::all();
        $inventories = Inventory::all('id', 'name');
        return view('products.create', compact('categories', 'inventories'));
    }
    public function store(Request $request)
    {
        $this->authorize('create', new Product());

        $this->validateProduct($request);

        $product = new Product($request->except('image'));

        $product->image = $product->uploadImage();

        $product->save();

        $this->toBuy($product);

        return $product;
    }
    public function toBuy($product = null)
    {
        $this->authorize('create', new Purchase);

        if (empty(request()->inventory_id) || empty(request()->qty))
            return;

        $purchase = Purchase::findOrCreateThePurchase();

        $purchase->addProduct($product->id,$product->distributor_price);

        $this->deleteSessionVariable('purchase_id');

        $purchase->update([
            'status' => 'completed',
            'inventory_id' => request()->inventory_id
        ]);

        TransactionComplete::dispatch($purchase);
    }
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('products.edit', compact('categories', 'product'));
    }
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $this->validateProduct($request);
        $data['image'] = $product->uploadImage();
        $product->update(array_merge($request->except('_method'), $data));
        return ProductResource::make($product);
    }
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        if ($product->purchases()->exists())
            return response()->json(['message' => 'No se puede eliminar, existen compras con este producto.']);
        if ($product->sales()->exists())
            return response()->json(['message' => 'No se puede eliminar, existen ventas con este producto.']);
        return response()->json(['deleted' => $product->delete()]);
    }
    public function validateProduct($request)
    {
        return $request->validate([
            'sku' => $request->id
                ? "unique:products,sku,$request->id|required" : 'unique:products,sku|required',
            'description' => 'required',
            'wholesale_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'distributor_price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|dimensions:min_width=500,min_height=500',
            'qty' => 'numeric|min:1',
            'inventory_id' => 'numeric',
        ], [
            'description.required' => 'La descripción es requerida',
            'sku.required' => 'El SKU es requerido',
            'sku.unique' => 'El SKU ya existe en la base de datos',
            'wholesale_price.required' => 'El precio al por mayor es requerido',
            'wholesale_price.numeric' => 'El precio al por mayor debe ser un valor númerico',
            'retail_price.required' => 'El precio al por menor es requerido',
            'retail_price.numeric' => 'El precio al por menor debe ser un valor númerico',
            'distributor_price.required' => 'El precio distribuidor es requerido',
            'distributor_price.numeric' => 'El precio distribuidor debe ser un valor númerico',
            'category_id.required' => 'La categoría es obligatoría.',
            'category_id.numeric' => 'El identificador de la categoría debe ser numerico.',
            'image.image' => 'El archivo enviado no es una imagén valida.',
            'image.dimensions' => 'El ancho y alto de la imagen como "minimo" debe de ser de 500px ',
            'qty.numeric' => 'El campo cantidad de compra debe ser numerico',
            'qty.min' => 'La cantidad debe ser minimo 1',
        ]);
    }
}
