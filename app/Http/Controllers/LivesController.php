<?php

namespace App\Http\Controllers;

use App\Models\Artigos;
use App\Models\ConfiguracaoSite;
use App\Models\Lives;
use App\Models\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LivesController extends Controller
{
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
            $lives = Lives::create([
                'titulo' => $titulo,
                'link' => $link,
                'imagem' => $imageName,
                'user_id' => $user_id,
            ]);
        } else {
            $lives = Lives::create([
                'titulo' => $titulo,
                'link' => $link,
                'user_id' => $user_id,
            ]);
        }

        return redirect()->back()->with('success', 'Lives criado com sucesso')->with('lives', $lives);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $lives = Lives::findOrFail($id);

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
            if ($lives->imagem && file_exists(public_path('images/') . $lives->imagem)) {
                unlink(public_path('images/') . $lives->imagem);
            }

            // Update the user with the new image
            $lives->imagem = $imageName;
        }

        // Update user attributes
        $lives->titulo = $titulo;
        $lives->link = $link;

        // Save the updated user data
        $lives->save();


        return redirect()->back()->with('success', 'Lives atualizado com sucesso')->with('lives', $lives);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontra o artigo
        $lives = Lives::findOrFail($id);

        // Verifica se o usuário logado é o dono do artigo
        // if ($artigo->user_id !== Auth::id()) {
        //     return redirect()->route('artigos.index')->with('error', 'Você não tem permissão para excluir este artigo.');
        // }

        // Remove a imagem associada se existir
        if ($lives->imagem) {
            Storage::delete('public/artigos/' . $lives->imagem);
        }

        // Exclui o artigo
        $lives->delete();

        return redirect()->back()->with('success', 'Lives excluído com sucesso!');

    }
}
