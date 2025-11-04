<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CadastroConfirmation;

class UserController extends Controller
{
    public function index(Request $request){
        $termo = trim($request->input('busca', ''));
        $checkbox = $request->input('filtro', []);

        // Pega o usuário logado (se tiver)
        $user = auth()->user();

        // Começa a query
        $query = DB::table('vagas');

        // 🔍 Filtro por termo
        if ($termo) {
            $query->where(function ($q) use ($termo) {
                $q->where('empresa', 'like', "%{$termo}%")
                ->orWhere('titulo', 'like', "%{$termo}%")
                ->orWhere('requisitos', 'like', "%{$termo}%");
            });
        }

        // ✅ Filtro por checkbox
        if (!empty($checkbox)) {
            $query->whereIn('tipo', $checkbox);
        }

        // 🧠 Pega o tipo do usuário pelo banco (caso o Auth não tenha carregado)
        if ($user) {
            $userData = DB::table('users')->where('id', $user->id)->first();
        } else {
            $userData = null;
        }

        // 🔒 Filtragem de visibilidade
        if (!$userData || $userData->conta !== 'admin') {
            // Se for aluno ou visitante → só vagas visíveis (visibilidade = 1)
            $query->where('visibilidade', 1);
        }
        // Se for admin → vê tudo (não aplica filtro)

        $vagas = $query->orderBy('empresa')->get();

        return view('mural.index', compact('vagas', 'termo', 'checkbox'));
    }


    public function documento_estagio()
    {
        return view('documento_estagio.index');
    }

    public function informacoes()
    {
        return view('informacoes.index');
    }

    public function pagInit()
    {
        return view('pag_init.index'); // ou qualquer view
    }

    public function cadastrar(Request $request){
        // 1️⃣ Validação dos dados
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'atuacao' => 'required|string|max:255',
            'id_aluno' => 'required|integer',
            'id_vaga' => 'required|integer',
            'curriculo' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'email_vaga' => 'required|email|max:255',  // E-mail do responsável pela vaga
            'responsavel' => 'required|string|max:255', // Nome do responsável pela vaga
        ]);

        // 2️⃣ Variáveis do formulário (dados do responsável pela vaga)
        $emailVaga = $validated['email_vaga'];  // E-mail do responsável pela vaga
        $responsavel = $validated['responsavel'];  // Nome do responsável pela vaga

        // 3️⃣ Upload do arquivo (se existir)
        if ($request->hasFile('curriculo')) {
            $file = $request->file('curriculo');
            $path = $file->store('curriculos', 'public');
            $validated['curriculo'] = $path;
        }

        // 4️⃣ Inserção no banco de dados (apenas os dados do candidato)
        DB::table('inscritos')->insert([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'telefone' => $validated['telefone'],
            'atuacao' => $validated['atuacao'],
            'id_aluno' => $validated['id_aluno'],
            'id_vaga' => $validated['id_vaga'],
            'curriculo' => isset($validated['curriculo']) ? $validated['curriculo'] : null,  // Se o currículo foi enviado
        ]);

        // 5️⃣ Montar a mensagem do e-mail
        $mensagem = "
            <h2>Olá, {$responsavel}!</h2>
            <p>Temos um candidato para a sua vaga, o/a candidato(a) {$validated['nome']}.</p>
            <p>Ele/ela atua na área de {$validated['atuacao']}, por favor, o/a considere para a vaga, obrigado!</p>
            <p>Telefone de contato: {$validated['telefone']}</p>
            <p>E-mail de contato: {$validated['email']}</p>
            <p>Curriculo anexado abaixo!</p>
        ";

        // 6️⃣ Envio de e-mail para o responsável pela vaga
        Mail::html($mensagem, function ($message) use ($emailVaga, $validated) {
            $message->to($emailVaga)  // E-mail do responsável pela vaga
                    ->subject('Confirmação de Cadastro - Novo Candidato');

            // Se o candidato enviou um currículo, anexa o arquivo
            if (!empty($validated['curriculo'])) {
                $message->attach(storage_path('app/public/' . $validated['curriculo']));
            }
        });

        // 7️⃣ Retorna mensagem para o usuário
        return redirect()->back()->with([
            'mensagem' => 'Cadastro realizado com sucesso! Um e-mail foi enviado ao responsável pela vaga.',
            'tipo' => 'alert-success'
        ]);
    }

    public function vaga(Request $request){
        // Validação dos dados
        $validated = $request->validate([
            'empresa' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'responsavel' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'requisitos' => 'required|string|max:255',
            'atividades' => 'required|string|max:255',
            'init_expediente' => 'required|date_format:H:i:s',
            'fim_expediente' => 'required|date_format:H:i:s',
            'beneficios' => 'required|string|max:255',
            'publicacao' => 'required|string',
            'visibilidade' => 'required|in:0,1',
        ], [
            'init_expediente.date_format' => 'O início do expediente deve estar no formato HH:MM:SS.',
            'fim_expediente.date_format' => 'O fim do expediente deve estar no formato HH:MM:SS.',
        ]);

        // Inserir no banco
        DB::table('vagas')->insert($validated);

        return redirect()->back()->with([
            'mensagem' => 'Cadastro realizado com sucesso!',
            'tipo' => 'alert-success'
        ]);
    }


    public function atualizarVaga(Request $request, $id)
    {
        // Validação dos dados
        $validated = $request->validate([
            'empresa' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'responsavel' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'requisitos' => 'required|string|max:255',
            'atividades' => 'required|string|max:255',
            'init_expediente' => 'required|date_format:H:i:s',
            'fim_expediente' => 'required|date_format:H:i:s',
            'beneficios' => 'required|string|max:255',
            'publicacao' => 'required|string',
            'visibilidade' => 'required|in:0,1',
        ], [
            'init_expediente.date_format' => 'O início do expediente deve estar no formato HH:MM:SS.',
            'fim_expediente.date_format' => 'O fim do expediente deve estar no formato HH:MM:SS.',
        ]);

        // Atualizar no banco
        DB::table('vagas')->where('id', $id)->update($validated);

        return redirect()->back()->with([
            'mensagem' => 'Vaga atualizada com sucesso!',
            'tipo' => 'alert-success'
        ]);
    }
    public function excluirVaga(Request $request, $id)
    {
        // Excluir do banco
        DB::table('vagas')->where('id', $id)->delete();

        return redirect()->back()->with([
            'mensagem' => 'Vaga excluída com sucesso!',
            'tipo' => 'alert-success'
        ]);
    }
}
