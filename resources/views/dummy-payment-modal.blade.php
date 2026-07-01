<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment - PB Sahaja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#f7f7f7] min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-[14px] shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px] max-w-md w-full p-8" id="paymentModal">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-[#ff385c]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#ff385c]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-[#222222]">Pembayaran Dummy</h2>
            <p class="text-sm text-[#6a6a6a] mt-1">Simulasi pembayaran untuk testing</p>
        </div>

        <div class="bg-[#fafafa] rounded-lg p-4 mb-6 border border-[#ebebeb]">
            <div class="flex justify-between text-sm mb-2">
                <span class="text-[#6a6a6a]">Produk</span>
                <span class="font-semibold text-[#222222]" id="productName">-</span>
            </div>
            <div class="flex justify-between text-sm mb-2">
                <span class="text-[#6a6a6a]">Order ID</span>
                <span class="font-mono text-xs text-[#222222]" id="orderId">-</span>
            </div>
            <div class="border-t border-[#ebebeb] pt-2 mt-2">
                <div class="flex justify-between">
                    <span class="font-semibold text-[#222222]">Total</span>
                    <span class="text-lg font-bold text-[#ff385c]" id="totalAmount">Rp0</span>
                </div>
            </div>
        </div>

        <div class="space-y-3">
            <button onclick="confirmPayment('success')"
                    class="w-full bg-[#ff385c] text-white font-semibold py-3.5 rounded-lg hover:bg-[#e00b41] transition-colors shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px]">
                ✓ Bayar Berhasil
            </button>
            <button onclick="confirmPayment('pending')"
                    class="w-full bg-[#f7f7f7] text-[#222222] font-semibold py-3.5 rounded-lg hover:bg-[#ebebeb] transition-colors border border-[#dddddd]">
                ⏳ Pending
            </button>
            <button onclick="confirmPayment('failure')"
                    class="w-full bg-white text-[#6a6a6a] font-semibold py-3.5 rounded-lg hover:bg-[#f7f7f7] transition-colors border border-[#dddddd]">
                ✕ Gagal
            </button>
        </div>

        <p class="text-[10px] text-[#999999] text-center mt-4">Mode dummy — tidak ada transaksi nyata</p>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('order_id');
        const productName = urlParams.get('product');
        const amount = urlParams.get('amount');

        document.getElementById('productName').textContent = productName || '-';
        document.getElementById('orderId').textContent = orderId || '-';
        document.getElementById('totalAmount').textContent = 'Rp' + Number(amount || 0).toLocaleString('id-ID');

        function confirmPayment(status) {
            fetch('/dummy-payment/confirm', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ order_id: orderId, status: status }),
            })
            .then(res => res.json())
            .then(data => {
                if (status === 'success') {
                    alert('Pembayaran berhasil! Pesanan Anda sedang diproses.');
                } else if (status === 'pending') {
                    alert('Pembayaran pending. Silakan selesaikan pembayaran.');
                } else {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                }
                window.location.href = '/';
            })
            .catch(() => {
                alert('Terjadi kesalahan.');
            });
        }
    </script>
</body>
</html>
