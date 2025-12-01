<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .payment-method {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .qris-code {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin: 15px 0;
        }

        .bank-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .btn-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn-upload input[type=file] {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
            font-size: 100px;
        }

        .preview-image {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            display: none;
        }

        .tab-content {
            padding: 15px 0;
        }

        .countdown-timer {
            background-color: #fff8e1;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            border-left: 4px solid #ffc107;
        }

        .countdown-text {
            font-weight: bold;
            color: #d32f2f;
        }

        .payment-time {
            font-size: 0.9em;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container payment-container">
        <h2 class="text-center mb-4">Konfirmasi Pembayaran</h2>

        <div class="alert alert-info">
            Silakan lakukan pembayaran dan unggah bukti transfer untuk proses verifikasi.
        </div>

        <div class="countdown-timer">
            <p class="mb-1">Selesaikan pembayaran dalam:</p>
            <p class="countdown-text" id="countdown">23:59:59</p>
            <p class="payment-time">Pembayaran berlaku hingga <span id="expiry-time">17 Mei 2023, 23:59 WIB</span></p>
        </div>

        <div class="payment-method">
            <h5>Total Pembayaran</h5>
            <h3 class="text-primary">Rp 1.250.000,-</h3>
            <p class="text-muted">No. Booking: INV-20230517-001</p>
            <p class="payment-time">Dibuat pada: 17 Mei 2023, 12:30 WIB</p>

            <hr>

            <ul class="nav nav-tabs" id="paymentTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank"
                        type="button" role="tab">Transfer Bank</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="qris-tab" data-bs-toggle="tab" data-bs-target="#qris" type="button"
                        role="tab">QRIS</button>
                </li>
            </ul>

            <div class="tab-content" id="paymentTabsContent">
                <div class="tab-pane fade show active" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                    <div class="bank-details">
                        <h5>Bank BCA</h5>
                        <p>No. Rekening: <strong>123 456 7890</strong></p>
                        <p>Atas Nama: <strong>PT. Contoh Pembayaran</strong></p>
                        <p class="text-danger">Harap transfer tepat sampai 3 digit terakhir</p>
                    </div>

                    <div class="bank-details">
                        <h5>Bank Mandiri</h5>
                        <p>No. Rekening: <strong>987 654 3210</strong></p>
                        <p>Atas Nama: <strong>PT. Contoh Pembayaran</strong></p>
                        <p class="text-danger">Harap transfer tepat sampai 3 digit terakhir</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="qris" role="tabpanel" aria-labelledby="qris-tab">
                    <div class="qris-code">
                        <h5>Scan QRIS untuk Pembayaran</h5>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=INV-20230517-001"
                            alt="QR Code Pembayaran" class="img-fluid mb-3">
                        <p class="text-muted">Gunakan aplikasi mobile banking atau e-wallet untuk scan QR code ini</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="payment-confirmation">
            <h5 class="mb-3">Upload Bukti Pembayaran</h5>

            <form id="paymentForm">
                <div class="mb-3">
                    <label for="bankSelect" class="form-label">Bank Tujuan</label>
                    <select class="form-select" id="bankSelect" required>
                        <option value="" selected disabled>Pilih Bank Tujuan</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="senderName" class="form-label">Nama Pengirim</label>
                    <input type="text" class="form-control" id="senderName"
                        placeholder="Nama sesuai rekening pengirim" required>
                </div>

                <div class="mb-3">
                    <label for="paymentAmount" class="form-label">Jumlah Transfer</label>
                    <input type="number" class="form-control" id="paymentAmount" placeholder="Masukkan jumlah transfer"
                        required>
                </div>

                <div class="mb-3">
                    <label for="paymentDate" class="form-label">Tanggal Transfer</label>
                    <input type="datetime-local" class="form-control" id="paymentDate" required>
                </div>

                <div class="mb-3">
                    <label for="paymentProof" class="form-label">Bukti Transfer</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary btn-upload">
                            Pilih File
                            <input type="file" id="paymentProof" accept="image/*,.pdf" required>
                        </button>
                        <input type="text" class="form-control" placeholder="File bukti transfer" disabled
                            id="fileLabel">
                    </div>
                    <small class="text-muted">Format: JPG, PNG, atau PDF (maks. 2MB)</small>
                    <img id="imagePreview" class="preview-image img-thumbnail preview-image">
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="confirmCheck" required>
                    <label class="form-check-label" for="confirmCheck">Saya telah melakukan transfer sesuai dengan
                        nominal dan detail di atas</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set waktu kedaluwarsa (24 jam dari sekarang)
        const expiryTime = new Date();
        expiryTime.setHours(expiryTime.getHours() + 24);

        // Format waktu kedaluwarsa untuk ditampilkan
        document.getElementById('expiry-time').textContent =
            expiryTime.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                timeZone: 'Asia/Jakarta',
                timeZoneName: 'short'
            });

        // Countdown timer
        function updateCountdown() {
            const now = new Date();
            const diff = expiryTime - now;

            if (diff <= 0) {
                document.getElementById('countdown').textContent = "00:00:00";
                document.getElementById('countdown').className = "countdown-text text-danger";
                return;
            }

            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000;

                document.getElementById('countdown').textContent =
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            // Update countdown setiap detik
            setInterval(updateCountdown, 1000);
            updateCountdown(); // Panggil sekali saat pertama kali load

            // Preview image sebelum upload
            document.getElementById('paymentProof').addEventListener('change', function(e) {
                const fileLabel = document.getElementById('fileLabel');
                const imagePreview = document.getElementById('imagePreview');

                if (this.files && this.files[0]) {
                    fileLabel.value = this.files[0].name;

                    // Jika file adalah gambar, tampilkan preview
                    if (this.files[0].type.match('image.*')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            imagePreview.style.display = 'block';
                            imagePreview.src = e.target.result;
                        }

                        reader.readAsDataURL(this.files[0]);
                    } else {
                        imagePreview.style.display = 'none';
                    }
                }
            });

            // Form submission
            document.getElementById('paymentForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Validasi form
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    this.classList.add('was-validated');
                    return;
                }

                // Simulasi pengiriman data
                alert('Bukti pembayaran berhasil dikirim. Terima kasih!');
                // Di sini biasanya akan ada AJAX request ke backend

                // Reset form
                this.reset();
                document.getElementById('imagePreview').style.display = 'none';
                this.classList.remove('was-validated');
            });
    </script>
</body>

</html>
