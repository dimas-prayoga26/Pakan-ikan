@extends('admin.main')

@section('container-admin')
<div class="container">
    <div class="page-inner">
        <div class="card">
            <div class="card-header">
                <h3>Edit Setting Tool</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('settings.update', $settingDatas->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempMin" >Minimal Suhu:</label>
                                <input class="form-control" type="text" id="tempMin" name="tempMin" value="{{ $settingDatas->tempMin }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempMax">Maksimal Suhu:</label>
                                <input class="form-control" type="text" id="tempMax" name="tempMax" value="{{ $settingDatas->tempMax }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phMin">Minimal PH:</label>
                                <input class="form-control" type="text" id="phMin" name="phMin" value="{{ $settingDatas->phMin }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phMax">Maksimal PH:</label>
                                <input class="form-control" type="text" id="phMax" name="phMax" value="{{ $settingDatas->phMax }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="feedMax">Minimal Feed:</label>
                                <input class="form-control" type="text" id="feedMax" name="feedMax" value="{{ $settingDatas->feedMax }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
