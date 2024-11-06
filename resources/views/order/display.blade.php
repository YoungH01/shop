@extends('layouts.app');
@section('content')
<div class="card">
    <div class="card-body">
       <h4 class="card-title ml-3">Order table</h4>
       <div class="row">
          <div class="col-12">
             <div class="table-responsive">
                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer ml-3">
                   <div class="row">
                      <div class="col-sm-12 col-md-6">
                         <div class="dataTables_length" id="order-listing_length">
                            <label>
                               Show 
                               <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control">
                                  <option value="5">5</option>
                                  <option value="10">10</option>
                                  <option value="15">15</option>
                                  <option value="-1">All</option>
                               </select>
                               entries
                            </label>
                         </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                            <div id="order-listing_filter" class="dataTables_filter d-flex justify-content-end">
                                <label>
                                    <input type="search" class="form-control" placeholder="Search" aria-controls="order-listing">
                                </label>
                            </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-12">
                         <table id="order-listing" class="table dataTable no-footer" aria-describedby="order-listing_info">
                            <thead>
                               <tr>
                                  <th class="sorting sorting_asc" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order #: activate to sort column descending" style="width: 72.5781px;">Order #</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased On: activate to sort column ascending" style="width: 122.422px;">Purchased On</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Customer: activate to sort column ascending" style="width: 88.1094px;">Customer</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Ship to: activate to sort column ascending" style="width: 72.375px;">Ship to</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Base Price: activate to sort column ascending" style="width: 91.9688px;">Base Price</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased Price: activate to sort column ascending" style="width: 138.031px;">Purchased Price</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 83.0156px;">Status</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 71.5px;">Actions</th>
                               </tr>
                            </thead>
                            <tbody>
                              {{-- {{dd($orderData)}} --}}
                               @foreach($orderData as $order)
                                 @foreach ($order->orderDetails as $detail)
                                    <tr class="odd">
                                       <td class="sorting_1">{{ $index + 1 }}</td>
                                       <td>{{ $order->created_at }}</td>
                                       <td>{{ $order->name }}</td>
                                       <td>{{ $order->address }}</td>
                                       <td>${{ $detail->base_price }}</td>
                                       <td>${{ $detail->price }}</td>
                                       <td>
                                          <label class="badge badge-success">Done</label>
                                       </td>
                                       <td>
                                          <button class="btn btn-outline-primary">View</button>
                                       </td>
                                    </tr>
                                     {{ $index += 1 }}
                                    @endforeach
                               @endforeach
                            </tbody>
                         </table>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-12 col-md-5">
                         <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                      </div>
                      <div class="col-sm-12 col-md-7">
                         <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                            <ul class="pagination">
                               <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a aria-controls="order-listing" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a></li>
                               <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                               <li class="paginate_button page-item next disabled" id="order-listing_next"><a aria-controls="order-listing" aria-disabled="true" role="link" data-dt-idx="next" tabindex="-1" class="page-link">Next</a></li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection