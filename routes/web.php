<?php
/*==================================
capturar todos los datos 
=================================*/
use Illuminate\Http\Request;
/*==================================
clase del modelo
=================================*/
use App\Models\Product;

/*==================================
RUTA PARA Autenticarse
=================================*/
Route::middleware('auth')->group(function(){
    /*==================================
RUTA PARA VISTA INDEX
=================================*/
Route::get('products',function(){
    $products=Product::orderBy('created_at','desc')->get();
    return view('products.index', compact('products'));
})->name('products.index');
/*==================================
RUTA PARA VISTA CREATE
=================================*/
route::get('products/create',function(){
    return view('products.create');
})->name('products.name');
/*==================================
RUTA PARA guardar datos
=================================*/
Route::post('products',function(Request $request){
     $request->all() ;
     $newProduct =new Product;
     $newProduct->description =$request->input('description');
     $newProduct->price =$request->input('price');
     $newProduct->save();
     return redirect()->route('products.index')->with('info','Producto creado exitosamente');
})->name('products.store');
/*==================================
RUTA PARA ELIMINAR DATOS 
=================================*/
route::delete('products/{id}', function($id){
    $product = Product::findOrFail($id);
    $product->delete();
    return redirect()->route('products.index')->with('info','Producto Eliminado Correctamente');

})->name('products.destroy');
/*==================================
RUTA PARA Editar DATOS 
=================================*/
Route::get('products/{id}/edit', function($id){
    $product =Product::findOrFail($id);
    return view('products.edit', compact('product'));
})->name('products.edit');
/*==================================
RUTA PARA Editar DATOS y guardarlos
=================================*/
Route::put('/products/{id}',function(Request $request, $id){
    $product =Product::findOrFail($id);
    $product->description =$request->input('description');
    $product->price =$request->input('price');
    $product->save();
    return redirect()->route('products.index')->with('info','Producto se Actualizo Correctamente');
})->name('products.update');
/*==================================
RUTA PARA Autenticarse
=================================*/
});
Auth::routes();




