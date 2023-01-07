<div class="report">
    <div class="container">
        <div class="table-responsive-md">
            <table class="table table-bordered table-striped pay-table"
                style="white-space: pre-line; vertical-align:middle">
                <thead>
                    <tr>
                        <th>Payment Date</th>
                        <th>Invoice ID</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @php
                        echo '<pre>';
                        var_dump($payapplies);
                        echo '</pre>';
                    @endphp --}}

                    @php
                        $unique_invoices = [];
                    @endphp
                    @foreach ($payapplies as $payapplie)
                        @php
                            if (isset($payapplie->paid_amount) && !empty($payapplie->paid_amount)) {
                                    $data = json_decode($payapplie->paid_amount, true);
                            
                                    foreach ($data as $key => $q_details) {
                                        isset($qc_invoices[$key]['qc_total_amount']) ? ($qc_invoices[$key]['qc_total_amount'] += $q_details['qc_amount']) : ($qc_invoices[$key]['qc_total_amount'] = $q_details['qc_amount']);
                            
                                        isset($qc_invoices[$key]['paid_at']) ? ($qc_invoices[$key]['paid_at'] = $q_details['qc_date']) : ($qc_invoices[$key]['paid_at'] = '');
                            
                                        isset($qc_invoices[$key]['headname']) ? ($qc_invoices[$key]['headname'] = $payapplie->feehead->head_name . ',') : ($qc_invoices[$key]['headname'] = '');
                            
                                        $qc_invoices[$key]['pay_id'][] = $payapplie->id;
                                        $qc_invoices[$key]['pay_id']['qc_invo'] = $key;
                                        $qc_invoices[$key]['headname'] .= $payapplie->feehead->head_name . ',';
                                        $qc_invoices[$key]['paid_at'] = $q_details['qc_date'];
                                    }
                            }
                        @endphp
                        @if ($payapplie->payment_state == 200 || $payapplie->payment_state == 10)
           
                            @if (!empty($payapplie->invoice) && !in_array($payapplie->invoice, $unique_invoices))
                                @php
                                    array_push($unique_invoices, $payapplie->invoice);
                                    $total = $payapplies->where('invoice', $payapplie->invoice)->sum('total_amount');
                                @endphp
                                <tr>
                                    <td>{{ $payapplie->updated_at }}</td>
                                    <td>{{ $payapplie->invoice }}</td>
                                    {{-- <td>{{ $payapplie->feehead->head_name }}</td> --}}
                                    <td>{{ $total }}</td>
                                    <td style="vertical-align: middle">Success</td>
                                    <td style="white-space: initial">
                                        <button class="btn btn-success btn-sm" value="{{ $payapplie->invoice }}"
                                            id="payreportpdfGenerate">
                                            <i class="fa fa-file" aria-hidden="true"></i> Get Receipt</button>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach


                    @if (isset($qc_invoices) && !empty($qc_invoices))
                        @if (count($qc_invoices) > 0)
                            @foreach ($qc_invoices as $qc_invo => $items)
                                <tr>
                                    <td>{{ $payapplie->updated_at }}</td>
                                    <td>{{ $qc_invo }}</td>
                                    <td>{{ $qc_invoices[$qc_invo]['qc_total_amount'] }}</td>
                                    {{-- <td>{{ $qc_invoices[$qc_invo]['headname'] }}</td> --}}
                                    <td style="vertical-align: middle">Success</td>
                                    <td style="white-space: initial">
                                        @php
                                            $pay_ids = json_encode($qc_invoices[$qc_invo]['pay_id']);
                                        @endphp
                                        <button class="btn btn-success btn-sm" value="{{ $pay_ids }}"
                                            id="payreportpdfGenerate">
                                            <i class="fa fa-file" aria-hidden="true"></i> Get Receipt</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                    {{-- @php
                        echo '<pre>';
                        var_dump($qc_invoices);
                        echo '</pre>';
                    @endphp --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
