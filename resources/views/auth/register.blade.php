<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Xevora IA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-950 via-violet-950 to-slate-950 flex items-center justify-center p-4">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-violet-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-violet-500 via-purple-500 to-indigo-600 rounded-3xl shadow-2xl shadow-violet-500/25 mb-6">
                <span class="text-5xl font-black text-white tracking-tight">X</span>
            </div>
            <h1 class="text-4xl font-bold text-white tracking-tight">
                Xevora<span class="text-violet-400"> IA</span>
            </h1>
            <p class="text-gray-400 mt-2 text-lg">Rejoignez la révolution de l'IA</p>
        </div>

        <div class="bg-slate-900/60 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-700/50 p-8">
            <h2 class="text-xl font-semibold text-white mb-6 text-center">Créez votre compte</h2>
            
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-4 rounded-xl mb-6">
                    @foreach ($errors->all() as $error)
                        <p class="flex items-start space-x-2">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $error }}</span>
                        </p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-gray-500 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none transition"
                           placeholder="John Doe">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Adresse email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-gray-500 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none transition"
                           placeholder="vous@exemple.com">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-gray-500 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none transition"
                           placeholder="Minimum 8 caractères">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-gray-500 focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 focus:outline-none transition"
                           placeholder="Répétez le mot de passe">
                </div>

                <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-violet-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:ring-offset-slate-900 transform hover:scale-[1.02] transition-all duration-200 shadow-lg shadow-violet-500/25 mt-6">
                    Créer mon compte
                </button>
            </form>

            <div class="mt-6 text-center">
                <span class="text-gray-400">Déjà un compte ?</span>
                <a href="{{ route('login') }}" class="ml-1 text-violet-400 hover:text-violet-300 font-medium transition">Connectez-vous</a>
            </div>
        </div>

        <p class="text-center text-gray-600 text-sm mt-6">
            © 2026 Xevora IA • Propulsé par KJA Studio Labs
        </p>
    </div>
</body>
</html>