@extends('layouts.app')

@section('title', 'Whatsapp API Cloud Manager')

@section('content_header')
    <div class="row m-1">
        <div class="col-12 ">
            <h4 class="main-title">Whatsapp API Cloud Manager</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li class="">
                    <a href="{{ route('dashboard') }}" class="f-s-14 f-w-500">
                        <span>
                            <i class="ph-duotone  ph-stack f-s-16"></i> Home
                        </span>
                    </a>
                </li>
                <li class="active">
                    <a href="#" class="f-s-14 f-w-500">Whatsapp API Cloud Manager</a>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('content')
    <!-- Main content -->
    <div class="col-md-5 col-lg-4 col-xxl-3">
        <div class="card education-profile-card">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="header-title-text">Profile</h5>
                </div>
                <div class="profile-top-content">
                    <div class="h-80 w-80 d-flex-center b-r-50 overflow-hidden">
                        <img src="../assets/images/dashboard/ecommerce-dashboard/whatsapp.png" alt=""
                            class="img-fluid">
                    </div>
                    <h6 class="text-dark f-w-600 mb-0">{{ $whatsapp_business_account->name }}</h6>
                    <p class="text-secondary f-s-13 mb-0">{{ '@' . $whatsapp_business_account->name }}</p>
                    {{-- <div>
                        <button type="button" class="btn btn-primary">Follow</button>
                        <a href="./profile.html" target="_blank" role="button" class="btn btn-light-secondary">View
                            Profile</a>
                    </div> --}}
                    <div class="text-center">
                        <p class="text-secondary txt-ellipsis-2 f-s-15 my-4">Business account ID:
                            {{ $whatsapp_business_account->whatsapp_business_id }} <br>
                            App ID: {{ $whatsapp_business_account->app_id }} <br>
                            Time zone: {{ $whatsapp_business_account->timezone_id }}
                        </p>
                        <input type="hidden" name="whatsapp_business_account_id" id="whatsapp_business_account_id" value="{{ $whatsapp_business_account->whatsapp_business_id }}">
                    </div>
                </div>
                <div class="profile-content-box">
                    <div class="profile-details">
                        <p class="f-s-18 mb-0"><i class="ph-bold  ph-clock-countdown"></i></p>
                        <span class="badge text-light-primary">0H</span>
                    </div>
                    <div class="profile-details">
                        <p class="f-s-18 mb-0"><i class="ph-fill  ph-book-bookmark"></i></p>
                        <span class="badge text-light-secondary">0</span>
                    </div>
                    <div class="profile-details">
                        <p class="f-s-18 mb-0"><i class="ph-fill  ph-seal-check"></i></p>
                        <span class="badge text-light-success">0K</span>
                    </div>
                    <div class="profile-details">
                        <p class="f-s-18 mb-0"><i class="ph-fill  ph-user-circle"></i></p>
                        <span class="badge text-light-info">0K</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="header-title-text">Phone Numbers</h5>

                @foreach ($whatsapp_business_account->phoneNumbers as $phoneNumber)
                    <ul class="messages-list mt-3">
                        <li class="messages-list-item">
                            <a href="#" onclick="selectPhoneNumber('{{ $phoneNumber->whatsapp_phone_id }}')">
                                <div
                                    class="h-40 w-40 d-flex-center b-r-15 overflow-hidden text-bg-secondary messages-list-avtar">
                                    <img src="{{ $phoneNumber->businessProfile->profile_picture_url }}" alt=""
                                        class="img-fluid">
                                </div>
                                <div class="messages-list-content">
                                    <h6 class="mb-0 f-s-16">{{ $phoneNumber->verified_name }}</h6>
                                    <p class="mb-0 f-s-13 text-secondary">{{ '+' . $phoneNumber->display_phone_number }}</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-8 col-xxl-9">
        <div class="card equal-card">
            <div class="card-header code-header">
                <h5>Whatsapp API Cloud Manager</h5>
                <a data-bs-toggle="collapse" href="#tab1" aria-expanded="false" aria-controls="tab1">
                    <i class="ti ti-code source" data-source="t1"></i>
                </a>
            </div>
            <div class="card-body">
                <input type="hidden" name="tab-pane-selected" id="tab-pane-selected" value="number-profile-tab-pane">
                <input type="hidden" name="whatsapp-phone-number-id" id="whatsapp-phone-number-id" value="">
                <input type="hidden" name="contact-id" id="contact-id" value="">
                <ul class="nav nav-tabs app-tabs-primary" id="Basic" role="tablist">
                    <li class="nav-item" role="presentation" onclick="selectTabPane('number-profile-tab-pane')">
                        <button class="nav-link active" id="number-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#number-profile-tab-pane" type="button" role="tab"
                            aria-controls="number-profile-tab-pane" aria-selected="true">Number Profile</button>
                    </li>
                    <li class="nav-item" role="presentation" onclick="selectTabPane('template-tab-pane')">
                        <button class="nav-link" id="template-tab" data-bs-toggle="tab" data-bs-target="#template-tab-pane"
                            type="button" role="tab" aria-controls="template-tab-pane"
                            aria-selected="true">Templates</button>
                    </li>
                    <li class="nav-item" role="presentation" onclick="selectTabPane('whatsapp-chat-tab-pane')">
                        <button class="nav-link" id="whatsapp-chat-tab" data-bs-toggle="tab"
                            data-bs-target="#whatsapp-chat-tab-pane" type="button" role="tab"
                            aria-controls="whatsapp-chat-tab-pane" aria-selected="false">Whatsapp
                            Chat</button>
                    </li>
                    <li class="nav-item" role="presentation" onclick="selectTabPane('update-account-tab-pane')">
                        <button class="nav-link" id="update-account-tab" data-bs-toggle="tab"
                            data-bs-target="#update-account-tab-pane" type="button" role="tab"
                            aria-controls="update-account-tab-pane" aria-selected="false">Update
                            Account</button>
                    </li>
                </ul>
                <div class="tab-content" id="BasicContent">
                    <div class="tab-pane fade show active" id="number-profile-tab-pane" role="tabpanel"
                        aria-labelledby="number-profile-tab" tabindex="0">
                        <div class="col-lg-4 col-xxl-3 col-box-4 order-lg--1">
                            <div class="card">
                                <div class="card-body card-profile-container">
                                    <div class="profile-container">
                                        <div class="image-details">
                                            <div class="profile-image"></div>
                                            {{-- <div class="profile-pic">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type="file" id="imageUpload"
                                                            accept=".png, .jpg, .jpeg">
                                                        <label for="imageUpload"><i class="ti ti-photo-heart"></i></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <div id="imgPreview">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="person-details">
                                            <h5 class="f-w-600" style="margin-top: 50px !important;">Ninfa Monaldo
                                                <img src="../assets/images/profile-app/01.png" class="w-20 h-20"
                                                    alt="instagram-check-mark">
                                            </h5>
                                            <p>Web designer &amp; Developer</p>
                                            {{-- <div class="details">
                                                <div>
                                                    <h4 class="text-primary">10</h4>
                                                    <p class="text-secondary">Post</p>
                                                </div>
                                                <div>
                                                    <h4 class="text-primary">3.4k</h4>
                                                    <p class="text-secondary">Follower</p>
                                                </div>
                                                <div>
                                                    <h4 class="text-primary">1k</h4>
                                                    <p class="text-secondary">Following</p>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <button type="button" class="btn btn-primary b-r-22" id="followButton">
                                                    <i class="ti ti-user"></i>
                                                    Follow</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <p class="text-muted f-s-13 profile-description">Hello! I am,Ninfa Monaldo Devoted web
                                        designer with
                                        over five years of experience and a strong understanding of Adobe Creative Suite,
                                        HTML5, CSS3 and Java. Excited to bring my exceptional front-end development
                                        abilities to the retail industry. </p>
                                    <div class="about-list">
                                        <div>
                                            <span class="fw-medium"><i class="ti ti-briefcase"></i> Address</span>
                                            <span class="float-end f-s-13 text-secondary profile-address">IT Section</span>
                                        </div>
                                        <div>
                                            <span class="fw-medium"><i class="ti ti-mail"></i> Email</span>
                                            <span class="float-end f-s-13 text-secondary">Ninfa@gmail.com</span>
                                        </div>
                                        <div>
                                            <span class="fw-medium"><i class="ti ti-phone"></i> Contact</span>
                                            <span class="float-end f-s-13 text-secondary">0364 4559103</span>
                                        </div>
                                        <div>
                                            <span class="fw-medium"><i class="ti ti-cake"></i> Birth of Date</span>
                                            <span class="float-end f-s-13 text-secondary">24 Oct</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold"><i class="ti ti-map-pin"></i> Location</span>
                                            <span class="float-end f-s-13 text-secondary">Via Partenope, 117</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold"><i class="ti ti-device-laptop"></i> Website</span>
                                            <span class="float-end f-s-13 text-secondary">Ninfa_devWWW.com</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold"><i class="ti ti-brand-github"></i> Github</span>
                                            <span class="float-end f-s-13 text-secondary">Ninfa_dev</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="template-tab-pane" role="tabpanel" aria-labelledby="template-tab"
                        tabindex="0">
                        <div class="templates">
                            <div class="col-xxl-12">
                                <div class="card equal-card ">
                                    {{-- <div class="card-header">
                                        <h5>Add, Edit &amp; Remove table</h5>
                                    </div> --}}
                                    <div class="card-body p-0">
                                        <div id="myTable">
                                            <div class="list-table-header d-flex justify-content-sm-between mb-3">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#modal_create_template">+ New Template</button>

                                                <form class="app-form app-icon-form " action="#">
                                                    <div class="position-relative ">
                                                        <input type="search" class="form-control search"
                                                            placeholder="Search..." aria-label="Search">
                                                        <i class="ti ti-search text-dark"></i>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="overflow-auto app-scroll">
                                                <table
                                                    class="table table-bottom-border  list-table-data align-middle mb-0">
                                                    <thead>
                                                        <tr class="app-sort">
                                                            <th>
                                                                <input type="checkbox" class="form-check-input  checkAll"
                                                                    name="checkAll">
                                                            </th>
                                                            <th class="d-none">ID</th>
                                                            <th class="sort" data-sort="employee" scope="col">
                                                                Template name</th>
                                                            <th class="sort" data-sort="email" scope="col">Category
                                                            </th>
                                                            <th class="sort" data-sort="contact" scope="col">
                                                                Languaje
                                                            </th>
                                                            <th class="sort" data-sort="date" scope="col">Last
                                                                updated</th>
                                                            <th class="sort" data-sort="status" scope="col">Status
                                                            </th>
                                                            <th class="sort" data-sort="action" scope="col">Actions
                                                            </th>
                                                            <th class="sort" data-sort="delete" scope="col">Delete
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list" id="t-data">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="list-pagination">
                                                <ul class="pagination">
                                                    <li class="active"><a class="page" href="#" data-i="1"
                                                            data-page="4">1</a></li>
                                                    <li><a class="page" href="#" data-i="2"
                                                            data-page="4">2</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="whatsapp-chat-tab-pane" role="tabpanel"
                        aria-labelledby="whatsapp-chat-tab" tabindex="0">
                        <!-- Chat start -->
                        <div class="row position-relative chat-container-box">
                            <div class="col-lg-4 col-xxl-3  box-col-5">
                                <div class="chat-div">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="chatdp h-45 w-45 d-flex-center b-r-50 position-relative bg-danger">
                                                    <img src="../assets/images/avtar/09.png" alt=""
                                                        class="img-fluid b-r-50">
                                                    <span
                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                </span>
                                                <div class="flex-grow-1 ps-2">
                                                    <div class="fs-6"> Ninfa Monaldo</div>
                                                    <div class="text-muted f-s-12">Web Developer</div>
                                                </div>
                                                <div>
                                                    <div class="btn-group dropdown-icon-none">
                                                        <a role="button" data-bs-placement="top"
                                                            data-bs-toggle="dropdown" data-bs-auto-close="true"
                                                            aria-expanded="false">
                                                            <i class="ti ti-settings fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" data-popper-placement="bottom-start">
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="ti ti-brand-hipchat"></i> <span
                                                                        class="f-s-13">Chat Settings</span></a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="ti ti-phone-call"></i> <span
                                                                        class="f-s-13">Contact Settings</span></a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="ti ti-settings"></i> <span
                                                                        class="f-s-13">Settings</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="close-togglebtn">
                                                    <a class="ms-2 close-toggle" role="button"><i
                                                            class="ti ti-align-justified fs-5"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chat-tab-wrapper">
                                                <ul class="tabs chat-tabs">
                                                    <li class="tab-link active" data-tab="1"><i
                                                            class="ph-fill  ph-chat-circle-text f-s-18 me-2"></i>Chat</li>
                                                    <li class="tab-link" data-tab="2"><i
                                                            class="ph-fill  ph-wechat-logo f-s-18 me-2"></i>Updates</li>
                                                    <li class="tab-link" data-tab="3"><i
                                                            class="ph-fill  ph-phone-call f-s-18 me-2"></i>Contact</li>
                                                </ul>
                                            </div>
                                            <div class="content-wrapper">

                                                <!-- tab 1 -->

                                                <div id="tab-1" class="tabs-content active">
                                                    <div class="tab-wrapper">
                                                        <div class="mt-3">
                                                            {{-- <ul class="nav nav-tabs app-tabs-primary tab-light-primary chat-status-tab border-0 justify-content-between mb-0 pb-0"
                                                                id="Basic" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link active" id="private-tab"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#private-tab-pane" type="button"
                                                                        role="tab" aria-controls="private-tab-pane"
                                                                        aria-selected="false" tabindex="-1"><i
                                                                            class="ph-fill  ph-lock-key-open me-2"></i>Private</button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link" id="groups-tab"
                                                                        data-bs-toggle="tab"
                                                                        data-bs-target="#groups-tab-pane" type="button"
                                                                        role="tab" aria-controls="groups-tab-pane"
                                                                        aria-selected="false" tabindex="-1"><i
                                                                            class="ph-fill  ph-users-three me-2"></i>Group
                                                                    </button>
                                                                </li>
                                                            </ul> --}}
                                                            <div class="tab-content" id="BasicContent">
                                                                <!-- Private Chat -->
                                                                <div class="tab-pane fade show active"
                                                                    id="private-tab-pane" role="tabpanel"
                                                                    aria-labelledby="private-tab" tabindex="0">
                                                                    <div class="chat-contact">
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <span
                                                                                    class="h-45 w-45 d-flex-center b-r-50 position-relative bg-primary">
                                                                                    <img src="../assets/images/avtar/1.png"
                                                                                        alt=""
                                                                                        class="img-fluid b-r-50">
                                                                                    <span
                                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-50">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Bette Hagenes</p>
                                                                                <p
                                                                                    class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                                                                    <i class="ti ti-checks"></i> Hi! Bette
                                                                                    How are you?
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">2:30AM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <span
                                                                                    class="h-45 w-45 d-flex-center b-r-50 position-relative bg-dark">
                                                                                    <img src="../assets/images/avtar/2.png"
                                                                                        alt=""
                                                                                        class="img-fluid b-r-50">
                                                                                    <span
                                                                                        class="position-absolute top-0 end-0 p-1 bg-secondary border border-light rounded-circle"></span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-50">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Mark Walsh</p>
                                                                                <p
                                                                                    class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                                                                    <i class="ti ti-checks"></i> Hi! Work
                                                                                    is done
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">2:30AM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <span
                                                                                    class="h-45 w-45 d-flex-center b-r-50 position-relative bg-success">
                                                                                    <img src="../assets/images/avtar/3.png"
                                                                                        alt=""
                                                                                        class="img-fluid b-r-50">
                                                                                    <span
                                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-50">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Jerry Ladies</p>
                                                                                <p
                                                                                    class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                                                                    <i class="ti ti-checks"></i> I'm
                                                                                    waiting
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">2:30AM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <span
                                                                                    class="h-45 w-45 d-flex-center b-r-50 position-relative bg-danger">
                                                                                    <img src="../assets/images/avtar/4.png"
                                                                                        alt=""
                                                                                        class="img-fluid b-r-50">
                                                                                    <span
                                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-50">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Jessica</p>
                                                                                <p
                                                                                    class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                                                                    <i class="ti ti-checks"></i> Awesome!
                                                                                    🤩 I like it
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">2:30AM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <span
                                                                                    class="h-45 w-45 d-flex-center b-r-50 position-relative bg-warning">
                                                                                    <img src="../assets/images/avtar/5.png"
                                                                                        alt=""
                                                                                        class="img-fluid b-r-50">
                                                                                    <span
                                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-50">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Sue Flay</p>
                                                                                <p
                                                                                    class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                                                                    <i class="ti ti-checks"></i> oh, Really
                                                                                    !!
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">1:00PM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <span
                                                                                    class="h-45 w-45 d-flex-center b-r-50 position-relative bg-dark">
                                                                                    <img src="../assets/images/avtar/6.png"
                                                                                        alt=""
                                                                                        class="img-fluid b-r-50">
                                                                                    <span
                                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-50">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Isla White</p>
                                                                                <p
                                                                                    class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                                                                    <i class="ti ti-checks"></i> Bye! see
                                                                                    you soon
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">12:33PM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <span
                                                                                    class="h-45 w-45 d-flex-center b-r-50 position-relative bg-secondary">
                                                                                    <img src="../assets/images/avtar/07.png"
                                                                                        alt=""
                                                                                        class="img-fluid b-r-50">
                                                                                    <span
                                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-50">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Anita Break</p>
                                                                                <p
                                                                                    class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                                                                    <i class="ti ti-checks"></i> Bye!
                                                                                </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">1:52AM</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Group Chat -->
                                                                <div class="tab-pane fade" id="groups-tab-pane"
                                                                    role="tabpanel" aria-labelledby="groups-tab"
                                                                    tabindex="0">
                                                                    <div class="chat-contact chat-group-list">
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <ul class="avatar-group">
                                                                                    <li
                                                                                        class="text-bg-warning h-45 w-45 d-flex-center b-r-50">
                                                                                        A
                                                                                    </li>
                                                                                    <li class="text-bg-secondary h-35 w-35 d-flex-center b-r-50"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-title="2 More">
                                                                                        2+
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-75">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Office Group</p>
                                                                                <p
                                                                                    class="text-secondary f-s-12 chat-message">
                                                                                    Hi! Bette How are you?</p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">2:30AM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <ul class="avatar-group">
                                                                                    <li
                                                                                        class="h-45 w-45 d-flex-center overflow-hidden b-r-50 bg-primary">
                                                                                        <img src="../assets/images/avtar/16.png "
                                                                                            alt=""
                                                                                            class="img-fluid">
                                                                                    </li>
                                                                                    <li class="text-bg-secondary h-35 w-35 d-flex-center b-r-50"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-title="2 More">
                                                                                        4+
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-75">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Markting Group</p>
                                                                                <p
                                                                                    class="text-secondary f-s-12 chat-message">
                                                                                    Hi! Work is done</p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">7:24AM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <ul class="avatar-group">
                                                                                    <li
                                                                                        class="h-45 w-45 d-flex-center overflow-hidden b-r-50 bg-info">
                                                                                        <img src="../assets/images/avtar/15.png "
                                                                                            alt=""
                                                                                            class="img-fluid">
                                                                                    </li>
                                                                                    <li class="text-bg-secondary h-35 w-35 d-flex-center b-r-50"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-title="2 More">
                                                                                        10+
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-75">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Developer Group</p>
                                                                                <p
                                                                                    class="text-secondary f-s-12 chat-message">
                                                                                    I'm waiting </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">2min</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <ul class="avatar-group">
                                                                                    <li
                                                                                        class="text-bg-danger h-45 w-45 d-flex-center overflow-hidden b-r-50">
                                                                                        AD
                                                                                    </li>
                                                                                    <li class="text-bg-secondary h-35 w-35 d-flex-center b-r-50"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-title="2 More">
                                                                                        2+
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-75">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Designer Group</p>
                                                                                <p
                                                                                    class="text-secondary f-s-12 chat-message">
                                                                                    Awesome! 🤩 I like it </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">2day</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <ul class="avatar-group">
                                                                                    <li
                                                                                        class="h-45 w-45 d-flex-center overflow-hidden b-r-50 bg-dark">
                                                                                        <img src="../assets/images/avtar/14.png "
                                                                                            alt=""
                                                                                            class="img-fluid">
                                                                                    </li>
                                                                                    <li class="text-bg-secondary h-35 w-35 d-flex-center b-r-50"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-title="2 More">
                                                                                        15+
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-75">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    Friend's Group</p>
                                                                                <p
                                                                                    class="text-secondary f-s-12 chat-message">
                                                                                    Bye! see you soon </p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">12:30PM</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="chat-contactbox">
                                                                            <div class="position-absolute">
                                                                                <ul class="avatar-group">
                                                                                    <li
                                                                                        class="text-bg-danger h-45 w-45 d-flex-center overflow-hidden b-r-50">
                                                                                        <img src="../assets/images/avtar/10.png"
                                                                                            alt=""
                                                                                            class="img-fluid">
                                                                                    </li>
                                                                                    <li class="text-bg-secondary h-35 w-35 d-flex-center b-r-50"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-title="2 More">
                                                                                        25+
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="flex-grow-1 text-start mg-s-75">
                                                                                <p
                                                                                    class="mb-0 f-w-500 text-dark txt-ellipsis-1">
                                                                                    client Group</p>
                                                                                <p
                                                                                    class="text-muted text-success f-s-12 chat-message">
                                                                                    Typing...</p>
                                                                            </div>
                                                                            <div>
                                                                                <p class="f-s-12 chat-time">Now</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="float-end">
                                                                    <div class="btn-group dropup  dropdown-icon-none">
                                                                        <button
                                                                            class="btn btn-primary icon-btn b-r-22 dropdown-toggle active"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            data-bs-auto-close="true"
                                                                            aria-expanded="false">
                                                                            <i class="ti ti-plus"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu"
                                                                            data-popper-placement="bottom-start">
                                                                            <li><a class="dropdown-item" href="#"><i
                                                                                        class="ti ti-brand-hipchat"></i>
                                                                                    <span class="f-s-13">New
                                                                                        Chat</span></a>
                                                                            </li>
                                                                            <li><a class="dropdown-item" href="#"><i
                                                                                        class="ti ti-phone-call"></i> <span
                                                                                        class="f-s-13">New
                                                                                        Contact</span></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- tab 2 -->

                                                <div id="tab-2" class="tabs-content">
                                                    <div class="chat-contact tabcontent">
                                                        <div class="updates-box">
                                                            <div class="b-2-success b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-primary">
                                                                    <img src="../assets/images/avtar/16.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Bette Hagenes</span>
                                                                <p class="f-s-12 text-secondary mb-0">2:30AM</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-secondary b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-info">
                                                                    <img src="../assets/images/avtar/6.png" alt=""
                                                                        class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Jessica</span>
                                                                <p class="f-s-12 text-secondary mb-0">2min</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-secondary b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-dark">
                                                                    <img src="../assets/images/avtar/5.png" alt=""
                                                                        class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Jerry Ladies</span>
                                                                <p class="f-s-12 text-secondary mb-0">7:00AM</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-success b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-warning">
                                                                    <img src="../assets/images/avtar/4.png" alt=""
                                                                        class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Emery McKenzie</span>
                                                                <p class="f-s-12 text-secondary mb-0">5:26PM</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-success b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-primary">
                                                                    <img src="../assets/images/avtar/3.png" alt=""
                                                                        class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Mark Walsh</span>
                                                                <p class="f-s-12 text-secondary mb-0">1:26PM</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-secondary b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-dark">
                                                                    <img src="../assets/images/avtar/2.png" alt=""
                                                                        class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Noah Davis</span>
                                                                <p class="f-s-12 text-secondary mb-0">6:22PM</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-secondary b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-primary">
                                                                    <img src="../assets/images/avtar/1.png" alt=""
                                                                        class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>
                                                                    Isla White</span>
                                                                <p class="f-s-12 text-secondary mb-0">6:10PM</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-secondary b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-secondary">
                                                                    <img src="../assets/images/avtar/10.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Fleta Walsh</span>
                                                                <p class="f-s-12 text-secondary mb-0">5:26PM</p>
                                                            </div>
                                                        </div>
                                                        <div class="updates-box">
                                                            <div class="b-2-secondary b-r-50 p-1">
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-secondary">
                                                                    <img src="../assets/images/avtar/11.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 text-start ps-2">
                                                                <span>Pete Sakes</span>
                                                                <p class="f-s-12 text-secondary mb-0">3:26PM</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="float-end">
                                                        <div class="btn-group dropdown-icon-none">
                                                            <button
                                                                class="btn btn-primary icon-btn b-r-22 dropdown-toggle active"
                                                                type="button" data-bs-toggle="dropdown"
                                                                data-bs-auto-close="true" aria-expanded="false">
                                                                <i class="ti ti-plus"></i>
                                                            </button>
                                                            <ul class="dropdown-menu"
                                                                data-popper-placement="bottom-start">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ti ti-brand-hipchat"></i> <span
                                                                            class="f-s-13">New Chat</span></a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ti ti-phone-call"></i> <span
                                                                            class="f-s-13">New Contact</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- tab 3 -->

                                                <div id="tab-3" class="tabs-content">
                                                    <div class="chat-contact tabcontent chat-contact-list">
                                                        <div class=" d-flex align-items-center py-3">
                                                            <div>
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-info">
                                                                    <img src="../assets/images/avtar/13.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                    <span
                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ps-2">
                                                                <p class="contact-name text-dark mb-0 f-w-500">Bette
                                                                    Hagenes</p>
                                                                <p class="mb-0 text-secondary f-s-13">+978356479</p>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-success d-flex-center b-r-50">
                                                                    <i class="ti ti-phone-call"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-primary d-flex-center b-r-50 ms-1">
                                                                    <i class="ti ti-video"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-3">
                                                            <div>
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-danger">
                                                                    <img src="../assets/images/avtar/12.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                    <span
                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ps-2">
                                                                <p class="contact-name text-dark mb-0 f-w-500">Fleta Walsh
                                                                </p>
                                                                <p class="mb-0 text-secondary f-s-13">+988456479</p>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-success d-flex-center b-r-50">
                                                                    <i class="ti ti-phone-call"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-primary d-flex-center b-r-50 ms-1">
                                                                    <i class="ti ti-video"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-3">
                                                            <div>
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-warning">
                                                                    <img src="../assets/images/avtar/11.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                    <span
                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ps-2">
                                                                <p class="contact-name text-dark mb-0 f-w-500">Lenora
                                                                    Bogisich</p>
                                                                <p class="mb-0 text-secondary f-s-13">+4583546479</p>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-success d-flex-center b-r-50">
                                                                    <i class="ti ti-phone-call"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-primary d-flex-center b-r-50 ms-1">
                                                                    <i class="ti ti-video"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-3">
                                                            <div>
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-success">
                                                                    <img src="../assets/images/avtar/10.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                    <span
                                                                        class="position-absolute top-0 end-0 p-1 bg-secondary border border-light rounded-circle"></span>
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ps-2">
                                                                <p class="contact-name text-dark mb-0 f-w-500">Emery
                                                                    McKenzie</p>
                                                                <p class="mb-0 text-secondary f-s-13">+378356479</p>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-success d-flex-center b-r-50">
                                                                    <i class="ti ti-phone-call"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-primary d-flex-center b-r-50 ms-1">
                                                                    <i class="ti ti-video"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-3">
                                                            <div>
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-danger">
                                                                    <img src="../assets/images/avtar/08.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                    <span
                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ps-2">
                                                                <p class="contact-name text-dark mb-0 f-w-500">Elmer</p>
                                                                <p class="mb-0 text-secondary f-s-13">+678356270</p>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-success d-flex-center b-r-50">
                                                                    <i class="ti ti-phone-call"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-primary d-flex-center b-r-50 ms-1">
                                                                    <i class="ti ti-video"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-3">
                                                            <div>
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-success">
                                                                    <img src="../assets/images/avtar/09.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                    <span
                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ps-2">
                                                                <p class="contact-name text-dark mb-0 f-w-500">Mark Walsh
                                                                </p>
                                                                <p class="mb-0 text-secondary f-s-13">+780356479</p>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-success d-flex-center b-r-50">
                                                                    <i class="ti ti-phone-call"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-primary d-flex-center b-r-50 ms-1">
                                                                    <i class="ti ti-video"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center py-3">
                                                            <div>
                                                                <span
                                                                    class="h-40 w-40 d-flex-center b-r-50 position-relative bg-warning">
                                                                    <img src="../assets/images/avtar/07.png"
                                                                        alt="" class="img-fluid b-r-50">
                                                                    <span
                                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                                </span>
                                                            </div>
                                                            <div class="flex-grow-1 ps-2">
                                                                <p class="contact-name text-dark mb-0 f-w-500">Sue Flay</p>
                                                                <p class="mb-0 text-secondary f-s-13">+780356479</p>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-success d-flex-center b-r-50">
                                                                    <i class="ti ti-phone-call"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <span
                                                                    class="h-35 w-35 text-outline-primary d-flex-center b-r-50 ms-1">
                                                                    <i class="ti ti-video"></i>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="float-end">
                                                        <div class="btn-group dropdown-icon-none">
                                                            <button
                                                                class="btn btn-primary icon-btn b-r-22 dropdown-toggle active"
                                                                type="button" data-bs-toggle="dropdown"
                                                                data-bs-auto-close="true" aria-expanded="false">
                                                                <i class="ti ti-plus"></i>
                                                            </button>
                                                            <ul class="dropdown-menu"
                                                                data-popper-placement="bottom-start">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ti ti-brand-hipchat"></i> <span
                                                                            class="f-s-13">New Chat</span></a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ti ti-phone-call"></i> <span
                                                                            class="f-s-13">New Contact</span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xxl-9 box-col-7">
                                <div class="card chat-container-content-box">
                                    <div class="card-header">
                                        <div class="chat-header d-flex align-items-center">
                                            <div class="d-lg-none">
                                                <a class="me-3 toggle-btn" role="button"><i
                                                        class="ti ti-align-justified"></i></a>
                                            </div>
                                            <a href="./profile.html">
                                                <span
                                                    class="profileimg h-45 w-45 d-flex-center b-r-50 position-relative bg-light">
                                                    <img id="contact-image" src="../assets/images/avtar/14.png"
                                                        alt="" class="img-fluid b-r-50">
                                                    <span
                                                        class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                                </span>
                                            </a>
                                            <div class="flex-grow-1 ps-2 pe-2">
                                                <div class="fs-6" id="contact-name"> Jerry Ladies</div>
                                                <div class="text-muted f-s-12 text-success">Online</div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-success h-45 w-45 icon-btn b-r-22 me-sm-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="ti ti-phone-call f-s-20"></i>
                                            </button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-body p-0">
                                                        <div class="call">
                                                            <div class="call-div">
                                                                <img src="../assets/images/profile-app/32.jpg"
                                                                    class="w-100" alt="">
                                                                <div class="call-caption">
                                                                    <h2 class="text-white">Jerry Ladies</h2>
                                                                    <div class="d-flex justify-content-center">
                                                                        <span
                                                                            class="bg-success h-40 w-40 d-flex-center b-r-50 animate__animated animate__1 animate__shakeY animate__infinite call-btn pointer-events-auto"
                                                                            data-bs-dismiss="modal">
                                                                            <i class="ti ti-phone-call"></i>
                                                                        </span>
                                                                        <span
                                                                            class="bg-danger h-40 w-40 d-flex-center b-r-50 ms-4 call-btn pointer-events-auto"
                                                                            data-bs-dismiss="modal">
                                                                            <i class="ti ti-phone"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-primary h-45 w-45 icon-btn b-r-22 me-sm-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                                <i class="ti ti-video f-s-20"></i>
                                            </button>
                                            <div class="modal fade" id="exampleModal1" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-body p-0">
                                                        <div class="call">
                                                            <div class="call-div pointer-events-auto">
                                                                <img src="../assets/images/profile-app/25.jpg"
                                                                    class="w-100" alt="">

                                                                <div class="call-caption">
                                                                    <div
                                                                        class="d-flex justify-content-center align-items-center">

                                                                        <span
                                                                            class="bg-white h-35 w-35 d-flex-center b-r-50 ms-4">
                                                                            <i class="ti ti-microphone text-dark"></i>
                                                                        </span>
                                                                        <span data-bs-dismiss="modal"
                                                                            class="bg-danger h-45 w-45 d-flex-center b-r-50 ms-4 animate__pulse animate__animated animate__infinite animate__faster call-btn pointer-events-auto">
                                                                            <i class="ti ti-phone"></i>
                                                                        </span>
                                                                        <span
                                                                            class="bg-white h-35 w-35 d-flex-center b-r-50 ms-4">
                                                                            <i class="ti ti-phone-pause text-dark"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="video-div">
                                                                <img src="../assets/images/profile-app/31.jpg"
                                                                    class="w-100 rounded" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-secondary h-45 w-45 icon-btn b-r-22 me-sm-2"
                                                    data-bs-toggle="dropdown" data-bs-auto-close="true"
                                                    aria-expanded="false">
                                                    <i class="ti ti-settings f-s-20"></i>
                                                </button>
                                                <ul class="dropdown-menu" data-popper-placement="bottom-start">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="ti ti-brand-hipchat"></i> <span class="f-s-13">Chat
                                                                Settings</span></a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="ti ti-phone-call"></i> <span class="f-s-13">Contact
                                                                Settings</span></a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="ti ti-settings"></i> <span
                                                                class="f-s-13">Settings</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body chat-body">
                                        <div class="chat-container ">
                                            <div class="text-center">
                                                <span class="badge text-light-secondary">Today</span>
                                            </div>
                                            <div class="position-relative">
                                                <div class="chatdp h-45 w-45 b-r-50 position-absolute start-0 bg-light">
                                                    <img src="../assets/images/avtar/14.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </div>
                                                <div class="chat-box">
                                                    <div>
                                                        <p class="chat-text">Hi! Ninfa Monaldo can we go over the project
                                                            details for the upcoming presentation?</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:00PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative">
                                                <div class="chat-box-right">
                                                    <div>
                                                        <p class="chat-text">Sure, Jerry.</p>
                                                        <p class="chat-text">I was just reviewing our notes.</p>
                                                        <p class="chat-text">What do you want to start with?</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:02PM</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="chatdp h-45 w-45 b-r-50 position-absolute end-0 top-0 bg-danger">
                                                    <img src="../assets/images/avtar/09.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </div>
                                            </div>
                                            <div class="position-relative">
                                                <div class="chatdp h-45 w-45 b-r-50 position-absolute start-0 bg-light">
                                                    <img src="../assets/images/avtar/14.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </div>
                                                <div class="chat-box">
                                                    <div>
                                                        <p class="chat-text"> Let’s begin with the project timeline.</p>
                                                        <p class="chat-text"> Are we on track to meet the deadlines?</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:03PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative">
                                                <div class="chat-box-right">
                                                    <div>
                                                        <p class="chat-text">Yes, mostly.</p>
                                                        <p class="chat-text">We completed the initial research phase and
                                                            the design draft. We're currently in the development phase,
                                                            which should be done by the end of the week.</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:02PM</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="chatdp h-45 w-45 b-r-50 position-absolute end-0 top-0 bg-danger">
                                                    <img src="../assets/images/avtar/09.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </div>
                                            </div>
                                            <div class="position-relative">
                                                <span class="chatdp h-45 w-45 position-absolute start-0 b-r-50 bg-light">
                                                    <img src="../assets/images/avtar/14.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </span>
                                                <div class="chat-box">
                                                    <div>
                                                        <p class="chat-text"> Great to hear! </p>
                                                        <p class="chat-text"> How about the testing phase? When do we plan
                                                            to start that?</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:06PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative">
                                                <div class="chat-box-right">
                                                    <div>
                                                        <p class="chat-text">We have it scheduled to start next Monday.
                                                            That gives us a full week to iron out any issues before the
                                                            final presentation.</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:08M</p>
                                                    </div>
                                                </div>
                                                <span
                                                    class="chatdp h-45 w-45 b-r-50 position-absolute top-0 end-0 bg-danger">
                                                    <img src="../assets/images/avtar/09.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </span>
                                            </div>
                                            <div class="position-relative">
                                                <span class="chatdp h-45 w-45 b-r-50 position-absolute start-0 bg-light">
                                                    <img src="../assets/images/avtar/14.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </span>
                                                <div class="chat-box">
                                                    <div>
                                                        <p class="chat-text"> Perfect. Have we assigned specific tasks for
                                                            the testing phase?</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:10PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative">
                                                <div class="chat-box-right">
                                                    <div>
                                                        <p class="chat-text">Yes, I've assigned the initial testing to the
                                                            QA team. I've also scheduled a meeting with them to go over the
                                                            testing protocols.</p>
                                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i>
                                                            2:08M</p>
                                                    </div>
                                                </div>
                                                <span
                                                    class="chatdp h-45 w-45 b-r-50 position-absolute top-0 end-0 bg-danger">
                                                    <img src="../assets/images/avtar/09.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </span>
                                            </div>
                                            <div class="position-relative">
                                                <span class="chatdp h-45 w-45 b-r-50 position-absolute start-0 bg-light">
                                                    <img src="../assets/images/avtar/14.png" alt=""
                                                        class="img-fluid b-r-50">
                                                </span>
                                                <div class="chat-box">
                                                    <div>
                                                        <p class="chat-text">Typing....</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="chat-footer d-flex">
                                            <div class="app-form flex-grow-1">
                                                <div class="input-group">
                                                    <form id="sendMessageForm" class="input-group">
                                                        <span class="input-group-text bg-secondary ms-2 me-2 b-r-10 ">
                                                            <a class="emoji-btn d-flex-center" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" data-bs-original-title="Emoji"
                                                                role="button">
                                                                <i class="ti ti-mood-smile f-s-18"></i>
                                                            </a>
                                                        </span>
                                                        <input type="text" id="messageInput"
                                                            class="form-control b-r-6" placeholder="Type a message"
                                                            aria-label="Recipient's username">
                                                        <button class="btn btn-sm btn-primary ms-2 me-2 b-r-4"
                                                            type="submit"><i class="ti ti-send"></i>
                                                            <span>Send</span></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="d-none d-sm-block">
                                                <a class="bg-secondary h-50 w-50 d-flex-center b-r-10 ms-1" role="button"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Microphone">
                                                    <i class="ti ti-microphone f-s-18"></i>
                                                </a>
                                            </div>
                                            <div class="d-none d-sm-block">
                                                <a class="bg-secondary h-50 w-50 d-flex-center b-r-10 ms-1" role="button"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Camera">
                                                    <i class="ti ti-camera-plus f-s-18"></i>
                                                </a>
                                            </div>
                                            <div class="d-none d-sm-block">
                                                <a class="bg-secondary h-50 w-50 d-flex-center b-r-10 ms-1" role="button"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Paperclip">
                                                    <i class="ti ti-paperclip f-s-18"></i>
                                                </a>
                                            </div>
                                            <div class="d-none d-sm-block">
                                                <a class="bg-secondary h-50 w-50 d-flex-center b-r-10 ms-1" role="button"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-original-title="Template">
                                                    <i class="ti ti-template f-s-18"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <div class="btn-group dropdown-icon-none d-sm-none">
                                                    <a class="h-35 w-35 d-flex-center ms-1" role="button"
                                                        data-bs-toggle="dropdown" data-bs-auto-close="true"
                                                        aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" data-popper-placement="bottom-start">
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="ti ti-microphone"></i> <span
                                                                    class="f-s-13">Microphone</span></a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"> <i
                                                                    class="ti ti-camera-plus"></i> <span
                                                                    class="f-s-13">camera</span></a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="ti ti-paperclip"></i> <span
                                                                    class="f-s-13">paperclip</span></a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="ti ti-file"></i> <span
                                                                    class="f-s-13">file</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Chat end -->
                    </div>

                    <div class="tab-pane fade" id="update-account-tab-pane" role="tabpanel"
                        aria-labelledby="update-account-tab" tabindex="0">
                        <p class="mb-0">PHP is a popular general-purpose scripting language that is especially suited to
                            web
                            development.</p>
                        <p class="mb-0">It was originally created by Rasmus Lerdorf in 1994; the PHP reference
                            implementation is now
                            produced by The PHP Group.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bundle/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/whatsapp/custom.css') }}">
@stop

@section('modals')
    @include('whatsapp.modals.modal-create-template')
    @include('whatsapp.modals.modal-detail-template')
    @include('whatsapp.modals.modal-edit-template')
    @include('whatsapp.modals.modal-send-template')
    @include('whatsapp.modals.modal-delete-template')
@stop

@section('js')
    {{-- <script src="{{ asset('assets/js/whatsapp/custom.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/bundle/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/whatsapp/components/custom-modal.js') }}"></script>

    @verbatim
    <script>
        $(document).ready(function() {
            $('#createTemplateName').maxlength({
                warningClass: "badge text-bg-warning",
                limitReachedClass: "badge text-bg-success"
            });
        });


        const profileContainer = document.querySelector(".card-profile-container");
        profileContainer.style.display = "none";

        const contactsContainer = document.querySelector(".chat-contact");
        contactsContainer.innerHTML = "";

        const chatContainer = document.querySelector(".chat-container");
        chatContainer.innerHTML = "";

        function selectTabPane($tabPane) {
            const tabPane_selected = document.querySelector("#tab-pane-selected");
            tabPane_selected.value = $tabPane;
            const whatsappPhoneNumberId = document.querySelector(
                "#whatsapp-phone-number-id"
            ).value;

            switch ($tabPane) {
                case "number-profile-tab-pane":
                    loadProfile();
                    break;
                case "template-tab-pane":
                    loadTemplate(whatsappPhoneNumberId);
                    break;
                case "whatsapp-chat-tab-pane":
                    loadChat(whatsappPhoneNumberId);
                    break;
                case "update-account-tab-pane":
                    loadUpdateAccount(whatsappPhoneNumberId);
                    break;
            }
        }

        function loadProfile() {
            const whatsappPhoneNumberId = document.querySelector(
                "#whatsapp-phone-number-id"
            ).value;
            if (!whatsappPhoneNumberId) {
                showAlert("warning", "Debe Seleccionar un NUmero de telefono.");
                return;
            }

            fetch(`/phone-number/${whatsappPhoneNumberId}/profile`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Actualiza los datos del perfil en la página
                    const whatsappPhoneNumberId = document.querySelector(
                        "#whatsapp-phone-number-id"
                    );
                    const tabPane_selected =
                        document.querySelector("#tab-pane-selected");
                    const profileImage = document.querySelector(".profile-image");
                    const profileDescription = document.querySelector(
                        ".profile-description"
                    );
                    const personDetailsName =
                        document.querySelector(".person-details h5");
                    const personDetailsDescription =
                        document.querySelector(".person-details p");
                    const emailElement = document.querySelector(
                        ".about-list .email .float-end"
                    );
                    const contactElement = document.querySelector(
                        ".about-list .contact .float-end"
                    );
                    const locationElement = document.querySelector(
                        ".about-list .location .float-end"
                    );
                    const profileAddress = document.querySelector(".profile-address");
                    const websiteElement = document.querySelector(
                        ".about-list .website .float-end"
                    );
                    const githubElement = document.querySelector(
                        ".about-list .github .float-end"
                    );

                    if (profileImage) {
                        profileImage.innerHTML =
                            `<img src="${data.business_profile.profile_picture_url}" alt="" class="img-fluid">`;
                    }
                    if (personDetailsName) {
                        personDetailsName.innerHTML =
                            `${data.verified_name} <img src="../assets/images/profile-app/01.png" class="w-20 h-20" alt="instagram-check-mark">`;
                    }
                    if (personDetailsDescription) {
                        personDetailsDescription.innerText =
                            data.business_profile.description;
                        profileDescription.innerText =
                            data.business_profile.description;
                    }
                    if (emailElement) {
                        emailElement.innerText = data.business_profile.email;
                    }
                    if (contactElement) {
                        contactElement.innerText = data.display_phone_number;
                    }
                    if (locationElement) {
                        locationElement.innerText = data.business_profile.address;
                    }

                    if (profileAddress) {
                        profileAddress.innerText = data.business_profile.address;
                    }
                    if (websiteElement) {
                        websiteElement.innerText = data.business_profile.websites
                            .map((website) => website.website)
                            .join(", ");
                    }
                    if (githubElement) {
                        githubElement.innerText = data.business_profile.github;
                    }

                    profileContainer.style.display = "block";
                })
                .catch((error) => {
                    console.error("Error:", error);
                    // alert('Error al cargar el perfil.');
                    showAlert("danger", "Error al cargar el perfil.");
                });
        }

        function loadTemplate() {
            const whatsappPhoneNumberId = document.querySelector(
                "#whatsapp-phone-number-id"
            ).value;
            if (!whatsappPhoneNumberId) {
                showAlert("warning", "Debe Seleccionar un NUmero de telefono.");
                return;
            }

            fetch(`/templates/${whatsappPhoneNumberId}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Procesa los datos de la plantilla aquí
                    console.log(data);
                    // Llenar la tabla con los datos de la plantilla
                    const tbody = document.getElementById("t-data");
                    tbody.innerHTML = ""; // Limpiar el contenido existente

                    data.forEach((template) => {
                        const row = document.createElement("tr");

                        row.innerHTML = `
                            <th scope="row"><input class="form-check-input mt-0 ms-2" type="checkbox" name="item"></th>
                            <td class="id d-none">${template.template_id}</td>
                            <td class="employee">${template.name}</td>
                            <td class="email">${template.category}</td>
                            <td class="contact">${template.language}</td>
                            <td class="date">${new Date(
                                template.updated_at
                            ).toLocaleDateString()}</td>
                            <td class="status">
                                <span class="badge ${
                                    template.status === "APPROVED"
                                        ? "bg-success-subtle text-success"
                                        : template.status === "REJECTED"
                                            ? "bg-danger-subtle text-danger"
                                            : "bg-secondary-subtle text-secondary"
                                } text-uppercase">${template.status}</span>
                            </td>
                            <td class="edit">
                                <div class="d-flex justify-content-around">
                                    <button type="button" class="btn btn-sm btn-primary icon-btn b-r-4 mr-2 modal-detailTemplate" data-bs-toggle="modal" data-bs-target="#modal_detail_template" data-template-name="${template.name}" data-template-id="${template.template_id}" data-template-wa-id="${template.wa_template_id}">
                                        <i class="fa-solid fa-eye fa-fw"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary icon-btn b-r-4 mr-2 modal-editTemplate" data-bs-toggle="modal" data-bs-target="#modal_edit_template" data-template-name="${template.name}" data-template-id="${template.template_id}" data-template-wa-id="${template.wa_template_id}">
                                        <i class="fa-solid fa-pencil fa-fw"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary icon-btn b-r-4 modal-sendTemplate" data-bs-toggle="modal" data-bs-target="#modal_send_template" data-template-name="${template.name}" data-template-id="${template.template_id}" data-template-wa-id="${template.wa_template_id}">
                                        <i class="fa-solid fa-paper-plane fa-fw"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="remove">
                                <button type="button" class="btn btn-danger icon-btn b-r-4 modal-deleteTemplate" data-bs-toggle="modal" data-bs-target="#modal_delete_template">
                                    <i class="fa-solid fa-trash fa-fw"></i>
                                </button>
                             </td>
                        `;

                        tbody.appendChild(row);
                        // Puedes actualizar el DOM con los datos de la plantilla si es necesario
                    });
                })
                .catch((error) => {
                    // console.error("Error:", error);
                    // alert('Error al cargar la plantilla.');
                    showAlert("danger", "Error al cargar la plantilla.");
                });
        }

        function loadChat() {
            const whatsappPhoneNumberId = document.querySelector(
                "#whatsapp-phone-number-id"
            ).value;
            if (!whatsappPhoneNumberId) {
                showAlert("warning", "Debe Seleccionar un NUmero de telefono.");
                return;
            }

            fetch(`/whatsapp-chat/${whatsappPhoneNumberId}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Procesa los datos de la plantilla aquí
                    console.log(data);
                    const contactsContainer = document.querySelector(".chat-contact");
                    contactsContainer.innerHTML = ""; // Limpiar el contenido existente

                    Object.values(data).forEach((contact) => {
                        const contactBox = document.createElement("div");
                        contactBox.className = "chat-contactbox";
                        contactBox.dataset.contactId = contact.contact_id;

                        contactBox.innerHTML = `
                            <div class="position-absolute">
                                <span class="h-45 w-45 d-flex-center b-r-50 position-relative bg-primary">
                                    <img src="../assets/images/avtar/1.png" alt="" class="img-fluid b-r-50">
                                    <span class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                </span>
                            </div>
                            <div class="flex-grow-1 text-start mg-s-50">
                                <p class="mb-0 f-w-500 text-dark txt-ellipsis-1">${
                                    contact.contact_name
                                }</p>
                                <p class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                    <i class="ti ti-checks"></i> ${
                                        contact.phone_number
                                    }
                                </p>
                            </div>
                            <div>
                                <p class="f-s-12 chat-time">${new Date(
                                    contact.updated_at
                                ).toLocaleTimeString()}</p>
                            </div>
                        `;

                        contactBox.addEventListener("click", function() {
                            loadChatHistory(contact.contact_id);
                        });

                        contactsContainer.appendChild(contactBox);
                    });
                    // Llenar la tabla con los datos de la plantilla
                })
                .catch((error) => {
                    console.error("Error:", error);
                    // alert('Error al cargar la plantilla.');
                    showAlert("danger", "Error al cargar el chat.");
                });
        }

        function loadChatHistory(contactId) {
            const whatsappPhoneNumberId = document.querySelector(
                "#whatsapp-phone-number-id"
            ).value;
            const contactIdinput = document.querySelector("#contact-id");
            contactIdinput.value = contactId;

            if (!whatsappPhoneNumberId) {
                showAlert("warning", "Debe Seleccionar un Número de teléfono.");
                return;
            }

            fetch(`/chat-history/${contactId}/${whatsappPhoneNumberId}`)
                .then((response) => response.json())
                .then((data) => {
                    const chatContainer = document.querySelector(".chat-container");
                    chatContainer.innerHTML = ""; // Limpiar el contenido existente

                    // Actualizar datos del contacto en el modal
                    const contact = data.contact;
                    const contactNameElement = document.querySelector("#contact-name");
                    contactNameElement.textContent = contact.contact_name;
                    document.querySelector("#contact-image").src =
                        contact.profile_image_url || "../assets/images/avtar/14.png";

                    data.messages.forEach((message) => {
                        const messageElement = document.createElement("div");
                        const isOutgoing = message.message_method === "OUTPUT";
                        const messageTime = new Date(
                            message.timestamp * 1000
                        ).toLocaleTimeString();

                        messageElement.className = "position-relative";

                        if (message.message_type === "TEXT") {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? "chat-box-right" : "chat-box"}">
                        <div>
                            <p class="chat-text">${message.message_content}</p>
                            <p class="text-muted"><i class="ti ti-checks ${
                                message.readed_at ? "text-primary" : ""
                            }"></i> ${new Date(
                        message.created_at
                    ).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === "IMAGE") {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? "chat-box-right" : "chat-box"}">
                        <div>
                            <img src="${
                                message.media_files[0].url
                            }" alt="" class="img-fluid">
                            <p class="text-muted"><i class="ti ti-checks ${
                                message.readed_at ? "text-primary" : ""
                            }"></i> ${new Date(
                        message.created_at
                    ).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === "DOCUMENT") {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? "chat-box-right" : "chat-box"}">
                        <div>
                            <a href="${
                                message.media_files[0].url
                            }" target="_blank" class="btn btn-primary">${
                        message.message_content
                    }</a>
                            <p class="text-muted"><i class="ti ti-checks ${
                                message.readed_at ? "text-primary" : ""
                            }"></i> ${new Date(
                        message.created_at
                    ).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === "AUDIO") {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? "chat-box-right" : "chat-box"}">
                        <div>
                            <audio controls>
                                <source src="${
                                    message.media_files[0].url
                                }" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <p class="text-muted"><i class="ti ti-checks ${
                                message.readed_at ? "text-primary" : ""
                            }"></i> ${new Date(
                        message.created_at
                    ).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === "VIDEO") {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? "chat-box-right" : "chat-box"}">
                        <div>
                            <video width="320" height="240" controls>
                                <source src="${
                                    message.media_files[0].url
                                }" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <p class="text-muted"><i class="ti ti-checks ${
                                message.readed_at ? "text-primary" : ""
                            }"></i> ${new Date(
                        message.created_at
                    ).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        }

                        chatContainer.appendChild(messageElement);
                    });

                    // Scroll to the bottom of the chat container
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Error al cargar el historial de conversaciones.");
                });
        }

        function selectPhoneNumber(phone_number_id) {
            const tabPane_selected = document.querySelector("#tab-pane-selected");
            const whatsappPhoneNumberId = document.querySelector(
                "#whatsapp-phone-number-id"
            );

            whatsappPhoneNumberId.value = phone_number_id;

            switch (tabPane_selected.value) {
                case "number-profile-tab-pane":
                    loadProfile(phone_number_id);
                    break;
                case "template-tab-pane":
                    loadTemplate();
                    break;
                case "whatsapp-chat-tab-pane":
                    loadChat();
                    break;
                case "update-account-tab-pane":
                    loadUpdateAccount();
                    break;
            }
        }

        // document.addEventListener('DOMContentLoaded', function() {
        //     const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id').value;
        //     if (!whatsappPhoneNumberId) {
        //         showAlert('warning', 'Debe Seleccionar un Número de teléfono.');
        //         return;
        //     }

        //     const sendMessageForm = document.getElementById('sendMessageForm');
        //     const messageInput = document.getElementById('messageInput');
        //     const chatContainer = document.querySelector('.chat-container');

        //     sendMessageForm.addEventListener('submit', function(event) {
        //         event.preventDefault();

        //         alert('Send');

        //         const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id').value;
        //         const contactId = document.querySelector('#contact-id').value;
        //         const messageContent = messageInput.value.trim();

        //         if (!whatsappPhoneNumberId) {
        //             showAlert('warning', 'Debe Seleccionar un Número de teléfono.');
        //             return;
        //         }

        //         if (!messageContent) {
        //             showAlert('warning', 'El mensaje no puede estar vacío.');
        //             return;
        //         }

        //         fetch('/send-message', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             },
        //             body: JSON.stringify({
        //                 whatsapp_phone_id: whatsappPhoneNumberId,
        //                 contact_id: contactId,
        //                 message_content: messageContent,
        //                 tipo: 'TEXT',
        //                 type: 'OUTPUT'
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.success) {
        //                 const messageElement = document.createElement('div');
        //                 messageElement.className = 'position-relative chat-box-right';
        //                 messageElement.innerHTML = `
    //                     <div>
    //                         <p class="chat-text">${messageContent}</p>
    //                         <p class="text-muted"><i class="ti ti-checks text-primary"></i> ${new Date().toLocaleString()}</p>
    //                     </div>
    //                 `;
        //                 chatContainer.appendChild(messageElement);
        //                 chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll to the bottom
        //                 messageInput.value = ''; // Clear the input
        //             } else {
        //                 showAlert('danger', 'Error al enviar el mensaje.');
        //             }
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             showAlert('danger', 'Error al enviar el mensaje.');
        //         });
        //     });
        // });

        $(document).ready(function() {
            // Delegación de eventos para elementos dinámicos
            $(document).on('click', '.modal-detailTemplate', function () {
                var templateId = $(this).data('template-id');
                var templateName = $(this).data('template-name');
                var waTemplateId = $(this).data('template-wa-id');
                var json = {}; // Define el JSON que necesitas enviar

                $.ajax({
                    url: '/template-detail',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        json: json,
                        template_id: templateId,
                        wa_template_id: waTemplateId
                    },
                    success: function (response) {
                        // Manejar la respuesta
                        console.log(response);
                        $('#modal_detail_template_body').html(response);
                        $('#modal_detail_template').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        $(document).ready(function() {
            function openSendModal(button) {
                const template_Id = button.getAttribute("data-template-id");
                const templateName = button.getAttribute("data-template-name");
                const waTemplateId = button.getAttribute("data-template-wa-id");

                $('#send_template_id').val(template_Id);

                var json = {}; // Define el JSON que necesitas enviar

                $.ajax({
                    url: '/template-detail',
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        json: json,
                        template_id: template_Id,
                        wa_template_id: waTemplateId
                    },
                    success: function (response) {
                        // Manejar la respuesta
                        // console.log(response);
                        $('#detail_template_body').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });


                $.ajax({
                    url: '/template-json', // Ruta de Laravel para obtener los detalles de la plantilla
                    type: 'POST',
                    data: {
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        id: template_Id
                    },
                    success: function (data) {
                        // Mapea los datos del JSON a los campos del formulario
                        // console.log(data);

                        const form = document.getElementById('sendTemplateForm');
                        form.innerHTML = ''; // Limpiar el formulario

                        // Añadir campo para el destinatario
                        form.innerHTML += `
                            <div class="form-group">
                                <label for="countryCode">Código de País</label>
                                <select class="form-control" id="countryCode" name="countryCode" required>
                                    <option value="+57">Colombia (+57)</option>
                                    <!-- Añadir más códigos de país según sea necesario -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Número de Teléfono</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                        `;

                        console.log(data.components);
                        // Añadir campos dinámicos basados en los parámetros de la plantilla
                        data.components.forEach(component => {
                            if (component.type === 'HEADER' && component.text) {
                                const matches = component.text.match(/@{{\d+}}/g);
                                if (matches) {
                                    form.innerHTML += `<h5>HEADER Parameters</h5>`;
                                    matches.forEach((match, index) => {
                                        const exampleText = component.example ? component.example.header_text[index] : '';
                                        form.innerHTML += `
                                            <div class="form-group">
                                                <label for="param_HEADER_${index}">HEADER Param ${index + 1}</label>
                                                <input type="text" class="form-control" id="param_HEADER_${index}" name="param_HEADER_${index}" value="${exampleText}" required>
                                            </div>
                                        `;
                                    });
                                }
                            } else if (component.type === 'BODY' && component.text) {
                                console.log(component);
                                const matches = component.text.match(/{{\d+}}/g);
                                console.log("Matches: " + matches);
                                if (matches) {
                                    form.innerHTML += `<h5>BODY Parameters</h5>`;
                                    matches.forEach((match, index) => {
                                        const exampleText = component.example ? component.example.body_text[0][index] : '';
                                        form.innerHTML += `
                                            <div class="form-group">
                                                <label for="param_BODY_${index}">BODY Param ${index + 1}</label>
                                                <input type="text" class="form-control" id="param_BODY_${index}" name="param_BODY_${index}" value="${exampleText}" required>
                                            </div>
                                        `;
                                    });
                                }
                            } else if (component.type === 'BUTTONS') {
                                component.buttons.forEach((button, buttonIndex) => {
                                    if (button.url) {
                                        const matches = button.url.match(/{{\d+}}/g);
                                        if (matches) {
                                            form.innerHTML += `<h5>Button ${buttonIndex + 1} Parameters</h5>`;
                                            matches.forEach((match, index) => {
                                                const exampleText = button.example ? button.example[index] : '';
                                                form.innerHTML += `
                                                    <div class="form-group">
                                                        <label for="param_BUTTON_${buttonIndex}_${index}">Button ${buttonIndex + 1} Param ${index + 1}</label>
                                                        <input type="text" class="form-control" id="param_BUTTON_${buttonIndex}_${index}" name="param_BUTTON_${buttonIndex}_${index}" value="${exampleText}" required>
                                                    </div>
                                                `;
                                            });
                                        }
                                    }
                                });
                            }
                        });

                        // Añadir campo oculto para el ID de la plantilla
                        // form.innerHTML += `<input type="hidden" id="templateId" name="template_id" value="${data.id}">`;

                        // Añadir botón de envío
                        // form.innerHTML += `<button type="submit" class="btn btn-primary">Enviar</button>`;

                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud:', error);
                        alert("Hubo un error al cargar los datos de la plantilla. Por favor, intenta de nuevo.");
                    }
                });
            }

            $(document).on('click', '.modal-sendTemplate', function () {
                // alert("Enviar plantilla");
                openSendModal(this);
            });

            $('#send_template_form').on('submit', function(event) {
                event.preventDefault(); // Prevenir el envío del formulario por defecto

                const formData = $(this).serialize(); // Serializar los datos del formulario

                $.ajax({
                    url: '/send-template', // Usar la URL de acción del formulario
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log('Éxito:', response);
                        alert("Plantilla enviada con éxito.");
                        $('#modal_send_template').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud:', error);
                        alert("Hubo un error al enviar la plantilla. Por favor, intenta de nuevo.");
                    }
                });
            });

        });

        $(document).ready(function() {
            const sendMessageForm = $("#sendMessageForm");
            const messageInput = $("#messageInput");
            const chatContainer = $(".chat-container");

            sendMessageForm.on("submit", function(event) {
                event.preventDefault();

                const whatsappPhoneNumberId = $("#whatsapp-phone-number-id").val();
                const contactId = $("#contact-id").val();
                const messageContent = messageInput.val().trim();

                if (!whatsappPhoneNumberId) {
                    showAlert("warning", "Debe Seleccionar un Número de teléfono.");
                    return;
                }

                if (!messageContent) {
                    showAlert("warning", "El mensaje no puede estar vacío.");
                    return;
                }

                $.ajax({
                    url: "/send-message",
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: JSON.stringify({
                        whatsapp_phone_id: whatsappPhoneNumberId,
                        contact_id: contactId,
                        message_content: messageContent,
                        tipo: "OUTPUT",
                        type: "TEXT",
                    }),
                    success: function(data) {
                        if (data.success) {
                            const messageElement = $(`
                                <div class="position-relative chat-box-right">
                                    <div>
                                        <p class="chat-text">${messageContent}</p>
                                        <p class="text-muted"><i class="ti ti-checks text-primary"></i> ${new Date().toLocaleString()}</p>
                                    </div>
                                </div>
                            `);
                            chatContainer.append(messageElement);
                            chatContainer.scrollTop(chatContainer[0]
                            .scrollHeight); // Scroll to the bottom
                            messageInput.val(""); // Clear the input
                        } else {
                            showAlert("danger", "Error al enviar el mensaje.");
                        }
                    },
                    error: function(error) {
                        console.error("Error:", error);
                        showAlert("danger", "Error al enviar el mensaje.");
                    },
                });
            });
        });



        $(document).ready(function() {
            // Seleccionamos el campo de entrada por su ID
            $('#createTemplateName').on('input', function() {
                // Obtenemos el valor actual del campo
                let inputValue = $(this).val();

                inputValue = inputValue.toLowerCase();
                inputValue = inputValue.replace(/\s+/g, '_');
                inputValue = inputValue.replace(/[^a-z0-9_]/g, '');
                $(this).val(inputValue);
            });

            // Función para mostrar/ocultar secciones según la categoría
            function toggleCategorySections() {
                // const category = $('#createTemplateCategory').val();

                // if (category === 'AUTHENTICATION') {
                //     // Mostrar bloque de autenticación y ocultar los demás
                //     $('.authentication_template').show();
                //     $('.utility_template, .marketing_template').hide();
                // } else {
                //     // Mostrar secciones de marketing/utility y ocultar autenticación
                //     $('.authentication_template').hide();
                //     $('.utility_template, .marketing_template').show();
                // }

                const category = $('#createTemplateCategory').val();
                const isAuth = category === 'AUTHENTICATION';

                // Body Text
                const $bodyText = $('#createBodyText');
                $bodyText.prop('required', !isAuth); // <- Cambio clave aquí
                $bodyText.closest('.form-group').toggle(!isAuth);

                // Footer Text
                const $footerText = $('#createFooterText');
                $footerText.prop('required', !isAuth);
                $footerText.closest('.form-group').toggle(!isAuth);

                // Mostrar/ocultar secciones
                $('.authentication_template').toggle(isAuth);
                $('.utility_template, .marketing_template').toggle(!isAuth);
            }

            // Ejecutar al cargar la página (por si hay un valor predeterminado)
            toggleCategorySections();

            // Escuchar cambios en el select de categoría
            $('#createTemplateCategory').change(function() {
                toggleCategorySections();
            });

            $('#createTemplateHeader').change(function() {
                // Ocultar todos los contenedores primero
                $('div[id^="createHeader"]').hide();

                var selected = $(this).val();

                // Si es Ninguno, no mostramos nada
                if (selected === 'ninguno') {
                    return;
                }

                // Buscar el contenedor correspondiente al tipo seleccionado
                $('#createHeader' + selected.charAt(0).toUpperCase() + selected.slice(1) + 'Group').show();
            });

            // Función para mostrar/ocultar secciones del header
            function toggleHeaderSections() {
                const headerType = $('#createTemplateHeader').val();

                // Ocultar todos los grupos primero
                $('#createHeaderTextGroup, #createHeaderImageGroup, #createHeaderVideoGroup, #createHeaderDocumentGroup').hide();

                // Mostrar solo el grupo correspondiente
                switch (headerType) {
                    case 'TEXT':
                        $('#createHeaderTextGroup').show();
                        break;
                    case 'IMAGE':
                        $('#createHeaderImageGroup').show();
                        break;
                    case 'VIDEO':
                        $('#createHeaderVideoGroup').show();
                        break;
                    case 'DOCUMENT':
                        $('#createHeaderDocumentGroup').show();
                        break;
                    // 'ninguno' y 'Ubicacion' ocultan todo
                }
            }

            // Ejecutar al cargar la página
            toggleHeaderSections();

            // Escuchar cambios en el select
            $('#createTemplateHeader').change(function() {
                toggleHeaderSections();
            });

            // Preview de imagen seleccionada
            $('#createHeaderImage').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage img').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            let variableAdded = false;
            const $headerText = $('#createHeaderText');
            const $variableFields = $('#createVariableFields');
            const $variableType = $('#createTemplateVariable');

            // Detectar escritura en el header text
            $headerText.on('input', function(e) {
                const value = $(this).val();
                const cursorPosition = this.selectionStart; // Posición del cursor

                // Buscar si el usuario escribió "{{"
                const textBeforeCursor = value.substring(0, cursorPosition);
                const hasNewVariable = textBeforeCursor.includes('{{');

                // Si se detecta "{{" y no hay variable previa
                if (hasNewVariable && !variableAdded) {
                    const variable = $variableType.val() === 'number' ? '1' : 'variable';
                    const newValue = value.replace('{{', `{{${variable}}}`); // Reemplazar solo el "{{"

                    $(this).val(newValue);
                    variableAdded = true;
                    addExampleInput(variable);

                    // Mover el cursor después de la variable
                    const newCursorPos = newValue.indexOf(`{{${variable}}}`) + `{{${variable}}}`.length;
                    this.setSelectionRange(newCursorPos, newCursorPos);
                }

                // Validar solo una variable
                const variableCount = (value.match(/\{\{.*?\}\}/g) || []).length;
                if (variableCount > 1) {
                    $(this).val(value.replace(/\{\{.*?\}\}/g, '')); // Eliminar todas las variables
                    variableAdded = false;
                    $variableFields.empty();
                }
            });

            // Generar campo de ejemplo
            function addExampleInput(variable) {
                const html = `
                    <div class="form-group mt-3 example-input">
                        <label>Ejemplo para {{${variable}}}</label>
                        <input type="text"
                            name="example_${variable}"
                            class="form-control"
                            required>
                    </div>
                `;
                $variableFields.html(html);
            }

            // Reiniciar estado si se borra la variable
            $headerText.on('keyup', function(e) {
                const value = $(this).val();
                if (!value.includes('{{')) {
                    variableAdded = false;
                    $variableFields.empty();
                }
            });

            // Actualizar variable existente si cambia el tipo
            $variableType.change(function() {
                if (variableAdded) {
                    const oldVariable = $variableType.val() === 'number' ? 'variable' : '1'; // Variable opuesta
                    const newVariable = $(this).val() === 'number' ? '1' : 'variable';

                    // Reemplazar solo la variable, mantener el texto
                    const newValue = $headerText.val().replace(`{{${oldVariable}}}`, `{{${newVariable}}}`);
                    $headerText.val(newValue);
                    addExampleInput(newVariable);
                }
            });

            const $bodyText = $('#createBodyText');
            // const $variableType = $('#createTemplateVariable');
            let currentVariables = [];
            let variableType = 'number';

            // =============================================
            // Función para contar palabras (EXCLUYENDO variables)
            // =============================================
            function countValidWords(text) {
                // Eliminar variables y contar palabras restantes
                return text.replace(/\{\{.*?\}\}/g, ' ') // Reemplazar variables por espacios
                        .trim()                         // Eliminar espacios al inicio/final
                        .split(/\s+/)                   // Dividir por espacios
                        .filter(word => word.length > 0).length; // Filtrar palabras vacías
            }

            // =============================================
            // Función de Validación (Actualizada)
            // =============================================
            function validateBody() {
                const text = $bodyText.val();
                const variablesCount = currentVariables.length;
                const wordCount = countValidWords(text); // Palabras sin variables
                const minWords = calculateMinWords(variablesCount);

                // Mostrar advertencia si no cumple
                $('#bodyWarnings').html(
                    (wordCount < minWords) ?
                    `<div class="alert alert-danger">
                        Se requieren mínimo <strong>${minWords} palabras</strong>
                        (sin contar variables). Actual: ${wordCount}
                    </div>` : ''
                );

                // Generar campos de ejemplo
                generateExampleInputs();
            }

            // =============================================
            // Resto del Código (sin cambios en otras funciones)
            // =============================================
            $bodyText.on('input', function(e) {
                const value = $(this).val();
                const cursorPos = this.selectionStart;

                if (value.slice(cursorPos - 2, cursorPos) === '{{') {
                    const newVarNumber = currentVariables.length + 1;
                    const newVar = variableType === 'number' ?
                                `{{${newVarNumber}}}` :
                                `{{variable${newVarNumber}}}`;

                    const newValue = value.slice(0, cursorPos - 2) + newVar + value.slice(cursorPos);
                    $(this).val(newValue);
                    currentVariables = detectVariables(newValue);
                    updateSequence();
                }

                currentVariables = detectVariables(value);
                updateSequence();
                validateBody();
            });

            $variableType.change(function() {
                variableType = $(this).val();
                updateVariableNames();
                validateBody();
            });

            function detectVariables(text) {
                const regex = variableType === 'number' ?
                            /\{\{(\d+)\}\}/g :
                            /\{\{(variable\d+)\}\}/g;
                return [...new Set([...text.matchAll(regex)].map(m => m[1]))]
                    .sort((a, b) => variableType === 'number' ? a - b : a.localeCompare(b));
            }

            function updateSequence() {
                const currentText = $bodyText.val();
                let newText = currentText;

                if (variableType === 'number') {
                    const varsInOrder = [...new Set(currentVariables.map(Number))].sort((a,b) => a - b);
                    varsInOrder.forEach((oldNum, index) => {
                        const newNum = index + 1;
                        if (oldNum != newNum) {
                            newText = newText.replace(new RegExp(`\\{\\{${oldNum}\\}\\}`, 'g'), `{{${newNum}}}`);
                        }
                    });
                }

                if (newText !== currentText) {
                    $bodyText.val(newText);
                    currentVariables = detectVariables(newText);
                }
            }

            function updateVariableNames() {
                let newText = $bodyText.val();
                currentVariables.forEach((oldVar, index) => {
                    const newVar = variableType === 'number' ? (index + 1) : `variable${index + 1}`;
                    newText = newText.replace(new RegExp(`\\{\\{${oldVar}\\}\\}`, 'g'), `{{${newVar}}}`);
                });
                $bodyText.val(newText);
                currentVariables = detectVariables(newText);
            }

            function calculateMinWords(varCount) {
                const requirements = {1:2, 2:5, 3:7, 4:9, 5:11};
                return varCount > 5 ? 0 : requirements[varCount] || 0;
            }

            function generateExampleInputs() {
                const html = currentVariables.map(varName => `
                    <div class="form-group">
                        <label>Ejemplo para {{${varName}}}</label>
                        <input type="text" name="example_${varName}" class="form-control" required>
                    </div>
                `).join('');
                $('#bodyExamples').html(html);
            }

            // Inicialización
            validateBody();

            const $footerText = $('#createFooterText');

            // Eliminar variables automáticamente
            $footerText.on('input', function() {
                const cleanValue = $(this).val().replace(/\{\{.*?\}\}/g, ''); // Eliminar {{cualquier_cosa}}
                $(this).val(cleanValue);
            });

            const buttonTemplates = {
                quick_replay_desactivar: {
                    max: 1,
                    html: `
                        <div class="quick_replay_buttons mb-4" data-button-type="quick_reply">
                            <label><b>Respuesta rápida - Desactivar marketing <sub>• Recomendado</sub></b></label>
                            <div class="row desactivar-marketing mb-3">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo botón</label>
                                        <select class="form-select" name="quick_replay_type[]" readonly>
                                            <option value="DESACTIVAR_MKT" selected>Desactivar marketing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label class="form-label">Texto del botón</label>
                                        <input type="text" class="form-control"
                                            value="Detener promociones"
                                            name="desactivar_text"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger delete-button icon-btn b-r-4">
                                        <i class="fa-solid fa-trash-alt"></i>
                                    </button>
                                </div>
                                <div class="alert alert-light-dark mt-2">
                                    Entiendo que es responsabilidad de dejar de enviar mensajes de marketing...
                                </div>
                            </div>
                        </div>
                    `
                },
                quick_replay_personalizado: {
                    max: 10,  // Ilimitados
                    html: `
                        <div class="quick_replay_buttons mb-4" data-button-type="quick_reply_custom">
                            <label><b>Respuesta rápida - Personalizado <sub>• Opcional</sub></b></label>
                            <div class="row boton-personalizado">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo botón</label>
                                        <select class="form-select" name="quick_replay_type[]" readonly>
                                            <option value="PERSONALIZADO" selected>Personalizado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label class="form-label">Texto del botón</label>
                                        <input type="text" class="form-control"
                                            name="personalizado_text"
                                            placeholder="Quick Reply"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger delete-button icon-btn b-r-4">
                                        <i class="fa-solid fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `
                },
                go_to_web: {
                    max: 2,
                    html: `
                        <div class="call_to_actions_bottons mb-4" data-button-type="go_to_web">
                            <label><b>Llamada a la acción - Ir a sitio web <sub>• Opcional</sub></b></label>
                            <div class="row ir-a-web">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo de acción</label>
                                        <select class="form-select" name="call_to_action_type[]">
                                            <option value="URL" selected>Ir a Web</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Texto del botón</label>
                                        <input type="text" class="form-control"
                                            name="web_button_text"
                                            placeholder="Visitar sitio"
                                            maxlength="25"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo de URL</label>
                                        <select class="form-select" name="url_type[]">
                                            <option value="static">Estática</option>
                                            <option value="dynamic">Dinámica</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">URL</label>
                                        <input type="url" class="form-control"
                                            name="web_url"
                                            placeholder="https://ejemplo.com"
                                            maxlength="2000"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger delete-button icon-btn b-r-4">
                                        <i class="fa-solid fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `
                },
                call: {
                    max: 1,
                    html: `
                        <div class="call_to_actions_bottons mb-4" data-button-type="call">
                            <label><b>Llamada a la acción - Llamar a numero de teléfono <sub>• Opcional</sub></b></label>
                            <div class="row llamar-numero-telefono">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo de acción</label>
                                        <select class="form-select" name="call_to_action_type[]">
                                            <option value="PHONE_NUMBER" selected>Llamar a teléfono</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Texto del botón</label>
                                        <input type="text" class="form-control"
                                            name="call_button_text"
                                            value="Llamar ahora"
                                            maxlength="25"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">País</label>
                                        <select class="form-select" name="country_code">
                                            <option value="+57">COL +57</option>
                                            <option value="+1">USA +1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control"
                                            name="phone_number"
                                            pattern="[0-9]{7,10}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger delete-button icon-btn b-r-4">
                                        <i class="fa-solid fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `
                },
                copy_code: {
                    max: 1,
                    html: `
                        <div class="call_to_actions_bottons mb-4" data-button-type="copy_code">
                            <label><b>Llamada a la acción - Copiar código de oferta <sub>• Opcional</sub></b></label>
                            <div class="row copiar-codigo-oferta">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo de acción</label>
                                        <select class="form-select" name="call_to_action_type[]">
                                            <option value="COPY_CODE" selected>Copiar código</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Texto del botón</label>
                                        <input type="text" class="form-control"
                                            name="copy_button_text"
                                            value="Copiar código"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Código de ejemplo</label>
                                        <input type="text" class="form-control"
                                            name="promo_code"
                                            placeholder="EJEMPLO123"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger delete-button icon-btn b-r-4">
                                        <i class="fa-solid fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `
                }
            };

            let buttonCounts = {
                quick_replay_desactivar: 0,
                quick_replay_personalizado: 0,
                go_to_web: 0,
                call: 0,
                copy_code: 0
            };

            // Manejador para agregar botones
            $('.dropdown-item').on('click', function(e) {
                e.preventDefault();
                const buttonType = $(this).data('type'); // Usar data-type

                // Validación especial para quick_replay_personalizado
                if (buttonType === 'quick_replay_personalizado') {
                    $('.create_buttons_group').append(buttonTemplates[buttonType].html);
                    buttonCounts[buttonType]++;
                    return;
                }

                // Validación para otros botones
                if (buttonCounts[buttonType] < buttonTemplates[buttonType].max) {
                    $('.create_buttons_group').append(buttonTemplates[buttonType].html);
                    buttonCounts[buttonType]++;
                    updateButtonStatus();
                } else {
                    alert(`¡Máximo ${buttonTemplates[buttonType].max} botones permitidos para este tipo!`);
                }
            });

            // Eliminar botones
            $('.create_buttons_group').on('click', '.delete-button', function() {
                const $buttonGroup = $(this).closest('.mb-4');
                const type = detectButtonType($buttonGroup);

                buttonCounts[type]--;
                $buttonGroup.remove();
                updateButtonStatus();
            });

            // Detectar tipo de botón
            function detectButtonType($element) {
                if ($element.find('option[value="DESACTIVAR_MKT"]').length > 0) return 'quick_replay_desactivar';
                if ($element.find('option[value="PERSONALIZADO"]').length > 0) return 'quick_replay_personalizado';
                if ($element.find('option[value="URL"]').length > 0) return 'go_to_web';
                if ($element.find('option[value="PHONE_NUMBER"]').length > 0) return 'call';
                if ($element.find('option[value="COPY_CODE"]').length > 0) return 'copy_code';
            }

            // Actualizar estado del dropdown
            // function updateButtonStatus() {
            //     $('.dropdown-item').each(function() {
            //         const type = $(this).data('type');
            //         if (type !== 'quick_replay_personalizado') {
            //             const max = buttonTemplates[type].max;
            //             $(this).toggleClass('disabled', buttonCounts[type] >= max);
            //         }
            //     });
            // }

            // Actualizar estado del dropdown
            function updateButtonStatus() {
                $('.dropdown-item').each(function() {
                    const type = $(this).data('type');
                    console.log(`Processing type: ${type}`);
                    if (type !== 'quick_replay_personalizado') {
                        const template = buttonTemplates[type];
                        if (template) {
                            const max = template.max;
                            $(this).toggleClass('disabled', buttonCounts[type] >= max);
                        } else {
                            console.warn(`No template found for type: ${type}`);
                        }
                    }
                });
            }

            /// Manejar cambio de tipo de URL
            $(document).on('change', 'select[name="url_type[]"]', function() {
                const $row = $(this).closest('.row.ir-a-web');
                const urlType = $(this).val();
                const $urlInput = $row.find('input[name="web_url[]"]');

                // Limpiar variables si cambia a estática
                if (urlType === 'static') {
                    $urlInput.val($urlInput.val().replace(/\{\{.*?\}\}/g, ''));
                    $row.find('.url-variable-group').remove();
                }

                // Actualizar validación
                validateUrlField($urlInput);
            });

            // Manejador para input de URL dinámica
            $(document).on('input', 'input[name="web_url[]"]', function() {
                const $input = $(this);
                const urlType = $input.closest('.row').find('select[name="url_type[]"]').val();

                if (urlType === 'dynamic') {
                    handleDynamicUrlInput($input);
                }

                validateUrlField($input);
            });

            // Función para manejar inputs dinámicos (versión corregida)
            function handleDynamicUrlInput($input) {
                const value = $input.val();
                const cursorPos = $input[0].selectionStart;
                const variableType = $('#createTemplateVariable').val();

                // Detectar si el usuario escribió {{
                if (value.slice(cursorPos - 2, cursorPos) === '{{') {
                    // Eliminar variables existentes y los 2 caracteres {{ recién escritos
                    const cleanValue = value.replace(/\{\{.*?\}\}/g, '').replace(/{{/g, '');

                    // Generar nueva variable
                    const newVar = variableType === 'number' ? `{{1}}` : `{{url}}`;

                    // Insertar variable en posición correcta
                    const newValue =
                        cleanValue.slice(0, cursorPos - 2) + // Texto antes del cursor
                        newVar +                             // Variable insertada
                        cleanValue.slice(cursorPos - 2);     // Texto después del cursor (sin los {{)

                    $input.val(newValue);

                    // Agregar campo de ejemplo si no existe
                    const $row = $input.closest('.row');
                    if (!$row.find('.url-variable-group').length) {
                        $row.find('.col-md-3:has(input[name="web_url[]"])').after(`
                            <div class="col-md-3 url-variable-group">
                                <div class="mb-3">
                                    <label class="form-label">Ejemplo para ${newVar}</label>
                                    <input type="text" class="form-control"
                                        name="url_variable_example[]"
                                        placeholder="valor-ejemplo"
                                        required>
                                </div>
                            </div>
                        `);
                    }

                    // Posicionar cursor después de la variable
                    setTimeout(() => {
                        const newPos = newValue.indexOf(newVar) + newVar.length;
                        $input[0].setSelectionRange(newPos, newPos);
                    }, 0);
                }

                // Eliminar variables extras si se escriben manualmente
                const variableCount = (value.match(/\{\{.*?\}\}/g) || []).length;
                if (variableCount > 1) {
                    $input.val(value.replace(/\{\{.*?\}\}/g, '').replace('{{', '{{'));
                }
            }

            // Función de validación de URL
            function validateUrlField($input) {
                const url = $input.val();
                const urlType = $input.closest('.row').find('select[name="url_type[]"]').val();
                let isValid = true;

                // Expresión regular para URL con posible variable
                const urlPattern = /^(https?:\/\/)?([\w-]+(\.[\w-]+)+\/?)|([\w-]+(\.[\w-]+)*(\{\{.*?\}\})[\w-]*)*(\/[\w-]*)*(\?.*)?$/;

                if (urlType === 'static') {
                    // Validación URL estándar
                    isValid = /^(https?:\/\/)?([\w-]+(\.[\w-]+)+)(\/[\w-]*)*(\?.*)?$/.test(url);
                } else {
                    // Validación con variable
                    isValid = urlPattern.test(url) && (url.match(/\{\{.*?\}\}/g) || []).length <= 1;
                }

                // Actualizar estilos visuales
                $input.toggleClass('is-valid', isValid);
                $input.toggleClass('is-invalid', !isValid);

                return isValid;
            }

            // Sincronizar tipo de variable global
            $('#createTemplateVariable').change(function() {
                $('select[name="url_type[]"]').each(function() {
                    if ($(this).val() === 'dynamic') {
                        const $input = $(this).closest('.row').find('input[name="web_url[]"]');
                        const currentVar = $input.val().match(/\{\{.*?\}\}/);
                        const newVar = $(this).val() === 'number' ? '{{1}}' : '{{url}}';

                        if (currentVar) {
                            $input.val($input.val().replace(currentVar[0], newVar));
                            $(this).closest('.row').find('.url-variable-group label')
                                .text(`Ejemplo para ${newVar}`);
                        }
                    }
                });
            });

            // Validar antes de enviar el formulario
            // $('#createTemplateForm').on('submit', function(e) {
            //     let allValid = true;

            //     $('input[name="web_url[]"]').each(function() {
            //         if (!validateUrlField($(this))) {
            //             allValid = false;
            //         }
            //     });

            //     if (!allValid) {
            //         e.preventDefault();
            //         alert('¡Por favor corrige las URLs inválidas!');
            //     }
            // });

            async function submitCreateTemplateForm(event) {
                event.preventDefault();

                // 1. Declarar e inicializar templateData PRIMERO
                const templateData = {
                    name: $('#createTemplateName').val(),
                    language: $('#createTemplateLanguage').val(),
                    category: $('#createTemplateCategory').val(),
                    components: [] // Inicializar como array vacío
                };

                const formData = new FormData();

                console.log(templateData);

                if (templateData.category !== 'AUTHENTICATION' && !$('#createBodyText').val()) {
                    showAlert('error', 'El texto del cuerpo es requerido');
                    return;
                }

                if($('#createTemplateHeader').val() === 'IMAGE' || $('#createTemplateHeader').val() === 'VIDEO' || $('#createTemplateHeader').val() === 'DOCUMENT'){
                    const headerTypeFile = $('#createTemplateHeader').val();
                    const fileInputForm = document.getElementById(`createHeader${headerTypeFile}`);
                    const file = fileInputForm.files[0];
                    formData.append('file', file); // Adjuntar el archivo al FormData
                    formData.append('type', file.type);
                }

                if (templateData.category === 'AUTHENTICATION') {
                    console.log('AUTHENTICATION');
                    if (!$('#autocompletar_sin_toque_condiciones').is(':checked')) {
                        showAlert('error', 'Debes aceptar los términos de autocompletado sin toque');
                        alert("Debes aceptar los términos de autocompletado sin toque");
                        return;
                    }

                    if ($('#caducidad_codigo').is(':checked') && !$('#minutos_caducidad').val()) {
                        showAlert('error', 'Debes especificar minutos de caducidad');
                        alert("Debes especificar minutos de caducidad");
                        return;
                    }

                    // Validar que el código de ejemplo tenga formato correcto
                    const codePattern = /^[A-Z0-9]{6,8}$/;
                    if (!codePattern.test($('#createCopyCodeButton').val())) {
                        showAlert('error', 'El código debe tener 6-8 caracteres alfanuméricos en mayúsculas');
                        alert("El código debe tener 6-8 caracteres alfanuméricos en mayúsculas");
                        return;
                    }

                    // const authComponents = {
                    //     type: "AUTHENTICATION",
                    //     securityRecommendation: $('#recomenracion_seguridad').is(':checked'),
                    //     codeExpirationMinutes: $('#minutos_caducidad').val() || null,
                    //     otpType: $('input[name="config_send_code"]:checked').val(),
                    //     copyButtonText: $('#createCopyCodeButton').val()
                    // };

                    // console.log(authComponents);

                    // templateData.components = [authComponents]; // Reemplazar otros componentes

                    // Agregar componente BODY
                    templateData.components.push({
                        type: "BODY",
                        add_security_recommendation: $('#recomenracion_seguridad').is(':checked')
                    });

                    // Agregar componente FOOTER
                    templateData.components.push({
                        type: "FOOTER",
                        code_expiration_minutes: $('#minutos_caducidad').val() || 10 // Valor por defecto
                    });

                    // Agregar componente BUTTONS
                    templateData.components.push({
                        type: "BUTTONS",
                        buttons: [
                            {
                                type: "OTP",
                                otp_type: $('input[name="config_send_code"]:checked').val()
                            }
                        ]
                    });
                } else {
                    // 2. Manejar componentes HEADER
                    const headerType = $('#createTemplateHeader').val();
                    if (headerType !== 'ninguno') {
                        const headerComponent = {
                            type: "HEADER",
                            format: headerType
                        };

                        if (headerType === 'TEXT') {
                            const headerText = $('#createHeaderText').val();
                            headerComponent.text = headerText;

                            // Capturar ejemplo de variable del header
                            const headerExample = $('#createVariableFields input').val(); // Selector específico
                            if (headerExample) {
                                headerComponent.example = {
                                    header_text: [headerExample] // Array según requerimiento de API
                                };
                            }
                        } else if (headerType === 'IMAGE' || headerType === 'VIDEO' || headerType === 'DOCUMENT') {
                            const headerFileInput = document.getElementById(`createHeader${headerType}`);
                            if (headerFileInput.files.length > 0) {
                                const file = headerFileInput.files[0];
                                const uploadResponse = await uploadMedia(file);

                                if (uploadResponse.success) {
                                    headerComponent.example = {
                                        header_handle: uploadResponse.handle
                                    };
                                } else {
                                    alert("No file selected");
                                    return;
                                }
                            }
                        } else if (headerType === 'LOCATION') {
                            // No necesita parámetros adicionales
                        }

                        templateData.components.push(headerComponent);
                    }

                    // 3. Componente BODY
                    const bodyText = $('#createBodyText').val();
                    if (bodyText) {
                        const bodyComponent = {
                            type: "BODY",
                            text: bodyText
                        };

                        // Capturar ejemplos en el formato correcto
                        const exampleInputs = $('#bodyExamples').find('input').toArray();
                        const examples = exampleInputs.map(input => $(input).val().trim()).filter(Boolean);

                        if (examples.length > 0) {
                            const variableCount = (bodyText.match(/\{\{.*?\}\}/g) || []).length;

                            if (examples.length !== variableCount) {
                                showAlert('error', `Número de ejemplos (${examples.length}) no coincide con variables (${variableCount})`);
                                return;
                            }

                            bodyComponent.example = {
                                body_text: examples // Array con ejemplos
                            };
                        }

                        templateData.components.push(bodyComponent);
                    }

                    // 4. Componente FOOTER
                    const footerText = $('#createFooterText').val();
                    if (footerText) {
                        templateData.components.push({
                            type: "FOOTER",
                            text: footerText
                        });
                    }

                    // 5. Componente BUTTONS
                    const buttons = [];
                    $('.create_buttons_group > div').each(function() {
                        const buttonType = $(this).data('button-type');
                        let buttonData;

                        switch(buttonType) {
                            case 'quick_reply':
                                const quickReplyText = $(this).find('input[name="desactivar_text"]').val();
                                console.log('Quick Reply Text:', quickReplyText); // Depuración
                                buttonData = {
                                    type: "QUICK_REPLY",
                                    text: quickReplyText
                                };
                                break;

                            case 'quick_reply_custom':
                                const quickReplyCustonText = $(this).find('input[name="personalizado_text"]').val();
                                console.log('Quick Reply Text:', quickReplyCustonText); // Depuración
                                buttonData = {
                                    type: "QUICK_REPLY",
                                    text: quickReplyCustonText
                                };
                                break;

                            case 'go_to_web':
                                const urlData = {
                                    type: "URL",
                                    text: $(this).find('input[name="web_button_text"]').val(),
                                    url: $(this).find('input[name="web_url"]').val()
                                };

                                // Capturar ejemplo de variable en URL
                                const urlExample = $(this).closest('.row').find('.url-variable-group input').val();
                                if (urlExample) {
                                    urlData.example = [urlExample];
                                }

                                buttonData = urlData;
                                break;

                            case 'call':
                                buttonData = {
                                    type: "PHONE_NUMBER",
                                    text: $(this).find('input[name="call_button_text"]').val(),
                                    phone_number: $(this).find('select[name="country_code"]').val() + $(this).find('input[name="phone_number"]').val()
                                };
                                break;

                            case 'copy_code':
                                buttonData = {
                                    type: "COPY_CODE",
                                    example: $(this).find('input[name="promo_code"]').val()
                                };
                                break;
                        }

                        if (buttonData) buttons.push(buttonData);
                    });

                    if (buttons.length > 0) {
                        templateData.components.push({
                            type: "BUTTONS",
                            buttons: buttons
                        });
                    }
                }


                // 7. Validaciones finales
                if (!validateTemplate(templateData)) {
                    showAlert('error', 'Por favor completa todos los campos requeridos');
                    return;
                }

                formData.append('jsonBody', JSON.stringify(templateData));
                formData.append('whatsapp_account_id', $('#whatsapp_business_account_id').val());


                // 8. Enviar al backend
                try {
                    const response = await fetch('/template-create', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    const result = await response.json();
                    handleApiResponse(result);

                } catch (error) {
                    console.error('Error:', error);
                    showAlert('error', 'Error al crear la plantilla. Por favor, inténtelo de nuevo.');
                }
            }

            // Funciones auxiliares
            // async function uploadMedia(file) {
            //     const formData = new FormData();
            //     formData.append('file', file);
            //     formData.append('wa_account_id', '462194216974157');

            //     const response = await fetch('/media/upload', {
            //         method: 'POST',
            //         headers: {
            //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            //         },
            //         body: formData
            //     });

            //     return response.json();
            // }
            async function uploadMedia(file) {
                const validTypes = {
                    'image/jpeg': 'IMAGE',
                    'image/png': 'IMAGE',
                    'video/mp4': 'VIDEO',
                    'application/pdf': 'DOCUMENT'
                };

                if (!validTypes[file.type]) {
                    throw new Error('Tipo de archivo no soportado');
                }

                const formData = new FormData();
                formData.append('file', file);
                formData.append('type', validTypes[file.type]);
                formData.append('wa_account_id', '462194216974157');

                try {
                    const response = await fetch('/media/upload', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    if (!response.ok) throw new Error('Error en servidor');

                    return await response.json();
                } catch (error) {
                    console.error('Upload error:', error);
                    showAlert('error', 'Error subiendo archivo: ' + error.message);
                    throw error;
                }
            }

            // function validateTemplate(template) {
            //     // Validar requerimientos mínimos de WhatsApp
            //     if (!template.name || !template.language || !template.category) return false;
            //     if (template.components.length === 0) return false;

            //     // Validar límites de caracteres
            //     if (template.name.length > 512) return false;

            //     return true;
            // }

            function validateTemplate(template) {
                // Validar campos requeridos
                if (!template.name || !template.language || !template.category) return false;

                // Validar componentes
                if (template.components.length === 0) return false;

                // Validar ejemplos donde sean requeridos
                template.components.forEach(component => {
                    if (component.type === "BODY" && component.example) {
                        // if (component.example.body_text[0].length !== (component.text.match(/\{\{.*?\}\}/g) || []).length) {
                        //     alert("Componente: " + component.example.body_text[0].length + "Componente Text: " + (component.text.match(/\{\{.*?\}\}/g) || []).length)
                        //     throw new Error('Número de ejemplos no coincide con variables en body');
                        // }
                    }

                    if (component.type === "HEADER" && component.format === "TEXT" && component.example) {
                        if (component.example.header_text.length !== (component.text.match(/\{\{.*?\}\}/g) || []).length) {
                            throw new Error('Número de ejemplos no coincide con variables en header');
                        }
                    }
                });

                return true;
            }

            function handleApiResponse(response) {
                if (response.success) {
                    showAlert('success', 'Plantilla creada exitosamente');
                    closeModal('modal_create_template');
                    $('body').removeClass('modal-open').css('padding-right', '');
                } else {
                    showAlert('error', response.error || 'Error desconocido');
                }
            }

            // Attach submit event to the form
            document.getElementById('createTemplateForm').addEventListener('submit', submitCreateTemplateForm);

        });
    </script>
    @endverbatim
@stop
