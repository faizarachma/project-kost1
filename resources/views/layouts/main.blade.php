<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Putri Alfia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: white;
        }

        .login-button:hover {
            background-color: #4CAF50;
            /* Ganti dengan warna sesuai keinginan */
            color: white;
            border-color: #4CAF50;
        }

        /* Ubah warna saat ditekan (active) */
        .login-button:active {
            background-color: #3e8e41;
            /* Ganti dengan warna sesuai keinginan */
            color: white;
            border-color: #3e8e41;
        }

        .logo {
            height: 100px;
            /* Ganti sesuai ukuran yang diinginkan */
            width: 100px;
            /* Agar proporsi tetap terjaga */
        }

        .navbar-brand img {
            max-height: 50px;
        }

        nav a.nav-link {
            margin-right: 15px;
        }

        .hero {
            background-image: url('/images/logo.png');
            /* Ubah ke path gambar Anda */
            background-size: cover;
            background-position: center;
            height: 80vh;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .carousel-item {
            height: 70vh;
        }

        .nav-link.active {
            color: #4CAF50 !important;
            font-weight: bold;
            border-bottom: 2px solid #4CAF50;
        }

        section {
            padding: 100px 0;
        }

        html {
            scroll-behavior: smooth;
        }

        .room-img {
            height: 200px;
            object-fit: cover;
        }

        .badge-available {
            background-color: #28a745;
        }

        .badge-occupied {
            background-color: #dc3545;
        }

        .facility-badge {
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container ">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/images/logo1.png" alt="Logo" style="height: 80px; margin-right: 5px;">
                KOST PUTRI ALFIA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#room">Room</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link{{ request()->routeIs('user.history') ? ' active' : '' }}"
                                href="{{ route('user.history') }}"
                                style="{{ request()->routeIs('user.history') ? 'border-bottom: 2px solid #4CAF50;' : '' }}">
                                Booking
                            </a>
                        </li>
                    @endauth
                    <li class="nav-item ms-3">
                        @auth
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>
                                    Hai, {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="#">Profile</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('user.logout') }}" method="POST" id="logout-form"
                                            onsubmit="event.preventDefault(); this.submit(); setTimeout(() => { window.location.href='{{ url('/') }}'; }, 500);">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="btn btn-outline-success login-button rounded-pill px-4 py-2"
                                href="{{ route('auth.user.login') }}" style="border: 2px solid #4CAF50; color: #4CAF50;"
                                onmouseover="this.style.backgroundColor='#4CAF50'; this.style.color='white';"
                                onmouseout="this.style.backgroundColor='white'; this.style.color='#4CAF50';">
                                Login/Register
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer class="text-center py-4" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="/images/logo1.png" alt="Logo" style="height: 100px; margin-right: 5px;">
                        <strong>KOST PUTRI ALFIA</strong>
                    </a>
                    <div class="mt-3" style="text-align: justify;">
                        <p class="mt-3">Kost
                            Putri Alfia adalah tempat tinggal yang nyaman dan aman untuk para wanita. Kami menyediakan
                            fasilitas lengkap dan layanan terbaik untuk kenyamanan Anda.</p>
                        <p>Jalan Sokaraja IV, Purwokerto, Jawa Tengah</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Follow Us</h5>
                    <div class="social-media mt-3">
                        <ul class="list-unstyled d-flex justify-content-center">
                            <li class="mx-2">
                                <a href="https://www.instagram.com/your_instagram" target="_blank">
                                    <i class="bi bi-instagram" style="font-size: 1.5rem; color: #28a745;"></i>
                                </a>
                            </li>
                            <li class="mx-2">
                                <a href="https://wa.me/081234567890" target="_blank">
                                    <i class="bi bi-whatsapp" style="font-size: 1.5rem; color: #28a745;"></i>
                                </a>
                            </li>
                            <li class="mx-2">
                                <a href="https://www.facebook.com/your_facebook" target="_blank">
                                    <i class="bi bi-facebook" style="font-size: 1.5rem; color: #28a745;"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1 text-start">
                    <h5 class="mb-3">Layanan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#cleaning" class="text-decoration-none text-dark">Layanan Kebersihan</a></li>
                        <li><a href="#wifi" class="text-decoration-none text-dark">Wi-Fi Gratis</a></li>
                        <li><a href="#security" class="text-decoration-none text-dark">Keamanan 24 Jam</a></li>
                        <li><a href="#laundry" class="text-decoration-none text-dark">Layanan Laundry</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <p>&copy; 2023 Kost Putri Alfia. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Masukkan JavaScript di sini -->
    <script>
        // Fungsi untuk menandai navbar item yang aktif berdasarkan scroll
        document.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section'); // Ambil semua elemen section
            const navLinks = document.querySelectorAll('.nav-link'); // Ambil semua item navbar

            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150; // Offset agar lebih presisi
                const sectionHeight = section.offsetHeight;
                const scrollY = window.scrollY;

                // Cek apakah scrollY berada di dalam section ini
                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    currentSection = section.getAttribute('id');
                }
            });

            // Update kelas 'active' pada navbar link
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(currentSection)) {
                    link.classList.add('active');
                }
                if (currentSection === 'contact') {
                    document.querySelector('.nav-link[href="#about"]').classList.add('active');
                }
            });
        });
    </script>


</body>

</html>
