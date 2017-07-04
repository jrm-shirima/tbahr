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
              <div class="count">{{$professionDistribution['all']}}</div>
              <span class="count_bottom"><i class="">{{100}}% registered</i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top">Engineers</span>
              <div class="count blue">{{$professionDistribution['engineers']}}</div>
              <span class="count_bottom"><i class="blue"><i class="fa fa-sort-asc"></i>@if($professionDistribution['all']){{round(($professionDistribution['engineers']/$professionDistribution['all'])* 100)}}% @else 0% @endif of all employees</i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Architects</span>
              <div class="count green">{{$professionDistribution['architects']}}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>@if($professionDistribution['all']){{round(($professionDistribution['architects']/$professionDistribution['all'])* 100)}}% @else 0% @endif of all employees</i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Quantity Surveyors</span>
              <div class="count red">{{$professionDistribution['quantitySurveyors']}}</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>@if($professionDistribution['all']){{round(($professionDistribution['quantitySurveyors']/$professionDistribution['all'])* 100)}}% @else 0% @endif of all employees </i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Accountants</span>
              <div class="count purple">{{$professionDistribution['accountants']}}</div>
              <span class="count_bottom"><i class="purple"><i class="fa fa-sort-asc"></i>@if($professionDistribution['all']){{round(($professionDistribution['accountants']/$professionDistribution['all'])* 100)}}% @else 0% @endif of all employees </i></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Others</span>
              <div class="count text-info">{{$professionDistribution['others']}}</div>
              <span class="count_bottom"><i class="text-info"><i class="fa fa-sort-asc"></i>@if($professionDistribution['all']){{round(($professionDistribution['others']/$professionDistribution['all'])* 100)}}% @else 0% @endif of all employees</i></span>
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
                      <p>All Employees <span class="red" >{{round($empCatPercentages['all'])}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$empCatPercentages['all']}}"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Permanent <span class="red" >{{round($empCatPercentages['permanent'])}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$empCatPercentages['permanent']}}"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Temporary <span class="red" >{{round($empCatPercentages['temporary'])}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$empCatPercentages['temporary']}}"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Internship <span class="red" >{{round($empCatPercentages['internship'])}}%</span></p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$empCatPercentages['internship']}}"></div>
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
