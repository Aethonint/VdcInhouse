@extends('admin.app')
@section('content')
<main class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Defect Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Defect Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
<div id="imagePreviewModal">
    <img id="previewImg" src="" alt="Preview">
</div>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Is Defect</th>
                            <th>Note</th>
                            <th class="text-center">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($defect->details as $index => $detail)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $detail->is_defect !== null && $detail->is_defect !== '' ? $detail->is_defect : '--' }}</td>
                            <td>{{ $detail->note !== null && $detail->note !== '' ? $detail->note : '--' }}</td>
                            <td class="text-center">
    @if(!empty($detail->image_path))
        <img src="{{ asset('storage/'.$detail->image_path) }}" 
             class="img-thumbnail preview-image" width="80" style="border-radius: 5px;">
    @else
        --
    @endif
</td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No Defect Details Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">
                        <a href="{{ route('defect.index') }}" class="btn btn-primary">Back to Defects</a>
                    </div>

        </div>
    </div>

</main>
@endsection
