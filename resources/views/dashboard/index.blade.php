<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Xevora IA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-slate-950">
    <!-- Navigation -->
    <nav class="bg-slate-900/80 backdrop-blur-xl border-b border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/25">
                        <span class="text-xl font-black text-white">X</span>
                    </div>
                    <h1 class="text-xl font-bold text-white hidden sm:block">
                        Xevora<span class="text-indigo-400"> IA</span>
                    </h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-400 hidden sm:block">{{ Auth::user()->name }}</span>
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-slate-800 rounded-xl transition">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero -->
        <div class="relative bg-gradient-to-br from-indigo-600/10 via-violet-600/10 to-indigo-600/10 rounded-3xl p-8 sm:p-12 mb-8 border border-slate-800 overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
            <div class="relative text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-3xl shadow-xl shadow-indigo-500/25 mb-6">
                    <span class="text-4xl font-black text-white">X</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-bold text-white mb-4">
                    Bienvenue sur <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">Xevora IA</span>
                </h2>
                <p class="text-gray-400 text-lg sm:text-xl max-w-2xl mx-auto">
                    L'assistant IA nouvelle génération. Chat, images, trading, code - tout est là.
                </p>
            </div>
        </div>

                <!-- Features -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('chat.index') }}" class="bg-slate-900/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-800 hover:border-indigo-500/50 transition-all duration-300 group hover:scale-[1.02] block">
                <div class="w-12 h-12 bg-indigo-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-2xl">💬</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Chat IA</h3>
                <p class="text-gray-500 text-sm">Conversations intelligentes avec les meilleurs modèles.</p>
            </a>
            <a href="#" class="bg-slate-900/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-800 hover:border-violet-500/50 transition-all duration-300 group hover:scale-[1.02] block">
                <div class="w-12 h-12 bg-violet-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-2xl">🎨</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Images IA</h3>
                <p class="text-gray-500 text-sm">Générez des visuels, affiches et logos en un clic.</p>
            </a>
            <a href="#" class="bg-slate-900/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-800 hover:border-emerald-500/50 transition-all duration-300 group hover:scale-[1.02] block">
                <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-2xl">📈</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Trading</h3>
                <p class="text-gray-500 text-sm">Analyse technique et recommandations en temps réel.</p>
            </a>
            <a href="#" class="bg-slate-900/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-800 hover:border-amber-500/50 transition-all duration-300 group hover:scale-[1.02] block">
                <div class="w-12 h-12 bg-amber-500/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition">
                    <span class="text-2xl">💻</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Code</h3>
                <p class="text-gray-500 text-sm">Développement assisté et génération de code.</p>
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-slate-900/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-800 text-center">
                <p class="text-gray-500 text-sm mb-2">Crédits</p>
                <p class="text-3xl font-bold text-white">{{ Auth::user()->credits }}</p>
            </div>
            <div class="bg-slate-900/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-800 text-center">
                <p class="text-gray-500 text-sm mb-2">Conversations</p>
                <p class="text-3xl font-bold text-white">0</p>
            </div>
            <div class="bg-slate-900/50 backdrop-blur-sm rounded-2xl p-6 border border-slate-800 text-center">
                <p class="text-gray-500 text-sm mb-2">Plan</p>
                <p class="text-3xl font-bold text-white capitalize">{{ Auth::user()->plan }}</p>
            </div>
        </div>
    </main>
</body>
</html>