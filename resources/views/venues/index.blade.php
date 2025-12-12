@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Lapangan</h1>
        <div>
            <button class="btn btn-outline-primary me-2">Filter <i class="bi bi-funnel"></i></button>
            <button class="btn btn-primary">Urutkan: Terdekat</button>
        </div>
    </div>

    <!-- Filter Sidebar & Content -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-3">Filter</h5>
                    
                    <!-- Jenis Lapangan -->
                    <div class="mb-4">
                        <h6 class="mb-2">Jenis Lapangan</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="futsal">
                            <label class="form-check-label" for="futsal">Futsal</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="badminton">
                            <label class="form-check-label" for="badminton">Badminton</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="basket">
                            <label class="form-check-label" for="basket">Basket</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="tennis">
                            <label class="form-check-label" for="tennis">Tennis</label>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <h6 class="mb-2">Rentang Harga</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="price" id="price1" checked>
                            <label class="form-check-label" for="price1">Semua Harga</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="price" id="price2">
                            <label class="form-check-label" for="price2">≤ Rp 150.000</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="price" id="price3">
                            <label class="form-check-label" for="price3">Rp 150.000 - 300.000</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="price" id="price4">
                            <label class="form-check-label" for="price4">≥ Rp 300.000</label>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="mb-4">
                        <h6 class="mb-2">Jam Operasional</h6>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            <input type="time" class="form-control" value="08:00">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            <input type="time" class="form-control" value="22:00">
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 mt-3">Terapkan Filter</button>
                </div>
            </div>
        </div>

        <!-- List Lapangan -->
        <div class="col-md-9">
            <div class="row g-4">
                @for($i = 1; $i <= 9; $i++)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-court h-100">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-{{ ['1518609878373','1546519638','1521412644187'][$i%3] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                 class="card-img-top" style="height: 180px; object-fit: cover;" alt="Lapangan {{$i}}">
                            <span class="position-absolute top-0 end-0 m-2 badge {{ $i % 3 == 0 ? 'bg-danger' : 'bg-success' }}">
                                {{ $i % 3 == 0 ? 'Booked' : 'Available' }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="card-title mb-0">Lapangan {{$i}}</h5>
                                    <p class="text-muted mb-0 small">
                                        <i class="bi bi-geo-alt"></i> Area {{ ['Jakarta','Bandung','Surabaya'][$i%3] }}
                                    </p>
                                </div>
                                <span class="badge bg-info">{{ ['Futsal','Badminton','Basket'][$i%3] }}</span>
                            </div>
                            
                            <div class="rating-stars mb-2">
                                @for($j = 1; $j <= 5; $j++)
                                    <i class="bi {{ $j <= rand(3,5) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                                <span class="ms-1 small">({{ rand(35,50)/10 }})</span>
                            </div>
                            
                            <p class="card-text small mb-3">
                                Fasilitas: {{ ['AC, Locker, Toilet','Parkir Luas, Cafe','Lighting LED, Sound System'][$i%3] }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div>
                                    <h5 class="text-primary mb-0">Rp {{ number_format(100000 + ($i * 30000), 0, ',', '.') }}</h5>
                                    <small class="text-muted">per jam</small>
                                </div>
                                <a href="/courts/{{$i}}" class="btn btn-primary">Booking</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection