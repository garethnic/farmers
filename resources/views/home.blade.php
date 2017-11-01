@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h2>History</h2>
            <p>Subscriber count: <strong>{{ number_format($subscriptions) }}</strong></p>
            <table class="table table-striped table-bordered table-responsive-md">
                <thead>
                <th scope="col">Year</th>
                <th scope="col">Assaults</th>
                <th scope="col">Murders</th>
                </thead>
                <tbody>
                @foreach($history as $hist)
                    <tr>
                        <td>{{ $hist->year }}</td>
                        <td>{{ $hist->assaults }}</td>
                        <td>{{ $hist->murders }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $history->links() }}
        </div>

        <div class="col-md-6">
            @if($currentYear !== null)
                <h2>Current Year ({{ $currentYear->year }})</h2>
            @else
                <h2>Create a new year</h2>
            @endif
            <div class="form-group row">
                <form action="/api/create-new-year" class="form-inline" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-sm btn-primary">New Year</button>
                </form>
            </div>
            @if ($currentYear !== null)
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Assaults</label>
                    <label for="staticEmail" class="col-sm-10 col-form-label">{{ $currentYear->assaults }}</label>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Murders</label>
                    <label for="staticEmail" class="col-sm-10 col-form-label">{{ $currentYear->murders }}</label>
                </div>

                <div class="form-group row">
                    <form action="/api/add-new-assault" class="form-inline" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-warning">Add Assault</button>
                    </form>

                    <div class="px-4"></div>

                    <form action="/api/add-new-murder" class="form-inline" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Add Murder</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
