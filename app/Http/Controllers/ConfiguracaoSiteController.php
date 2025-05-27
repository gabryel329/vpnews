<?php

namespace App\Http\Controllers;

use App\Models\Artigos;
use App\Models\ConfiguracaoSite;
use App\Models\Lives;
use App\Models\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracaoSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artigos = Artigos::orderBy('created_at', 'desc')->paginate(3); // Mostra 10 artigos por página
        $trending = Trending::orderBy('created_at', 'desc')->paginate(3);
        $lives = Lives::orderBy('created_at', 'desc')->paginate(3);
        $configuracoes = ConfiguracaoSite::where('id', 1)->get();

        return view('home', compact(['artigos', 'trending', 'lives', 'configuracoes']));
    }

    // Salvar nova configuração
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'sobre_roda_pe' => 'nullable|string',
            'nome' => 'nullable|string',
            'textonossotime' => 'nullable|string|max:7',
            'sobre1' => 'nullable|string',
            'sobre1cor' => 'nullable|string|max:7',
            'sobre2' => 'nullable|string',
            'sobre2cor' => 'nullable|string|max:7',
            'telefone' => 'nullable|string',
            'email' => 'nullable|email',
            'localizacao' => 'nullable|string',
            'cor_background' => 'nullable|string|max:7',
            'corhouve' => 'nullable|string|max:7',
        ]);

        $data = $request->except(['icon', 'logo']);

        if ($request->hasFile('icon')) {
            $imagem = $request->file('icon');
            if ($imagem && $imagem->isValid()) {
            $filenameWithExt = $imagem->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $imagem->getClientOriginalExtension();
            $imageName = $filename . '.' . $extension;
            $imagem->move(public_path('images/'), $imageName);
            $data['icon'] = $imageName;
            }
        }

        if ($request->hasFile('logo')) {
            $imagem = $request->file('logo');
            if ($imagem && $imagem->isValid()) {
            $filenameWithExt = $imagem->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $imagem->getClientOriginalExtension();
            $imageName = $filename . '.' . $extension;
            $imagem->move(public_path('images/'), $imageName);
            $data['logo'] = $imageName;
            }
        }

        ConfiguracaoSite::create($data);

        return redirect()->back()->with('success', 'Configuração criada com sucesso.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(ConfiguracaoSite $configuracaoSite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConfiguracaoSite $configuracaoSite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $config = ConfiguracaoSite::findOrFail($id);

    // Validação dos campos
    $request->validate([
        'icon' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        'sobre_roda_pe' => 'nullable|string',
        'textonossotime' => 'nullable|string|max:7',
        'sobre1' => 'nullable|string',
        'nome' => 'nullable|string',
        'sobre1cor' => 'nullable|string|max:7',
        'sobre2' => 'nullable|string',
        'sobre2cor' => 'nullable|string|max:7',
        'telefone' => 'nullable|string',
        'email' => 'nullable|email',
        'localizacao' => 'nullable|string',
        'cor_background' => 'nullable|string|max:7',
        'corhouve' => 'nullable|string|max:7',
    ]);

    // Upload das imagens, se enviadas
    if ($request->hasFile('icon')) {
        $imagem = $request->file('icon');
        if ($imagem && $imagem->isValid()) {
            $filenameWithExt = $imagem->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $imagem->getClientOriginalExtension();
            $imageName = $filename . '.' . $extension;
            $imagem->move(public_path('images/'), $imageName);
            $config->icon = $imageName;
        }
    }

    if ($request->hasFile('logo')) {
        $imagem = $request->file('logo');
        if ($imagem && $imagem->isValid()) {
            $filenameWithExt = $imagem->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $imagem->getClientOriginalExtension();
            $imageName = $filename . '.' . $extension;
            $imagem->move(public_path('images/'), $imageName);
            $config->logo = $imageName;
        }
    }

    // Atualizar os campos
    $config->sobre_roda_pe = $request->input('sobre_roda_pe');
    $config->nome = $request->input('nome');
    $config->textonossotime = $request->input('textonossotime');
    $config->sobre1 = $request->input('sobre1');
    $config->sobre1cor = $request->input('sobre1cor');
    $config->sobre2 = $request->input('sobre2');
    $config->sobre2cor = $request->input('sobre2cor');
    $config->telefone = $request->input('telefone');
    $config->email = $request->input('email');
    $config->localizacao = $request->input('localizacao');
    $config->cor_background = $request->input('cor_background');
    $config->corhouve = $request->input('corhouve');

    $config->save();

    return redirect()->back()->with('success', 'Configurações atualizadas com sucesso.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $config = ConfiguracaoSite::findOrFail($id);

    // Excluir os arquivos de imagem associados, se existirem
    if ($config->icon) {
        Storage::delete('public/images/' . $config->icon);
    }

    if ($config->logo) {
        Storage::delete('public/images/' . $config->logo);
    }

    // Deleta o registro
    $config->delete();

    return redirect()->back()->with('success', 'Configuração excluída com sucesso.');
}
}
