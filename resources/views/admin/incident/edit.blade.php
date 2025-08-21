@extends('admin.app')

@section('content')
<main class="page-content">
    <div class="justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-card">
                <div class="card-body bg-white p-4 rounded-card">
                    <h2 class="card-title mb-3">Edit Incident Details (ID: {{ $incident->id }})</h2>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Edit Incident Form --}}
                    <form method="POST" action="{{ route('incident.update', $incident->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="incident_id" value="{{ $incident->id }}">

                        <div class="row d-none">
                            <div class="mb-3 col-md-6">
                                <label>Incident ID</label>
                                <input type="text" class="form-control" value="{{ $incident->id }}" readonly>
                            </div>
                        </div>

                        <h5 class="card-subtitle mb-2">Incident Details</h5>

                        <div id="details-container">
                            @foreach($incident->details as $index => $detail)
                                <div class="card mb-3 shadow-sm p-3">
                                    <h5 class="mb-3">Detail #{{ $index + 1 }}</h5>

                                    <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail->id }}">

                                    <div class="mb-2">
                                        <label>Field Name</label>
                                        <input type="text" name="details[{{ $index }}][field_name]" class="form-control"
                                            value="{{ $detail->field_name }}" required>
                                    </div>

                                    <div class="mb-2">
                                        <label>Notes</label>
                                        <textarea name="details[{{ $index }}][notes]" class="form-control">{{ $detail->notes }}</textarea>
                                    </div>

                                    <div class="mb-2">
                                        <label>Current Image:</label><br>
                                        @if($detail->image_path)
                                            <img src="{{ asset('storage/' . $detail->image_path) }}" width="120" class="mb-2 rounded">
                                        @else
                                            <p>No image</p>
                                        @endif
                                        <input type="file" name="details[{{ $index }}][image]" class="form-control">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" id="add-detail">+ Add New Detail</button>

                        <div class="d-flex justify-content-start align-items-center gap-5">
                            <button type="submit" class="btn btn-primary mt-3">Update Incident</button>
                            <a href="{{ route('incident.index') }}" class="btn btn-outline-danger mt-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.getElementById('add-detail').addEventListener('click', function () {
    let container = document.getElementById('details-container');
    let index = container.children.length;

    let newDetail = `
        <div class="card mb-3 shadow-sm p-3">
            <h5 class="mb-3">Detail #${index + 1}</h5>
            <div class="mb-2">
                <label>Field Name</label>
                <input type="text" name="details[${index}][field_name]" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Notes</label>
                <textarea name="details[${index}][notes]" class="form-control"></textarea>
            </div>
            <div class="mb-2">
                <label>Image</label>
                <input type="file" name="details[${index}][image]" class="form-control">
            </div>
        </div>`;
    container.insertAdjacentHTML('beforeend', newDetail);
});
</script>
@endsection