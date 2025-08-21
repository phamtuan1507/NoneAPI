{{-- Tất cả các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Chi tiết sản phẩm')

{{-- Đặt file css cho page --}}
@section('file', 'product-detail')

{{-- Đặt class cho body --}}
@section('page', 'product-detail')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Chi tiết sản phẩm
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Chi tiết sản phẩm </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container flex flex-col gap-6 p-4 mx-auto md:flex-row pt-[120px] pb-[90px]">
            <!-- Product Image Gallery -->
            <div class="w-full md:w-1/2">
                @if (!$product)
                    <div class="text-center">
                        <p>Sản phẩm không tồn tại!</p>
                    </div>
                @else
                    <div class="w-full overflow-hidden h-96">
                        <img src="{{ asset('storage/' . ($mainImage ?? ($product->image ?? 'https://via.placeholder.com/400'))) }}"
                            alt="Main Product Image"
                            class="object-cover w-full h-full transition-opacity duration-500 main-image">
                    </div>
                    <div class="flex gap-2 mt-4">
                        @foreach ($productImages as $index => $image)
                            <div class="w-20 h-20 overflow-hidden cursor-pointer">
                                <img src="{{ asset('storage/' . ($image ?? ($product->image ?? 'https://via.placeholder.com/400'))) }}"
                                    onclick="document.querySelector('.main-image').src='{{ asset('storage/' . ($image ?? ($product->image ?? 'https://via.placeholder.com/400'))) }}'"
                                    alt="Thumbnail"
                                    class="object-cover w-full h-full transition-opacity bg-[#f1f1f1] duration-300 hover:opacity-75">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            @if ($product)
                <div class="w-full md:w-1/2">
                    <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
                    <p class="mt-1 text-gray-500">
                        @if ($product->reviews->avg('rating'))
                            {{ number_format($product->reviews->avg('rating'), 1) }} / 5
                            @for ($i = 1; $i <= 5; $i++)
                                <span
                                    class="text-yellow-400">{{ $i <= $product->reviews->avg('rating') ? '★' : '☆' }}</span>
                            @endfor
                            ({{ $product->reviews->count() }} đánh giá)
                        @else
                            Hiện tại không có đánh giá nào
                        @endif
                    </p>
                    <p class="mt-2 text-xl font-semibold">{{ number_format($product->price) }}đ</p>
                    <p class="mt-4 text-gray-600">{{ $product->description }}</p>
                    <div class="mt-4">
                        <p><strong>SKU:</strong> {{ $product->sku }}</p>
                        <p><strong>Danh Mục:</strong> {{ $product->category->name ?? 'Không có danh mục' }}</p>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex items-center gap-4 mt-4">
                            <label for="quantity" class="font-semibold">Số Lượng:</label>
                            <div class="flex items-center border rounded">
                                <button onclick="updateQuantity('decrease', this)" class="px-3 py-1">-</button>
                                <input type="number" id="quantity" name="quantity" value="1" class="w-16 text-center"
                                    max="{{ $product->quantity }}" min="1">
                                <button onclick="updateQuantity('increase', this)" class="px-3 py-1">+</button>
                            </div>
                        </div>
                        <button onclick="addToCart({{ $product->id }})"
                            class="relative z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer mt-4">
                            Thêm vào giỏ hàng
                            <span
                                class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                            <span
                                class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                        </button>
                    </div>
                </div>
            @endif
        </div>

        @if ($product)
            <div class="container p-4 mx-auto">
                <!-- Nav Tabs -->
                <div class="border-b">
                    <nav class="flex gap-4">
                        <button onclick="showTab('description')"
                            class="{{ request()->get('tab') === 'description' || !request()->get('tab') ? 'border-b-2 border-amber-700 text-amber-700' : 'text-gray-500' }} px-4 py-2">
                            Mô tả
                        </button>
                        <button onclick="showTab('review')"
                            class="{{ request()->get('tab') === 'review' ? 'border-b-2 border-amber-700 text-amber-700' : 'text-gray-500' }} px-4 py-2">
                            Đánh giá
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="mt-4">
                    <div id="description-tab"
                        class="p-4 bg-gray-100 {{ request()->get('tab') !== 'review' ? 'block' : 'hidden' }}">
                        <p>{{ $product->description }}</p>
                        <ul class="mt-2 ml-5 list-disc">
                            <li>Beauty products dolor consectetur adipisicing</li>
                            <li>Given they’re tree abundantly male our</li>
                        </ul>
                    </div>
                    <div id="review-tab"
                        class="p-4 bg-gray-100 {{ request()->get('tab') === 'review' ? 'block' : 'hidden' }}">
                        <p class="bg-[#ffffff] p-[14px_25px]">
                            @if ($product->reviews->count())
                                Đánh giá trung bình: {{ number_format($product->reviews->avg('rating'), 1) }} / 5
                                @for ($i = 1; $i <= 5; $i++)
                                    <span
                                        class="text-yellow-400">{{ $i <= $product->reviews->avg('rating') ? '★' : '☆' }}</span>
                                @endfor
                                ({{ $product->reviews->count() }} đánh giá)
                            @else
                                Hiện tại không có đánh giá nào.
                            @endif
                        </p>
                        <h2 class="mt-4 text-xl font-semibold">
                            ĐÁNH GIÁ "{{ $product->name }}"
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Email của bạn sẽ không được hiển thị công khai. Các trường bắt buộc được đánh dấu *
                        </p>
                        <div class="mt-4">
                            <label class="block">Chọn số sao</label>
                            <div id="star-rating" class="flex items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span
                                        class="cursor-pointer text-2xl {{ in_array($i, $selectedStars ?? []) ? 'text-yellow-400' : 'text-gray-300' }}"
                                        onclick="selectStar({{ $i }})">★</span>
                                @endfor
                            </div>
                            <input type="hidden" id="rating" name="rating" value="{{ old('rating') ?? 0 }}">
                        </div>
                        <div class="mt-4">
                            <label class="block">Nhận xét của bạn</label>
                            <textarea id="comment" name="comment" class="w-full p-2 mt-2 border rounded" rows="4"
                                placeholder="Viết nhận xét của bạn">{{ old('comment') }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label class="block">Họ tên *</label>
                            <input type="text" id="name" name="name"
                                value="{{ auth()->check() ? auth()->user()->name : old('name') }}"
                                class="w-full p-2 border rounded" required />
                        </div>
                        <div class="mt-4">
                            <label class="block">Email *</label>
                            <input type="email" id="email" name="email"
                                value="{{ auth()->check() ? auth()->user()->email : old('name') }}"
                                class="w-full p-2 border rounded" required />
                        </div>
                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="save-info" name="save_info" class="mr-2" />
                                Lưu tên, email và trang web của tôi trong trình duyệt này cho lần bình luận tiếp theo.
                            </label>
                        </div>
                        <button onclick="submitReview({{ $product->id }})"
                            class="relative mt-[24px] z-[1] inline-block px-[23px] py-[10px] text-sm font-bold uppercase tracking-wider text-white bg-[#a05c3c] border-none rounded-none overflow-hidden text-center group cursor-pointer">
                            ĐĂNG ĐÁNH GIÁ
                            <span
                                class="absolute bottom-0 left-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                            <span
                                class="absolute top-0 right-0 w-1/2 h-0 bg-[#131e35] z-[-1] transition-all duration-400 ease-[cubic-bezier(0.77,0,0.18,1)] group-hover:h-full group-focus:h-full"></span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
<script>
    // JavaScript for quantity update
    function updateQuantity(action, element) {
        const input = element.parentElement.querySelector('input');
        let value = parseInt(input.value);
        const max = parseInt(input.getAttribute('max'));
        if (action === 'decrease' && value > 1) input.value = value - 1;
        if (action === 'increase' && value < max) input.value = value + 1;
    }

    // JavaScript for tab switching
    function showTab(tab) {
        document.getElementById('description-tab').classList.toggle('hidden', tab !== 'description');
        document.getElementById('review-tab').classList.toggle('hidden', tab !== 'review');
        const url = new URL(window.location);
        url.searchParams.set('tab', tab);
        window.history.pushState({}, '', url);
    }

    // Initialize tab based on URL parameter
    document.addEventListener('DOMContentLoaded', () => {
        const tab = new URLSearchParams(window.location.search).get('tab') || 'description';
        showTab(tab);
    });

    // JavaScript for adding to cart
    function addToCart(productId) {
        fetch('/check-auth', { // Kiểm tra trạng thái đăng nhập
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(authData => {
                console.log('Auth data:', authData); // Kiểm tra giá trị authData
                if (!authData.authenticated) {
                    showLoginPrompt();
                    return;
                }

                const quantity = document.getElementById('quantity').value;
                fetch('{{ route('cart.add', ['productId' => ':id']) }}'.replace(':id', productId), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            quantity: parseInt(quantity)
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Yêu cầu không thành công: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const successDiv = document.createElement('div');
                            successDiv.id = 'success-message';
                            successDiv.className =
                                'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
                            successDiv.innerHTML =
                                `<span class="block">${data.message}</span><div id="success-countdown" class="absolute bottom-0 left-0 h-1 bg-green-500 transition-all duration-500 ease-linear" style="width: 100%;"></div>`;
                            document.body.insertBefore(successDiv, document.body.firstChild);

                            const cartCount = document.getElementById('cart-count');
                            if (cartCount) {
                                cartCount.textContent = data.count;
                            }

                            setTimeout(() => {
                                const countdown = successDiv.querySelector('#success-countdown');
                                let width = 100;
                                const interval = setInterval(() => {
                                    width -= 1;
                                    countdown.style.width = `${width}%`;
                                    if (width <= 0) {
                                        clearInterval(interval);
                                        successDiv.style.display = 'none';
                                    }
                                }, 50);
                            }, 0);
                        } else {
                            const errorDiv = document.createElement('div');
                            errorDiv.id = 'error-message';
                            errorDiv.className =
                                'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
                            errorDiv.innerHTML =
                                `<ul><li>${data.message}</li></ul><div id="error-countdown" class="absolute bottom-0 left-0 h-1 bg-red-500 transition-all duration-300 ease-linear" style="width: 100%;"></div>`;
                            document.body.insertBefore(errorDiv, document.body.firstChild);

                            setTimeout(() => {
                                const countdown = errorDiv.querySelector('#error-countdown');
                                let width = 100;
                                const interval = setInterval(() => {
                                    width -= 1;
                                    countdown.style.width = `${width}%`;
                                    if (width <= 0) {
                                        clearInterval(interval);
                                        errorDiv.style.display = 'none';
                                    }
                                }, 30);
                            }, 0);
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                        alert('Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng. Chi tiết: ' + error.message);
                    });
            })
            .catch(error => console.error('Lỗi kiểm tra đăng nhập:', error));
    }

    // Hàm cập nhật số lượng giỏ hàng trên header
    function updateCartCount() {
        fetch('/cart/count', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.count;
                }
            })
            .catch(error => console.error('Lỗi khi cập nhật số lượng:', error));
    }

    // Gọi updateCartCount khi trang tải (nếu cần)
    document.addEventListener('DOMContentLoaded', () => {
        const tab = new URLSearchParams(window.location.search).get('tab') || 'description';
        showTab(tab);
        updateCartCount();
    });

    // Function to show login prompt
    function showLoginPrompt() {
        const loginDiv = document.createElement('div');
        loginDiv.id = 'login-prompt';
        loginDiv.className =
            'fixed bottom-0 left-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 max-w-xs relative overflow-hidden z-50';
        loginDiv.innerHTML = `
            <span class="block">Vui lòng <a href="{{ route('login') }}" class="underline">đăng nhập</a> để thực hiện thao tác này!</span>
            <div id="login-countdown" class="absolute bottom-0 left-0 h-1 bg-yellow-500 transition-all duration-500 ease-linear" style="width: 100%;"></div>
        `;
        document.body.insertBefore(loginDiv, document.body.firstChild);

        setTimeout(() => {
            const countdown = loginDiv.querySelector('#login-countdown');
            let width = 100;
            const interval = setInterval(() => {
                width -= 1;
                countdown.style.width = `${width}%`;
                if (width <= 0) {
                    clearInterval(interval);
                    loginDiv.style.display = 'none';
                }
            }, 50);
        }, 0);
    }
    // JavaScript cho việc chọn số sao
    let selectedStars = [];

    function selectStar(star) {
        selectedStars = star <= 5 ? [star] : [];
        document.getElementById('rating').value = selectedStars[0] || 0;
        updateStarDisplay();
    }

    function updateStarDisplay() {
        const stars = document.querySelectorAll('#star-rating span');
        stars.forEach((star, index) => {
            star.classList.toggle('text-yellow-400', selectedStars.includes(index + 1));
            star.classList.toggle('text-gray-300', !selectedStars.includes(index + 1));
        });
    }

    // Hàm submit review
    // function submitReview(productId) {
    //     const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    //     console.log('CSRF Token Element:', csrfTokenElement);
    //     const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : null;
    //     console.log('CSRF Token:', csrfToken);

    //     fetch('/check-auth', {
    //             headers: {
    //                 'X-CSRF-TOKEN': csrfToken || '',
    //                 'Accept': 'application/json',
    //             }
    //         })
    //         .then(response => response.json())
    //         .then(authData => {
    //             console.log('Auth Data:', authData);
    //             const ratingElement = document.getElementById('rating');
    //             const commentElement = document.getElementById('comment');
    //             const nameElement = document.getElementById('name');
    //             const emailElement = document.getElementById('email');
    //             const saveInfoElement = document.getElementById('save-info');

    //             console.log('Rating Element:', ratingElement);
    //             console.log('Comment Element:', commentElement);
    //             console.log('Name Element:', nameElement);
    //             console.log('Email Element:', emailElement);
    //             console.log('Save Info Element:', saveInfoElement);

    //             if (!ratingElement || !commentElement || !nameElement || !emailElement || !saveInfoElement) {
    //                 alert('Một hoặc nhiều trường không được tìm thấy trong trang. Vui lòng làm mới trang.');
    //                 return;
    //             }

    //             const rating = ratingElement.value;
    //             const comment = commentElement.value;
    //             const name = nameElement.value.trim();
    //             const email = emailElement.value.trim();
    //             const saveInfo = saveInfoElement.checked;

    //             // Kiểm tra nếu chưa đăng nhập và không có thông tin hợp lệ
    //             if (!authData.authenticated && (!name || !email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))) {
    //                 showLoginPrompt();
    //                 return;
    //             }

    //             fetch('/reviews', {
    //                     method: 'POST',
    //                     headers: {
    //                         'X-CSRF-TOKEN': csrfToken || '',
    //                         'Content-Type': 'application/json',
    //                         'Accept': 'application/json',
    //                     },
    //                     body: JSON.stringify({
    //                         product_id: productId,
    //                         rating: parseInt(rating),
    //                         comment: comment,
    //                         name: name,
    //                         email: email,
    //                         save_info: saveInfo
    //                     })
    //                 })
    //                 .then(response => {
    //                     if (!response.ok) {
    //                         throw new Error('Yêu cầu không thành công: ' + response.statusText);
    //                     }
    //                     return response.json();
    //                 })
    //                 .then(data => {
    //                     if (data.success) {
    //                         const successDiv = document.createElement('div');
    //                         successDiv.id = 'success-message';
    //                         successDiv.className =
    //                             'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
    //                         successDiv.innerHTML =
    //                             `<span class="block">${data.message}</span><div id="success-countdown" class="absolute bottom-0 left-0 h-1 bg-green-500 transition-all duration-500 ease-linear" style="width: 100%;"></div>`;
    //                         document.body.insertBefore(successDiv, document.body.firstChild);

    //                         setTimeout(() => {
    //                             const countdown = successDiv.querySelector('#success-countdown');
    //                             let width = 100;
    //                             const interval = setInterval(() => {
    //                                 width -= 1;
    //                                 countdown.style.width = `${width}%`;
    //                                 if (width <= 0) {
    //                                     clearInterval(interval);
    //                                     successDiv.style.display = 'none';
    //                                     location.reload(); // Tải lại trang để cập nhật đánh giá
    //                                 }
    //                             }, 50);
    //                         }, 0);
    //                     } else {
    //                         const errorDiv = document.createElement('div');
    //                         errorDiv.id = 'error-message';
    //                         errorDiv.className =
    //                             'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
    //                         errorDiv.innerHTML =
    //                             `<ul><li>${data.message}</li></ul><div id="error-countdown" class="absolute bottom-0 left-0 h-1 bg-red-500 transition-all duration-300 ease-linear" style="width: 100%;"></div>`;
    //                         document.body.insertBefore(errorDiv, document.body.firstChild);

    //                         setTimeout(() => {
    //                             const countdown = errorDiv.querySelector('#error-countdown');
    //                             let width = 100;
    //                             const interval = setInterval(() => {
    //                                 width -= 1;
    //                                 countdown.style.width = `${width}%`;
    //                                 if (width <= 0) {
    //                                     clearInterval(interval);
    //                                     errorDiv.style.display = 'none';
    //                                 }
    //                             }, 30);
    //                         }, 0);
    //                     }
    //                 })
    //                 .catch(error => {
    //                     console.error('Lỗi:', error);
    //                     alert('Đã xảy ra lỗi khi gửi đánh giá. Chi tiết: ' + error.message);
    //                 });
    //         })
    //         .catch(error => console.error('Lỗi kiểm tra đăng nhập:', error));
    // }

    function submitReview(productId) {
        const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
        console.log('CSRF Token Element:', csrfTokenElement);
        const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : null;
        console.log('CSRF Token:', csrfToken);

        fetch('/check-auth', {
                headers: {
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(authData => {
                console.log('Auth Data:', authData);
                const ratingElement = document.getElementById('rating');
                const commentElement = document.getElementById('comment');
                const nameElement = document.getElementById('name');
                const emailElement = document.getElementById('email');
                const saveInfoElement = document.getElementById('save-info');

                console.log('Rating Element:', ratingElement);
                console.log('Comment Element:', commentElement);
                console.log('Name Element:', nameElement);
                console.log('Email Element:', emailElement);
                console.log('Save Info Element:', saveInfoElement);

                if (!ratingElement || !commentElement || !nameElement || !emailElement || !saveInfoElement) {
                    alert('Một hoặc nhiều trường không được tìm thấy trong trang. Vui lòng làm mới trang.');
                    return;
                }

                const rating = ratingElement.value;
                const comment = commentElement.value.trim();
                const name = nameElement.value.trim();
                const email = emailElement.value.trim();
                const saveInfo = saveInfoElement.checked;

                // Kiểm tra nếu chưa đăng nhập và không có thông tin hợp lệ
                if (!authData.authenticated && (!name || !email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))) {
                    showLoginPrompt();
                    return;
                }

                fetch('/reviews', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken || '',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            rating: parseInt(rating),
                            comment: comment,
                            name: name,
                            email: email,
                            save_info: saveInfo
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            if (response.status === 401) {
                                showLoginPrompt();
                                return;
                            }
                            throw new Error('Yêu cầu không thành công: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const successDiv = document.createElement('div');
                            successDiv.id = 'success-message';
                            successDiv.className =
                                'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
                            successDiv.innerHTML =
                                `<span class="block">${data.message}</span><div id="success-countdown" class="absolute bottom-0 left-0 h-1 bg-green-500 transition-all duration-500 ease-linear" style="width: 100%;"></div>`;
                            document.body.insertBefore(successDiv, document.body.firstChild);

                            setTimeout(() => {
                                const countdown = successDiv.querySelector('#success-countdown');
                                let width = 100;
                                const interval = setInterval(() => {
                                    width -= 1;
                                    countdown.style.width = `${width}%`;
                                    if (width <= 0) {
                                        clearInterval(interval);
                                        successDiv.style.display = 'none';
                                        location.reload(); // Tải lại trang để cập nhật đánh giá
                                    }
                                }, 50);
                            }, 0);
                        } else {
                            const errorDiv = document.createElement('div');
                            errorDiv.id = 'error-message';
                            errorDiv.className =
                                'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-auto max-w-7xl relative overflow-hidden';
                            errorDiv.innerHTML =
                                `<ul><li>${data.message}</li></ul><div id="error-countdown" class="absolute bottom-0 left-0 h-1 bg-red-500 transition-all duration-300 ease-linear" style="width: 100%;"></div>`;
                            document.body.insertBefore(errorDiv, document.body.firstChild);

                            setTimeout(() => {
                                const countdown = errorDiv.querySelector('#error-countdown');
                                let width = 100;
                                const interval = setInterval(() => {
                                    width -= 1;
                                    countdown.style.width = `${width}%`;
                                    if (width <= 0) {
                                        clearInterval(interval);
                                        errorDiv.style.display = 'none';
                                    }
                                }, 30);
                            }, 0);
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                        // Không dùng alert, chỉ log lỗi để debug
                    });
            })
            .catch(error => console.error('Lỗi kiểm tra đăng nhập:', error));
    }

    // Khởi tạo khi trang tải
    document.addEventListener('DOMContentLoaded', () => {
        const tab = new URLSearchParams(window.location.search).get('tab') || 'description';
        showTab(tab);
        updateCartCount();
    });
</script>
