<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice <?php echo e($order->order_code); ?> — LaundryHub</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f1f5f9; color: #0f172a; font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif; }
        .toolbar { max-width: 820px; margin: 0 auto; padding: 20px 20px 0; display: flex; justify-content: space-between; align-items: center; gap: 12px; }
        .toolbar a { color: #475569; font-size: 12px; font-weight: 700; text-decoration: none; }
        .toolbar a:hover { color: #2563eb; }
        .toolbar button { border: 0; border-radius: 10px; background: #2563eb; color: #fff; padding: 10px 16px; font-size: 12px; font-weight: 800; cursor: pointer; }
        .toolbar button:hover { background: #1d4ed8; }
        .sheet { max-width: 820px; margin: 16px auto 40px; background: #fff; border-radius: 16px; box-shadow: 0 20px 50px rgba(15, 23, 42, .08); overflow: hidden; }
        .accent { height: 6px; background: linear-gradient(90deg, #2563eb, #22d3ee, #34d399); }
        .head { display: flex; justify-content: space-between; gap: 24px; padding: 34px 38px 26px; border-bottom: 1px solid #e2e8f0; }
        .brand { display: flex; align-items: center; gap: 10px; font-size: 20px; font-weight: 900; letter-spacing: -.03em; }
        .mark { display: grid; place-items: center; width: 38px; height: 38px; border-radius: 11px; background: #2563eb; color: #fff; font-size: 16px; }
        .muted { color: #64748b; font-size: 11px; line-height: 1.7; }
        .right { text-align: right; }
        .label { font-size: 9px; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; color: #94a3b8; }
        .code { margin-top: 4px; font-size: 18px; font-weight: 900; color: #1d4ed8; }
        .badge { display: inline-block; margin-top: 8px; border-radius: 999px; background: #dbeafe; color: #1d4ed8; padding: 5px 12px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; }
        .body { padding: 28px 38px 34px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .party { padding: 14px 16px; border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; }
        .party p { margin: 5px 0 0; font-size: 12px; }
        .party strong { display: block; font-size: 13px; color: #0f172a; }
        table { width: 100%; border-collapse: collapse; margin-top: 26px; }
        th { text-align: left; font-size: 9px; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; color: #94a3b8; border-bottom: 1px solid #e2e8f0; padding: 0 0 10px; }
        td { padding: 14px 0; border-bottom: 1px solid #f1f5f9; font-size: 12px; vertical-align: top; }
        td.right, th.right { text-align: right; }
        .item-name { font-weight: 800; color: #0f172a; }
        .item-sub { margin-top: 3px; font-size: 10px; color: #64748b; }
        .summary { width: 310px; margin-left: auto; margin-top: 18px; }
        .summary div { display: flex; justify-content: space-between; gap: 24px; padding: 5px 0; font-size: 11px; color: #475569; }
        .summary .total { margin-top: 8px; border-top: 1px solid #e2e8f0; padding-top: 12px; font-size: 12px; font-weight: 800; color: #0f172a; align-items: baseline; }
        .summary .total span:last-child { font-size: 22px; letter-spacing: -.03em; color: #1d4ed8; }
        .note { margin-top: 26px; padding: 14px 16px; border: 1px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; font-size: 11px; line-height: 1.6; color: #475569; }
        .foot { margin-top: 26px; display: flex; justify-content: space-between; gap: 20px; border-top: 1px solid #e2e8f0; padding-top: 16px; font-size: 10px; color: #94a3b8; }
        .foot strong { color: #475569; }
        @media (max-width: 640px) {
            .head, .body { padding: 24px 22px; }
            .grid { grid-template-columns: 1fr; }
            .summary { width: 100%; }
            .head { flex-direction: column; }
            .right { text-align: left; }
        }
        @media print {
            body { background: #fff; }
            .toolbar { display: none; }
            .sheet { margin: 0 auto; max-width: none; border-radius: 0; box-shadow: none; }
            .accent { display: none; }
            .foot { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="<?php echo e(route('customer.orders.show', $order->id)); ?>">&larr; Kembali ke pelacakan pesanan</a>
        <button type="button" onclick="window.print()">Cetak / Simpan PDF</button>
    </div>

    <main class="sheet">
        <div class="accent"></div>
        <header class="head">
            <div>
                <div class="brand"><span class="mark">L</span> LaundryHub</div>
                <p class="muted" style="margin:8px 0 0">Nota digital resmi pesanan laundry.<br>Diterbitkan otomatis oleh sistem multi-tenant LaundryHub.</p>
            </div>
            <div class="right">
                <p class="label">Invoice</p>
                <p class="code">#<?php echo e($order->order_code); ?></p>
                <span class="badge"><?php echo e($order->status); ?></span>
                <p class="muted" style="margin:8px 0 0"><?php echo e($order->created_at?->locale('id')->translatedFormat('d M Y, H:i')); ?> WIB</p>
            </div>
        </header>

        <div class="body">
            <div class="grid">
                <div class="party">
                    <p class="label">Mitra Laundry</p>
                    <strong><?php echo e($order->tenant?->name ?? 'Mitra Laundry'); ?></strong>
                    <p class="muted"><?php echo e($order->tenant?->address ?: 'Alamat outlet terdaftar di LaundryHub'); ?></p>
                    <p class="muted"><?php echo e($order->tenant?->phone ?: '-'); ?></p>
                </div>
                <div class="party">
                    <p class="label">Ditagihkan Kepada</p>
                    <strong><?php echo e($order->customer?->name ?? auth()->user()->name); ?></strong>
                    <p class="muted"><?php echo e($order->customer?->email ?? auth()->user()->email); ?></p>
                    <p class="muted"><?php echo e($order->customer?->phone ?? '-'); ?></p>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Deskripsi Layanan</th>
                        <th class="right">Berat</th>
                        <th class="right">Harga</th>
                        <th class="right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $subtotal = (float) ($order->service?->price ?? 0) * (float) $order->weight;
                        $weight = rtrim(rtrim(number_format((float) $order->weight, 2, ',', '.'), '0'), ',');
                    ?>
                    <tr>
                        <td>
                            <div class="item-name"><?php echo e($order->service?->name ?? 'Layanan Laundry'); ?></div>
                            <div class="item-sub"><?php echo e(ucfirst($order->pickup_type ?: 'dropoff')); ?> &bull; Estimasi <?php echo e($order->service?->estimated_duration ?? 2); ?> hari</div>
                        </td>
                        <td class="right"><?php echo e($weight); ?> kg</td>
                        <td class="right">Rp<?php echo e(number_format((float) ($order->service?->price ?? 0), 0, ',', '.')); ?></td>
                        <td class="right" style="font-weight:800">Rp<?php echo e(number_format($subtotal, 0, ',', '.')); ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="summary">
                <div><span>Subtotal</span><span>Rp<?php echo e(number_format($subtotal, 0, ',', '.')); ?></span></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) ($order->delivery_fee ?? 0) > 0): ?>
                    <div><span>Biaya antar-jemput</span><span>Rp<?php echo e(number_format((float) $order->delivery_fee, 0, ',', '.')); ?></span></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) ($order->platform_fee ?? 0) > 0): ?>
                    <div><span>Biaya layanan platform</span><span>Rp<?php echo e(number_format((float) $order->platform_fee, 0, ',', '.')); ?></span></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((float) ($order->discount ?? 0) > 0): ?>
                    <div><span>Diskon<?php echo e($order->voucher_code ? ' ('.$order->voucher_code.')' : ''); ?></span><span style="color:#059669">−Rp<?php echo e(number_format((float) $order->discount, 0, ',', '.')); ?></span></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="total"><span>Total</span><span>Rp<?php echo e(number_format((float) ($order->total_price ?? $order->total ?? 0), 0, ',', '.')); ?></span></div>
            </div>

            <div class="note">
                <strong>Metode pembayaran:</strong> <?php echo e($order->payment_method ?: 'Belum dipilih'); ?> &bull;
                <strong>Status pembayaran:</strong> <?php echo e($order->payment_status ?: 'Menunggu Pembayaran'); ?><br>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->customer_note): ?>
                    <strong>Catatan pesanan:</strong> <?php echo e($order->customer_note); ?><br>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                Simpan invoice ini sebagai bukti pesanan yang sah. Klaim garansi dapat diajukan maksimal 1×24 jam setelah pesanan diterima.
            </div>

            <div class="foot">
                <span>Dokumen dibuat otomatis oleh <strong>LaundryHub</strong>.</span>
                <span>Butuh bantuan? Hubungi mitra melalui halaman pelacakan pesanan.</span>
            </div>
        </div>
    </main>
</body>
</html>
<?php /**PATH D:\laragon\www\Laundry-Multitenant-terintegrasi\Laundry-Multitenant\resources\views\laundry\invoice.blade.php ENDPATH**/ ?>