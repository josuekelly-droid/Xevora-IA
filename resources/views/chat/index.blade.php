<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat IA - Xevora IA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-950">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900/80 border-r border-slate-800 flex flex-col hidden md:flex">
            <div class="p-4 border-b border-slate-800">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-lg flex items-center justify-center">
                        <span class="text-sm font-black text-white">X</span>
                    </div>
                    <span class="text-white font-semibold">Xevora IA</span>
                </a>
            </div>

            <div class="p-4">
                <a href="{{ route('chat.index') }}" class="w-full flex items-center justify-center space-x-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl py-3 px-4 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Nouveau Chat</span>
                </a>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-2">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Historique</p>
                @forelse($conversations as $conv)
                    <a href="{{ route('chat.show', $conv->id) }}" class="block p-3 rounded-xl hover:bg-slate-800 transition text-sm text-gray-400 hover:text-white truncate">
                        💬 {{ $conv->title }}
                    </a>
                @empty
                    <p class="text-gray-600 text-sm text-center py-8">Aucune conversation</p>
                @endforelse
            </div>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->plan }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Chat Area -->
        <main class="flex-1 flex flex-col">
            <!-- Top bar -->
            <header class="bg-slate-900/80 border-b border-slate-800 p-4 flex items-center justify-between">
                <h1 class="text-white font-semibold text-lg">💬 Chat IA</h1>
                <div class="flex items-center space-x-3">
                    <span class="text-gray-400 text-sm">{{ Auth::user()->credits }} crédits</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-gray-400 hover:text-white text-sm transition">Déconnexion</button>
                    </form>
                </div>
            </header>

            <!-- Empty state -->
            <div class="flex-1 flex items-center justify-center p-8">
                <div class="text-center max-w-2xl">
                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl shadow-indigo-500/25">
                        <span class="text-5xl font-black text-white">X</span>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-4">Xevora IA Chat</h2>
                    <p class="text-gray-400 text-lg mb-8">
                        Votre assistant IA nouvelle génération. Posez vos questions, obtenez des réponses intelligentes.
                    </p>
                    
                    <!-- Quick start form -->
                    <form action="{{ route('chat.store') }}" method="POST" class="max-w-xl mx-auto">
                        @csrf
                        <div class="relative">
                            <textarea name="message" rows="3" required
                                      class="w-full px-4 py-4 bg-slate-800/50 border border-slate-700 rounded-2xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none resize-none"
                                      placeholder="Écrivez votre message pour commencer..."></textarea>
                            <button type="submit" class="absolute bottom-3 right-3 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl transition flex items-center space-x-2">
                                <span>Envoyer</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <!-- Suggestions -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6">
                        <button onclick="document.querySelector('textarea').value='Explique-moi le machine learning'" class="p-3 bg-slate-800/50 border border-slate-700 rounded-xl text-left text-gray-400 hover:text-white hover:border-slate-600 transition text-sm">
                            💡 Explique-moi le machine learning
                        </button>
                        <button onclick="document.querySelector('textarea').value='Écris un script Python pour...'" class="p-3 bg-slate-800/50 border border-slate-700 rounded-xl text-left text-gray-400 hover:text-white hover:border-slate-600 transition text-sm">
                            🐍 Écris un script Python pour...
                        </button>
                        <button onclick="document.querySelector('textarea').value='Quelles sont les dernières news tech ?'" class="p-3 bg-slate-800/50 border border-slate-700 rounded-xl text-left text-gray-400 hover:text-white hover:border-slate-600 transition text-sm">
                            📰 Quelles sont les dernières news tech ?
                        </button>
                        <button onclick="document.querySelector('textarea').value='Aide-moi à résoudre un problème'" class="p-3 bg-slate-800/50 border border-slate-700 rounded-xl text-left text-gray-400 hover:text-white hover:border-slate-600 transition text-sm">
                            🤔 Aide-moi à résoudre un problème
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>