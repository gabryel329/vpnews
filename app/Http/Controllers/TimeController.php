<?php

namespace App\Http\Controllers;

use App\Models\Artigos;
use App\Models\ConfiguracaoSite;
use App\Models\Lives;
use App\Models\Time;
use App\Models\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TimeController extends Controller
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
        $times = Time::orderBy('created_at', 'desc')->paginate(3);
        return view('home', compact(['artigos', 'trending', 'lives', 'configuracoes', 'times']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // Capitalize the input
        $nome = ucfirst($request->input('nome'));
        $obs = $request->input('obs');
        $foto = $request->file('foto');


        if ($foto && $foto->isValid()) {
            $filenameWithExt = $foto->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $foto->getClientOriginalExtension();
            // Filename to store
            $imageName = $filename . '.' . $extension;

            // Upload Image to the 'public/images/' directory
            $foto->move(public_path('images/'), $imageName);

            // Create a new user
            $time = Time::create([
                'nome' => $nome,
                'obs' => $obs,
                'foto' => $imageName,
            ]);
        } else {
            $time = Time::create([
                'nome' => $nome,
                'obs' => $obs,
            ]);
        }

        return redirect()->back()->with('success', 'Colaborador criado com sucesso')->with('time', $time);
    }

    public function update(Request $request, $id)
    {
        // Find the user by ID
        $time = Time::findOrFail($id);

        // Capitalize the input
        $nome = ucfirst($request->input('nome'));
        $obs = $request->input('obs');
        $foto = $request->file('foto');

        if ($foto && $foto->isValid()) {
            $filenameWithExt = $foto->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $foto->getClientOriginalExtension();
            $imageName = $filename . '.' . $extension;

            // Upload Image to the 'public/images/' directory
            $foto->move(public_path('images/'), $imageName);

            // Remove the old image if exists
            if ($time->foto && file_exists(public_path('images/') . $time->foto)) {
                unlink(public_path('images/') . $time->foto);
            }

            // Update the user with the new image
            $time->foto = $imageName;
        }

        // Update user attributes
        $time->nome = $nome;
        $time->obs = $obs;

        // Save the updated user data
        $time->save();


        return redirect()->back()->with('success', 'Colaborador atualizado com sucesso')->with('time', $time);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontra o artigo
        $time = Time::findOrFail($id);

        // Verifica se o usuário logado é o dono do artigo
        // if ($artigo->user_id !== Auth::id()) {
        //     return redirect()->route('artigos.index')->with('error', 'Você não tem permissão para excluir este artigo.');
        // }

        // Remove a imagem associada se existir
        if ($time->imagem) {
            Storage::delete('public/artigos/' . $time->imagem);
        }

        // Exclui o artigo
        $time->delete();

        return redirect()->back()->with('success', 'Colaborador excluído com sucesso!');

    }
}
