<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;

class AgendamentoController extends Controller
{
    private $apiKey = 'teste';
    private $baseUrl = 'http://127.0.0.1:8000/api';

    public function index()
    {
        $especialidades = $this->getEspecialidades();
        return view('contato', compact('especialidades'));
    }

    public function getEspecialidades()
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->get("$this->baseUrl/especialidades");

        if (!$response->successful()) {
            return [];
        }

        // Acessa a chave correta:
        return $response->json()['especialidades'] ?? [];
    }

    public function getConvenios()
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->get("$this->baseUrl/convenios");

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Erro ao buscar convênios'], $response->status());
    }

    public function getProcedimentos(Request $request)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post("$this->baseUrl/procedimentos", [
            'convenio_id' => $request->input('convenio_id'),
            'page' => $request->input('page', 1), // envia a página, padrão 1
            'limit' => 20
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Erro ao buscar procedimentos'], $response->status());
    }





    public function getProfissionais($especialidadeId)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->get("$this->baseUrl/profissionais/$especialidadeId");

        return response()->json($response->json());
    }

    public function getDisponibilidades($profissionalId, $especialidadeId, $data)
    {
        $url = "$this->baseUrl/disponibilidades/$profissionalId/$especialidadeId/$data";

        Log::info('🔎 Requisição de Disponibilidade', [
            'url' => $url,
            'params' => [
                'profissionalId' => $profissionalId,
                'especialidadeId' => $especialidadeId,
                'data' => $data
            ]
        ]);

        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey
        ])->get($url);

        Log::info('📥 Resposta da API de Disponibilidade', [
            'status' => $response->status(),
            'body' => $response->json()
        ]);

        return response()->json($response->json());
    }

public function enviar(Request $request)
{
    // Monta os dados no formato esperado
    $dados = [
        [
            "data" => $request->input('data'), // ex: 08/05/2025
            "horario" => $request->input('horario'),
            "paciente" => $request->input('paciente'),
            "paciente_id" => $request->input('paciente_id') ?? null,
            "celular" => $request->input('celular'),
            "matricula" => $request->input('matricula') ?? null,
            "convenio" => (int) $request->input('convenio'),
            "procedimento_id" => $request->input('procedimento_id'),
            "codigo" => $request->input('codigo'),
            "valor_proc" => $request->input('valor_proc'),
            "profissionalId" => (int) $request->input('profissionalId'),
            "especialidadeId" => (int) $request->input('especialidadeId'),
        ]
    ];

    // Loga o JSON exatamente como enviado
    Log::info('JSON enviado para API de agendamento', $dados);

    try {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post("{$this->baseUrl}/agenda", $dados);

        Log::info('Resposta da API de agendamento', [
            'status' => $response->status(),
            'body' => $response->json()
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Agendamento realizado com sucesso!');
        }

        return back()->with('error', 'Erro ao agendar: ' . ($response->json()['message'] ?? 'Erro desconhecido'));
    } catch (\Exception $e) {
        return back()->with('error', 'Erro de conexão com a API: ' . $e->getMessage());
    }
}


}
