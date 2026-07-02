<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pelacakan Penawaran Desain Web | PROPOSAL.CORE</title>
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
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 254, 0.6);
        }
        .tracking-dot {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        /* Custom skeleton loading animations representing Skeletonizer behavior */
        .skeleton-block {
            background: linear-gradient(90deg, #e2e8f0 25%, #cbd5e1 50%, #e2e8f0 75%);
            background-size: 200% 100%;
            animation: skeleton-load 1.5s infinite;
        }
        @keyframes skeleton-load {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
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
                    <button onclick="switchTab('form-section')" id="nav-form-section" class="nav-btn text-primary font-semibold font-label-md text-label-md transition-colors relative pb-1 border-b-2 border-primary">Ajukan Penawaran</button>
                    <button onclick="switchTab('track-section')" id="nav-track-section" class="nav-btn text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-colors relative pb-1 border-b-2 border-transparent">Lacak Proposal</button>
                    
                    @if(session('admin_logged_in'))
                        <a href="{{ route('admin.dashboard') }}" class="nav-btn text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-colors relative pb-1 border-b-2 border-transparent">
                            Dashboard Admin
                        </a>
                    @else
                        <button onclick="openLoginModal()" class="nav-btn text-on-surface-variant hover:text-on-surface font-label-md text-label-md transition-colors relative pb-1 border-b-2 border-transparent">
                            Dashboard Admin
                        </button>
                    @endif
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
                @else
                    <button onclick="openLoginModal()" class="px-4 py-2 border border-secondary text-secondary rounded-lg font-semibold text-xs hover:bg-secondary hover:text-white transition-colors">
                        Sign In Admin
                    </button>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="flex-grow flex flex-col items-center justify-center px-4 py-8">
        <div class="w-full max-w-[1000px] flex flex-col gap-8">

            <!-- TAB 1: FORMULIR PENAWARAN (GUEST SUBMISSION) -->
            <section id="form-section" class="tab-content flex flex-col gap-8">
                <div class="text-center flex flex-col gap-3">
                    <h1 class="font-headline-xl text-[36px] md:text-headline-xl text-primary tracking-tight font-extrabold">Ajukan Penawaran Desain Web</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                        Mulai langkah digital Anda hari ini. Lengkapi detail proyek Anda dan dapatkan estimasi harga resmi instan.
                    </p>
                </div>

                <div class="bg-surface-container-lowest border border-outline-variant p-8 md:p-10 rounded-xl shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-[6px] bg-gradient-to-r from-primary to-secondary"></div>
                    <h2 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">description</span> Formulir Data Klien
                    </h2>
                    
                    <form id="proposalForm" class="flex flex-col gap-6" onsubmit="handleFormSubmit(event)">
                        @csrf
                        <!-- Nama Klien -->
                        <div class="flex flex-col gap-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="client-name">Nama Lengkap Klien</label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-outline">person</span>
                                <input required class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="client-name" name="client_name" placeholder="Contoh: PT. Maju Jaya Kreatif / Ahmad Subarjo" type="text"/>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col gap-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="client-email">Alamat Email Aktif</label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-outline">mail</span>
                                <input required class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="client-email" name="email" placeholder="Contoh: ahmad@domain.com" type="email"/>
                            </div>
                            <span class="text-xs text-outline italic">Kode pelacakan penawaran resmi akan dikirim ke alamat email ini.</span>
                        </div>

                        <!-- Nomor Telepon (Kode Area Dropdown + No Telepon) -->
                        <div class="flex flex-col gap-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold">Nomor Telepon / WhatsApp</label>
                            <div class="flex gap-2">
                                <select id="phone-country-code" name="phone_country_code" class="w-32 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none py-3 px-3 transition-all">
                                    <option value="+62">🇮🇩 +62 (ID)</option>
                                    <option value="+65">🇸🇬 +65 (SG)</option>
                                    <option value="+60">🇲🇾 +60 (MY)</option>
                                    <option value="+1">🇺🇸 +1 (US)</option>
                                    <option value="+44">🇬🇧 +44 (UK)</option>
                                </select>
                                <div class="relative flex-grow flex items-center">
                                    <span class="material-symbols-outlined absolute left-4 text-outline">phone</span>
                                    <input required class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="client-phone" name="phone_number" placeholder="Contoh: 8123456789" type="tel" pattern="[0-9]{8,15}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Lengkap Terstruktur -->
                        <div class="border-t border-outline-variant pt-6 mt-2">
                            <h3 class="text-md font-bold text-primary mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined">map</span> Alamat Lengkap Klien
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2 flex flex-col gap-2">
                                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="address-street">Nama Jalan / Gedung / RT RW</label>
                                    <input required class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="address-street" name="address_street" placeholder="Nama Jalan, Blok, Kompleks, atau Gedung" type="text"/>
                                </div>
                                <div class="md:col-span-2 flex flex-col gap-2">
                                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="address-street2">Nama Jalan Baris 2 <span class="text-xs text-outline italic">(Opsional)</span></label>
                                    <input class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="address-street2" name="address_street2" placeholder="Detail tambahan (Contoh: Lantai 3, Kamar 304, dll)" type="text"/>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="address-city">Kabupaten / Kota</label>
                                    <input required class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="address-city" name="address_city" placeholder="Contoh: Jakarta Selatan" type="text"/>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="address-province">Provinsi</label>
                                    <input required class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="address-province" name="address_province" placeholder="Contoh: DKI Jakarta" type="text"/>
                                </div>
                                <div class="flex flex-col gap-2 md:col-span-2">
                                    <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="address-postal">Kode Pos</label>
                                    <input required class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" id="address-postal" name="address_postal" placeholder="Contoh: 12340" type="text" pattern="[0-9]{5}"/>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi Kebutuhan Singkat (Tambahan Detail untuk Klien) -->
                        <div class="flex flex-col gap-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="project-desc">Deskripsi Singkat Proyek</label>
                            <textarea id="project-desc" name="project_description" rows="3" class="w-full px-4 py-3 bg-surface border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all" placeholder="Jelaskan kebutuhan website Anda (Contoh: Landing Page Marketing, Toko Online dengan Payment Gateway, Profil Perusahaan, dll)"></textarea>
                        </div>

                        <button id="submitBtn" class="w-full bg-secondary text-on-secondary py-4 rounded-lg font-label-md text-label-md uppercase tracking-widest hover:bg-primary transition-colors active:scale-[0.98] duration-100 flex items-center justify-center gap-2 mt-4" type="submit">
                            <span>Kirim Penawaran</span>
                            <span class="material-symbols-outlined">send</span>
                        </button>
                    </form>
                </div>
            </section>

            <!-- TAB 2: PELACAKAN STATUS PENAWARAN (TRACKING) -->
            <section id="track-section" class="tab-content hidden flex flex-col gap-8">
                <div class="text-center flex flex-col gap-3">
                    <h1 class="font-headline-xl text-[36px] md:text-headline-xl text-primary tracking-tight font-extrabold">Lacak Penawaran Anda</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
                        Masukkan kode keamanan penawaran unik Anda di bawah ini untuk melihat update real-time dan tahap perkembangan dokumen Anda.
                    </p>
                </div>

                <!-- Search Card -->
                <div class="bg-surface-container-lowest border border-outline-variant p-8 md:p-10 rounded-xl shadow-sm">
                    <form id="trackForm" class="flex flex-col gap-6" onsubmit="handleTrackingSearch(event)">
                        <div class="flex flex-col gap-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider font-semibold" for="proposal-code">Kode Keamanan Penawaran</label>
                            <div class="relative flex items-center">
                                <span class="material-symbols-outlined absolute left-4 text-outline">key</span>
                                <input class="w-full pl-12 pr-4 py-4 bg-surface border border-outline-variant rounded-lg font-headline-md text-headline-md focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all placeholder:text-outline-variant" id="proposal-code" placeholder="Contoh: WD-202607-001" type="text" required/>
                            </div>
                        </div>
                        <button class="w-full bg-secondary text-on-secondary py-4 rounded-lg font-label-md text-label-md uppercase tracking-widest hover:bg-primary transition-colors active:scale-[0.98] duration-100 flex items-center justify-center gap-2" type="submit">
                            <span>Lacak Penawaran</span>
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </form>
                </div>

                <!-- Skeleton Loader Mock (Skeletonizer Simulation for 1-2s fetching time) -->
                <div id="skeleton-loader" class="hidden bg-surface-container-lowest border border-outline-variant p-8 rounded-xl shadow-sm flex flex-col gap-6">
                    <div class="flex justify-between items-center pb-4 border-b border-outline-variant">
                        <div class="h-6 w-48 skeleton-block rounded"></div>
                        <div class="h-8 w-24 skeleton-block rounded-full"></div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-3">
                            <div class="h-4 w-32 skeleton-block rounded"></div>
                            <div class="h-8 w-full skeleton-block rounded"></div>
                            <div class="h-4 w-24 skeleton-block rounded"></div>
                            <div class="h-6 w-full skeleton-block rounded"></div>
                        </div>
                        <div class="flex flex-col gap-3">
                            <div class="h-4 w-32 skeleton-block rounded"></div>
                            <div class="h-6 w-full skeleton-block rounded"></div>
                            <div class="h-6 w-3/4 skeleton-block rounded"></div>
                        </div>
                    </div>
                    <div class="h-20 w-full skeleton-block rounded mt-4"></div>
                </div>

                <!-- Search Result Detail Card (Dynamic Content) -->
                <div id="tracking-result" class="hidden bg-surface-container-lowest border border-outline-variant p-8 rounded-xl shadow-md flex flex-col gap-6 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-[6px]" id="result-accent-bar"></div>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 pb-4 border-b border-outline-variant">
                        <div>
                            <span class="text-xs uppercase tracking-wider text-outline font-semibold">Kode Penawaran</span>
                            <h2 class="text-2xl font-bold text-primary" id="result-proposal-code">WD-202607-001</h2>
                        </div>
                        <div id="result-status-badge" class="px-4 py-2 rounded-full font-bold text-sm">
                            Pending
                        </div>
                    </div>

                    <!-- Client Detail Info -->
                    <div class="grid md:grid-cols-2 gap-6 text-sm">
                        <div class="flex flex-col gap-4">
                            <div>
                                <h4 class="text-outline uppercase text-xs font-semibold mb-1">Nama Klien</h4>
                                <p class="text-on-surface font-semibold" id="result-client-name">PT. Maju Jaya Kreatif</p>
                            </div>
                            <div>
                                <h4 class="text-outline uppercase text-xs font-semibold mb-1">Hubungi Klien</h4>
                                <p class="text-on-surface" id="result-client-contact">ahmad@domain.com • +62 8123456789</p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <div>
                                <h4 class="text-outline uppercase text-xs font-semibold mb-1">Alamat Pengiriman</h4>
                                <p class="text-on-surface whitespace-pre-line" id="result-client-address">Jalan Jend Sudirman Kav 21
Gedung Antariksa Lt 5
Jakarta Selatan, DKI Jakarta
12340</p>
                            </div>
                        </div>
                    </div>

                    <!-- Project Description -->
                    <div class="bg-surface-container-low p-4 rounded-lg">
                        <h4 class="text-outline uppercase text-xs font-semibold mb-1">Deskripsi Kebutuhan Proyek</h4>
                        <p class="text-on-surface italic" id="result-project-desc">"Butuh website e-commerce modern dengan fitur checkout cepat."</p>
                    </div>

                    <!-- Lifecycle Indicator (Timeline) -->
                    <div class="w-full py-8 border-t border-outline-variant mt-4">
                        <!-- Progress Visualizer -->
                        <div class="flex flex-col md:flex-row items-center justify-between max-w-2xl mx-auto gap-y-6">
                            
                            <!-- Step 1 -->
                            <div class="flex flex-col items-center gap-2 tracking-step" id="step-1">
                                <div class="w-10 h-10 rounded-full border-2 border-primary bg-primary text-white flex items-center justify-center font-bold text-sm shadow-md transition-all duration-300">1</div>
                                <span class="font-label-sm text-label-sm text-primary font-bold">Diajukan</span>
                            </div>
                            <div class="hidden md:block h-1 bg-outline-variant flex-grow mx-2 mt-[-20px] transition-all duration-300" id="line-1"></div>
                            
                            <!-- Step 2 -->
                            <div class="flex flex-col items-center gap-2 tracking-step opacity-40" id="step-2">
                                <div class="w-10 h-10 rounded-full border-2 border-outline flex items-center justify-center font-bold text-sm bg-white transition-all duration-300">2</div>
                                <span class="font-label-sm text-label-sm text-outline font-semibold">Ditinjau</span>
                            </div>
                            <div class="hidden md:block h-1 bg-outline-variant flex-grow mx-2 mt-[-20px] transition-all duration-300" id="line-2"></div>
                            
                            <!-- Step 3 -->
                            <div class="flex flex-col items-center gap-2 tracking-step opacity-40" id="step-3">
                                <div class="w-10 h-10 rounded-full border-2 border-outline flex items-center justify-center font-bold text-sm bg-white transition-all duration-300">3</div>
                                <span class="font-label-sm text-label-sm text-outline font-semibold">Keputusan</span>
                            </div>
                            <div class="hidden md:block h-1 bg-outline-variant flex-grow mx-2 mt-[-20px] transition-all duration-300" id="line-3"></div>
                            
                            <!-- Step 4 -->
                            <div class="flex flex-col items-center gap-2 tracking-step opacity-40" id="step-4">
                                <div class="w-10 h-10 rounded-full border-2 border-outline flex items-center justify-center font-bold text-sm bg-white transition-all duration-300">4</div>
                                <span class="font-label-sm text-label-sm text-outline font-semibold">Proses Eksekusi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Grid (Recent & Help) -->
                <div class="grid md:grid-cols-2 gap-gutter">
                    <!-- Recent Searches -->
                    <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-lg flex flex-col gap-4">
                        <div class="flex items-center gap-2 text-primary border-b border-outline-variant pb-3">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">history</span>
                            <h3 class="font-label-md text-label-md font-bold uppercase">Pencarian Terakhir</h3>
                        </div>
                        <div class="flex flex-col gap-2" id="recent-searches-list">
                            <!-- Populated via Javascript -->
                            <p class="text-xs text-outline py-2 italic text-center">Belum ada riwayat pencarian terbaru.</p>
                        </div>
                    </div>

                    <!-- Need Help? -->
                    <div class="bg-surface-container-lowest border border-outline-variant p-6 rounded-lg flex flex-col gap-4">
                        <div class="flex items-center gap-2 text-primary border-b border-outline-variant pb-3">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">help_center</span>
                            <h3 class="font-label-md text-label-md font-bold uppercase">Butuh Bantuan?</h3>
                        </div>
                        <div class="flex flex-col gap-4">
                            <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                Jika Anda kehilangan kode penawaran Anda atau mengalami kendala pemuatan data, silakan hubungi layanan bantuan kami.
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <button class="px-4 py-2 border border-secondary text-secondary rounded-full font-label-sm text-label-sm hover:bg-secondary-fixed-dim/20 transition-colors">
                                    Live Support (WA)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <!-- FLOATING ADMIN LOGIN MODAL (WITHOUT SWITCHING PAGE) -->
    <div id="admin-login-modal" class="fixed inset-0 bg-black/60 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-sm w-full p-6 relative border border-outline-variant">
            <!-- Close Button (X) -->
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-outline hover:text-on-surface transition-colors flex">
                <span class="material-symbols-outlined">close</span>
            </button>

            <h3 class="text-2xl font-bold text-primary mb-6">Admin Login</h3>

            <!-- Error message container -->
            <div id="login-error-msg" class="hidden bg-red-100 border border-red-300 text-red-800 text-xs p-3 rounded-lg mb-4"></div>

            <form id="ajaxLoginForm" onsubmit="handleAjaxLogin(event)" class="flex flex-col gap-5">
                @csrf
                <!-- USERNAME OR EMAIL -->
                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-bold text-outline uppercase tracking-wider">Username or Email</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">person</span>
                        <input required type="text" id="login-username" class="w-full pl-11 pr-4 py-2.5 bg-surface border border-outline-variant rounded-lg text-sm focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all placeholder-outline" placeholder="Enter your username"/>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="flex flex-col gap-1">
                    <label class="text-[11px] font-bold text-outline uppercase tracking-wider">Password</label>
                    <div class="relative flex items-center">
                        <span class="material-symbols-outlined absolute left-3.5 text-outline text-[20px]">lock</span>
                        <input required type="password" id="login-password" class="w-full pl-11 pr-4 py-2.5 bg-surface border border-outline-variant rounded-lg text-sm focus:ring-2 focus:ring-secondary focus:border-secondary outline-none transition-all placeholder-outline" placeholder="••••••••"/>
                    </div>
                </div>

                <!-- Sign In Admin Button -->
                <button type="submit" id="ajaxSignInBtn" class="w-full bg-[#0058be] hover:bg-primary text-white py-3 rounded-lg text-sm font-bold transition-colors mt-2 shadow">
                    Sign In Admin
                </button>

                <!-- Forgot Password? -->
                <div class="text-center mt-1">
                    <a href="#" class="text-xs text-secondary hover:underline font-semibold">Forgot Password?</a>
                </div>
            </form>
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
        // Check query parameters to automatically show login modal
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('login') === '1') {
                openLoginModal();
            }
        });

        // Modal triggers
        function openLoginModal() {
            document.getElementById('admin-login-modal').classList.remove('hidden');
            document.getElementById('login-username').focus();
        }

        function closeLoginModal() {
            document.getElementById('admin-login-modal').classList.add('hidden');
            document.getElementById('login-error-msg').classList.add('hidden');
            document.getElementById('ajaxLoginForm').reset();
        }

        // Handle AJAX login verification (no page reload)
        function handleAjaxLogin(e) {
            e.preventDefault();
            const btn = document.getElementById('ajaxSignInBtn');
            const errorContainer = document.getElementById('login-error-msg');
            
            errorContainer.classList.add('hidden');
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[16px] mr-1 inline">sync</span> Verifying...';

            const payload = {
                username: document.getElementById('login-username').value,
                password: document.getElementById('login-password').value,
            };

            fetch('{{ route("login.submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(json => {
                btn.disabled = false;
                btn.innerText = 'Sign In Admin';

                if (json.success) {
                    showToast('Login berhasil! Mengalihkan ke Dashboard...');
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.dashboard") }}';
                    }, 1000);
                } else {
                    errorContainer.innerText = json.message || 'Username atau password salah.';
                    errorContainer.classList.remove('hidden');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerText = 'Sign In Admin';
                errorContainer.innerText = 'Koneksi server terputus.';
                errorContainer.classList.remove('hidden');
            });
        }

        // Init recent searches from localStorage
        if (!localStorage.getItem('recent_searches_live')) {
            localStorage.setItem('recent_searches_live', JSON.stringify([]));
        }

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

        // Switch between tabs
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(tabId).classList.remove('hidden');

            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('text-primary', 'font-semibold', 'border-primary');
                btn.classList.add('text-on-surface-variant', 'border-transparent');
            });

            const activeBtn = document.getElementById('nav-' + tabId);
            if (activeBtn) {
                activeBtn.classList.add('text-primary', 'font-semibold', 'border-primary');
                activeBtn.classList.remove('text-on-surface-variant', 'border-transparent');
            }

            if (tabId === 'track-section') {
                renderRecentSearches();
            }
        }

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

        // Handle client submission form (calls Live API)
        function handleFormSubmit(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('submitBtn');
            const originalBtnHtml = submitBtn.innerHTML;
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Mengirim & Menyimpan Ke Database...';
            submitBtn.classList.add('opacity-70');

            const payload = {
                client_name: document.getElementById('client-name').value,
                email: document.getElementById('client-email').value,
                phone_country_code: document.getElementById('phone-country-code').value,
                phone_number: document.getElementById('client-phone').value,
                address_street: document.getElementById('address-street').value,
                address_street2: document.getElementById('address-street2').value,
                address_city: document.getElementById('address-city').value,
                address_province: document.getElementById('address-province').value,
                address_postal: document.getElementById('address-postal').value,
                project_description: document.getElementById('project-desc').value,
            };

            fetch('/api/proposals', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(json => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                submitBtn.classList.remove('opacity-70');

                if (json.success) {
                    const uniqueCode = json.data.proposal_code;
                    document.getElementById('proposalForm').reset();
                    showToast(`Proposal sukses disimpan! Kode Pelacakan Anda: ${uniqueCode}`);
                    
                    // Add to recent search
                    addRecentSearch(uniqueCode, json.data.client_name, json.data.created_at.split('T')[0]);

                    // Redirect search view
                    document.getElementById('proposal-code').value = uniqueCode;
                    switchTab('track-section');
                    handleTrackingSearch();
                } else {
                    showToast(json.message || 'Gagal menyimpan proposal.', 'error');
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                submitBtn.classList.remove('opacity-70');
                showToast('Koneksi bermasalah atau database error.', 'error');
            });
        }

        // Handle status tracking search (calls Live API)
        function handleTrackingSearch(e) {
            if (e) e.preventDefault();
            const codeInput = document.getElementById('proposal-code').value.trim().toUpperCase();
            
            const skeletonLoader = document.getElementById('skeleton-loader');
            const trackingResult = document.getElementById('tracking-result');

            trackingResult.classList.add('hidden');
            skeletonLoader.classList.remove('hidden');

            fetch(`/api/proposals/${codeInput}`, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(json => {
                skeletonLoader.classList.add('hidden');

                if (json.success) {
                    const found = json.data;
                    document.getElementById('result-proposal-code').innerText = found.proposal_code;
                    document.getElementById('result-client-name').innerText = found.client_name;
                    document.getElementById('result-client-contact').innerText = `${found.email} • ${found.phone_country_code} ${found.phone_number}`;
                    
                    const addressLines = [found.address_street];
                    if (found.address_street2) addressLines.push(found.address_street2);
                    addressLines.push(`${found.address_city}, ${found.address_province}`);
                    addressLines.push(found.address_postal);
                    document.getElementById('result-client-address').innerText = addressLines.join('\n');
                    
                    document.getElementById('result-project-desc').innerText = `"${found.project_description || 'Tidak ada deskripsi.'}"`;

                    const badge = document.getElementById('result-status-badge');
                    const accent = document.getElementById('result-accent-bar');
                    badge.className = "px-4 py-2 rounded-full font-bold text-sm text-white ";
                    
                    let activeStep = 1;
                    if (found.status === 'Pending') {
                        badge.innerText = 'Pending';
                        badge.classList.add('bg-yellow-500');
                        accent.className = "absolute top-0 left-0 w-full h-[6px] bg-yellow-500";
                        activeStep = 1;
                    } else if (found.status === 'Reviewed') {
                        badge.innerText = 'Reviewed';
                        badge.classList.add('bg-blue-600');
                        accent.className = "absolute top-0 left-0 w-full h-[6px] bg-blue-600";
                        activeStep = 2;
                    } else if (found.status === 'Approved') {
                        badge.innerText = 'Approved (Disetujui)';
                        badge.classList.add('bg-green-600');
                        accent.className = "absolute top-0 left-0 w-full h-[6px] bg-green-600";
                        activeStep = 3;
                    } else if (found.status === 'Rejected') {
                        badge.innerText = 'Rejected (Ditolak)';
                        badge.classList.add('bg-red-600');
                        accent.className = "absolute top-0 left-0 w-full h-[6px] bg-red-600";
                        activeStep = 3;
                    }

                    updateLifecycleUI(activeStep, found.status);
                    trackingResult.classList.remove('hidden');

                    addRecentSearch(found.proposal_code, found.client_name, found.created_at.split('T')[0]);
                    showToast('Data penawaran berhasil ditemukan!');
                } else {
                    showToast('Kode penawaran tidak ditemukan atau tidak valid!', 'error');
                }
            })
            .catch(err => {
                skeletonLoader.classList.add('hidden');
                showToast('Koneksi atau server database gagal.', 'error');
            });
        }

        // Update step UI based on current status
        function updateLifecycleUI(stepNum, status) {
            for (let i = 1; i <= 4; i++) {
                const stepEl = document.getElementById(`step-${i}`);
                const circle = stepEl.querySelector('div');
                const text = stepEl.querySelector('span');
                
                stepEl.classList.add('opacity-40');
                circle.className = "w-10 h-10 rounded-full border-2 border-outline flex items-center justify-center font-bold text-sm bg-white transition-all duration-300";
                text.className = "font-label-sm text-label-sm text-outline font-semibold";
                
                if (i < 4) {
                    document.getElementById(`line-${i}`).className = "hidden md:block h-1 bg-outline-variant flex-grow mx-2 mt-[-20px] transition-all duration-300";
                }
            }

            for (let i = 1; i <= stepNum; i++) {
                const stepEl = document.getElementById(`step-${i}`);
                const circle = stepEl.querySelector('div');
                const text = stepEl.querySelector('span');

                stepEl.classList.remove('opacity-40');
                
                if (i === stepNum) {
                    if (status === 'Rejected') {
                        circle.className = "w-10 h-10 rounded-full border-2 border-error bg-error text-white flex items-center justify-center font-bold text-sm shadow-md transition-all duration-300";
                        text.className = "font-label-sm text-label-sm text-error font-bold";
                        text.innerText = "Ditolak";
                    } else if (status === 'Approved') {
                        circle.className = "w-10 h-10 rounded-full border-2 border-green-600 bg-green-600 text-white flex items-center justify-center font-bold text-sm shadow-md transition-all duration-300";
                        text.className = "font-label-sm text-label-sm text-green-600 font-bold";
                        text.innerText = "Disetujui";
                    } else {
                        circle.className = "w-10 h-10 rounded-full border-2 border-primary bg-primary text-white flex items-center justify-center font-bold text-sm shadow-md transition-all duration-300";
                        text.className = "font-label-sm text-label-sm text-primary font-bold";
                    }
                } else {
                    circle.className = "w-10 h-10 rounded-full border-2 border-primary bg-primary/20 text-primary flex items-center justify-center font-bold text-sm transition-all duration-300";
                    text.className = "font-label-sm text-label-sm text-primary/80 font-semibold";
                }

                if (i < stepNum && i < 4) {
                    document.getElementById(`line-${i}`).className = "hidden md:block h-1 bg-primary flex-grow mx-2 mt-[-20px] transition-all duration-300";
                }
            }

            if (status === 'Approved') {
                document.getElementById('line-3').className = "hidden md:block h-1 bg-primary flex-grow mx-2 mt-[-20px] transition-all duration-300";
                const step4 = document.getElementById('step-4');
                const circle4 = step4.querySelector('div');
                const text4 = step4.querySelector('span');
                step4.classList.remove('opacity-40');
                circle4.className = "w-10 h-10 rounded-full border-2 border-secondary bg-secondary text-white flex items-center justify-center font-bold text-sm shadow-md transition-all duration-300";
                text4.className = "font-label-sm text-label-sm text-secondary font-bold";
            }
        }

        // Add code to recent search list in localStorage
        function addRecentSearch(code, clientName, date) {
            let recent = JSON.parse(localStorage.getItem('recent_searches_live') || '[]');
            recent = recent.filter(r => r.code !== code);
            recent.unshift({ code, clientName, date });
            if (recent.length > 5) recent.pop();
            localStorage.setItem('recent_searches_live', JSON.stringify(recent));
            renderRecentSearches();
        }

        // Render recent search list
        function renderRecentSearches() {
            const list = document.getElementById('recent-searches-list');
            const recent = JSON.parse(localStorage.getItem('recent_searches_live') || '[]');
            
            if (recent.length === 0) {
                list.innerHTML = `<p class="text-xs text-outline py-2 italic text-center">Belum ada riwayat pencarian terbaru.</p>`;
                return;
            }

            list.innerHTML = recent.map(item => `
                <div onclick="selectRecentSearch('${item.code}')" class="flex items-center justify-between p-3 hover:bg-surface-container-low transition-colors rounded cursor-pointer group border border-transparent hover:border-outline-variant bg-white shadow-sm font-body-sm font-body-sm">
                    <div class="flex flex-col">
                        <span class="font-label-md text-label-md text-on-surface font-bold">${item.code}</span>
                        <span class="font-body-sm text-[12px] text-on-surface-variant">${item.clientName} • ${item.date}</span>
                    </div>
                    <span class="material-symbols-outlined text-outline group-hover:text-secondary">open_in_new</span>
                </div>
            `).join('');
        }

        function selectRecentSearch(code) {
            document.getElementById('proposal-code').value = code;
            handleTrackingSearch();
        }

        // Input effect
        const proposalInput = document.getElementById('proposal-code');
        if (proposalInput) {
            const inputParent = proposalInput.parentElement;
            proposalInput.addEventListener('focus', () => {
                inputParent.classList.add('scale-[1.01]', 'shadow-md');
            });
            proposalInput.addEventListener('blur', () => {
                inputParent.classList.remove('scale-[1.01]', 'shadow-md');
            });
        }
    </script>
</body>
</html>
