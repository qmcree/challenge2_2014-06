@extends('layout.master')

@section('alert')
    @include('partial.alert', [])
@stop

@section('form')
    @include('partial.form', ['offers' => $offers, 'today' => $today, 'countries' => $countries])
@stop

@section('results')
    @if (sizeof($results) > 0)
    <?php
    $totals = [
        'clicks' => 0,
        'leads' => 0,
        'epc' => 0.00,
        'conversion' => 0.0,
        'revenue' => 0.00,
    ];
    ?>
    <table class="table table-responsive table-striped table-hover">
        <thead>
        <tr>
            <th>Offer</th>
            <th>Clicks</th>
            <th>Leads</th>
            <th>EPC</th>
            <th>Conversion</th>
            <th>Revenue</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($results as $result)
        <tr>
            <td>{{{ $result->name }}}</td>
            <td>{{ (!empty($result->leadstat->clicks)) ? $result->leadstat->clicks : 0 }}</td>
            <td>{{ (!empty($result->leadstat->leads)) ? $result->leadstat->leads : 0 }}</td>
            <td>
                <?php
                $epc = 0;
                if (!empty($result->leadstat->pay_total) && !empty($result->leadstat->clicks)) {
                    $epc = sprintf('%.2F', ($result->leadstat->pay_total / $result->leadstat->clicks));
                    echo '$' . $epc;
                } else {
                    echo '$0.00';
                }
                ?>
            </td>
            <td>
                <?php
                $conversion = 0;
                if (!empty($result->leadstat->leads) && !empty($result->leadstat->clicks)) {
                    $conversion = sprintf('%.1F', ($result->leadstat->leads / $result->leadstat->clicks));
                    echo $conversion . '%';
                } else {
                    echo '0.0%';
                }
                ?>
            </td>
            <td>${{ (!empty($result->leadstat->pay_total)) ? $result->leadstat->pay_total : '0.00' }}</td>
        </tr>
        <?php
        $totals['clicks'] += $result->leadstat->clicks;
        $totals['leads'] += $result->leadstat->leads;
        $totals['epc'] += $epc;
        $totals['conversion'] += $conversion;
        $totals['revenue'] += $result->leadstat->pay_total;
        ?>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="text-right"><strong>Totals</strong></td>
            <td>{{ $totals['clicks'] }}</td>
            <td>{{ $totals['leads'] }}</td>
            <td>${{ sprintf('%.2F', $totals['epc']) }}</td>
            <td>{{ sprintf('%.1F', $totals['conversion']) }}%</td>
            <td>${{ sprintf('%.2F', $totals['revenue']) }}</td>
        </tr>
        </tfoot>
    </table>
    @elseif ($generated)
        <div class="alert alert-warning">
            There is no activity to show for this query.
        </div>
    @endif
@stop