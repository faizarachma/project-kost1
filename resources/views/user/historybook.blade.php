<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .badge-booking {
            font-size: 0.85em;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        .booking-card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        .booking-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
            padding-left: 1.5rem;
            border-left: 2px solid #dee2e6;
        }

        .timeline-item:last-child {
            border-left: 0;
        }

        .timeline-item.completed {
            border-left-color: #28a745;
        }

        .timeline-item.cancelled {
            border-left-color: #dc3545;
        }

        .timeline-point {
            position: absolute;
            left: -0.5rem;
            top: 0;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background-color: #6c757d;
        }

        .timeline-item.completed .timeline-point {
            background-color: #28a745;
        }

        .timeline-item.cancelled .timeline-point {
            background-color: #dc3545;
        }

        .timeline-content {
            padding-left: 0.5rem;
        }

        .status-badge {
            font-size: 0.75rem;
        }
    </style>
</head>


<body>

    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-calendar-check me-2"></i>Booking System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-history me-1"></i> History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user me-1"></i> Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}

    <div class="container py-4">
        <h3 class="mb-4 fw-bold">Riwayat Booking</h3>

        {{-- <!-- Filter Section -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h5 class="mb-0">Filter Booking</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari booking...">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#advancedFilter">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Advanced Filter (Collapsed by default) -->
                <div class="collapse mt-3" id="advancedFilter">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Semua Status</option>
                                <option>Pending</option>
                                <option>Completed</option>
                                <option>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary me-2">Terapkan Filter</button>
                        <button class="btn btn-outline-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Booking List -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Daftar Booking Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <!-- Booking Item 1 -->
                    <div class="list-group-item p-4 booking-card">
                        <div class="row align-items-center">
                            <div class="col-md-2 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="badge bg-primary badge-booking">#BK00123</span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">15 Jun 2023</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <h6 class="mb-1">Pijat Relaksasi</h6>
                                <small class="text-muted">Durasi: 60 menit</small>
                            </div>
                            <div class="col-md-2 mb-3 mb-md-0">
                                <span class="badge bg-warning text-dark status-badge">Pending</span>
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Total:</span>
                                    <span class="fw-bold">Rp 150.000</span>
                                </div>
                            </div>
                            <div class="col-md-2 text-md-end">
                                <button class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Item 2 -->
                    <div class="list-group-item p-4 booking-card">
                        <div class="row align-items-center">
                            <div class="col-md-2 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="badge bg-primary badge-booking">#BK00122</span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">14 Jun 2023</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <h6 class="mb-1">Facial Treatment</h6>
                                <small class="text-muted">Paket Premium</small>
                            </div>
                            <div class="col-md-2 mb-3 mb-md-0">
                                <span class="badge bg-success status-badge">Completed</span>
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Total:</span>
                                    <span class="fw-bold">Rp 350.000</span>
                                </div>
                            </div>
                            <div class="col-md-2 text-md-end">
                                <button class="btn btn-sm btn-outline-primary me-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-receipt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Item 3 -->
                    <div class="list-group-item p-4 booking-card">
                        <div class="row align-items-center">
                            <div class="col-md-2 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="badge bg-primary badge-booking">#BK00121</span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">10 Jun 2023</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <h6 class="mb-1">Hair Cut & Styling</h6>
                                <small class="text-muted">Stylist: John Doe</small>
                            </div>
                            <div class="col-md-2 mb-3 mb-md-0">
                                <span class="badge bg-danger status-badge">Cancelled</span>
                            </div>
                            <div class="col-md-3 mb-3 mb-md-0">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Total:</span>
                                    <span class="fw-bold">Rp 120.000</span>
                                </div>
                            </div>
                            <div class="col-md-2 text-md-end">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Detail Modal -->
    <div class="modal fade" id="bookingDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Booking #BK00123</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Informasi Booking</h6>
                            <ul class="list-unstyled">
                                <li><strong>Tanggal Booking:</strong> 15 Juni 2023, 14:30</li>
                                <li><strong>Status:</strong> <span class="badge bg-warning text-dark">Pending</span>
                                </li>
                                <li><strong>Layanan:</strong> Pijat Relaksasi</li>
                                <li><strong>Terapis:</strong> Anna Smith</li>
                                <li><strong>Jadwal:</strong> 16 Juni 2023, 16:00</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Pembayaran</h6>
                            <ul class="list-unstyled">
                                <li><strong>Total Harga:</strong> Rp 150.000</li>
                                <li><strong>Metode Pembayaran:</strong> Transfer Bank</li>
                                <li><strong>Status Pembayaran:</strong> <span
                                        class="badge bg-warning text-dark">Pending</span></li>
                                <li><strong>Batas Pembayaran:</strong> 16 Juni 2023, 12:00</li>
                            </ul>
                        </div>
                    </div>

                    <h6 class="mb-3">Timeline Booking</h6>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-point"></div>
                            <div class="timeline-content">
                                <h6>Booking Dibuat</h6>
                                <p class="text-muted mb-0">15 Juni 2023, 14:30</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-point"></div>
                            <div class="timeline-content">
                                <h6>Menunggu Pembayaran</h6>
                                <p class="text-muted mb-0">Bayar sebelum 16 Juni 2023, 12:00</p>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-warning mt-4">
                        <h6 class="alert-heading">Pembayaran Belum Dilakukan</h6>
                        <p class="mb-2">Silakan selesaikan pembayaran Anda sebelum waktu booking kadaluarsa.</p>
                        <button class="btn btn-sm btn-primary">Bayar Sekarang</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-danger">Batalkan Booking</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Demo functionality for the frontend
        document.addEventListener('DOMContentLoaded', function() {
            // Show detail modal when clicking on view buttons
            const viewButtons = document.querySelectorAll('.btn-outline-primary');
            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = new bootstrap.Modal(document.getElementById(
                        'bookingDetailModal'));
                    modal.show();
                });
            });

            // Toggle active state on pagination
            const paginationItems = document.querySelectorAll('.page-item');
            paginationItems.forEach(item => {
                item.addEventListener('click', function() {
                    paginationItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>
