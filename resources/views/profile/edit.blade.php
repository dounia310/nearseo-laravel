@extends('layouts.app')

@section('title', 'Profil')
@section('header-title', 'Profil')

@section('content')
    <div class="max-w-[1280px] mx-auto">
        <div class="mb-8">
            <p class="text-body text-on-surface-variant">Gérez vos informations personnelles et suivez vos performances SEO.</p>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-7 space-y-4">
                <section class="bg-white border rounded-xl p-6">
                    <h3 class="font-semibold text-lg mb-6">Informations Générales</h3>
                    @include('profile.partials.update-profile-information-form')
                </section>

                <section class="bg-white border rounded-xl p-6">
                    <h3 class="font-semibold text-lg mb-6">Sécurité</h3>
                    @include('profile.partials.update-password-form')
                    @include('profile.partials.delete-user-form')
                </section>
            </div>

            <div class="col-span-12 lg:col-span-5 space-y-4">
                <div class="bg-gray-800 text-white rounded-xl p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/20 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                    <div class="relative z-10">
                        <span class="bg-primary/20 text-primary text-[10px] px-2 py-1 rounded-full uppercase mb-4 inline-block">Votre compte</span>
                        <h3 class="text-2xl font-bold mb-1">{{ auth()->user()->name }}</h3>
                        <p class="text-sm opacity-80 mb-6">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

