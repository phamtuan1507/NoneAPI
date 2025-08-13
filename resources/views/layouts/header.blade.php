<header class="container px-4 mx-auto bg-white shadow sm:px-6 lg:px-8">
    <div class="container flex items-center justify-between mx-auto">
        <!-- Logo -->
        <div class="flex items-center py-[10px]">
            <a href="{{ route('home') }}" class="hover:text-[#7a4a2f]">
                <img src="{{ asset('logo.png') }}" alt="Mona Beauty Blendz" class="h-[100px]" />
            </a>
        </div>

        <!-- Main menu desktop -->
        <nav class="flex-1 flex justify-center py-[27px]">
            <ul class="hidden md:flex space-x-8 color-[#121f38] text-[14px] font-medium">
                <li>
                    <a href="{{ route('about') }}" class="hover:text-[#7a4a2f]">GIỚI THIỆU</a>
                </li>
                <li class="relative group">
                    <a href="#" class="hover:text-[#7a4a2f] flex items-center">
                        DỊCH VỤ
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul class="absolute left-0 top-full min-w-[180px] bg-white shadow-lg rounded-b z-20 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-all">
                        <li>
                            <a href="{{ route('services') }}" class="flex items-center px-5 py-2 hover:text-[#7a4a2f]">
                                <span class="mr-2 w-2 h-2 bg-[#7a4a2f] rounded-full"></span>
                                SPA THƯ GIÃN
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('team') }}" class="flex items-center px-5 py-2 hover:text-[#7a4a2f]">
                                <span class="mr-2 w-2 h-2 bg-[#7a4a2f] rounded-full"></span>
                                CHUYÊN GIA
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('appointment') }}" class="flex items-center px-5 py-2 hover:text-[#7a4a2f]">
                                <span class="mr-2 w-2 h-2 bg-[#7a4a2f] rounded-full"></span>
                                ĐẶT HẸN
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('products') }}" class="hover:text-[#7a4a2f]">SẢN PHẨM</a>
                </li>
                <li>
                    <a href="{{ route('blogs') }}" class="hover:text-[#7a4a2f]">TIN TỨC</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="hover:text-[#7a4a2f]">LIÊN HỆ</a>
                </li>
                @if (auth()->check() && auth()->user()->role === 'admin')
                    <li>
                        <a href="{{ route('admin.users') }}" class="hover:text-[#7a4a2f]">QUẢN LÝ NGƯỜI DÙNG</a>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Right icons -->
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <button class="text-[#1a2233] hover:text-[#7a4a2f] focus:outline-none cursor-pointer" onclick="openSearchForm()">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" />
                </svg>
            </button>
            <!-- Cart -->
            <div class="relative">
                <a href="{{ route('cart') }}" class="text-[#1a2233] hover:text-[#7a4a2f] focus:outline-none cursor-pointer">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="9" cy="21" r="1" stroke-width="2" />
                        <circle cx="20" cy="21" r="1" stroke-width="2" />
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" stroke-width="2" />
                    </svg>
                </a>
                <span class="absolute -top-2 -right-2 bg-[#7a4a2f] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{-- {{ session('cart', [])->sum('quantity') }} --}}
                    0
                </span>
            </div>
            @auth
                <span class="cursor-pointer hover:text-[#7a4a2f]" onclick="showProfile()">{{ auth()->user()->fullName ?? auth()->user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-[#7a4a2f] focus:outline-none">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-[#7a4a2f]">
                    <button class="text-[#1a2233] hover:text-[#7a4a2f] focus:outline-none cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </button>
                </a>
            @endauth
            <div class="hidden md:inline-block">
                <a href="{{ route('contact') }}">
                    <button class="relative z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                        Liên Hệ Ngay
                        <span class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                        <span class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                    </button>
                </a>
            </div>
            <!-- Hamburger menu -->
            <button class="md:hidden text-white bg-[#7a4a2f] p-2 focus:outline-none rounded" onclick="openMobileMenu()">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu drawer -->
    <div id="mobile-menu" class="fixed inset-0 z-50 flex bg-black bg-opacity-40 hidden">
        <div class="w-4/5 max-w-xs bg-[#f8f3f0] h-full shadow-xl flex flex-col">
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex items-center">
                    <img src="{{ asset('logo.png') }}" alt="Mona Beauty Blendz" class="h-10" />
                </div>
                <button class="text-white bg-[#7a4a2f] rounded-full w-8 h-8 flex items-center justify-center" onclick="closeMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex-1 overflow-y-auto">
                <ul class="mt-4 space-y-1 font-semibold text-[#1a2233]">
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center px-5 py-3 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">
                            <span class="mr-2">&rsaquo;</span> TRANG CHỦ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="flex items-center px-5 py-3 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">
                            <span class="mr-2">&rsaquo;</span> GIỚI THIỆU
                        </a>
                    </li>
                    <li>
                        <button onclick="toggleServiceMenu()" class="flex items-center w-full px-5 py-3 hover:text-[#7a4a2f] focus:outline-none">
                            <span class="mr-2">&rsaquo;</span>
                            <span>DỊCH VỤ</span>
                            <span class="ml-auto">
                                <span id="service-toggle" class="bg-gray-100 rounded-full px-2 py-0.5 text-[#7a4a2f]">+</span>
                            </span>
                        </button>
                        <ul id="service-menu" class="ml-8 border-l border-[#e5e7eb] hidden">
                            <li>
                                <a href="{{ route('services') }}" class="block px-5 py-2 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">Spa Thư Giãn</a>
                            </li>
                            <li>
                                <a href="{{ route('team') }}" class="block px-5 py-2 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">Chuyên Gia</a>
                            </li>
                            <li>
                                <a href="{{ route('appointment') }}" class="block px-5 py-2 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">Đặt Hẹn</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" class="flex items-center px-5 py-3 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">
                            <span class="mr-2">&rsaquo;</span> SẢN PHẨM
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blogs') }}" class="flex items-center px-5 py-3 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">
                            <span class="mr-2">&rsaquo;</span> TIN TỨC
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="flex items-center px-5 py-3 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">
                            <span class="mr-2">&rsaquo;</span> LIÊN HỆ
                        </a>
                    </li>
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.users') }}" class="flex items-center px-5 py-3 hover:text-[#7a4a2f]" onclick="closeMobileMenu()">
                                <span class="mr-2">&rsaquo;</span> QUẢN LÝ NGƯỜI DÙNG
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        <div class="flex-1" onclick="closeMobileMenu()"></div>
    </div>

    <!-- Search Bar -->
    <div id="search-form" class="fixed inset-0 z-[100] bg-black bg-opacity-90 flex items-center justify-center hidden">
        <form class="relative w-full max-w-3xl px-4" onsubmit="return false;">
            <input type="text" placeholder="Tìm kiếm..." class="w-full py-6 pl-8 pr-16 rounded-full border-2 border-[#a05c3c] bg-transparent text-white text-2xl outline-none" autofocus />
            <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 text-white hover:text-[#a05c3c] transition-transform duration-300 hover:scale-125 cursor-pointer">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8" stroke-width="2" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" />
                </svg>
            </button>
            <button type="button" class="absolute cursor-pointer right-0 top-0 -translate-y-1/2 translate-x-1/2 bg-white text-[#a05c3c] hover:bg-[#a05c3c] hover:text-white rounded-full w-14 h-14 flex items-center justify-center" onclick="closeSearchForm()">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </form>
    </div>
</header>

@section('scripts')
<script>
    function openMobileMenu() {
        document.getElementById('mobile-menu').classList.remove('hidden');
    }

    function closeMobileMenu() {
        document.getElementById('mobile-menu').classList.add('hidden');
        document.getElementById('service-menu').classList.add('hidden');
        document.getElementById('service-toggle').textContent = '+';
    }

    function toggleServiceMenu() {
        const menu = document.getElementById('service-menu');
        const toggle = document.getElementById('service-toggle');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            toggle.textContent = '-';
        } else {
            menu.classList.add('hidden');
            toggle.textContent = '+';
        }
    }

    function openSearchForm() {
        document.getElementById('search-form').classList.remove('hidden');
    }

    function closeSearchForm() {
        document.getElementById('search-form').classList.add('hidden');
    }

    function showProfile() {
        alert("Profile: {{ auth()->check() ? json_encode(['name' => auth()->user()->fullName ?? auth()->user()->username, 'token' => session('token')]) : 'Not logged in' }}");
    }
</script>
@endsection
