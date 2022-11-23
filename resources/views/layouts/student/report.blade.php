<div class="report">
    <div class="container">
        <div class="table-responsive-md">
            <table class="table table-bordered table-striped pay-table">
                <thead>
                    <tr>
                        <th>Payment Date</th>
                        <th>Invoice ID</th>
                        <th>Fee Head</th>
                        <th>Fee Sub Head</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($payapplies as $payapplie)
                    @if($payapplie->payment_state == 200)
                        <tr>
                            <td>{{$payapplie->updated_at}}</td>
                            <td>{{$payapplie->invoice}}</td>
                            <td>{{$payapplie->feehead->head_name}}</td>
                            <td>{{$payapplie->feesubhead->subhead_name}}</td>
                            <td>{{$payapplie->total_amount}}</td>
                            <td>Success</td>
                            <td>
                                <button class="btn btn-success">Download</button>
                            </td>
                        </tr>
                    @endif
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>