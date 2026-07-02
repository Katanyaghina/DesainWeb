<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Admin Penawaran | PROPOSAL.CORE</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary": "#ffffff",
                        "secondary": "#0058be",
                        "on-primary-fixed": "#00164e",
                        "on-primary-container": "#90a8ff",
                        "on-secondary-fixed": "#001a42",
                        "on-primary-fixed-variant": "#264191",
                        "inverse-surface": "#2d3133",
                        "surface-bright": "#f7f9fb",
                        "primary-container": "#1e3a8a",
                        "tertiary-container": "#314156",
                        "on-tertiary-fixed": "#0b1c30",
                        "on-surface": "#191c1e",
                        "tertiary-fixed": "#d3e4fe",
                        "secondary-fixed": "#d8e2ff",
                        "tertiary-fixed-dim": "#b7c8e1",
                        "primary": "#00236f",
                        "on-secondary-fixed-variant": "#004395",
                        "surface-container-high": "#e6e8ea",
                        "surface": "#f7f9fb",
                        "on-surface-variant": "#444651",
                        "surface-container": "#eceef0",
                        "outline-variant": "#c5c5d3",
                        "on-tertiary": "#ffffff",
                        "outline": "#757682",
                        "on-secondary-container": "#fefcff",
                        "on-tertiary-fixed-variant": "#38485d",
                        "primary-fixed-dim": "#b6c4ff",
                        "on-background": "#191c1e",
                        "inverse-on-surface": "#eff1f3",
                        "surface-container-low": "#f2f4f6",
                        "secondary-container": "#2170e4",
                        "surface-variant": "#e0e3e5",
                        "surface-container-lowest": "#ffffff",
                        "surface-dim": "#d8dadc",
                        "primary-fixed": "#dce1ff",
                        "surface-container-highest": "#e0e3e5",
                        "surface-tint": "#4059aa",
                        "error-container": "#ffdad6",
                        "tertiary": "#1b2b3f",
                        "on-tertiary-container": "#9dadc6",
                        "on-primary": "#ffffff",
                        "on-error-container": "#93000a",
                        "inverse-primary": "#b6c4ff",
                        "secondary-fixed-dim": "#adc6ff",
                        "on-error": "#ffffff",
                        "error": "#ba1a1a",
                        "background": "#f7f9fb"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-mobile": "16px",
                        "margin-desktop": "48px",
                        "max-width": "1440px",
                        "base": "8px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-xl-mobile": ["Inter"],
                        "headline-xl": ["Inter"],
                        "body-md": ["Inter"]
                    },
                    "fontSize": {
                        "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "headline-xl-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-xl": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="text-on-surface bg-background min-h-screen flex flex-col">

    <!-- Toast Notification -->
    <div id="toast-container" class="fixed top-20 right-4 z-50 pointer-events-none flex flex-col gap-2"></div>

    <!-- TopAppBar -->
    <header class="w-full sticky top-0 bg-surface-container-lowest z-40 border-b border-outline-variant shadow-sm">
        <div class="flex items-center justify-between px-margin-desktop py-4 w-full max-w-screen-2xl mx-auto">
            <div class="flex items-center gap-8">
                <nav class="flex gap-6">
                    <a href="{{ route('portal') }}" class="nav-btn text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-colors relative pb-1 border-b-2 border-transparent">Portal Klien</a>
                    <a href="{{ route('admin.dashboard') }}" class="nav-btn text-primary font-semibold font-label-md text-label-md transition-colors relative pb-1 border-b-2 border-primary">Dashboard Admin</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-4 relative">
                @if(session('admin_logged_in'))
                    <!-- Profile avatar dropdown (floating on top right) -->
                    <div class="relative inline-block text-left">
                        <button onclick="toggleUserDropdown()" class="w-10 h-10 rounded-full bg-primary-fixed-dim flex items-center justify-center border border-outline-variant overflow-hidden focus:outline-none">
                            <img class="w-full h-full object-cover" alt="Foto Admin" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=250"/>
                        </button>
                        <!-- Dropdown panel -->
                        <div id="user-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white border border-outline-variant ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <span class="block px-4 py-2 text-xs text-outline font-semibold border-b border-outline-variant">Masuk sebagai Admin</span>
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm text-on-surface hover:bg-surface-container-low">Dashboard Admin</a>
                                <form action="{{ route('logout') }}" method="POST" class="block w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 flex items-center gap-1.5 font-semibold">
                                        <span class="material-symbols-outlined text-[18px]">logout</span>
                                        Keluar (Sign Out)
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center px-4 py-8">
        <div class="w-full max-w-[1100px] flex flex-col gap-8">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight font-extrabold">Dashboard Pengelola Penawaran</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Kelola, tinjau, dan ekspor penawaran desain web langsung dari database MySQL.
                    </p>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-lg flex flex-col gap-1 shadow-sm">
                    <span class="text-xs font-semibold text-outline uppercase">Total Pengajuan</span>
                    <span class="text-3xl font-extrabold text-primary" id="kpi-total">{{ $proposals->count() }}</span>
                </div>
                <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-lg flex flex-col gap-1 shadow-sm border-l-4 border-yellow-500">
                    <span class="text-xs font-semibold text-outline uppercase">Pending</span>
                    <span class="text-3xl font-extrabold text-yellow-600" id="kpi-pending">{{ $proposals->where('status', 'Pending')->count() }}</span>
                </div>
                <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-lg flex flex-col gap-1 shadow-sm border-l-4 border-blue-500">
                    <span class="text-xs font-semibold text-outline uppercase">Reviewed</span>
                    <span class="text-3xl font-extrabold text-blue-600" id="kpi-reviewed">{{ $proposals->where('status', 'Reviewed')->count() }}</span>
                </div>
                <div class="bg-surface-container-lowest border border-outline-variant p-5 rounded-lg flex flex-col gap-1 shadow-sm border-l-4 border-green-500">
                    <span class="text-xs font-semibold text-outline uppercase">Approved</span>
                    <span class="text-3xl font-extrabold text-green-600" id="kpi-approved">{{ $proposals->where('status', 'Approved')->count() }}</span>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-outline-variant">
                    <h3 class="font-headline-md text-lg font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined">table_chart</span> Daftar Pengajuan Masuk
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant text-outline uppercase font-semibold text-[11px] tracking-wider">
                                <th class="py-4 px-6">Kode & Tanggal</th>
                                <th class="py-4 px-6">Informasi Klien</th>
                                <th class="py-4 px-6">Alamat</th>
                                <th class="py-4 px-6">Kebutuhan Proyek</th>
                                <th class="py-4 px-6 text-center">Status Proyek</th>
                                <th class="py-4 px-6 text-right">Aksi Kelola</th>
                            </tr>
                        </thead>
                        <tbody id="proposal-table-body">
                            @forelse($proposals as $p)
                                @php
                                    $badgeClass = "bg-yellow-100 text-yellow-800 border-yellow-300";
                                    if ($p->status === 'Reviewed') $badgeClass = "bg-blue-100 text-blue-800 border-blue-300";
                                    if ($p->status === 'Approved') $badgeClass = "bg-green-100 text-green-800 border-green-300";
                                    if ($p->status === 'Rejected') $badgeClass = "bg-red-100 text-red-800 border-red-300";
                                @endphp
                                <tr id="row-{{ $p->proposal_code }}" class="border-b border-outline-variant hover:bg-surface-container-low transition-colors">
                                    <td class="py-4 px-6 font-semibold">
                                        <div class="text-primary font-bold">{{ $p->proposal_code }}</div>
                                        <div class="text-xs text-outline">{{ $p->created_at->format('Y-m-d') }}</div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-on-surface">{{ $p->client_name }}</div>
                                        <div class="text-xs text-on-surface-variant">{{ $p->email }}</div>
                                        <div class="text-xs text-on-surface-variant">{{ $p->phone_country_code }} {{ $p->phone_number }}</div>
                                    </td>
                                    <td class="py-4 px-6 text-xs text-on-surface-variant max-w-[200px] truncate" title="{{ $p->address_street }}, {{ $p->address_city }}">
                                        {{ $p->address_street }}, {{ $p->address_city }}, {{ $p->address_province }} {{ $p->address_postal }}
                                    </td>
                                    <td class="py-4 px-6 text-xs text-on-surface-variant italic max-w-[200px] truncate" title="{{ $p->project_description }}">
                                        "{{ $p->project_description ?? 'Tidak ada deskripsi.' }}"
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span id="badge-{{ $p->proposal_code }}" class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $badgeClass }}">
                                            {{ $p->status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <select onchange="updateProposalStatus('{{ $p->proposal_code }}', this.value)" class="text-xs bg-white border border-outline-variant rounded p-1.5 focus:ring-1 focus:ring-secondary outline-none">
                                                <option value="Pending" {{ $p->status === 'Pending' ? 'selected' : '' }}>Set Pending</option>
                                                <option value="Reviewed" {{ $p->status === 'Reviewed' ? 'selected' : '' }}>Set Reviewed</option>
                                                <option value="Approved" {{ $p->status === 'Approved' ? 'selected' : '' }}>Approve</option>
                                                <option value="Rejected" {{ $p->status === 'Rejected' ? 'selected' : '' }}>Reject</option>
                                            </select>
                                            <button onclick="openPdfModal('{{ $p->proposal_code }}')" class="p-1.5 bg-secondary/10 hover:bg-secondary/20 text-secondary rounded transition-colors flex items-center justify-center" title="Ekspor PDF">
                                                <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                                            </button>
                                            <button onclick="deleteProposal('{{ $p->proposal_code }}')" class="p-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded transition-colors flex items-center justify-center" title="Hapus">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-outline italic">Tidak ada data proposal penawaran masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Ekspor PDF -->
    <div id="pdf-modal" class="fixed inset-0 bg-black/60 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto flex flex-col">
            <!-- Modal Header -->
            <div class="p-6 border-b border-outline-variant flex justify-between items-center bg-primary text-white rounded-t-xl">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-white">picture_as_pdf</span>
                    <h3 class="font-bold text-lg">Dokumen Penawaran Resmi (Pratinjau)</h3>
                </div>
                <button onclick="closePdfModal()" class="text-white hover:bg-white/20 p-1.5 rounded-full transition-colors flex">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <!-- Modal Body (PDF Content representation) -->
            <div class="p-8 flex flex-col gap-6 text-black" id="pdf-content-print">
                <!-- Letterhead -->
                <div class="flex justify-between items-start border-b-2 border-primary pb-4">
                    <div>
                        <h2 class="text-xl font-extrabold text-primary tracking-tight">PROPOSAL.CORE</h2>
                        <p class="text-xs text-gray-500">Jasa Desain & Pengembangan Web Premium</p>
                        <p class="text-xs text-gray-500">Jakarta, Indonesia • support@proposal.core</p>
                    </div>
                    <div class="text-right">
                        <h3 class="text-sm font-bold text-gray-700">DOKUMEN PENAWARAN</h3>
                        <p class="text-xs text-gray-600 font-semibold" id="pdf-proposal-code">WD-202607-001</p>
                        <p class="text-xs text-gray-500" id="pdf-date">2 Juli 2026</p>
                    </div>
                </div>

                <!-- Info Klien -->
                <div>
                    <h4 class="text-xs font-bold text-primary uppercase border-b border-gray-200 pb-1 mb-2">Tujuan Penawaran</h4>
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <p class="font-bold text-gray-800" id="pdf-client-name">PT. Maju Jaya Kreatif</p>
                            <p class="text-gray-600" id="pdf-client-contact">ahmad@domain.com</p>
                            <p class="text-gray-600" id="pdf-client-phone">+62 8123456789</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Alamat Lengkap Klien:</p>
                            <p class="text-gray-600 whitespace-pre-line" id="pdf-client-address">-</p>
                        </div>
                    </div>
                </div>

                <!-- Scope / Details -->
                <div>
                    <h4 class="text-xs font-bold text-primary uppercase border-b border-gray-200 pb-1 mb-2">Spesifikasi Kebutuhan Proyek</h4>
                    <div class="p-3 bg-gray-50 rounded text-xs italic text-gray-700 mb-4" id="pdf-project-desc">
                        -
                    </div>
                    <table class="w-full text-xs text-left border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200 font-bold">
                                <th class="p-2 border border-gray-200">Item Jasa Desain Web</th>
                                <th class="p-2 border border-gray-200 text-center">Durasi</th>
                                <th class="p-2 border border-gray-200 text-right">Estimasi Biaya Awal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2 border border-gray-200">Desain UI/UX Kustom (Responsive Mobile-First)</td>
                                <td class="p-2 border border-gray-200 text-center">2 Minggu</td>
                                <td class="p-2 border border-gray-200 text-right">Rp 4.500.000</td>
                            </tr>
                            <tr>
                                <td class="p-2 border border-gray-200">Pengembangan Frontend (HTML, Tailwind CSS, JS)</td>
                                <td class="p-2 border border-gray-200 text-center">3 Minggu</td>
                                <td class="p-2 border border-gray-200 text-right">Rp 6.000.000</td>
                            </tr>
                            <tr>
                                <td class="p-2 border border-gray-200">Sistem Admin & Integrasi API Web/Mobile (Laravel Backend)</td>
                                <td class="p-2 border border-gray-200 text-center">3 Minggu</td>
                                <td class="p-2 border border-gray-200 text-right">Rp 7.500.000</td>
                            </tr>
                            <tr class="font-bold bg-gray-50 text-gray-800">
                                <td class="p-2 border border-gray-200" colspan="2">Total Estimasi Harga Penawaran</td>
                                <td class="p-2 border border-gray-200 text-right text-primary">Rp 18.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Terms and Signatures -->
                <div class="grid grid-cols-2 gap-4 text-[10px] text-gray-500 pt-4 border-t border-gray-100">
                    <div>
                        <p class="font-bold text-gray-700">Ketentuan & Syarat:</p>
                        <p>1. Penawaran ini berlaku selama 30 hari kalender sejak diterbitkan.</p>
                        <p>2. Pekerjaan dimulai setelah pembayaran deposit 30% dari total nilai penawaran.</p>
                    </div>
                    <div class="text-right flex flex-col items-end gap-10">
                        <p class="font-bold text-gray-700">Hormat Kami,</p>
                        <div class="flex flex-col items-center">
                            <span class="font-bold text-primary underline">PROPOSAL.CORE Team</span>
                            <span>Manajer Operasional Proyek</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer / Actions -->
            <div class="p-6 border-t border-outline-variant bg-surface-container-low flex justify-end gap-2">
                <button onclick="closePdfModal()" class="px-4 py-2 border border-outline-variant hover:bg-surface-container-high rounded-lg text-xs font-semibold text-on-surface">Tutup</button>
                <button onclick="window.print()" class="px-4 py-2 bg-secondary hover:bg-primary text-white rounded-lg text-xs font-semibold flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">print</span> Cetak Proposal Resmi
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-auto py-8 bg-surface-container-low border-t border-outline-variant">
        <div class="text-center font-bold text-outline uppercase tracking-wider text-xs">
            UAS Pemrograman Perangkat Bergerak - C030324019
        </div>
    </footer>

    <!-- JS Logic -->
    <script>
        // Dropdown toggle function
        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('user-dropdown');
            if (dropdown && !e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });

        // Show toast alert helper
        function showToast(message, type = "success") {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `p-4 rounded-lg shadow-lg flex items-center gap-3 text-white text-sm pointer-events-auto transition-all duration-300 transform translate-y-2 opacity-0 ${
                type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-primary'
            }`;
            
            const icon = type === 'success' ? 'check_circle' : type === 'error' ? 'error' : 'info';
            toast.innerHTML = `
                <span class="material-symbols-outlined">${icon}</span>
                <span class="font-semibold">${message}</span>
            `;
            
            container.appendChild(toast);
            setTimeout(() => {
                toast.classList.remove('translate-y-2', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
            }, 10);

            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-2', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // Update proposal status via API
        function updateProposalStatus(code, newStatus) {
            fetch(`/api/proposals/${code}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(json => {
                if (json.success) {
                    showToast(`Status proposal ${code} berhasil diperbarui menjadi ${newStatus}`);
                    
                    // Update table badge dynamically
                    const badge = document.getElementById(`badge-${code}`);
                    badge.innerText = newStatus;
                    badge.className = "px-2.5 py-1 rounded-full text-xs font-bold border ";
                    if (newStatus === 'Pending') badge.classList.add('bg-yellow-100', 'text-yellow-800', 'border-yellow-300');
                    if (newStatus === 'Reviewed') badge.classList.add('bg-blue-100', 'text-blue-800', 'border-blue-300');
                    if (newStatus === 'Approved') badge.classList.add('bg-green-100', 'text-green-800', 'border-green-300');
                    if (newStatus === 'Rejected') badge.classList.add('bg-red-100', 'text-red-800', 'border-red-300');

                    recalculateKPIs();
                } else {
                    showToast(json.message || 'Gagal memperbarui status.', 'error');
                }
            })
            .catch(err => {
                showToast('Koneksi atau server error.', 'error');
            });
        }

        // Delete proposal via API
        function deleteProposal(code) {
            if (confirm(`Apakah Anda yakin ingin menghapus proposal ${code}?`)) {
                fetch(`/api/proposals/${code}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(json => {
                    if (json.success) {
                        showToast(`Proposal ${code} berhasil dihapus dari sistem.`);
                        document.getElementById(`row-${code}`).remove();
                        recalculateKPIs();
                    } else {
                        showToast(json.message || 'Gagal menghapus.', 'error');
                    }
                })
                .catch(err => {
                    showToast('Gagal menghapus data dari server.', 'error');
                });
            }
        }

        // Local KPI Recalculator
        function recalculateKPIs() {
            const rows = document.querySelectorAll('#proposal-table-body tr');
            let total = 0, pending = 0, reviewed = 0, approved = 0;

            rows.forEach(row => {
                const badge = row.querySelector('[id^="badge-"]');
                if (badge) {
                    total++;
                    const text = badge.innerText.trim();
                    if (text === 'Pending') pending++;
                    if (text === 'Reviewed') reviewed++;
                    if (text === 'Approved') approved++;
                }
            });

            document.getElementById('kpi-total').innerText = total;
            document.getElementById('kpi-pending').innerText = pending;
            document.getElementById('kpi-reviewed').innerText = reviewed;
            document.getElementById('kpi-approved').innerText = approved;
        }

        // PDF Preview Modal from server data
        function openPdfModal(code) {
            fetch(`/api/proposals/${code}`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(json => {
                if (json.success) {
                    const data = json.data;
                    document.getElementById('pdf-proposal-code').innerText = data.proposal_code;
                    document.getElementById('pdf-date').innerText = data.created_at.split('T')[0];
                    document.getElementById('pdf-client-name').innerText = data.client_name;
                    document.getElementById('pdf-client-contact').innerText = data.email;
                    document.getElementById('pdf-client-phone').innerText = `${data.phone_country_code} ${data.phone_number}`;
                    
                    const addressLines = [data.address_street];
                    if (data.address_street2) addressLines.push(data.address_street2);
                    addressLines.push(`${data.address_city}, ${data.address_province}`);
                    addressLines.push(data.address_postal);
                    document.getElementById('pdf-client-address').innerText = addressLines.join('\n');
                    
                    document.getElementById('pdf-project-desc').innerText = `"${data.project_description || 'Tidak ada deskripsi.'}"`;

                    document.getElementById('pdf-modal').classList.remove('hidden');
                } else {
                    showToast('Gagal memuat detail proposal.', 'error');
                }
            })
            .catch(err => {
                showToast('Koneksi database bermasalah.', 'error');
            });
        }

        function closePdfModal() {
            document.getElementById('pdf-modal').classList.add('hidden');
        }
    </script>
</body>
</html>
