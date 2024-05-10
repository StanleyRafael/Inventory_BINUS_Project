@extends('Templates.adminLogsTemplate')
@extends('Templates.adminTabs')

@section('tableContent')
    @foreach ($logs as $index => $log)
        <tr>
            <td class="number-column">{{ $index + 1 }}</td>
            <td class="normal-column">{{ $log->user->username }}</td>
            <td class="normal-column">{{ $log->itemName }}</td>
            <td class="quantity-column2">{{ $log->rmeQuantity }}</td>
            <td class="quantity-column2">{{ $log->gudang4Quantity }}</td>
            <td class="quantity-column2">{{ $log->gudang12Quantity }}</td>
            <td class="quantity-column2" style="font-weight: bold;">
                {{ $log->rmeQuantity + $log->gudang4Quantity + $log->gudang12Quantity }}
            </td>
            <td class="normal-column">{{ $log->reason }}</td>
            <td class="normal-column">
                {{ $log->created_at->format('d/m/Y H:i:s') }}
            </td>
        </tr>
    @endforeach
@endsection

