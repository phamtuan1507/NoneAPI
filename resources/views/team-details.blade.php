{{-- Tất các các page cần extends từ master.blade.php --}}
@extends('layouts.master')

{{-- Đặt title cho page --}}
@section('title', 'Chi tiết chuyên gia')

{{-- Đặt file css cho page --}}
@section('file', 'team-details')

{{-- Đặt class cho body --}}
@section('page', 'team-details')
@section('content')
    <main>
        <div
            class="bg-[url(/public/images/breadcumb.jpg)] pb-[0.1px] overflow-hidden relative bg-[#EFF1F5] bg-[length:100%_auto] bg-top bg-no-repeat bg-cover">
            <div class="relative z-[3] container mx-auto px-4 md:px-6 lg:px-8">
                <div class="p-[200px_0_200px_0]">
                    <h1 class="text-[#121f38] text-[60px] uppercase m-[-0.22em_0_-0.22em_0]">
                        Chi tiết chuyên gia
                    </h1>
                    <nav class="">
                        <a href="/" class="text-[14px] text-[#555555] hover:text-[#a05c3c]">
                            Trang chủ
                        </a>
                        <span class="mx-1">&#8250;</span>
                        <span class="text-[14px] text-[#121f38]"> Chi tiết chuyên gia </span>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container px-4 py-10 mx-auto sm:px-6 lg:px-8">
            @if ($expert)
                <div class="flex flex-col gap-10 lg:flex-row">
                    <!-- Image and Basic Info -->
                    <div class="lg:w-1/3">
                        <img src="{{ $expert->image ? asset('storage/' . $expert->image) : '/default-team.png' }}"
                            alt="Expert Image" class="w-full h-[400px] object-cover rounded-lg mb-6" />
                        <div class="text-center">
                            <p class="text-[#9a563a] uppercase text-[16px] font-semibold mb-2">
                                {{ $expert->position ?? 'Chưa có chức vụ' }}
                            </p>
                        </div>
                    </div>

                    <!-- Description and Skills -->
                    <div class="lg:w-2/3">
                        <div class="prose prose-lg text-[#121f38] mb-8">
                            {!! $expert->description !!}
                        </div>

                        <div class="mb-8">
                            <h3 class="text-[#121f38] text-[24px] font-semibold mb-4">KỸ NĂNG</h3>
                            <div class="space-y-4">
                                @foreach ($expert->skills as $skillKey => $skillValue)
                                    <div>
                                        <div class="flex justify-between mb-1 text-sm">
                                            <span class="capitalize">{{ $skillKey }}</span>
                                            <span>{{ $skillValue }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-[#a05c3c] h-2.5 rounded-full"
                                                style="width: {{ $skillValue }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-[#121f38] mb-8">
                            <p>
                                {{ $expert->name }} đáng tin cậy và luôn đảm bảo rằng mọi liệu pháp và
                                sản phẩm được sử dụng cho khách hàng đều đạt tiêu chuẩn cao nhất về
                                chất lượng và an toàn. Cô luôn tuân thủ các quy trình vệ sinh nghiêm
                                ngặt và đảm bảo môi trường làm việc và dụng cụ sạch sẽ để đảm bảo sự
                                an toàn tuyệt đối cho khách hàng.
                            </p>
                        </div>

                        <div class="text-[#121f38]">
                            <h3 class="text-[24px] font-semibold mb-4">Đội ngũ chuyên nghiệp</h3>
                            <p>
                                Với sự am hiểu sâu sắc và kỹ năng chuyên môn vượt trội,
                                {{ $expert->name }}
                                là một phần quan trọng trong đội ngũ chăm sóc da của chúng tôi.
                                Chúng tôi tin tưởng rằng với sự chăm sóc và tận tụy của cô, khách
                                hàng sẽ có trải nghiệm tuyệt vời và tìm thấy sự cân bằng và sắc đẹp
                                cho làn da của mình.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center text-[#121f38] py-10">
                    <p>Đang tải thông tin chuyên gia...</p>
                </div>
            @endif
        </div>
    </main>
@endsection
