<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - PB Sahaja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#fafafa] text-[#222222] antialiased">

    {{-- Nav --}}
    <nav class="bg-white border-b border-[#dddddd] h-20 flex items-center justify-between px-6 md:px-12 sticky top-0 z-50">
        <div class="flex items-center gap-10">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-[#ff385c]">PB SAHAJA</a>
            <a href="{{ route('home') }}" class="text-sm font-semibold text-[#6a6a6a] hover:text-[#ff385c] transition-colors">&larr; Ke Beranda</a>
        </div>
        <div class="flex items-center gap-3">
            <span class="hidden sm:inline text-sm font-medium text-[#6a6a6a]">{{ Auth::user()->name }}</span>
            @if (Auth::user()->isAdmin())
                <a href="/admin" class="text-sm font-semibold text-white bg-[#222222] rounded-full px-4 py-2 hover:bg-black transition-colors">Admin</a>
            @else
                <a href="{{ route('profile') }}" class="text-sm font-semibold text-white bg-[#ff385c] rounded-full px-4 py-2 hover:bg-[#e00b41] transition-colors">Profile</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-semibold text-[#6a6a6a] border border-[#dddddd] rounded-full px-4 py-2 hover:bg-[#f7f7f7] transition-colors">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Profile Header --}}
        <div class="bg-white rounded-[14px] border border-[#ebebeb] p-6 mb-6 shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px]">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-full bg-[#ff385c] flex items-center justify-center text-white text-2xl font-bold overflow-hidden">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-[#222222]">{{ $user->name }}</h1>
                    <p class="text-sm text-[#6a6a6a] mt-1">{{ $user->email }}</p>
                    <span class="inline-block mt-2 text-xs font-semibold px-3 py-1 rounded-full {{ $user->isAdmin() ? 'bg-[#ff385c]/10 text-[#ff385c]' : 'bg-[#f7f7f7] text-[#6a6a6a]' }}">
                        {{ $user->isAdmin() ? 'Super Admin' : 'Member' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Edit Profile --}}
            <div class="bg-white rounded-[14px] border border-[#ebebeb] p-6">
                <h2 class="text-lg font-bold text-[#222222] mb-4">Edit Profile</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold text-[#6a6a6a]">Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="w-full mt-1 px-4 py-3 rounded-lg border border-[#dddddd] focus:border-[#ff385c] focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-[#6a6a6a]">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="w-full mt-1 px-4 py-3 rounded-lg border border-[#dddddd] focus:border-[#ff385c] focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-[#6a6a6a]">Foto Profile</label>
                            <input type="file" name="avatar" accept="image/*" class="w-full mt-1 text-sm text-[#6a6a6a]">
                        </div>
                        <button type="submit" class="w-full bg-[#ff385c] text-white font-semibold py-3 rounded-lg hover:bg-[#e00b41] transition-colors">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="bg-white rounded-[14px] border border-[#ebebeb] p-6">
                <h2 class="text-lg font-bold text-[#222222] mb-4">Ubah Password</h2>
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-semibold text-[#6a6a6a]">Password Saat Ini</label>
                            <input type="password" name="current_password" class="w-full mt-1 px-4 py-3 rounded-lg border border-[#dddddd] focus:border-[#ff385c] focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-[#6a6a6a]">Password Baru</label>
                            <input type="password" name="password" class="w-full mt-1 px-4 py-3 rounded-lg border border-[#dddddd] focus:border-[#ff385c] focus:outline-none text-sm">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-[#6a6a6a]">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="w-full mt-1 px-4 py-3 rounded-lg border border-[#dddddd] focus:border-[#ff385c] focus:outline-none text-sm">
                        </div>
                        <button type="submit" class="w-full bg-[#222222] text-white font-semibold py-3 rounded-lg hover:bg-black transition-colors">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Order History --}}
        <div class="bg-white rounded-[14px] border border-[#ebebeb] p-6 mt-6">
            <h2 class="text-lg font-bold text-[#222222] mb-4">Riwayat Pesanan</h2>
            @if ($orders->isEmpty())
                <p class="text-sm text-[#6a6a6a] text-center py-8">Belum ada pesanan.</p>
            @else
                <div class="space-y-3">
                    @foreach ($orders as $order)
                        <div class="flex items-center justify-between py-3 border-b border-[#ebebeb] last:border-0">
                            <div>
                                <p class="text-sm font-semibold text-[#222222]">{{ $order->midtrans_order_id }}</p>
                                <p class="text-xs text-[#6a6a6a]">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full
                                    {{ $order->payment_status === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : ($order->payment_status === 'pending' ? 'bg-yellow-50 text-yellow-700 border border-yellow-200' : 'bg-red-50 text-red-700 border border-red-200') }}">
                                    {{ $order->payment_status === 'success' ? 'Berhasil' : ($order->payment_status === 'pending' ? 'Pending' : 'Gagal') }}
                                </span>
                                <p class="text-sm font-bold text-[#ff385c] mt-1">
                                    @php
                                        $total = $order->items->sum(fn($i) => $i->menu?->price * $i->quantity ?? 0);
                                    @endphp
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>

</body>
</html>
