@extends('layouts.master')

@section('title', 'Chi tiết nhân viên')

@section('file', 'admin.team.show')

@section('page', 'admin.team.show')

@section('content')
    <main>
        {{-- <a href="{{ route('admin.staff-skill.create', $staff->id) }}" class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">Thêm kỹ năng</a> --}}

        <div class="container px-4 py-10 mx-auto sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <h3 class="text-[#a05c3c] uppercase text-[18px] font-medium mb-2">
                    Chi tiết nhân viên
                </h3>
                @if ($staff)
                    <h2 class="text-[#121f38] text-[36px] font-bold">
                        {{ $staff->name }}
                    </h2>
                @else
                    <h2 class="text-[#121f38] text-[36px] font-bold">Không tìm thấy nhân viên</h2>
                @endif
            </div>

            @if ($staff)
                <div class="flex flex-col gap-10 lg:flex-row">
                    <div class="lg:w-1/3">
                        <img src="{{ $staff->image ? asset('storage/' . $staff->image) : '/default-team.png' }}"
                            alt="Staff Image" class="w-full h-[400px] object-cover rounded-lg mb-6" />
                        <div class="text-center">
                            <p class="text-[#9a563a] uppercase text-[16px] font-semibold mb-2">
                                {{ $staff->position ?? 'Chưa có chức vụ' }}
                            </p>
                        </div>
                    </div>

                    <div class="lg:w-2/3">
                        <div class="prose prose-lg text-[#121f38] mb-8">
                            {!! $staff->description !!}
                        </div>

                        <div class="mb-8">
                            <h3 class="text-[#121f38] text-[24px] font-semibold mb-4">KỸ NĂNG</h3>
                            <div class="space-y-4">
                                @forelse ($staff->skills as $skillKey => $skillValue)
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
                                @empty
                                    <p>Chưa có kỹ năng nào được thêm.</p>
                                @endforelse
                            </div>
                            <a href="{{ route('admin.staff-skill.create', $staff->id) }}"
                                class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">Thêm kỹ năng</a>
                        </div>

                        <div class="text-[#121f38] mb-8">
                            <p>
                                {{ $staff->name }} đáng tin cậy và luôn đảm bảo rằng mọi liệu pháp và
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
                                {{ $staff->name }}
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
                    <p>Đang tải thông tin nhân viên...</p>
                </div>
            @endif

            <div class="mt-10 text-center">
                <a href="{{ route('admin.team.index') }}"
                    class="text-[#a05c3c] hover:text-[#7a4a2f] text-[16px] font-medium underline">
                    Quay lại danh sách
                </a>
            </div>
        </div>
    </main>
@endsection
