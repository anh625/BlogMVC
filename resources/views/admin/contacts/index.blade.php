<table>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>contact_status</th>
        <th>action</th>
    </tr>
    @foreach($contacts as $c)
        <tr>
            <td>{{ $c->contact_id }}</td>
            <td>{{ $c->contact_name }}</td>

            <!-- Form A: gửi khi thay đổi select -->
            <td>
                <form action="{{ route('admin.contact.update',$c->contact_id) }}" method="POST" class="status-form">
                    @csrf
                    @method("PUT")
                    <select name="contact_status" class="status-select">
                        <option value="new" {{ $c->contact_status === 'new' ? 'selected' : '' }}>new</option>
                        <option value="processing" {{ $c->contact_status === 'processing' ? 'selected' : '' }}>processing</option>
                        <option value="replied" {{ $c->contact_status === 'replied' ? 'selected' : '' }}>replied</option>
                    </select>
                </form>
            </td>

            <!-- Form B: gửi khi bấm nút delete -->
            <td>
                <form action="{{ route('admin.contact.delete',$c->contact_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<script>
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function () {
            this.form.submit();
        });
    });
</script>
