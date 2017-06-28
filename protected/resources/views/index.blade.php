@extends('layout.master')
@section('page-title')
    {{"Home"}}
@endsection
@section('header')
     @include('layout.header')
@endsection
@section('left-navigation')
     @include('layout.left-navigation')
@endsection
@section('top-navigation')
     @include('layout.top-navigation')
@endsection
@section('page-content')
          <style>
          .bg-grey {
               background: #ddd!important;
               border: 1px solid #fff!important;
               color: #73879C;
              }
          </style>
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top">Total Employees</span>
              <div class="count">700</div>
              <span class="count_bottom"><i class="">100% registered</i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top">Engineers</span>
              <div class="count blue">200</div>
              <span class="count_bottom"><i class="blue"><i class="fa fa-sort-asc"></i>30% of all employees</i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Architects</span>
              <div class="count green">200</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>30% of all employees</i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Quantity Surveyors</span>
              <div class="count red">100</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>15% of all employees </i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Accountants</span>
              <div class="count purple">20</div>
              <span class="count_bottom"><i class="purple"><i class="fa fa-sort-asc"></i>10% of all employees </i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Others</span>
              <div class="count text-info">180</div>
              <span class="count_bottom"><i class="text-info"><i class="fa fa-sort-asc"></i>20% of all employees</i></span>
            </div>
          </div>
          <!-- /top tiles -->
          <div class="row x_title"></div>
          <div class="row x_title">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3>Employees Pie Chart Representation</h3>
              </div>
          </div>
          <div class="row">
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div style="width:90%;">
                  {!! $employees->render() !!}
                </div>
               </div>
               <div class="col-md-3 col-sm-3 col-xs-12 bg-grey">
                  <div class="x_title">
                    <h2>Employees Categories</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <?php
                        $all  =                 ($employeesCategories['all_employees']/$employeesCategories['all_employees']) * 100;
                        $permanent  =           ($employeesCategories['permanent']/$employeesCategories['all_employees']) * 100;
                        $temporary  =           ($employeesCategories['temporary']/$employeesCategories['all_employees']) * 100;
                        $internship =           ($employeesCategories['internship']/$employeesCategories['all_employees']) * 100;
                      ?>

                      <p>All Employees <span class="red" >{{$all}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$all}}"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Permanent <span class="red" >{{$permanent}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$permanent}}"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Temporary <span class="red" >{{$temporary}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$temporary}}"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Internship <span class="red" >{{$internship}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$internship}}"></div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          <div class="row x_title"></div>
          <div class="row x_title">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3>Regional Employees HorizontaL Bar Chart Representation</h3>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div style="width:100%;">
                  {!! $regions->render() !!}
                </div>
              </div>
          </div>
          <div class="clearfix"></div>
        <!-- /page content -->
@endsection
@section('footer')
     @include('layout.footer')
@endsection
