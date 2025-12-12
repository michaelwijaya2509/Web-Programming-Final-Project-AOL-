@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-cog me-2"></i> Setup Game
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Player List -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2"></i> Pemain Terdaftar ({{ count($players) }})
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($players as $index => $player)
                                    <span class="badge bg-primary p-2" style="font-size: 0.9rem;">
                                        {{ $index + 1 }}. {{ $player }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    @if(count($players) >= 2)
                    <!-- Setup Form -->
                    <form action="/scoreboard/setup" method="POST">
                        @csrf
                        
                        <div class="row mb-4">
                            <!-- Game Type -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-gamepad me-2"></i> Jenis Permainan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="game_type" id="badminton" value="badminton" required checked>
                                            <label class="form-check-label w-100" for="badminton">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-success text-white p-2 rounded me-3">
                                                        <i class="fas fa-badminton fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">🏸 Badminton</h6>
                                                        <small class="text-muted">First to 21 (win by 2), max 30</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="game_type" id="tennis" value="tennis" required>
                                            <label class="form-check-label w-100" for="tennis">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-warning text-white p-2 rounded me-3">
                                                        <i class="fas fa-baseball-ball fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">🎾 Tennis</h6>
                                                        <small class="text-muted">0-15-30-40-deuce system</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="game_type" id="padel" value="padel" required>
                                            <label class="form-check-label w-100" for="padel">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-danger text-white p-2 rounded me-3">
                                                        <i class="fas fa-table-tennis fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">🎾 Padel</h6>
                                                        <small class="text-muted">Set-game system with tiebreak</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Game Mode -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-users me-2"></i> Mode Permainan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="mode" id="single" value="single" required checked>
                                            <label class="form-check-label w-100" for="single">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white p-2 rounded me-3">
                                                        <i class="fas fa-user fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Single</h6>
                                                        <small class="text-muted">1 vs 1 (minimal 2 pemain)</small>
                                                        <div class="text-success">
                                                            <i class="fas fa-check-circle"></i> Tersedia
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mode" id="double" value="double" required 
                                                   @if(count($players) < 4) disabled @endif>
                                            <label class="form-check-label w-100" for="double">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-secondary text-white p-2 rounded me-3">
                                                        <i class="fas fa-users fa-2x"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Double</h6>
                                                        <small class="text-muted">2 vs 2 (minimal 4 pemain)</small>
                                                        @if(count($players) >= 4)
                                                            <div class="text-success">
                                                                <i class="fas fa-check-circle"></i> Tersedia
                                                            </div>
                                                        @else
                                                            <div class="text-danger">
                                                                <i class="fas fa-times-circle"></i> Butuh {{ 4 - count($players) }} pemain lagi
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="/scoreboard" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-play me-1"></i> Mulai Pertandingan
                            </button>
                        </div>
                    </form>
                    @else
                    <!-- Not Enough Players -->
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-circle me-2"></i> Pemain Tidak Cukup!</h5>
                        <p class="mb-3">Butuh minimal 2 pemain untuk memulai pertandingan.</p>
                        <a href="/scoreboard" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Tambah Pemain
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-check-input:checked + label {
    background-color: rgba(13, 110, 253, 0.1);
    border-radius: 8px;
    padding: 10px;
}
.form-check {
    padding-left: 0;
}
.form-check-input {
    margin-left: 0;
    margin-right: 10px;
}
</style>
@endsection