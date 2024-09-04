@extends('layouts.app');
@section('content')
    <div class="d-flex justify-content-end">
        <div class="header-right d-flex flex-end flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                <p class="m-0 pr-3">Super Admin</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                <p class="m-0">BDHH</p>
                </a>
            </div>
            <a href="{{route('admins.add.view')}}">
                <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                    <i class="mdi mdi-plus-circle"></i>
                    Add Admin
                </button>
            </a>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-body">
           <h4 class="card-title ml-3">Admin</h4>
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
                                   <tr class="text-center">
                                      <th class="sorting sorting_asc" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order #: activate to sort column descending" style="width: 72.5781px;">STT</th>
                                      <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased On: activate to sort column ascending" style="width: 122.422px;">ID</th>
                                      <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Customer: activate to sort column ascending" style="width: 88.1094px;">Tên</th>
                                      <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Ship to: activate to sort column ascending" style="width: 72.375px;">Email</th>
                                      <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Ship to: activate to sort column ascending" style="width: 72.375px;">Số điện thoại</th>
                                      <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased Price: activate to sort column ascending" style="width: 138.031px;">Địa chỉ</th>
                                      <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Ship to: activate to sort column ascending" style="width: 72.375px;">Tuỳ chỉnh</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $index => $admin)
                                        <tr class="odd text-center">
                                            <td class="sorting_1">{{$index+1}}</td>
                                            <td>{{$admin->id}}</td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>{{$admin->phone}}</td>
                                            <td>{{$admin->address}}</td>
                                            <td>
                                                <a href="{{ route('admins.update.view', $admin->id) }}" class="btn btn-outline-warning" type="submit">
                                                    Chỉnh sửa
                                                </a>
                                                <form action="{{ route('admins.remove', $admin->id) }}" method="POST" style="display:inline;">
                                                   @csrf
                                                   <button 
                                                      class="btn btn-outline-danger" 
                                                      style="width:100px; {{ $admin->id == 1 ? 'pointer-events: none;' : '' }}"
                                                      type="submit" 
                                                      onclick="return confirm('Are you sure you want to delete this admin?')">
                                                      Xoá
                                                   </button>
                                               </form>
                                            </td>
                                        </tr>
                                   @endforeach
                                </tbody>
                             </table>
                          </div>
                       </div>
                       <div class="row  mt-5">
                          <div class="col-sm-12 col-md-5">
                             <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                          </div>
                          <div class="col-sm-12 col-md-7 d-flex justify-content-end">
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