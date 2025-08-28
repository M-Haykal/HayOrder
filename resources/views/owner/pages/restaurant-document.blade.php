@extends('owner.layout.index')

@section('title', 'Document Restaurant | ' . auth()->user()->restaurants->first()->name_restaurant)
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Document Restaurant</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Document Restaurant</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="text-header">
                <h4 class="card-title">Document {{ $restaurant->name_restaurant }}</h4>
                <p class="card-title-desc">Please submit supporting documents to change the restaurant's status. </p>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('owner.dashboard.documents.store', ['restaurant' => $restaurant->slug]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="document_type" class="form-label">Document Type</label>
                    <select name="document_type" id="document_type" class="form-control" required>
                        <option value="business_license">Business License</option>
                        <option value="health_certificate">Health Certificate</option>
                        <option value="food_safety_certificate">Food Safety Certificate</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file_path" class="form-label">Document File</label>
                    <input type="file" name="file_path" id="file_path" class="form-control" required
                        accept=".pdf,.doc,.docx,image/*">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- end card body -->
    </div>
@endsection
