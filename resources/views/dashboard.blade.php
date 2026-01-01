@extends('layouts.base')

@section('content')
    <style>
        .dashboard-container {
            padding: 30px 15px;
        }

        .page-header {
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #1565c0;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-subtitle {
            color: #666;
            font-size: 15px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--card-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-card.blue {
            --card-color: #1e88e5;
        }

        .stat-card.green {
            --card-color: #43a047;
        }

        .stat-card.orange {
            --card-color: #fb8c00;
        }

        .stat-card.purple {
            --card-color: #8e24aa;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            background: var(--card-color);
            color: white;
        }

        .stat-badge {
            background: #e8f5e9;
            color: #43a047;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .stat-badge.red {
            background: #ffebee;
            color: #e53935;
        }

        .stat-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-footer {
            font-size: 13px;
            color: #999;
        }

        /* Chart Section */
        .chart-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 40px;
        }

        .chart-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .chart-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1565c0;
            font-weight: 600;
        }

        /* Recent Bookings Table */
        .table-section {
            margin-bottom: 40px;
        }

        .table-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .table-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-view-all {
            background: linear-gradient(135deg, #1e88e5 0%, #1565c0 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.4);
            color: white;
            text-decoration: none;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .custom-table thead th {
            background: #f8f9fa;
            padding: 15px;
            font-weight: 600;
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
            border: none;
            letter-spacing: 0.5px;
        }

        .custom-table thead th:first-child {
            border-radius: 8px 0 0 8px;
        }

        .custom-table thead th:last-child {
            border-radius: 0 8px 8px 0;
        }

        .custom-table tbody tr {
            background: white;
            transition: all 0.3s ease;
        }

        .custom-table tbody tr:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .custom-table tbody td {
            padding: 18px 15px;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .custom-table tbody td:first-child {
            border-left: 1px solid #f0f0f0;
            border-radius: 8px 0 0 8px;
        }

        .custom-table tbody td:last-child {
            border-right: 1px solid #f0f0f0;
            border-radius: 0 8px 8px 0;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-badge.pending {
            background: #fff3e0;
            color: #f57c00;
        }

        .status-badge.confirmed {
            background: #e8f5e9;
            color: #43a047;
        }

        .status-badge.completed {
            background: #e3f2fd;
            color: #1e88e5;
        }

        .status-badge.cancelled {
            background: #ffebee;
            color: #e53935;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }

        .user-email {
            font-size: 12px;
            color: #999;
        }

        .court-badge {
            background: #e3f2fd;
            color: #1565c0;
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
        }

        .price-text {
            font-weight: 700;
            color: #43a047;
            font-size: 15px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-icon {
            font-size: 60px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .action-btn {
            background: white;
            border: 2px solid #e3e8ef;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .action-btn:hover {
            border-color: #1e88e5;
            background: #e3f2fd;
            transform: translateY(-3px);
            color: #1565c0;
            text-decoration: none;
        }

        .action-icon {
            font-size: 36px;
        }

        .action-label {
            font-weight: 600;
            font-size: 14px;
        }

        @media (max-width: 992px) {
            .chart-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 24px;
            }

            .table-card {
                padding: 20px;
                overflow-x: auto;
            }

            .custom-table {
                min-width: 600px;
            }
        }
    </style>

    <div class="dashboard-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <span>📊</span>
                Dashboard
            </h1>
            <p class="page-subtitle">Selamat datang di dashboard.</p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-header">
                    <div class="stat-icon">🏸</div>
                </div>
                <div class="stat-title">Total Lapangan</div>
                <div class="stat-value">{{ count($lapangan) ?? 0 }}</div>
                <div class="stat-footer">Lapangan Aktif</div>
            </div>

            <div class="stat-card green">
                <div class="stat-header">
                    <div class="stat-icon">📅</div>
                </div>
                <div class="stat-title">Total Penyewaan</div>
                <div class="stat-value">{{ $penyewaan ?? 0 }}</div>
                <div class="stat-footer">Semua penyewaan</div>
            </div>

            <div class="stat-card orange">
                <div class="stat-header">
                    <div class="stat-icon">⏳</div>
                </div>
                <div class="stat-title">Penyewaan Tertunda</div>
                <div class="stat-value">{{ $pendingBookings ?? 0 }}</div>
                <div class="stat-footer">Menunggu Konfirmasi</div>
            </div>

            <div class="stat-card purple">
                <div class="stat-header">
                    <div class="stat-icon">💰</div>
                </div>
                <div class="stat-title">Total Revenue</div>
                <div class="stat-value">Rp{{ number_format($bayar ?? 0) }}</div>
                <div class="stat-footer">IDR this month</div>
            </div>
        </div>

        <!-- Quick Actions -->
        {{-- <div class="quick-actions">
            <a href="{{ route('lapangan.create') }}" class="action-btn">
                <div class="action-icon">➕</div>
                <div class="action-label">Add New Court</div>
            </a>
            <a href="{{ route('penyewaan.index') }}" class="action-btn">
                <div class="action-icon">📋</div>
                <div class="action-label">View All Bookings</div>
            </a>
            <a href="{{ route('lapangan.index') }}" class="action-btn">
                <div class="action-icon">⚙️</div>
                <div class="action-label">Manage Courts</div>
            </a>
            <a href="#" class="action-btn">
                <div class="action-icon">📊</div>
                <div class="action-label">View Reports</div>
            </a>
        </div> --}}

        <!-- Chart Section -->
        {{-- <div class="chart-section">
            <div class="chart-card">
                <h3 class="chart-title">
                    <span>📈</span>
                    Booking Statistics
                </h3>
                <div class="chart-placeholder">
                    Chart: Booking Trends (Last 7 Days)
                </div>
            </div>

            <div class="chart-card">
                <h3 class="chart-title">
                    <span>🏆</span>
                    Court Performance
                </h3>
                <div class="chart-placeholder">
                    Chart: Most Booked Courts
                </div>
            </div>
        </div> --}}

        <!-- Recent Bookings Table -->
        {{-- <div class="table-section">
            <div class="table-card">
                <div class="table-header">
                    <h3 class="table-title">
                        <span>🕐</span>
                        Recent Bookings
                    </h3>
                    <a href="{{ route('penyewaan.index') }}" class="btn-view-all">View All</a>
                </div>

                @if (isset($recentBookings) && $recentBookings->count() > 0)
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Court</th>
                                <th>Date & Time</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentBookings as $booking)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($booking->user->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">{{ $booking->user->name ?? 'Unknown' }}</div>
                                                <div class="user-email">{{ $booking->user->email ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="court-badge">{{ $booking->lapangan->nama_lapangan ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600;">
                                            {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</div>
                                        <div style="font-size: 12px; color: #999;">{{ $booking->jam_mulai }} -
                                            {{ $booking->jam_selesai }}</div>
                                    </td>
                                    <td>
                                        <span class="price-text">Rp {{ number_format($booking->total_harga ?? 0) }}</span>
                                    </td>
                                    <td>
                                        @if ($booking->status == 'pending')
                                            <span class="status-badge pending">Pending</span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="status-badge confirmed">Confirmed</span>
                                        @elseif($booking->status == 'completed')
                                            <span class="status-badge completed">Completed</span>
                                        @else
                                            <span class="status-badge cancelled">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('penyewaan.show', $booking->id) }}"
                                            class="btn btn-sm btn-primary" style="border-radius: 6px;">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <div>No recent bookings found</div>
                    </div>
                @endif
            </div>
        </div> --}}
    </div>
@endsection
