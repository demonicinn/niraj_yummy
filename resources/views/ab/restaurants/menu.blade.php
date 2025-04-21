<div class="col-12">
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{ $title }}</div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $i => $app)
                        <tr class="align-middle">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $app->name }}</td>
                            <td>${{ $app->price }}</td>
                            <td>{{ $app->description }}</td>
                            <td>{{ $app->rating }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>