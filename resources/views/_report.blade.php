<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Open</th>
        <th scope="col">High</th>
        <th scope="col">Low</th>
        <th scope="col">Close</th>
        <th scope="col">Volume</th>
    </tr>
    </thead>
    <tbody>
    @forelse($report as $i => $row)
        <tr>
            <th scope="row">{{$i+1}}</th>
            @foreach($row as $value)
                <td>{{$value}}</td>
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="7">
                <p class="text-center">No data found</p>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>