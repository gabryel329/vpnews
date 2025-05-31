<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class AgendamentoController extends Controller
{
    private $apiKey;
    private $baseUrl;

     public function __construct()
    {
        $this->apiKey = env('API_KEY');
        $this->baseUrl = rtrim(env('API_URL'), '/'); // remove / final se tiver
    }

    public function index()
    {
        $especialidades = $this->getEspecialidades();
        return view('agenda', compact('especialidades'));
    }

    public function getEspecialidades()
    {
        try {
            $client = new Client();

            $response = $client->get("{$this->baseUrl}/especialidades", [
                'headers' => [
                    'X-API-KEY' => $this->apiKey,
                    'Accept' => 'application/json',
                ],
                'http_errors' => false, // não lançar exceção automática
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['especialidades'] ?? [];
        } catch (\Exception $e) {
            Log::error('Erro ao acessar API de especialidades: ' . $e->getMessage());
            return [];
        }
    }

    public function getConvenios()
    {
        try {
            $client = new \GuzzleHttp\Client();

            $response = $client->get("{$this->baseUrl}/convenios", [
                'headers' => [
                    'X-API-KEY' => $this->apiKey,
                    'Accept' => 'application/json',
                ],
                'http_errors' => false,
            ]);

            $data = json_decode($response->getBody(), true);

            return response()->json([
                'convenios' => $data['convenios'] ?? []
            ]);

        } catch (\Exception $e) {
            Log::error("Erro ao buscar convênios: " . $e->getMessage());
            return response()->json(['convenios' => []], 500);
        }
    }


    public function getProcedimentos(Request $request)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->get("$this->baseUrl/procedimentos", [
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
            "procedimento_id" => $request->input('procedimento_nome'),
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
