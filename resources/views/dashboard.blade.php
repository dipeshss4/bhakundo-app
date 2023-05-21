@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="content">
      <!-- Overview -->
      <div class="row items-push">
          <div class="col-sm-6 col-xl-3">
              <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full flex-grow-1">
                      <div class="item rounded-3 bg-body mx-auto my-3">
                          <i class="fa fa-users fa-lg text-primary"></i>
                      </div>
                      <div class="fs-1 fw-bold"></div>
                      <div class="text-muted mb-3"> Users</div>
                      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                          <i class="fa fa-caret-up me-1"></i>
                          {{$usersCount}}
                      </div>
                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                      <a class="fw-medium" href="javascript:void(0)">
                          View all users
                          <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-3">
              <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full flex-grow-1">
                      <div class="item rounded-3 bg-body mx-auto my-3">
                          <i class="fa fa-level-up-alt fa-lg text-primary"></i>
                      </div>
                      <div class="fs-1 fw-bold">{{$newsCount}}</div>
                      <div class="text-muted mb-3">News</div>
                      <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                      </div>
                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                      <a class="fw-medium" href="{{route('news.index')}}">
                          Explore News
                          <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-3">
              <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full flex-grow-1">
                      <div class="item rounded-3 bg-body mx-auto my-3">
                          <i class="fa fa-chart-line fa-lg text-primary"></i>
                      </div>
                      <div class="fs-1 fw-bold">{{$teamsCount}}</div>
                      <div class="text-muted mb-3">Teams </div>

                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                      <a class="fw-medium" href="{{route('teams.index')}}">
                          View all Teams
                          <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                      </a>
                  </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-3">
              <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full">
                      <div class="item rounded-3 bg-body mx-auto my-3">
                          <i class="fa fa-wallet fa-lg text-primary"></i>
                      </div>
                      <div class="fs-1 fw-bold">{{$leagueCount}}</div>
                      <div class="text-muted mb-3">League</div>
                  </div>
                  <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
                      <a class="fw-medium" href="{{route('leauge.index')}}">
                         League Count
                          <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                      </a>
                  </div>
              </div>
          </div>
      </div>
      <!-- END Overview -->

      <!-- Store Growth -->

@endsection
