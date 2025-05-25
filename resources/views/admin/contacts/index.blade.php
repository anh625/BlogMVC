@extends('admin.layouts.master')
@section('title', 'Danh sách liên hệ')

@section('content')
<div class="container py-3">
    <div class="mb-3">
    @forelse ($contacts as $contact)
        <div class="card shadow-sm mb-3 border-start
            @switch($contact->contact_status)
                @case('new') border-primary @break
                @case('processing') border-warning @break
                @case('replied') border-success @break
            @endswitch
        ">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h6 class="mb-1">{{ $contact->contact_name }}
                            <span class="badge bg-secondary ms-2">{{ $contact->subject }}</span>
                        </h6>
                        <p class="mb-1 text-muted small">
                            <i class="bi bi-telephone"></i> {{ $contact->contact_phone }} ·
                            {{ $contact->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <form method="POST" action="{{ route('admin.contact.update', $contact->contact_id) }}">
                        @csrf
                        @method('PUT')
                        <select name="contact_status" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                            <option value="new" {{ $contact->contact_status === 'new' ? 'selected' : '' }}>🟡 Mới</option>
                            <option value="processing" {{ $contact->contact_status === 'processing' ? 'selected' : '' }}>🟠 Đang xử lý</option>
                            <option value="replied" {{ $contact->contact_status === 'replied' ? 'selected' : '' }}>🟢 Đã phản hồi</option>
                        </select>
                    </form>
                </div>

                <p class="mb-2">{{ $contact->message }}</p>

                <div class="d-flex justify-content-end gap-2">
                    <form action="{{ route('admin.contact.delete', $contact->contact_id) }}" method="POST"
                          onsubmit="return confirm('Bạn có chắc muốn xóa yêu cầu trợ giúp này không?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Chưa có liên hệ nào.</div>
    @endforelse

    <div class="mt-4">
        {{ $contacts->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
