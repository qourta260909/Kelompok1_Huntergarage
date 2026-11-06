@extends('layouts.admin')

@section('title', 'Profil')

@section('content')
    <header class="page-heading">
        <div>
            <h1>Profil admin</h1>
            <p>Informasi akun yang sedang digunakan untuk mengelola Hunter Garage.</p>
        </div>
        <a class="button-primary" href="{{ route('profile.edit') }}">
            <svg aria-hidden="true" viewBox="0 0 24 24"><path d="m15 5 4 4M4 20l4-.8L19 8a2.1 2.1 0 0 0-3-3L5 16z"/></svg>
            Ubah profil
        </a>
    </header>

    <section class="panel profile-card">
        <div class="profile-identity">
            <span class="profile-avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
            <h2>{{ auth()->user()->name }}</h2>
            <p>{{ auth()->user()->email }}</p>
            <span class="status-badge status-new">Administrator</span>
        </div>
        <div class="profile-details">
            <div class="profile-field">
                <span>Nama lengkap</span>
                <strong>{{ auth()->user()->name }}</strong>
            </div>
            <div class="profile-field">
                <span>Alamat email</span>
                <strong>{{ auth()->user()->email }}</strong>
            </div>
            <div class="profile-field">
                <span>Peran akun</span>
                <strong>Administrator</strong>
            </div>
            <div class="profile-field">
                <span>Akun dibuat</span>
                <strong>{{ auth()->user()->created_at?->locale('id')->translatedFormat('d M Y') ?? '—' }}</strong>
            </div>
        </div>
    </section>
@endsection
