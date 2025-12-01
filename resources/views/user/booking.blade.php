<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #1b5e20;
            --accent-color: #4caf50;
            --light-bg: #f8f9fa;
            --light-green: #e8f5e9;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }

        .room-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .room-number {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-outline-secondary {
            border-radius: 8px;
            padding: 10px 25px;
        }

        .payment-option {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
            cursor: pointer;
            background-color: var(--light-green);
        }

        .payment-option:hover {
            border-color: var(--accent-color);
            transform: translateY(-3px);
        }

        .payment-option.active {
            border-color: var(--primary-color);
            background-color: rgba(46, 125, 50, 0.1);
        }

        .bank-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-right: 10px;
        }

        .total-cost {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }

        /* Tambahan untuk responsif */
        @media (max-width: 576px) {
            .room-number {
                font-size: 2rem;
            }

            .total-cost {
                font-size: 1.5rem;
            }
        }

        /* Payment Instruction Styles */
        .payment-instruction {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-color);
        }

        .bank-account {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('user.booking.store') }}" id="bookingForm" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <div class="card mb-4">
                        <div class="card-header text-center">
                            <h1 class="room-number mb-0">
                                Kamar No. <span id="roomNumber">{{ $room->no_kamar ?? 'N/A' }}</span>
                            </h1>
                            <p class="mb-0">Kost Alifia</p>
                        </div>

                        <img src="{{ $photoUrl }}" class="room-image" alt="Kamar Kost {{ $room->no_kamar ?? '' }}"
                            onerror="this.onerror=null;this.src='https://via.placeholder.com/800x500?text=Image+Not+Found'">

                        <div class="card-body p-4">
                            <!-- Data Pemesan Section -->
                            <div class="mb-4">
                                <h5 class="mb-3" style="color: var(--primary-color);">
                                    <i class="fas fa-user-circle me-2"></i> Data Pemesan
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                value="{{ Auth::user()->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ Auth::user()->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp" class="form-label">No. HP/WhatsApp</label>
                                            <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                                value="{{ Auth::user()->no_hp ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ Auth::user()->alamat ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Room Info Section -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-users me-3"
                                            style="color: var(--primary-color); font-size: 1.25rem;"></i>
                                        <div>
                                            <p class="mb-0 text-muted small">Jumlah Penghuni</p>
                                            <h5 class="mb-0">1 Orang</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-calendar-alt me-3"
                                            style="color: var(--primary-color); font-size: 1.25rem;"></i>
                                        <div>
                                            <p class="mb-0 text-muted small">Tanggal Mulai Sewa</p>
                                            <input type="text" class="form-control datepicker" id="startDate"
                                                name="start_date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 p-4 rounded-3" style="background-color: var(--light-green);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">Total Biaya Sewa:</h5>
                                        <small class="text-muted">(1 bulan x Rp
                                            {{ number_format($room->harga, 0, ',', '.') }})</small>
                                    </div>
                                    <div class="total-cost" id="totalCost">
                                        Rp {{ number_format($room->harga, 0, ',', '.') }}
                                    </div>
                                    <input type="hidden" name="total_amount" value="{{ $room->harga }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between pt-3">
                                <a href="{{ route('user.listroom') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i> Kembali
                                </a>
                                <a href="{{ route('user.booking.konfirmasi') }}" class="btn btn-primary"
                                    id="submitButton">
                                    <i class="fas fa-paper-plane me-2"></i> Booking Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. Pembayaran</h6>
                    <p>Pembayaran harus dilakukan dalam waktu 24 jam setelah pemesanan.</p>

                    <h6>2. Konfirmasi Pembayaran</h6>
                    <p>Setelah mengupload bukti pembayaran, admin akan memverifikasi dalam waktu 1x24 jam.</p>

                    <h6>3. Pembatalan</h6>
                    <p>Pembatalan dapat dilakukan maksimal 3 hari sebelum tanggal check-in.</p>

                    <h6>4. Kebijakan Pengembalian</h6>
                    <p>Tidak ada pengembalian dana setelah check-in.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        // Initialize date pickers
        flatpickr(".datepicker", {
            locale: "id",
            dateFormat: "d F Y",
            defaultDate: "today",
            minDate: "today"
        });

        // Form submission handler
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submitButton');
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
            submitButton.disabled = true;
        });
    </script>
</body>

</html>
