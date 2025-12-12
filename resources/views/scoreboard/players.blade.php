@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-user-plus me-2"></i> Input Pemain
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Tambahkan nama pemain yang akan bertanding. Nama tidak boleh duplikat.
                    </p>
                    
                    <!-- Add Player Form -->
                    <form action="/scoreboard/add-player" method="POST" class="mb-4">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" 
                                           name="name" 
                                           class="form-control" 
                                           placeholder="Masukkan nama pemain" 
                                           required
                                           maxlength="50">
                                </div>
                                <small class="text-muted">Maksimal 50 karakter</small>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus-circle me-1"></i> Tambah Pemain
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Players List -->
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list me-2"></i> Daftar Pemain
                                <span class="badge bg-light text-dark float-end">{{ count($players) }} pemain</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(count($players) > 0)
                                <div class="list-group">
                                    @foreach($players as $index => $player)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-user-circle me-2 text-primary"></i>
                                                <strong>{{ $player }}</strong>
                                                <small class="text-muted ms-2">Pemain #{{ $index + 1 }}</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">{{ $index + 1 }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada pemain yang ditambahkan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            @if(count($players) > 0)
                                <form action="/scoreboard/reset" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" 
                                            class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin mereset semua data?')">
                                        <i class="fas fa-trash-alt me-1"></i> Reset Semua
                                    </button>
                                </form>
                            @endif
                        </div>
                        
                        <div>
                            @if(count($players) >= 2)
                                <a href="/scoreboard/setup" class="btn btn-success">
                                    <i class="fas fa-arrow-right me-1"></i> Lanjut ke Setup Game
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Info Box -->
                    @if(count($players) < 2)
                        <div class="alert alert-warning mt-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian!</strong> Minimal 2 pemain diperlukan untuk memulai pertandingan.
                            @if(count($players) == 1)
                                Tambahkan 1 pemain lagi.
                            @else
                                Tambahkan 2 pemain.
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection