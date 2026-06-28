<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('user_id', Auth::id())
            ->where('type', 'chat')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        if ($conversation->user_id !== Auth::id()) {
            abort(403);
        }

        $messages = $conversation->messages()->orderBy('created_at')->get();
        $conversations = Conversation::where('user_id', Auth::id())
            ->where('type', 'chat')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('chat.show', compact('conversation', 'messages', 'conversations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:4000',
        ]);

        $user = Auth::user();

        // Créer une nouvelle conversation
        $conversation = Conversation::create([
            'user_id' => $user->id,
            'title' => Str::limit($request->message, 100),
            'model' => 'gpt-4',
            'type' => 'chat',
            'status' => 'active',
        ]);

        // Message utilisateur
        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $request->message,
        ]);

        // Simuler une réponse IA (à remplacer par l'API plus tard)
        $aiResponse = $this->generateAIResponse($request->message);

        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'assistant',
            'content' => $aiResponse,
            'model' => 'gpt-4',
        ]);

        return redirect()->route('chat.show', $conversation->id);
    }

    public function continueChat(Request $request, Conversation $conversation)
    {
        if ($conversation->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:4000',
        ]);

        // Message utilisateur
        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $request->message,
        ]);

        // Simuler une réponse IA
        $aiResponse = $this->generateAIResponse($request->message);

        Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'assistant',
            'content' => $aiResponse,
            'model' => 'gpt-4',
        ]);

        // Mettre à jour la date de la conversation
        $conversation->touch();

        return redirect()->route('chat.show', $conversation->id);
    }

    private function generateAIResponse($message)
    {
        // Simulation d'IA (à remplacer par OpenAI/Claude)
        $responses = [
            "Je comprends votre message. Je suis Xevora IA, votre assistant intelligent. Comment puis-je vous aider davantage ?",
            "Excellente question ! Voici ce que je peux vous dire : je suis en cours de développement et je serai bientôt connecté aux modèles d'IA les plus puissants comme GPT-4 et Claude.",
            "Merci pour votre message ! Xevora IA est conçu pour vous offrir la meilleure expérience d'assistant IA. Restez connecté pour les fonctionnalités avancées !",
            "Je traite votre demande... Actuellement en mode simulation, mais bientôt je serai alimenté par une véritable IA pour des réponses précises et pertinentes.",
            "Intéressant ! Xevora IA pourra bientôt analyser des documents, générer du code, créer des images et bien plus encore. Cette conversation sera sauvegardée."
        ];

        return $responses[array_rand($responses)] . "\n\n> *Mode simulation - L'API IA sera intégrée prochainement.*";
    }
}