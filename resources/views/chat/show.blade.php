<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $conversation->title }} - Xevora IA</title>
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
                @foreach($conversations as $conv)
                    <a href="{{ route('chat.show', $conv->id) }}" 
                       class="block p-3 rounded-xl transition text-sm truncate {{ $conv->id === $conversation->id ? 'bg-indigo-600/20 text-white' : 'text-gray-400 hover:text-white hover:bg-slate-800' }}">
                        💬 {{ $conv->title }}
                    </a>
                @endforeach
            </div>
        </aside>

        <!-- Chat -->
        <main class="flex-1 flex flex-col">
            <header class="bg-slate-900/80 border-b border-slate-800 p-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </a>
                    <h1 class="text-white font-semibold truncate max-w-md">{{ $conversation->title }}</h1>
                </div>
            </header>

            <!-- Messages -->
            <div class="flex-1 overflow-y-auto p-4 sm:p-8 space-y-6" id="messages-container">
                @foreach($messages as $message)
                    <div class="flex {{ $message->role === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="flex items-start space-x-3 max-w-[80%] {{ $message->role === 'user' ? 'flex-row-reverse space-x-reverse' : '' }}">
                            @if($message->role === 'assistant')
                                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs font-black text-white">X</span>
                                </div>
                            @else
                                <div class="w-8 h-8 bg-slate-700 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="{{ $message->role === 'user' ? 'bg-indigo-600 text-white rounded-2xl rounded-tr-none' : 'bg-slate-800 text-gray-200 rounded-2xl rounded-tl-none' }} px-4 py-3">
                                <p class="text-sm whitespace-pre-wrap">{{ $message->content }}</p>
                                <p class="text-xs mt-2 {{ $message->role === 'user' ? 'text-indigo-200' : 'text-gray-500' }}">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Input -->
            <div class="bg-slate-900/80 border-t border-slate-800 p-4">
                <form action="{{ route('chat.continue', $conversation->id) }}" method="POST">
                    @csrf
                    <div class="relative max-w-4xl mx-auto">
                        <textarea name="message" rows="2" required
                                  class="w-full px-4 py-3 pr-24 bg-slate-800/50 border border-slate-700 rounded-2xl text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none resize-none"
                                  placeholder="Écrivez votre message..."></textarea>
                        <button type="submit" class="absolute bottom-2 right-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl transition flex items-center space-x-2">
                            <span class="hidden sm:inline">Envoyer</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>