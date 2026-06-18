{{-- resources/views/auth/reset-password.blade.php --}}
@extends('layouts.guest')

@section('title', 'Réinitialisation du mot de passe')
@section('header-title', 'Nouveau mot de passe')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-4xl text-primary">password</span>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Nouveau mot de passe
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Créez un nouveau mot de passe pour votre compte.
            </p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Le token est passé via la route -->
            <input type="hidden" name="token" value="{{ $token ?? '' }}">

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Adresse email
                </label>
                <div class="mt-1 relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">email</span>
                    <input id="email" name="email" type="email" required 
                           value="{{ $email ?? old('email') }}"
                           class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                           placeholder="votre@email.com">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Nouveau mot de passe
                </label>
                <div class="mt-1 relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">lock</span>
                    <input id="password" name="password" type="password" required 
                           class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                           placeholder="••••••••">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Confirmer le mot de passe
                </label>
                <div class="mt-1 relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">lock</span>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                           placeholder="••••••••">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all">
                    <span class="material-symbols-outlined text-lg mr-2">save</span>
                    Réinitialiser le mot de passe
                </button>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-primary hover:underline">
                    Retour à la connexion
                </a>
            </div>
        </form>
    </div>
</div>
@endsection