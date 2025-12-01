<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\KelolaKamar; // Assuming you have a Room model
use App\Models\KelolaPemesanan;
use Illuminate\Support\Facades\Hash;
use App\Models\KelolaPesanan; // Assuming you have a Booking model
use App\Models\pembayaran;


class AuthController extends Controller
{
    public function index(){
        $rooms = KelolaKamar::where('status', 'available')->take(3)->get();
        return view('user.home', compact('rooms'));

    }
    public function showLoginForm()
    {
        return view('auth.user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if the user is an admin
            if ($user->role === 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun admin tidak dapat login di halaman ini.',
                ]);
            }

            return redirect()->route('user.home')->with('success', 'Login berhasil.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }



    public function showRegisterForm()
    {
        return view('auth.user.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Automatically set the role to 'user' for new registrations
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => strtolower(str_replace(' ', '', $request->name)),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => 'user', // Default role
            'tanggal_lahir' => $request->tanggal_lahir,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('auth.user.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function listRoom()
    {

        $rooms = KelolaKamar::paginate(10);

        return view('user.listroom', compact('rooms'));

    }

    public function detailRoom($id)
    {

        $room = KelolaKamar::findOrFail($id);

        return view('user.detailroom', compact('room'));
    }


    public function bookingroom(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        $request->validate([
            'room_id' => 'required|exists:kelola_kamar,id'
        ]);

        $room = KelolaKamar::findOrFail($request->query('room_id'));

        return view('user.booking', [
            'room' => $room,
            'photoUrl' => $room->gambar ? asset('storage/' . $room->gambar) : 'https://via.placeholder.com/800x500?text=No+Image'
        ]);
    }

    public function storeBooking(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'room_id' => 'required|exists:kamar,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'start_date' => 'required|date',
            'total_amount' => 'required|numeric'
        ]);

        // Simpan data booking sementara di session
        $bookingData = [
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'start_date' => $request->start_date,
            'total_amount' => $request->total_amount,
            'status' => 'pending'
        ];

        session()->put('temp_booking', $bookingData);

        // Redirect ke halaman konfirmasi
        return redirect()->route('user.booking.konfirmasi');
    }

    public function showConfirmation()
    {
        if (!session()->has('temp_booking')) {
            return redirect()->route('user.listroom')->with('error', 'Silahkan lakukan booking terlebih dahulu');
        }

        $bookingData = session('temp_booking');
        $room = KelolaKamar::find($bookingData['room_id']);

        return view('user.booking.confirmation', [
            'booking' => $bookingData,
            'room' => $room
        ]);
    }

    public function confirmBooking()
    {
        if (!session()->has('temp_booking')) {
            return redirect()->route('user.listroom')->with('error', 'Silahkan lakukan booking terlebih dahulu');
        }

        $tempBooking = session('temp_booking');

        try {
            $booking = new KelolaPemesanan();
            $booking->user_id = $tempBooking['user_id'];
            $booking->room_id = $tempBooking['room_id'];
            $booking->start_date = $tempBooking['start_date'];
            $booking->total_amount = $tempBooking['total_amount'];
            $booking->status = 'pending';
            $booking->save();

            // Hapus data sementara setelah berhasil disimpan
            session()->forget('temp_booking');

            return redirect()->route('user.payment')->with('success', 'Booking berhasil diproses!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses booking: ' . $e->getMessage());
        }
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk melihat riwayat booking.');
        }

        $user = Auth::user();
        // Ambil data dari model KelolaPemesanan berdasarkan penghuni_id (user id)
        $bookings = \App\Models\KelolaPemesanan::where('penghuni_id', $user->id)->with('kamar')->get();

        return view('user.historybook', compact('bookings'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }


}
