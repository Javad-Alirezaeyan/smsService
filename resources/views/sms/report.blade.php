<?php
?>




@extends("layouyts.master")
@section('title', "Report")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Report</h4>

                    <div class="row m-t-40">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card  card-info">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">{{ $smsTotal}}</h1>
                                    <h6 class="text-white">All Sms</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card  card-success">
                                <div class="box text-center">
                                    <h1 class="font-light text-white">
                                      {{ $smsTotalApi1 }}</h1>
                                    <h6 class="text-white">Api 1 </h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card  card-danger">
                                <div class="box text-center">
                                    <h1 class="font-light text-white">
                                       {{ $smsTotalApi2 }}</h1>
                                    <h6 class="text-white"> Api 2</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-warning">
                                <div class="box text-center">
                                    <h1 class="font-light text-white">{{0}}</h1>
                                    <h6 class="text-white">Test</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="row">
        <!-- column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Top Senders</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mobile</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach ($topSenders as $row)
                               <tr>
                                   <td>{{ $i++ }}</td>
                                   <td>{{ $row->mobile }}</td>
                                   <td>{{ $row->total }}</td>
                               </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <pie-chart></pie-chart>
        </div>
    </div>



@endsection

