@extends('layouts.app');
@section('content')
<div class="card">
    <div class="card-body">
       <h4 class="card-title ml-3">Lịch sử mua hàng</h4>
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
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Ship to: activate to sort column ascending" style="width: 72.375px;">Ship to</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Base Price: activate to sort column ascending" style="width: 91.9688px;">Base Price</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased Price: activate to sort column ascending" style="width: 138.031px;">Purchased Price</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 83.0156px;">Status</th>
                                  <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 71.5px;">Actions</th>
                               </tr>
                            </thead>
                            <tbody>
                               <tr class="odd">
                                  <td class="sorting_1">1</td>
                                  <td>2012/08/03</td>
                                  <td>New York</td>
                                  <td>$1500</td>
                                  <td>$3200</td>
                                  <td>
                                     <label class="badge badge-info">On hold</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="even">
                                  <td class="sorting_1">2</td>
                                  <td>2015/04/01</td>
                                  <td>Brazil</td>
                                  <td>$4500</td>
                                  <td>$7500</td>
                                  <td>
                                     <label class="badge badge-danger">Pending</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="odd">
                                  <td class="sorting_1">3</td>
                                  <td>2010/11/21</td>
                                  <td>Tokyo</td>
                                  <td>$2100</td>
                                  <td>$6300</td>
                                  <td>
                                     <label class="badge badge-success">Closed</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="even">
                                  <td class="sorting_1">4</td>
                                  <td>2016/01/12</td>
                                  <td>Tokyo</td>
                                  <td>$2100</td>
                                  <td>$6300</td>
                                  <td>
                                     <label class="badge badge-success">Closed</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="odd">
                                  <td class="sorting_1">5</td>
                                  <td>2017/12/28</td>
                                  <td>Tokyo</td>
                                  <td>$2100</td>
                                  <td>$6300</td>
                                  <td>
                                     <label class="badge badge-success">Closed</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="even">
                                  <td class="sorting_1">6</td>
                                  <td>2000/10/30</td>
                                  <td>Tokyo</td>
                                  <td>$2100</td>
                                  <td>$6300</td>
                                  <td>
                                     <label class="badge badge-info">On-hold</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="odd">
                                  <td class="sorting_1">7</td>
                                  <td>2011/03/11</td>
                                  <td>Tokyo</td>
                                  <td>$2100</td>
                                  <td>$6300</td>
                                  <td>
                                     <label class="badge badge-success">Closed</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="even">
                                  <td class="sorting_1">8</td>
                                  <td>2015/06/25</td>
                                  <td>Italy</td>
                                  <td>$6300</td>
                                  <td>$2100</td>
                                  <td>
                                     <label class="badge badge-info">On-hold</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="odd">
                                  <td class="sorting_1">9</td>
                                  <td>2016/11/12</td>
                                  <td>Tokyo</td>
                                  <td>$2100</td>
                                  <td>$6300</td>
                                  <td>
                                     <label class="badge badge-success">Closed</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
                               <tr class="even">
                                  <td class="sorting_1">10</td>
                                  <td>2003/12/26</td>
                                  <td>Germany</td>
                                  <td>$1100</td>
                                  <td>$2300</td>
                                  <td>
                                     <label class="badge badge-danger">Pending</label>
                                  </td>
                                  <td>
                                     <button class="btn btn-outline-primary">View</button>
                                  </td>
                               </tr>
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