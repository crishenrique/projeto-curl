<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Artigo;


class CapturarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('capturar');
    }

    public function storecarros(Request $request){
        $dados = $request->all();
        $searches = array();
        $searchesImgs = array();
        $searchesTituloLink = array();
        $searchesListDados = array();
        $searchesPrecos = array();
        $dadosCarros = array();


        if(isset($dados['textoDigitado']) && !empty($dados['textoDigitado'])){
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.questmultimarcas.com.br/estoque?termo='.$dados['textoDigitado']);
            // SSL important
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $html = curl_exec($ch);
            curl_close($ch);


            if(preg_match_all('/<article class="card clearfix" id="\s*(.*)\s*">/', $html,$searches)){
                foreach($searches[1] as $item){
                    $dadosCarros[]['id_carro'] = $item;
                }
            }

            preg_match_all('/<div class="card__img">\s*<a href="\s*(.*)\s*">\s*< *img[^>]*src *= *["\']?([^"\']*)/i', $html,$searchesImgs);


            preg_match_all('/<h2 class="card__title ui-title-inner">\s*<a href="\s*(.*)\s*">\s*(.*)\s*<\/a><\/h2>/', $html,$searchesTituloLink);



            preg_match_all('/<span class="card-list__title">\s*(.*)\s*<\/span>\s*<span class="card-list__info">\s*(.*)\s*<\/span>/', $html,$searchesListDados);

            preg_match_all('/<span class="card__price-number">\s*(.*)\s*<\/span>/', $html,$searchesPrecos);



            $cont = 0;
            $countCarros = count($dadosCarros);


            for($i = 0; $i < $countCarros; $i++){

                $dadosCarros[$i]['id_usuario'] = Auth::user()->id;
                $dadosCarros[$i]['img'] = $searchesImgs[2][$i];

                $dadosCarros[$i]['link'] = $searchesTituloLink[1][$i];
                $dadosCarros[$i]['nome_veiculo'] = $searchesTituloLink[2][$i];

                for($j = 0; $j < 6; $j++){

                    $info = explode(': ', $searchesListDados[1][$cont]);

                    $dadosCarros[$i][removeAcento($info[0])] = $searchesListDados[2][$cont];

                    unset($searchesListDados[1][$cont]);
                    unset($searchesListDados[2][$cont]);
                    $cont++;
                }

                $preco = explode('036; ', $searchesPrecos[1][$i]);
                $dadosCarros[$i]['preco'] = strip_tags($preco[1]);


            }

            foreach($dadosCarros as $carro){
                $newArtigo = Artigo::create($carro);
            }



             return response()->json(true);
        }

        return response()->json(false);

    }

    public function destroy(Request $request, $id){

        $artigo = Artigo::findOrFail($id);

        if($artigo){
            $artigo->delete();
            return redirect()->route('home')->with('success', 'O Artigo foi removido!!!');
        }

        return redirect()->route('home')->with('error', 'Não foi possível deletar este artigo!!!');

    }

}
