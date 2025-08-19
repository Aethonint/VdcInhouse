@extends('admin.app')
@section('content')
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Incident Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Incident Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); justify-content:center; align-items:center;">
        <img id="previewImg" src="" alt="Preview" style="max-width:90%; max-height:90%;">
    </div>

    <hr />
    <div class="card">
        <div class="card-body">
          
            <p><strong>Vehicle:</strong> {{ $incident->assignment->vehicle->vin_sn ?? 'N/A'}}</p>
            <p><strong>Incident Date:</strong> {{ $incident->incident_date }}</p>
            <p><strong>Status:</strong> {{ ucfirst($incident->status) }}</p>

            <div class="table-responsive mt-4">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Field Name</th>
                            <th>Notes</th>
                            <th class="text-center">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incident->details as $index => $detail)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $detail->field_name ?? '--' }}</td>
                            <td>{{ $detail->notes ?? '--' }}</td>
                            <td class="text-center">
                                @if(!empty($detail->image_path))
                                    <img src="{{ asset('storage/'.$detail->image_path) }}" 
                                         class="img-thumbnail preview-image" width="80" style="border-radius: 5px; cursor:pointer;">
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No Incident Details Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <a href="{{ route('incident.index') }}" class="btn btn-primary">Back to Incidents</a>
            </div>
        </div>
    </div>

</main>

<script>
    document.querySelectorAll('.preview-image').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('previewImg').src = this.src;
            document.getElementById('imagePreviewModal').style.display = 'flex';
        });
    });

    document.getElementById('imagePreviewModal').addEventListener('click', function() {
        this.style.display = 'none';
    });
</script>
@endsection
