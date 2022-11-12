<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Attribute;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;

class ProductController extends Controller
{

    
    private $product;

    public function __construct(Product $product)
    {
    $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function getData(Request $req)
    {
        return $req ->input();
    }
    public function index(Request $request)
    {
        
        return Product::all();
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $dados=[
            'name' => $request->name,
            'valorUnit' => $request->valorUnit,
            'quantidade' => $request->quantidade,
            'valorDesconto' => $request->valorDesconto,
            'precoCompra'=> ( $request->quantidade * $request->valorUnit ) -(($request->quantidade * $request->valorUnit *$request->valorDesconto) / 100)
            
           
        ];

        for ($i = 0; $i < count((array)$dados['precoCompra']); $i++) { 
            $this->product->create([
                'name' => $request->name,
                'valorUnit' => $request->valorUnit ,
                'quantidade' => $request->quantidade,
                'valorDesconto' => $request->valorDesconto,
                'precoCompra'=> ( $request->quantidade * $request->valorUnit ) -(($request->quantidade * $request->valorUnit *$request->valorDesconto) / 100)

                
            ]);
        } 


        
    // //    $quantidade = 'quantidade';
    // //    $quantidade1= (int)$quantidade;
    // //    $valorUnit='valorUnit';
    // //    $valorUnit1=(int)$valorUnit;
    // //    $valorDesconto='valorDesconto';
    // //    $valorDesconto1=(int)$valorDesconto;
       
    // //    $precoCompra = ($quantidade1 * $valorUnit1) -(($quantidade1 * $valorUnit1 * $valorDesconto1) / 100);
       
    // //    $precoCompra2 = $request->input('precoCompra', $precoCompra);


        

    //     // $request -> validate([
            

            
    //     //     'name'=>'required',
    //     //     'valorUnit'=>'required',
    //     //     'quantidade'=>'required',
    //     //     'valorDesconto'=>'required',
            
            
    //     // ]);

        

        

    // //    $getPrecoCompra= dd($request -> get("precoCompra"
            
    // //     ));

        $posts= (Product::where($dados)->get()); // tentar sem o where e pegar os dados do json //posso trazer qualquer linha específica da tabela product.
        return view('price')->with(compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
