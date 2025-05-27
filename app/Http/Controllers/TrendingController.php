<?php

namespace App\Http\Controllers;

use App\Models\Artigos;
use App\Models\ConfiguracaoSite;
use App\Models\Lives;
use App\Models\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrendingController extends Controller
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

    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        // Capitalize the input
        $titulo = ucfirst($request->input('titulo'));
        $link = $request->input('link');
        $imagem = $request->file('imagem');


        if ($imagem && $imagem->isValid()) {
            $filenameWithExt = $imagem->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $imagem->getClientOriginalExtension();
            // Filename to store
            $imageName = $filename . '.' . $extension;

            // Upload Image to the 'public/images/' directory
            $imagem->move(public_path('images/'), $imageName);

            // Create a new user
            $trending = Trending::create([
                'titulo' => $titulo,
                'link' => $link,
                'imagem' => $imageName,
                'user_id' => $user_id,
            ]);
        } else {
            $trending = Trending::create([
                'titulo' => $titulo,
                'link' => $link,
                'user_id' => $user_id,
            ]);
        }

        return redirect()->back()->with('success', 'Trending criado com sucesso')->with('trending', $trending);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $trending = Trending::findOrFail($id);

        // Capitalize the input
        $titulo = ucfirst($request->input('titulo'));
        $link = $request->input('link');
        $imagem = $request->file('imagem');

        if ($imagem && $imagem->isValid()) {
            $filenameWithExt = $imagem->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $imagem->getClientOriginalExtension();
            $imageName = $filename . '.' . $extension;

            // Upload Image to the 'public/images/' directory
            $imagem->move(public_path('images/'), $imageName);

            // Remove the old image if exists
            if ($trending->imagem && file_exists(public_path('images/') . $trending->imagem)) {
                unlink(public_path('images/') . $trending->imagem);
            }

            // Update the user with the new image
            $trending->imagem = $imageName;
        }

        // Update user attributes
        $trending->titulo = $titulo;
        $trending->link = $link;

        // Save the updated user data
        $trending->save();


        return redirect()->back()->with('success', 'Trending atualizado com sucesso')->with('trending', $trending);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontra o artigo
        $trending = Trending::findOrFail($id);

        // Verifica se o usuário logado é o dono do artigo
        // if ($artigo->user_id !== Auth::id()) {
        //     return redirect()->route('artigos.index')->with('error', 'Você não tem permissão para excluir este artigo.');
        // }

        // Remove a imagem associada se existir
        if ($trending->imagem) {
            Storage::delete('public/artigos/' . $trending->imagem);
        }

        // Exclui o artigo
        $trending->delete();

        return redirect()->back()->with('success', 'Trending excluído com sucesso!');

    }
}
