@extends('admin.app')

@section('content')
<main class="page-content">
    <div class="justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-card">
                <div class="card-body bg-white p-4 rounded-card">
                    <h2 class="card-title mb-3">Edit Defect_Details (ID: {{ $defect->id }})</h2>

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

                    {{-- Edit Defect Form --}}
                    <form method="POST" action="{{ route('defects.update', $defect->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="defect_id" value="{{ $defect->id }}">

                        <div class="row d-none">
                            <div class="mb-3 col-md-6">
                                <label>Defect ID</label>
                                <input type="text" class="form-control" value="{{ $defect->id }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
       <label for="total_defects">Total Defects</label>
      <input type="number" name="total_defects" id="total_defects" class="form-control" 
             value="{{ $defect->total_defects }}" min="0">
       </div>

                        <h5 class="card-subtitle mb-2">Defect Details</h5>

                        <div id="defect-details-container">
                            @foreach ($defect->details as $index => $detail)
                                <div class="card mb-3 shadow-sm defect-detail-block">
                                    <div class="card-body">
                                        <h5 class="mb-3">Detail #{{ $index + 1 }}</h5>

                                        <input type="hidden" name="detail_ids[]" value="{{ $detail->id }}">

                                        <div class="mb-3 col-md-6">
                                            <label>Defective (Yes / No)</label>
                                            <select name="defectives[]" class="form-select">
                                                <option value="yes" {{ $detail->is_defect == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $detail->is_defect == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Note</label>
                                            <textarea name="notes[]" class="form-control" placeholder="Enter note">{{ $detail->note }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Image</label><br>
                                            @if($detail->image_path)
                                                <img src="{{ asset('storage/'.$detail->image_path) }}" width="120" class="mb-2 rounded">
                                            @endif
                                            <input type="file" name="images[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" id="add-defect-detail">+ Add New Detail</button>

                        <div class="d-flex justify-content-start align-items-center gap-5">
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                            <a href="{{ route('defect.index') }}" class="btn btn-outline-danger mt-3">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.getElementById('add-defect-detail').addEventListener('click', function () {
    const container = document.getElementById('defect-details-container');
    const index = container.querySelectorAll('.defect-detail-block').length;

    const newBlock = `
        <div class="card mb-3 shadow-sm defect-detail-block">
            <div class="card-body">
                <h5 class="mb-3">Detail #${index + 1}</h5>

                <div class="mb-3 col-md-6">
                    <label>Defective (Yes / No)</label>
                    <select name="defectives[]" class="form-select">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Note</label>
                    <textarea name="notes[]" class="form-control" placeholder="Enter note"></textarea>
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="images[]" class="form-control">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newBlock);
});
</script>
@endsection