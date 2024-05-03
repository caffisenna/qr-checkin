<table>
    <thead>
        <tr>
            @foreach ($headings as $head)
                <th>{{ $head }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->furigana }}</td>
                <td>{{ $member->bsid }}</td>
                <td>{{ $member->prefecture }}</td>
                <td>{{ $member->district }}</td>
                <td>{{ $member->role }}</td>
                <td>{{ $member->field1 }}</td>
                <td>{{ $member->field2 }}</td>
                <td>{{ $member->field3 }}</td>
                <td>{{ $member->checked_in_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
