<div class="report">
    <div class="container">
        <div class="table-responsive-md">
            <table class="table table-bordered table-striped pay-table">
                <thead>
                    <tr>
                        <th>Payment Date</th>
                        <th>Invoice ID</th>
                        <th>Fee Head</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $q_sum = [];
                    @endphp
                   @foreach($payapplies as $payapplie)
                        @php 
                            
                            if(isset($payapplie->paid_amount) && !empty($payapplie->paid_amount))
                            {
                                $data = json_decode($payapplie->paid_amount, true);
                                foreach($data as $key => $q_details)
                                {
                                    array_push($q_sum,$q_details["qc_amount"]);
                                }
                                $total = array_sum($q_sum);
                            }
                        var_dump($payapplie->invoice);

                        @endphp
                        @if($payapplie->payment_state == 200 || $payapplie->payment_state == 10)
                        
                            <tr>
                                <td>{{$payapplie->updated_at}}</td>
                                <td>{{$payapplie->invoice}}</td>
                                <td>{{$payapplie->feehead->head_name}}</td>
                                @php 
                                    $total = $payapplies->where('invoice', $payapplie->invoice)->sum('total_amount');
                                @endphp
                                <td>{{$total}}</td>
                                <td>Success</td>
                                <td>
                                    <button class="btn btn-success" value="{{$payapplie->invoice}}" id="payreportpdfGenerate">
                                    <i class="fa fa-file" aria-hidden="true"></i> Get Receipt</button>
                                </td>
                            </tr>
                        
                        @endif
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>