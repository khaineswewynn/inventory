@extends('layout.master')

@section('main')
    <div class="container">
        <!-- Notification Section -->
        <div class="row mb-3" id="noti-session">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @forelse ($roles as $role)
                            <a class="nav-link @if($role->id == auth()->user()->role_id) active @endif" id="nav-{{$role->id}}-tab" data-bs-toggle="tab" href="#nav-{{$role->id}}" role="tab" aria-controls="nav-{{$role->id}}" @if($role->id == auth()->user()->role_id) aria-selected="true" @else aria-selected="false" @endif>{{ $role->roles }}</a>
                        @empty
                            <p>No roles found.</p>
                        @endforelse
                    </div>
                </nav>

                <div class="tab-content mt-3" id="nav-tabContent">
                    @forelse ($roles as $role)
                        <div class="tab-pane fade @if($role->id == auth()->user()->role_id) show active @endif" id="nav-{{$role->id}}" role="tabpanel" aria-labelledby="nav-{{$role->id}}-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Permissions for {{ $role->roles }}</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $permissions = \App\Models\Permission::where('role_id', $role->id)->pluck('route_name')->toArray();
                                    @endphp

                                    <form action="/permission" method="post">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        <div class="row">
                                            @foreach (['user', 'product', 'provider', 'category', 'customer', 'location', 'warehouse', 'purchase'] as $permission)
                                                <div class="col-md-3 mb-3">
                                                    <div class="border p-3 rounded">
                                                        <h6 class="mb-2">{{ ucfirst($permission) }} Permission</h6>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="{{ $permission }}-index" value="{{ $permission }}-index" @if(in_array("{$permission}-index", $permissions)) checked @endif>
                                                            <label class="form-check-label">{{ ucfirst($permission) }} List</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="{{ $permission }}-create" value="{{ $permission }}-create" @if(in_array("{$permission}-create", $permissions)) checked @endif>
                                                            <label class="form-check-label">{{ ucfirst($permission) }} Create</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="{{ $permission }}-edit" value="{{ $permission }}-edit" @if(in_array("{$permission}-edit", $permissions)) checked @endif>
                                                            <label class="form-check-label">{{ ucfirst($permission) }} Edit</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="{{ $permission }}-show" value="{{ $permission }}-show" @if(in_array("{$permission}-show", $permissions)) checked @endif>
                                                            <label class="form-check-label">{{ ucfirst($permission) }} View Detail</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="{{ $permission }}-delete" value="{{ $permission }}-delete" @if(in_array("{$permission}-delete", $permissions)) checked @endif>
                                                            <label class="form-check-label">{{ ucfirst($permission) }} Delete</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6 text-end">
                                                <a href="/permissions" class="btn btn-secondary">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No roles found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#noti-session").fadeOut(3000);
            }, 1000);
        });
    </script>
@endpush
