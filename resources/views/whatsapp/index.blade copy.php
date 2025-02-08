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
<style>
    .message-content {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px; /* Ajusta el ancho según tus necesidades */
        display: inline-block;
        vertical-align: middle;
    }


    /* .plantillas {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 10px;
    } */

    .plantilla-card {
        /* background-color: #ffffff; */
        background: #3987192e;
        margin-bottom: 10px;
        border-radius: 10px;
        padding: 15px;
        width: 300px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        color: #333;
        /* flex: 1 1 calc(33% - 10px);
        min-width: 250px;
        box-sizing: border-box; */
    }

    .plantilla-card-header {
        background: ##00805d !important;
        color: white;
        width: 100%;
    }

    .plantilla-card-content {
        width: 100%;
    }

    .plantilla-title {
        background-color: green;
        color: white;
    }

    .plantilla-header {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .plantilla-header span {
        overflow-wrap: break-word;
        text-align: initial;
    }

    .plantilla-body {
        font-size: 14px;
        line-height: 1.6;
    }

    .plantilla-body span {
        overflow-wrap: break-word;
        text-align: initial;
    }

    .plantilla-footer {
        margin-top: 10px;
        font-size: 12px;
        color: #777;
    }

    .plantilla-time {
        font-size: 12px;
        color: #999;
        text-align: right;
        margin-top: 10px;
    }

    .plantilla-button {
        background-color: #25d366;
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }

    .plantilla-button a {
        color: white;
        cursor: pointer;
        text-decoration: none;
    }

    .plantilla-button:hover {
        background-color: #1eb954;
    }

    .wb-template {
        /* width: 250px; */
        /* background: beige; */
        /* padding: 20px; */
    }
</style>
@stop

@section('modals')
    <!-- modal-1-start -->
    <div class="modal fade" id="modal_edit_template" tabindex="-1" aria-labelledby="modal_edit_template"
        aria-hidden="true">
        <div class="modal-dialog app_modal_md">
            <div class="modal-content">
                <div class="modal-header bg-primary-800">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalDefault13">Edit Template</h1>
                    <button type="button" class="fs-5 border-0  bg-none text-white" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-xmark fs-3"></i></button>
                </div>
                <form id="editTemplateForm">
                    <div class="modal-body ">
                        <div class="row">
                            <div class="col-lg-12 ps-4">
                                <!-- Formulario de edición de la plantilla -->
                                <!-- Nombre de la Plantilla -->
                                <div class="form-group mb-3">
                                    <label for="editTemplateName">Nombre de la Plantilla</label>
                                    <input type="text" id="editTemplateName" name="editTemplateName" class="form-control"
                                        maxlength="512" readonly>
                                    <input type="hidden" id="editTemplateId" name="editTemplateId">
                                    <input type="hidden" id="editTemplateWabaId" name="editTemplateWabaId">
                                    <input type="hidden" id="editCategory" name="editCategory">
                                </div>

                                <!-- Idioma de la Plantilla -->
                                <div class="form-group mb-3">
                                    <label for="editTemplateLanguage">Idioma de la Plantilla</label>
                                    <select class="form-control" name="editTemplateLanguage" id="editTemplateLanguage">
                                        <option value="af">Afrikáans "af"</option>
                                        <option value="sq">Albanés "sq"</option>
                                        <option value="ar">Árabe "ar"</option>
                                        <option value="az">Azerí "az"</option>
                                        <option value="bn">Bengalí "bn"</option>
                                        <option value="bg">Búlgaro "bg"</option>
                                        <option value="ca">Catalán "ca"</option>
                                        <option value="zh_CN">Chino (China) "zh_CN"</option>
                                        <option value="zh_HK">Chino (Hong Kong) "zh_HK"</option>
                                        <option value="zh_TW">Chino (Tailandia) "zh_TW"</option>
                                        <option value="hr">Croata "hr"</option>
                                        <option value="cs">Checo "cs"</option>
                                        <option value="da">Danés "da"</option>
                                        <option value="nl">Holandés "nl"</option>
                                        <option value="en">Inglés "en"</option>
                                        <option value="en_GB">Inglés (Reino Unido) "en_GB"</option>
                                        <option value="en_US">Inglés (EE. UU.) "en_US"</option>
                                        <option value="es_LA">Español (Latinoamérica) "es_LA"</option>
                                        <option value="et">Estonio "et"</option>
                                        <option value="fil">Filipino "fil"</option>
                                        <option value="fi">Finlandés "fi"</option>
                                        <option value="fr">Francés "fr"</option>
                                        <option value="de">Alemán "de"</option>
                                        <option value="el">Griego "el"</option>
                                        <option value="gu">Guyaratí "gu"</option>
                                        <option value="he">Hebreo "he"</option>
                                        <option value="hi">Hindi "hi"</option>
                                        <option value="hu">Húngaro "hu"</option>
                                        <option value="id">Indonesio "id"</option>
                                        <option value="ga">Irlandés "ga"</option>
                                        <option value="it">Italiano "it"</option>
                                        <option value="ja">Japonés "ja"</option>
                                        <option value="kn">Canarés "kn"</option>
                                        <option value="kk">Kazajo "kk"</option>
                                        <option value="ko">Coreano "ko"</option>
                                        <option value="lo">Lao "lo"</option>
                                        <option value="lv">Letón "lv"</option>
                                        <option value="lt">Lituano "lt"</option>
                                        <option value="mk">Macedonio "mk"</option>
                                        <option value="ms">Malayo "ms"</option>
                                        <option value="mr">Maratí "mr"</option>
                                        <option value="nb">Noruego "nb"</option>
                                        <option value="fa">Persa "fa"</option>
                                        <option value="pl">Polaco "pl"</option>
                                        <option value="pt_BR">Portugués (Brasil) "pt_BR"</option>
                                        <option value="pt_PT">Portugués (Portugal) "pt_PT"</option>
                                        <option value="pa">Punyabí "pa"</option>
                                        <option value="ro">Rumano "ro"</option>
                                        <option value="ru">Ruso "ru"</option>
                                        <option value="sr">Serbio "sr"</option>
                                        <option value="sk">Eslovaco "sk"</option>
                                        <option value="sl">Esloveno "sl"</option>
                                        <option value="es">Español "es"</option>
                                        <option value="es_AR">Español (Argentina) "es_AR"</option>
                                        <option value="es_ES">Español (España) "es_ES"</option>
                                        <option value="es_MX" selected>Español (México) "es_MX"</option>
                                        <option value="sw">Suajili "sw"</option>
                                        <option value="sv">Sueco "sv"</option>
                                        <option value="ta">Tamil "ta"</option>
                                        <option value="te">Telugu "te"</option>
                                        <option value="th">Tailandés "th"</option>
                                        <option value="tr">Turco "tr"</option>
                                        <option value="uk">Ucraniano "uk"</option>
                                        <option value="ur">Urdu "ur"</option>
                                        <option value="uz">Uzbeko "uz"</option>
                                        <option value="vi">Vietnamita "vi"</option>
                                    </select>
                                </div>

                                <!-- Variable de la Plantilla -->
                                <div class="form-group mb-3">
                                    <label for="editTemplateVariable">Variables de la plantilla</label>
                                    <select class="form-control" name="editTemplateVariable" id="editTemplateVariable">
                                        <option value="number">Numero</option>
                                        <option value="name">Nombre</option>
                                    </select>
                                </div>

                                <!-- Encabezado de la Plantilla -->
                                <div class="form-group mb-3">
                                    <label for="editTemplateHeader">Encabezado de la plantilla</label>
                                    <select class="form-control" name="editTemplateHeader" id="editTemplateHeader">
                                        <option value="ninguno">Ninguno</option>
                                        <option value="TEXT">Mensaje de Texto</option>
                                        <option value="IMAGE">Imagen</option>
                                        <option value="VIDEO">Video</option>
                                        <option value="DOCUMENT">Documento</option>
                                        <option value="Ubicacion">Ubicacion</option>
                                    </select>
                                </div>

                                <!-- Header Text -->
                                <div class="form-group mb-3" id="headerTextGroup">
                                    <label for="editHeaderText">Texto del Header</label>
                                    <input type="text" id="editHeaderText" name="editHeaderText" class="form-control variable variable-1"
                                        maxlength="60">
                                    <small class="form-text text-muted">Texto que aparecerá en el encabezado de la plantilla
                                        (opcional).</small>
                                    <div id="variableFields"></div>
                                </div>

                                <div class="row" id="headerImageGroup">
                                    <!-- Header Image -->
                                    <div class="col-6">
                                        <div class="form-group mb-3" >
                                            <label for="editHeaderImage">Imagen del Header</label>
                                            <input type="file" id="editHeaderImage" name="editHeaderImage" class="form-control"
                                                accept="image/*">
                                            <small class="form-text text-muted">Imagen que aparecerá en el encabezado de la plantilla
                                                (opcional).</small>
                                        </div>
                                    </div>
                                    <div class="col-6" id="previewImage">
                                        <img src="" alt="" class="preview" style="width: 50%">
                                    </div>
                                </div>


                                <!-- Header Video -->
                                <div class="form-group mb-3" id="headerVideoGroup">
                                    <label for="editHeaderVideo">Video del Header</label>
                                    <input type="file" id="editHeaderVideo" name="editHeaderVideo" class="form-control"
                                        accept="video/*">
                                    <small class="form-text text-muted">Video que aparecerá en el encabezado de la plantilla
                                        (opcional).</small>
                                </div>

                                <!-- Header Document -->
                                <div class="form-group mb-3" id="headerDocumentGroup">
                                    <label for="editHeaderDocument">Documento del Header</label>
                                    <input type="file" id="editHeaderDocument" name="editHeaderDocument" class="form-control"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx">
                                    <small class="form-text text-muted">Documento que aparecerá en el encabezado de la plantilla
                                        (opcional).</small>
                                </div>

                                <!-- Body -->
                                <div class="form-group mb-3">
                                    <label for="editBodyText">Texto del Body</label>
                                    <textarea id="editBodyText" name="editBodyText" class="form-control variable variable-10" rows="4" maxlength="1024" required></textarea>
                                    <small class="form-text text-muted">Texto principal del mensaje. Puedes incluir variables
                                        usando
                                        @{{ 1 }}, @{{ 2 }}, @{{ order_id }},
                                        @{{ mount }} etc.</small>
                                </div>

                                <!-- Footer -->
                                <div class="form-group mb-3">
                                    <label for="editFooterText">Texto del Footer</label>
                                    <input type="text" id="editFooterText" name="editFooterText" class="form-control variable variable-0"
                                        maxlength="60">
                                    <small class="form-text text-muted">Texto de pie de página (opcional).</small>
                                </div>

                                <!-- Botones -->
                                <div id="buttonsContainer">
                                    <label>Botones</label>
                                    <div class="form-group mb-3">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">+ Agregar Boton</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                                <p><b>Botones de respuesta rápida</b></p>
                                                <a class="dropdown-item" id="quick_replay_button" href="#">Desactivar
                                                    marketing <sub>Recomendado</sub></a>
                                                <a class="dropdown-item" id="quick_replay_custon_button"
                                                    href="#">Personalizado</a>
                                                <div class="dropdown-divider"></div>
                                                <p><b>Botones de llamada a la acción</b></p>
                                                <a class="dropdown-item" id="go_to_web_button" href="#">Ir a sitio web
                                                    <sub>2 botones
                                                        maximo</sub></a>
                                                <a class="dropdown-item" id="call_button" href="#">Llamar a numero de
                                                    telefono <sub>1
                                                        boton como maximo</sub></a>
                                                <a class="dropdown-item" id="copy_code_button" href="#">Copiar codigo de
                                                    oferta <sub>1 boton
                                                        como maximo</sub></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="buttons_group">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-light-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal-1-end -->

    <!-- modal-1-start -->
    <div class="modal fade" id="modal_detail_template" tabindex="-1" aria-labelledby="modal_detail_template"
        aria-hidden="true">
        <div class="modal-dialog app_modal_md">
            <div class="modal-content">
                <div class="modal-header bg-success-800">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalDefault13">View Template</h1>
                    <button type="button" class="fs-5 border-0  bg-none text-white" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-xmark fs-3"></i></button>
                </div>
                <div class="modal-body" id="modal_detail_template_body">
                    ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- modal-1-end -->

    <!-- modal-1-start -->
    <div class="modal fade" id="modal_send_template" tabindex="-1" aria-labelledby="modal_send_template"
        aria-hidden="true">
        <div class="modal-dialog app_modal_md">
            <div class="modal-content">
                <div class="modal-header bg-warning-800">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalDefault13">Send Template</h1>
                    <button type="button" class="fs-5 border-0  bg-none text-white" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-xmark fs-3"></i></button>
                </div>
                <form id="send_template_form">
                    @csrf
                    <input type="hidden" name="send_template_id" id="send_template_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12" id="detail_template_body"></div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="sendTemplateForm"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal-1-end -->

    <!-- modal-1-start -->
    <div class="modal fade" id="modal_delete_template" tabindex="-1" aria-labelledby="modal_send_template"
        aria-hidden="true">
        <div class="modal-dialog app_modal_md">
            <div class="modal-content">
                <div class="modal-header bg-danger-800">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalDefault13">Delete Template</h1>
                    <button type="button" class="fs-5 border-0  bg-none text-white" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-xmark fs-3"></i></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal-1-end -->

    <!-- modal-1-start -->
    <div class="modal fade" id="modal_create_template" tabindex="-1" aria-labelledby="modal_create_template"
        aria-hidden="true">
        <div class="modal-dialog app_modal_md">
            <div class="modal-content">
                <div class="modal-header bg-danger-800">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalDefault13">Create New Template</h1>
                    <button type="button" class="fs-5 border-0  bg-none text-white" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-xmark fs-3"></i></button>
                </div>
                <form id="createTemplateForm">
                    <div class="modal-body">
                        <!-- Formulario de edición de la plantilla -->
                        <div class="form-group mb-3 all_templates">
                            <!-- Nombre de la Plantilla -->
                            <div class="form-group mb-3">
                                <label for="createTemplateName">Nombre de la Plantilla</label>
                                <input type="text" id="createTemplateName" name="createTemplateName" class="form-control"
                                    maxlength="512">
                            </div>

                            <!-- Categoria de la Plantilla -->
                            <div class="form-group mb-3">
                                <label for="createTemplateCategory">Categoria de la plantilla</label>
                                <select class="form-control" name="createTemplateCategory" id="createTemplateCategory">
                                    <option value="MARKETING">MARKETING</option>
                                    <option value="UTILITY">UTILITY</option>
                                    <option value="AUTHENTICATION">AUTHENTICATION</option>
                                </select>
                            </div>

                            <!-- Idioma de la Plantilla -->
                            <div class="form-group mb-3">
                                <label for="createTemplateLanguage">Idioma de la Plantilla</label>
                                <select class="form-control" name="createTemplateLanguage" id="createTemplateLanguage">
                                    <option value="af">Afrikáans "af"</option>
                                    <option value="sq">Albanés "sq"</option>
                                    <option value="ar">Árabe "ar"</option>
                                    <option value="az">Azerí "az"</option>
                                    <option value="bn">Bengalí "bn"</option>
                                    <option value="bg">Búlgaro "bg"</option>
                                    <option value="ca">Catalán "ca"</option>
                                    <option value="zh_CN">Chino (China) "zh_CN"</option>
                                    <option value="zh_HK">Chino (Hong Kong) "zh_HK"</option>
                                    <option value="zh_TW">Chino (Tailandia) "zh_TW"</option>
                                    <option value="hr">Croata "hr"</option>
                                    <option value="cs">Checo "cs"</option>
                                    <option value="da">Danés "da"</option>
                                    <option value="nl">Holandés "nl"</option>
                                    <option value="en">Inglés "en"</option>
                                    <option value="en_GB">Inglés (Reino Unido) "en_GB"</option>
                                    <option value="en_US">Inglés (EE. UU.) "en_US"</option>
                                    <option value="es_LA">Español (Latinoamérica) "es_LA"</option>
                                    <option value="et">Estonio "et"</option>
                                    <option value="fil">Filipino "fil"</option>
                                    <option value="fi">Finlandés "fi"</option>
                                    <option value="fr">Francés "fr"</option>
                                    <option value="de">Alemán "de"</option>
                                    <option value="el">Griego "el"</option>
                                    <option value="gu">Guyaratí "gu"</option>
                                    <option value="he">Hebreo "he"</option>
                                    <option value="hi">Hindi "hi"</option>
                                    <option value="hu">Húngaro "hu"</option>
                                    <option value="id">Indonesio "id"</option>
                                    <option value="ga">Irlandés "ga"</option>
                                    <option value="it">Italiano "it"</option>
                                    <option value="ja">Japonés "ja"</option>
                                    <option value="kn">Canarés "kn"</option>
                                    <option value="kk">Kazajo "kk"</option>
                                    <option value="ko">Coreano "ko"</option>
                                    <option value="lo">Lao "lo"</option>
                                    <option value="lv">Letón "lv"</option>
                                    <option value="lt">Lituano "lt"</option>
                                    <option value="mk">Macedonio "mk"</option>
                                    <option value="ms">Malayo "ms"</option>
                                    <option value="mr">Maratí "mr"</option>
                                    <option value="nb">Noruego "nb"</option>
                                    <option value="fa">Persa "fa"</option>
                                    <option value="pl">Polaco "pl"</option>
                                    <option value="pt_BR">Portugués (Brasil) "pt_BR"</option>
                                    <option value="pt_PT">Portugués (Portugal) "pt_PT"</option>
                                    <option value="pa">Punyabí "pa"</option>
                                    <option value="ro">Rumano "ro"</option>
                                    <option value="ru">Ruso "ru"</option>
                                    <option value="sr">Serbio "sr"</option>
                                    <option value="sk">Eslovaco "sk"</option>
                                    <option value="sl">Esloveno "sl"</option>
                                    <option value="es">Español "es"</option>
                                    <option value="es_AR">Español (Argentina) "es_AR"</option>
                                    <option value="es_ES">Español (España) "es_ES"</option>
                                    <option value="es_MX">Español (México) "es_MX"</option>
                                    <option value="sw">Suajili "sw"</option>
                                    <option value="sv">Sueco "sv"</option>
                                    <option value="ta">Tamil "ta"</option>
                                    <option value="te">Telugu "te"</option>
                                    <option value="th">Tailandés "th"</option>
                                    <option value="tr">Turco "tr"</option>
                                    <option value="uk">Ucraniano "uk"</option>
                                    <option value="ur">Urdu "ur"</option>
                                    <option value="uz">Uzbeko "uz"</option>
                                    <option value="vi">Vietnamita "vi"</option>
                                </select>
                            </div>

                            <!-- Variable de la Plantilla -->
                            <div class="form-group mb-3">
                                <label for="createTemplateVariable">Variables de la plantilla</label>
                                <select class="form-control" name="createTemplateVariable" id="createTemplateVariable">
                                    <option value="number">Numero</option>
                                    <option value="name">Nombre</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group mb-3 authentication_template">
                            <div class="form-group mb-3">
                                <p><b>Codigo de Acceso de un solo uso</b></p>
                                <p>Envia codigo para verificar una transaccion o un inicio de sesion.</p>
                            </div>

                            <div class="form-group mb-3">
                                <label for="createCodeExpiration"><b>Configuración del envío de códigos</b></label>
                                <p>Elige cómo enviarán los clientes el código de WhatsApp a tu app. Las modificaciones de
                                    esta sección no requerirán revisión ni tendrán límites de edición. Obtén información
                                    sobre cómo enviar plantillas de mensajes de autenticación.</p>
                                <div class="custom-control custom-radio mb-3">
                                    <input class="custom-control-input" type="radio" id="autocompletar_sin_toque"
                                        name="config_send_code" value="sin_toque" checked="">
                                    <label for="autocompletar_sin_toque" class="custom-control-label">Autocompletar sin
                                        toque</label>
                                </div>

                                <div class="custom-control custom-checkbox" style="margin-left: 50px;">
                                    <input
                                        class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                        type="checkbox" id="autocompletar_sin_toque_condiciones"
                                        name="autocompletar_sin_toque_condiciones" checked>
                                    <label for="autocompletar_sin_toque_condiciones" class="custom-control-label">Al
                                        seleccionar la opción sin toque, entiendo que el uso de la autenticación sin toque
                                        por parte de Script Ateención al cliente está sujeto a las Condiciones del servicio
                                        de WhatsApp Business. Es responsabilidad de Script Ateención al cliente asegurarse
                                        de que los clientes prevean que el código se completará automáticamente si eligen
                                        recibir el código sin toque a través de WhatsApp.</label>
                                    <div class="alert alert-warning alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Nota!</h5>
                                        Es necesario marcar la casilla para enviar esta plantilla.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="autocompletar_con_toque"
                                        name="config_send_code" value="con_toque">
                                    <label for="autocompletar_con_toque" class="custom-control-label">Autocompletar con un
                                        toque</label>
                                    <p>El código se envía a tu app cuando un cliente toca el botón. Cuando no sea posible
                                        autocompletar, se enviará un mensaje para copiar el código.</p>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="copiar_codigo"
                                        name="config_send_code" value="copiar_codigo">
                                    <label for="copiar_codigo" class="custom-control-label">Copiar código</label>
                                    <p>El contenido de las plantillas de mensajes de autenticación no se puede editar.
                                        Puedes agregar contenido adicional de las siguientes opciones.</p>
                                </div>

                                <div class="custom-control custom-checkbox" style="margin-left: 50px;">
                                    <input
                                        class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                        type="checkbox" id="recomenracion_seguridad" name="recomenracion_seguridad"
                                        checked="checked">
                                    <label for="recomenracion_seguridad" class="custom-control-label">Agregar
                                        recomendación de seguridad.</label>
                                </div>
                                <div class="custom-control custom-checkbox" style="margin-left: 50px;">
                                    <input
                                        class="custom-control-input custom-control-input-danger custom-control-input-outline"
                                        type="checkbox" id="caducidad_codigo" name="caducidad_codigo">
                                    <label for="caducidad_codigo" class="custom-control-label">Agrega la fecha de
                                        caducidad para el código.</label>
                                </div>
                                <div class="" style="margin-left: 50px;">
                                    <label for="minutos_caducidad" class="">Minutos_caducidad</label>
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" class="form-control" id="minutos_caducidad"
                                            name="minutos_caducidad" value="1" max="90" min="1">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat">Minutos</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <p><b>Botones</b></p>
                                <p>Puedes personalizar el texto del botón para las opciones de autocompletar y de copiar
                                    código. Aunque la opción sin toque esté activada, los botones se necesitan para el
                                    método de entrega del código de respaldo.</p>
                            </div>

                            <div class="row form-group mb-3" id="createAutocompleteButtonGroup">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Autocompletar
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="createAutocompleteButton"
                                            name="createAutocompleteButton" value="Autocompletar">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6" id="createCopyCodeButtonGroup">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                Copiar codigo
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="createCopyCodeButton"
                                            name="createCopyCodeButton" value="Copiar codigo">
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                        </div>

                        <div class="utility_template marketing_template">
                            <!-- Encabezado de la Plantilla -->
                            <div class="form-group mb-3">
                                <label for="createTemplateHeader">Encabezado de la plantilla</label>
                                <select class="form-control" name="createTemplateHeader" id="createTemplateHeader">
                                    <option value="ninguno">Ninguno</option>
                                    <option value="TEXT">Mensaje de Texto</option>
                                    <option value="IMAGE">Imagen</option>
                                    <option value="VIDEO">Video</option>
                                    <option value="DOCUMENT">Documento</option>
                                    <option value="Ubicacion">Ubicacion</option>
                                </select>
                            </div>

                            <!-- Header Text -->
                            <div class="form-group mb-3" id="createHeaderTextGroup">
                                <label for="createHeaderText">Texto del Header</label>
                                <input type="text" id="createHeaderText" name="createHeaderText"
                                    class="form-control variable variable-1" maxlength="60">
                                <small class="form-text text-muted">Texto que aparecerá en el encabezado de la plantilla
                                    (opcional).</small>
                                <div id="createVariableFields"></div>
                            </div>

                            <div class="row" id="createHeaderImageGroup">
                                <!-- Header Image -->
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="createHeaderImage">Imagen del Header</label>
                                        <input type="file" id="createHeaderImage" name="createHeaderImage"
                                            class="form-control" accept="image/*">
                                        <small class="form-text text-muted">Imagen que aparecerá en el encabezado de la
                                            plantilla
                                            (opcional).</small>
                                    </div>
                                </div>
                                <div class="col-6" id="previewImage">
                                    <img src="" alt="" class="preview" style="width: 50%">
                                </div>
                            </div>

                            <!-- Header Video -->
                            <div class="form-group mb-3" id="createHeaderVideoGroup">
                                <label for="createHeaderVideo">Video del Header</label>
                                <input type="file" id="createHeaderVideo" name="createHeaderVideo"
                                    class="form-control" accept="video/*">
                                <small class="form-text text-muted">Video que aparecerá en el encabezado de la plantilla
                                    (opcional).</small>
                            </div>

                            <!-- Header Document -->
                            <div class="form-group mb-3" id="createHeaderDocumentGroup">
                                <label for="createHeaderDocument">Documento del Header</label>
                                <input type="file" id="createHeaderDocument" name="createHeaderDocument"
                                    class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                                <small class="form-text text-muted">Documento que aparecerá en el encabezado de la
                                    plantilla
                                    (opcional).</small>
                            </div>

                            <!-- Body -->
                            <div class="form-group mb-3">
                                <label for="createBodyText">Texto del Body</label>
                                <textarea id="createBodyText" name="createBodyText" class="form-control variable variable-10" rows="4"
                                    maxlength="1024" required></textarea>
                                <small class="form-text text-muted">Texto principal del mensaje. Puedes incluir variables
                                    usando
                                    @{{ 1 }}, @{{ 2 }}, @{{ order_id }},
                                    @{{ mount }} etc.</small>
                            </div>

                            <!-- Footer -->
                            <div class="form-group mb-3">
                                <label for="createFooterText">Texto del Footer</label>
                                <input type="text" id="createFooterText" name="createFooterText"
                                    class="form-control variable variable-0" maxlength="60">
                                <small class="form-text text-muted">Texto de pie de página (opcional).</small>
                            </div>

                            <!-- Botones -->
                            <div id="buttonsContainer">
                                <label>Botones</label>
                                <div class="form-group mb-3">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default">+ Agregar Boton</button>
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <p><b>Botones de respuesta rápida</b></p>
                                            <a class="dropdown-item" id="create_quick_replay_button"
                                                href="#">Desactivar
                                                marketing <sub>Recomendado</sub></a>
                                            <a class="dropdown-item" id="create_quick_replay_custon_button"
                                                href="#">Personalizado</a>
                                            <div class="dropdown-divider"></div>
                                            <p><b>Botones de llamada a la acción</b></p>
                                            <a class="dropdown-item" id="create_go_to_web_button" href="#">Ir a
                                                sitio web
                                                <sub>2 botones maximo</sub></a>
                                            <a class="dropdown-item" id="create_call_button" href="#">Llamar a
                                                numero de
                                                telefono <sub>1 boton como maximo</sub></a>
                                            <a class="dropdown-item" id="create_copy_code_button" href="#">Copiar
                                                codigo de
                                                oferta <sub>1 boton como maximo</sub></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="create_buttons_group">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modal-1-end -->
@stop

@section('js')
    <script>
        const profileContainer = document.querySelector('.card-profile-container');
        profileContainer.style.display = 'none';

        const contactsContainer = document.querySelector('.chat-contact');
        contactsContainer.innerHTML = '';

        const chatContainer = document.querySelector('.chat-container');
        chatContainer.innerHTML = '';

        function selectTabPane($tabPane) {
            const tabPane_selected = document.querySelector('#tab-pane-selected');
            tabPane_selected.value = $tabPane;
            const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id').value;

            switch ($tabPane) {
                case 'number-profile-tab-pane':
                    loadProfile();
                    break;
                case 'template-tab-pane':
                    loadTemplate(whatsappPhoneNumberId);
                    break;
                case 'whatsapp-chat-tab-pane':
                    loadChat(whatsappPhoneNumberId);
                    break;
                case 'update-account-tab-pane':
                    loadUpdateAccount(whatsappPhoneNumberId);
                    break;
            }

        }

        function loadProfile() {
            const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id').value;
            if (!whatsappPhoneNumberId) {
                showAlert('warning', 'Debe Seleccionar un NUmero de telefono.');
                return;
            }

            fetch(`{{ url('/phone-number') }}/${whatsappPhoneNumberId}/profile`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Actualiza los datos del perfil en la página
                    const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id');
                    const tabPane_selected = document.querySelector('#tab-pane-selected');
                    const profileImage = document.querySelector('.profile-image');
                    const profileDescription = document.querySelector('.profile-description');
                    const personDetailsName = document.querySelector('.person-details h5');
                    const personDetailsDescription = document.querySelector('.person-details p');
                    const emailElement = document.querySelector('.about-list .email .float-end');
                    const contactElement = document.querySelector('.about-list .contact .float-end');
                    const locationElement = document.querySelector('.about-list .location .float-end');
                    const profileAddress = document.querySelector('.profile-address');
                    const websiteElement = document.querySelector('.about-list .website .float-end');
                    const githubElement = document.querySelector('.about-list .github .float-end');



                    if (profileImage) {
                        profileImage.innerHTML =
                            `<img src="${data.business_profile.profile_picture_url}" alt="" class="img-fluid">`;
                    }
                    if (personDetailsName) {
                        personDetailsName.innerHTML =
                            `${data.verified_name} <img src="../assets/images/profile-app/01.png" class="w-20 h-20" alt="instagram-check-mark">`;
                    }
                    if (personDetailsDescription) {
                        personDetailsDescription.innerText = data.business_profile.description;
                        profileDescription.innerText = data.business_profile.description;
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
                        websiteElement.innerText = data.business_profile.websites.map(website => website.website).join(
                            ', ');
                    }
                    if (githubElement) {
                        githubElement.innerText = data.business_profile.github;
                    }

                    profileContainer.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    // alert('Error al cargar el perfil.');
                    showAlert('danger', 'Error al cargar el perfil.');
                });
        }

        function loadTemplate() {
            const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id').value;
            if (!whatsappPhoneNumberId) {
                showAlert('warning', 'Debe Seleccionar un NUmero de telefono.');
                return;
            }

            fetch(`{{ url('/templates') }}/${whatsappPhoneNumberId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Procesa los datos de la plantilla aquí
                    console.log(data);
                    // Llenar la tabla con los datos de la plantilla
                    const tbody = document.getElementById('t-data');
                    tbody.innerHTML = ''; // Limpiar el contenido existente

                    data.forEach(template => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                            <th scope="row"><input class="form-check-input mt-0 ms-2" type="checkbox" name="item"></th>
                            <td class="id d-none">${template.template_id}</td>
                            <td class="employee">${template.name}</td>
                            <td class="email">${template.category}</td>
                            <td class="contact">${template.language}</td>
                            <td class="date">${new Date(template.updated_at).toLocaleDateString()}</td>
                            <td class="status">
                                <span class="badge ${template.status === 'APPROVED' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'} text-uppercase">${template.status}</span>
                            </td>
                            <td class="edit"><div class="btn-group btn-rtl">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item modal-detailTemplate" data-bs-toggle="modal" data-bs-target="#modal_detail_template" href="#" data-template-name="${template.name}" data-template-id="${template.template_id}" data-template-wa-id="${template.wa_template_id}">Detalles de Plantilla</a></li>
                                    <li><a class="dropdown-item modal-editTemplate" data-bs-toggle="modal" data-bs-target="#modal_edit_template" href="#" data-template-name="${template.name}" data-template-id="${template.template_id}" data-template-wa-id="${template.wa_template_id}">Editar Plantilla</a></li>
                                    <li><a class="dropdown-item modal-sendTemplate" data-bs-toggle="modal" data-bs-target="#modal_send_template" href="#" data-template-name="${template.name}" data-template-id="${template.template_id}" data-template-wa-id="${template.wa_template_id}">Enviar Plantilla</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item modal-deleteTemplate" data-bs-toggle="modal" data-bs-target="#modal_delete_template" href="#">Eliminar Plantilla</a></li>
                                </ul>
                            </div></td>
                            <td class="remove"><button class="btn remove-item-btn btn-sm btn-danger">Remove</button></td>
                        `;

                        tbody.appendChild(row);
                        // Puedes actualizar el DOM con los datos de la plantilla si es necesario
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    // alert('Error al cargar la plantilla.');
                    showAlert('danger', 'Error al cargar la plantilla.');
                });
        }

        function loadChat() {
            const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id').value;
            if (!whatsappPhoneNumberId) {
                showAlert('warning', 'Debe Seleccionar un NUmero de telefono.');
                return;
            }

            fetch(`{{ url('/whatsapp-chat') }}/${whatsappPhoneNumberId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Procesa los datos de la plantilla aquí
                    console.log(data);
                    const contactsContainer = document.querySelector('.chat-contact');
                    contactsContainer.innerHTML = ''; // Limpiar el contenido existente

                    Object.values(data).forEach(contact => {
                        const contactBox = document.createElement('div');
                        contactBox.className = 'chat-contactbox';
                        contactBox.dataset.contactId = contact.contact_id;

                        contactBox.innerHTML = `
                            <div class="position-absolute">
                                <span class="h-45 w-45 d-flex-center b-r-50 position-relative bg-primary">
                                    <img src="../assets/images/avtar/1.png" alt="" class="img-fluid b-r-50">
                                    <span class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
                                </span>
                            </div>
                            <div class="flex-grow-1 text-start mg-s-50">
                                <p class="mb-0 f-w-500 text-dark txt-ellipsis-1">${contact.contact_name}</p>
                                <p class="text-secondary mb-0 f-s-12 mb-0 chat-message">
                                    <i class="ti ti-checks"></i> ${contact.phone_number}
                                </p>
                            </div>
                            <div>
                                <p class="f-s-12 chat-time">${new Date(contact.updated_at).toLocaleTimeString()}</p>
                            </div>
                        `;

                        contactBox.addEventListener('click', function() {
                            loadChatHistory(contact.contact_id);
                        });

                        contactsContainer.appendChild(contactBox);
                    });
                    // Llenar la tabla con los datos de la plantilla

                })
                .catch(error => {
                    console.error('Error:', error);
                    // alert('Error al cargar la plantilla.');
                    showAlert('danger', 'Error al cargar el chat.');
                });
        }

        function loadChatHistory(contactId) {
            const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id').value;
            const contactIdinput = document.querySelector('#contact-id');
            contactIdinput.value = contactId;

            if (!whatsappPhoneNumberId) {
                showAlert('warning', 'Debe Seleccionar un Número de teléfono.');
                return;
            }

            fetch(`/chat-history/${contactId}/${whatsappPhoneNumberId}`)
                .then(response => response.json())
                .then(data => {
                    const chatContainer = document.querySelector('.chat-container');
                    chatContainer.innerHTML = ''; // Limpiar el contenido existente

                    // Actualizar datos del contacto en el modal
                    const contact = data.contact;
                    const contactNameElement = document.querySelector('#contact-name');
                    contactNameElement.textContent = contact.contact_name;
                    document.querySelector('#contact-image').src = contact.profile_image_url ||
                        '../assets/images/avtar/14.png';

                    data.messages.forEach(message => {
                        const messageElement = document.createElement('div');
                        const isOutgoing = message.message_method === 'OUTPUT';
                        const messageTime = new Date(message.timestamp * 1000).toLocaleTimeString();

                        messageElement.className = 'position-relative';

                        if (message.message_type === 'TEXT') {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? 'chat-box-right' : 'chat-box'}">
                        <div>
                            <p class="chat-text">${message.message_content}</p>
                            <p class="text-muted"><i class="ti ti-checks ${message.readed_at ? 'text-primary' : ''}"></i> ${new Date(message.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === 'IMAGE') {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? 'chat-box-right' : 'chat-box'}">
                        <div>
                            <img src="${message.media_files[0].url}" alt="" class="img-fluid">
                            <p class="text-muted"><i class="ti ti-checks ${message.readed_at ? 'text-primary' : ''}"></i> ${new Date(message.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === 'DOCUMENT') {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? 'chat-box-right' : 'chat-box'}">
                        <div>
                            <a href="${message.media_files[0].url}" target="_blank" class="btn btn-primary">${message.message_content}</a>
                            <p class="text-muted"><i class="ti ti-checks ${message.readed_at ? 'text-primary' : ''}"></i> ${new Date(message.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === 'AUDIO') {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? 'chat-box-right' : 'chat-box'}">
                        <div>
                            <audio controls>
                                <source src="${message.media_files[0].url}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <p class="text-muted"><i class="ti ti-checks ${message.readed_at ? 'text-primary' : ''}"></i> ${new Date(message.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        } else if (message.message_type === 'VIDEO') {
                            messageElement.innerHTML = `
                    <div class="${isOutgoing ? 'chat-box-right' : 'chat-box'}">
                        <div>
                            <video width="320" height="240" controls>
                                <source src="${message.media_files[0].url}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <p class="text-muted"><i class="ti ti-checks ${message.readed_at ? 'text-primary' : ''}"></i> ${new Date(message.created_at).toLocaleString()}</p>
                        </div>
                    </div>
                    `;
                        }

                        chatContainer.appendChild(messageElement);
                    });

                    // Scroll to the bottom of the chat container
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar el historial de conversaciones.');
                });
        }

        function selectPhoneNumber(phone_number_id) {

            const tabPane_selected = document.querySelector('#tab-pane-selected');
            const whatsappPhoneNumberId = document.querySelector('#whatsapp-phone-number-id');

            whatsappPhoneNumberId.value = phone_number_id;

            switch (tabPane_selected.value) {
                case 'number-profile-tab-pane':
                    loadProfile(phone_number_id);
                    break;
                case 'template-tab-pane':
                    loadTemplate();
                    break;
                case 'whatsapp-chat-tab-pane':
                    loadChat();
                    break;
                case 'update-account-tab-pane':
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
            const sendMessageForm = $('#sendMessageForm');
            const messageInput = $('#messageInput');
            const chatContainer = $('.chat-container');

            sendMessageForm.on('submit', function(event) {
                event.preventDefault();

                const whatsappPhoneNumberId = $('#whatsapp-phone-number-id').val();
                const contactId = $('#contact-id').val();
                const messageContent = messageInput.val().trim();

                if (!whatsappPhoneNumberId) {
                    showAlert('warning', 'Debe Seleccionar un Número de teléfono.');
                    return;
                }

                if (!messageContent) {
                    showAlert('warning', 'El mensaje no puede estar vacío.');
                    return;
                }

                $.ajax({
                    url: '/send-message',
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        whatsapp_phone_id: whatsappPhoneNumberId,
                        contact_id: contactId,
                        message_content: messageContent,
                        tipo: 'OUTPUT',
                        type: 'TEXT'
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
                            messageInput.val(''); // Clear the input
                        } else {
                            showAlert('danger', 'Error al enviar el mensaje.');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        showAlert('danger', 'Error al enviar el mensaje.');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const createTemplateNameField = document.getElementById('createTemplateName');
            const headerTextFields = document.querySelectorAll("#editHeaderText, #createHeaderText");
            const bodyTextFields = document.querySelectorAll("#editBodyText, #createBodyText");
            const footerTextFields = document.querySelectorAll("#editFooterText, #createFooterText");
            const buttonsContainer = document.querySelector('.buttons_group');
            const buttonsCreateContainer = document.querySelector('.create_buttons_group');

            // Funcionalidad para los campos de nombre de plantilla (sin variables)
            const templateNameFields = document.querySelectorAll("#createTemplateName, #editTemplateName");
            templateNameFields.forEach((templateField) => {
                templateField.addEventListener("input", function () {
                    // Convertir a minúsculas y reemplazar espacios por _
                    this.value = this.value.toLowerCase().replace(/\s+/g, '_');
                });
            });

            // Ocultar los campos de archivo al cargar la página
            $('.authentication_template').hide();

            $('#headerTextGroup').hide();
            $('#headerImageGroup').hide();
            $('#headerVideoGroup').hide();
            $('#headerDocumentGroup').hide();

            $('#createHeaderTextGroup').hide();
            $('#createHeaderImageGroup').hide();
            $('#createHeaderVideoGroup').hide();
            $('#createHeaderDocumentGroup').hide();

            // Mostrar/ocultar los campos de archivo según el valor del select
            $('#createTemplateCategory').on('change', function () {
                var selectedValue = $(this).val();
                // alert(selectedValue);

                if (selectedValue === 'UTILITY') {
                    $('.authentication_template').hide();
                    $('.utility_template').show();
                } else if (selectedValue === 'MARKETING') {
                    $('.authentication_template').hide();
                    $('.utility_template').show();
                } else if (selectedValue === 'AUTHENTICATION') {
                    $('.authentication_template').show();
                    $('.utility_template').hide();
                }
            });

            $('#editTemplateHeader').on('change', function () {
                var selectedValue = $(this).val();
                // alert(selectedValue);
                $('#headerTextGroup').hide();
                $('#headerImageGroup').hide();
                $('#headerVideoGroup').hide();
                $('#headerDocumentGroup').hide();

                if (selectedValue === 'TEXT') {
                    $('#headerTextGroup').show();
                } else if (selectedValue === 'IMAGE') {
                    $('#headerImageGroup').show();
                } else if (selectedValue === 'VIDEO') {
                    $('#headerVideoGroup').show();
                } else if (selectedValue === 'DOCUMENT') {
                    $('#headerDocumentGroup').show();
                }
            });

            $('#createTemplateHeader').on('change', function () {
                var selectedValue = $(this).val();
                // alert(selectedValue);
                $('#createHeaderTextGroup').hide();
                $('#createHeaderImageGroup').hide();
                $('#createHeaderVideoGroup').hide();
                $('#createHeaderDocumentGroup').hide();

                if (selectedValue === 'TEXT') {
                    $('#createHeaderTextGroup').show();
                } else if (selectedValue === 'IMAGE') {
                    $('#createHeaderImageGroup').show();
                } else if (selectedValue === 'VIDEO') {
                    $('#createHeaderVideoGroup').show();
                } else if (selectedValue === 'DOCUMENT') {
                    $('#createHeaderDocumentGroup').show();
                }
            });

            // Delegación de eventos para elementos dinámicos
            $(document).on('click', '.modal-detailTemplate', function () {
                var templateId = $(this).data('template-id');
                var templateName = $(this).data('template-name');
                var waTemplateId = $(this).data('template-wa-id');
                var json = {}; // Define el JSON que necesitas enviar

                $.ajax({
                    url: '{{ route('template.detail') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        json: json,
                        template_id: templateId,
                        wa_template_id: waTemplateId
                    },
                    success: function (response) {
                        // Manejar la respuesta
                        // console.log(response);
                        $('#modal_detail_template_body').html(response);
                        $('#detailTemplateModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Función para detectar variables y crear campos de texto
            $(document).on('input', '#editHeaderText', function () {
                var text = $(this).val();
                var variablePattern = /@{{\s*([\w_]+)\s*}}/g;
                var match;
                var variables = [];

                // Detectar variables en el texto
                while ((match = variablePattern.exec(text)) !== null) {
                    variables.push(match[1]);
                }

                // Limpiar campos de variables existentes
                $('#variableFields').empty();

                // Crear campos de texto para cada variable detectada
                if (variables.length <= 1) {
                    variables.forEach(function (variable) {
                        createExampleField($('#editHeaderText')[0], variable);
                    });
                }
            });

            $(document).on('input', '#createHeaderText', function () {
                var text = $(this).val();
                var variablePattern = /@{{\s*([\w_]+)\s*}}/g;
                var match;
                var variables = [];

                // Detectar variables en el texto
                while ((match = variablePattern.exec(text)) !== null) {
                    variables.push(match[1]);
                }

                // Limpiar campos de variables existentes
                $('#createVariableFields').empty();

                // Crear campos de texto para cada variable detectada
                if (variables.length <= 1) {
                    variables.forEach(function (variable) {
                        createExampleField($('#createHeaderText')[0], variable);
                    });
                }
            });

            // Completar automáticamente las variables
            $(document).on('keyup', '#editHeaderText', function (e) {
                if (e.key === '{') {
                    var cursorPos = this.selectionStart;
                    var text = $(this).val();
                    var beforeCursor = text.substring(0, cursorPos);
                    var afterCursor = text.substring(cursorPos);

                    if (beforeCursor.endsWith('@{{')) {
                        var variableType = $('#editTemplateVariable').val();
                        var variableCount = $('#variableFields .form-group').length + 1;
                        var variableName = variableType === 'number' ? variableCount : 'variable_' + variableCount;

                        $(this).val(beforeCursor + variableName + '}}' + afterCursor);
                        this.selectionStart = this.selectionEnd = cursorPos + variableName.length + 2;
                    }
                }
            });

            $(document).on('keyup', '#createHeaderText', function (e) {
                if (e.key === '{') {
                    var cursorPos = this.selectionStart;
                    var text = $(this).val();
                    var beforeCursor = text.substring(0, cursorPos);
                    var afterCursor = text.substring(cursorPos);

                    if (beforeCursor.endsWith('@{{')) {
                        var variableType = $('#createTemplateVariable').val();
                        var variableCount = $('#createVariableFields .form-group').length + 1;
                        var variableName = variableType === 'number' ? variableCount : 'variable_' + variableCount;

                        $(this).val(beforeCursor + variableName + '}}' + afterCursor);
                        this.selectionStart = this.selectionEnd = cursorPos + variableName.length + 2;
                    }
                }
            });

            // Función para manejar el campo de ejemplo
            function updateExampleField(headerText) {
                // Eliminar el campo de ejemplo existente
                const existingExample = headerText.parentNode.querySelector('.example-field');
                if (existingExample) {
                    existingExample.remove();
                }

                // Verificar si hay una variable en el texto del encabezado
                const variableMatch = headerText.value.match(/@{{\d+}}/);
                if (variableMatch) {
                    // createExampleField(headerText, variableMatch[0]); // Crear un campo de ejemplo con la variable detectada
                }
            }

            function createExampleField(headerText, variable) {
                // Verificar si ya existe un campo de ejemplo para esta variable
                if (!headerText.parentNode.querySelector(`.example-field[data-variable="${variable}"]`)) {
                    const exampleField = document.createElement('input');
                    exampleField.type = 'text';
                    exampleField.placeholder = `Ejemplo para ${variable}`;
                    exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Agregar clases para el estilo
                    exampleField.setAttribute('data-variable', variable); // Agregar atributo para identificar la variable
                    headerText.parentNode.appendChild(exampleField);
                }
            }

            // Validar el texto del encabezado
            function validateHeaderText(headerText, validationMessage) {
                const text = headerText.value;
                const variablePattern = /@{{\s*([\w_]+)\s*}}/g;
                const variables = text.match(variablePattern) || [];

                // Mostrar mensaje de validación si se detecta más de una variable
                if (variables.length > 1) {
                    validationMessage.style.display = "block";
                    // Eliminar variables adicionales
                    const firstVariable = variables[0];
                    const newText = text.replace(variablePattern, (match, p1, offset) => {
                        return offset === text.indexOf(firstVariable) ? match : '';
                    });
                    headerText.value = newText;
                } else {
                    validationMessage.style.display = "none";
                }
            }

            // Función para insertar automáticamente la variable
            function autoInsertVariable(field) {
                const cursorPosition = field.selectionStart;
                const textBeforeCursor = field.value.slice(0, cursorPosition);
                const textAfterCursor = field.value.slice(cursorPosition);

                // Detectar apertura de `@{{` sin un número consecutivo
                if (textBeforeCursor.endsWith("@{{") && !textAfterCursor.startsWith("}}")) {
                    // Insertar nueva variable `@{{1}}` (ya que solo se permite una)
                    field.value = `${textBeforeCursor}1}}${textAfterCursor}`;
                    field.selectionStart = field.selectionEnd = cursorPosition + `1}}`.length;

                    // Actualizar el campo de ejemplo
                    updateExampleField(field);
                }
            }

            // Function to clear form fields
            function clearFormFields() {
                // Clear input fields
                document.getElementById('editTemplateName').value = '';
                document.getElementById('editTemplateLanguage').value = '';
                document.getElementById('editTemplateId').value = '';
                document.getElementById('editHeaderText').value = '';
                document.getElementById('editBodyText').value = '';
                document.getElementById('editFooterText').value = '';

                // Remove dynamically created example fields
                const exampleFields = document.querySelectorAll('.example-field');
                exampleFields.forEach(field => field.remove());

                // Remove dynamically created buttons
                const quickReplyButtonGroups = document.querySelectorAll('.quick_replay_button_group');
                quickReplyButtonGroups.forEach(group => group.remove());

                const callToActionButtonGroups = document.querySelectorAll('.call_to_action_button_group');
                callToActionButtonGroups.forEach(group => group.remove());
            }

            // Function to clear form fields
            function clearCreateFormFields() {
                // Clear input fields
                document.getElementById('createTemplateName').value = '';
                document.getElementById('createTemplateLanguage').value = '';
                document.getElementById('createTemplateId').value = '';
                document.getElementById('createHeaderText').value = '';
                document.getElementById('createBodyText').value = '';
                document.getElementById('createFooterText').value = '';

                // Remove dynamically created example fields
                const exampleFields = document.querySelectorAll('.example-field');
                exampleFields.forEach(field => field.remove());

                // Remove dynamically created buttons
                const quickReplyButtonGroups = document.querySelectorAll('.create_quick_replay_button_group');
                quickReplyButtonGroups.forEach(group => group.remove());

                const callToActionButtonGroups = document.querySelectorAll('.create_call_to_action_button_group');
                callToActionButtonGroups.forEach(group => group.remove());
            }

            // Function to add Quick Reply Button
            function addQuickReplyButton(type, text = '') {
                const quickReplyButtonGroup = document.createElement('div');
                quickReplyButtonGroup.classList.add('quick_replay_button_group');

                quickReplyButtonGroup.innerHTML = `
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="quick_replay_button_type">Type</label>
                                <select class="custom-select form-control-border" name="quick_replay_button_type">
                                    <option value="QUICK_REPLY" ${type === 'Personalizado' ? 'selected' : ''}>Personalizado</option>
                                    <option value="QUICK_REPLY" ${type === 'Respuesta preconfigurada' ? 'selected' : ''}>Respuesta preconfigurada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="quick_replay_button_text">Texto del Boton</label>
                                <input type="text" class="form-control" name="quick_replay_button_text" value="${text}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
                        </div>
                    </div>
                `;

                buttonsContainer.appendChild(quickReplyButtonGroup);
            }

            function addQuickReplyButtonCreate(type, text = '') {
                const quickReplyButtonGroup = document.createElement('div');
                quickReplyButtonGroup.classList.add('create_quick_replay_button_group');

                quickReplyButtonGroup.innerHTML = `
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="quick_replay_button_type">Type</label>
                                <select class="custom-select form-control-border" name="quick_replay_button_type">
                                    <option value="QUICK_REPLY" ${type === 'Personalizado' ? 'selected' : ''}>Personalizado</option>
                                    <option value="QUICK_REPLY" ${type === 'Respuesta preconfigurada' ? 'selected' : ''}>Respuesta preconfigurada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="quick_replay_button_text">Texto del Boton</label>
                                <input type="text" class="form-control" name="quick_replay_button_text" value="${text}">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
                        </div>
                    </div>
                `;

                buttonsCreateContainer.appendChild(quickReplyButtonGroup);
            }

            // function addQuickReplyButton(type) {
            //     const quickReplyButtonGroup = document.createElement('div');
            //     quickReplyButtonGroup.classList.add('quick_replay_button_group');

            //     quickReplyButtonGroup.innerHTML = `
            //         <div class="row">
            //             <div class="col-lg-3">
            //                 <div class="form-group">
            //                     <label for="quick_replay_button_type">Type</label>
            //                     <select class="custom-select form-control-border" name="quick_replay_button_type">
            //                         <option value="QUICK_REPLY" ${type === 'Personalizado' ? 'selected' : ''}>Personalizado</option>
            //                         <option value="QUICK_REPLY" ${type === 'Respuesta preconfigurada' ? 'selected' : ''}>Respuesta preconfigurada</option>
            //                     </select>
            //                 </div>
            //             </div>
            //             <div class="col-lg-7">
            //                 <div class="form-group">
            //                     <label for="quick_replay_button_text">Texto del Boton</label>
            //                     <input type="text" class="form-control" name="quick_replay_button_text">
            //                 </div>
            //             </div>
            //             <div class="col-lg-2">
            //                 <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
            //             </div>
            //         </div>
            //     `;

            //     buttonsContainer.appendChild(quickReplyButtonGroup);
            // }
            // Function to add Call to Action Button
            function addCallToActionButton(actionType, text = '', url = '', phoneNumber = '', code = '') {
                const callToActionButtonGroup = document.createElement('div');
                callToActionButtonGroup.classList.add('call_to_action_button_group');

                let actionFields = '';

                if (actionType === 'Ir a Web') {
                    actionFields = `
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_type">URL Type</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_type">
                                    <option>Estatica</option>
                                    <option>Dinamica</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="call_to_action_button_url">URL del sitio web</label>
                                <input type="text" class="form-control" name="call_to_action_button_url" value="${url}">
                            </div>
                        </div>
                    `;
                } else if (actionType === 'Llamar a numero de telefono') {
                    actionFields = `
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_country">Pais</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_country">
                                    <option>+57</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="call_to_action_button_phone">Numero de telefono</label>
                                <input type="text" class="form-control" name="call_to_action_button_phone" value="${phoneNumber}">
                            </div>
                        </div>
                    `;
                } else if (actionType === 'Copiar codigo de oferta') {
                    actionFields = `
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="call_to_action_button_code">Codigo de oferta</label>
                                <input type="text" class="form-control" name="call_to_action_button_code" value="${code}">
                            </div>
                        </div>
                    `;
                }

                callToActionButtonGroup.innerHTML = `
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_type">Tipo de accion</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_type">
                                    <option value="URL" ${actionType === 'Ir a Web' ? 'selected' : ''}>Ir a Web</option>
                                    <option value="PHONE_NUMBER" ${actionType === 'Llamar a numero de telefono' ? 'selected' : ''}>Llamar a numero de telefono</option>
                                    <option value="COPY_CODE" ${actionType === 'Copiar codigo de oferta' ? 'selected' : ''}>Copiar codigo de oferta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="call_to_action_button_text">Texto del Boton</label>
                                <input type="text" class="form-control" name="call_to_action_button_text" value="${text}">
                            </div>
                        </div>
                        ${actionFields}
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
                        </div>
                    </div>
                `;

                buttonsContainer.appendChild(callToActionButtonGroup);
            }

            function addCallToActionButtonCreate(actionType, text = '', url = '', phoneNumber = '', code = '') {
                const callToActionButtonGroup = document.createElement('div');
                callToActionButtonGroup.classList.add('call_to_action_button_group');

                let actionFields = '';

                if (actionType === 'Ir a Web') {
                    actionFields = `
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_type">URL Type</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_type">
                                    <option>Estatica</option>
                                    <option>Dinamica</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="call_to_action_button_url">URL del sitio web</label>
                                <input type="text" class="form-control" name="call_to_action_button_url" value="${url}">
                            </div>
                        </div>
                    `;
                } else if (actionType === 'Llamar a numero de telefono') {
                    actionFields = `
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_country">Pais</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_country">
                                    <option>+57</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="call_to_action_button_phone">Numero de telefono</label>
                                <input type="text" class="form-control" name="call_to_action_button_phone" value="${phoneNumber}">
                            </div>
                        </div>
                    `;
                } else if (actionType === 'Copiar codigo de oferta') {
                    actionFields = `
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="call_to_action_button_code">Codigo de oferta</label>
                                <input type="text" class="form-control" name="call_to_action_button_code" value="${code}">
                            </div>
                        </div>
                    `;
                }

                callToActionButtonGroup.innerHTML = `
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="call_to_action_button_type">Tipo de accion</label>
                                <select class="custom-select form-control-border" name="call_to_action_button_type">
                                    <option value="URL" ${actionType === 'Ir a Web' ? 'selected' : ''}>Ir a Web</option>
                                    <option value="PHONE_NUMBER" ${actionType === 'Llamar a numero de telefono' ? 'selected' : ''}>Llamar a numero de telefono</option>
                                    <option value="COPY_CODE" ${actionType === 'Copiar codigo de oferta' ? 'selected' : ''}>Copiar codigo de oferta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="call_to_action_button_text">Texto del Boton</label>
                                <input type="text" class="form-control" name="call_to_action_button_text" value="${text}">
                            </div>
                        </div>
                        ${actionFields}
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
                        </div>
                    </div>
                `;

                buttonsCreateContainer.appendChild(callToActionButtonGroup);
            }

            // function addCallToActionButton(actionType) {
            //     const callToActionButtonGroup = document.createElement('div');
            //     callToActionButtonGroup.classList.add('call_to_action_button_group');

            //     let actionFields = '';

            //     if (actionType === 'Ir a Web') {
            //         actionFields = `
            //             <div class="col-lg-2">
            //                 <div class="form-group">
            //                     <label for="call_to_action_button_type">URL Type</label>
            //                     <select class="custom-select form-control-border" name="call_to_action_button_type">
            //                         <option>Estatica</option>
            //                         <option>Dinamica</option>
            //                     </select>
            //                 </div>
            //             </div>
            //             <div class="col-lg-4">
            //                 <div class="form-group">
            //                     <label for="call_to_action_button_url">URL del sitio web</label>
            //                     <input type="text" class="form-control" name="call_to_action_button_url">
            //                 </div>
            //             </div>
            //         `;
            //     } else if (actionType === 'Llamar a numero de telefono') {
            //         actionFields = `
            //             <div class="col-lg-2">
            //                 <div class="form-group">
            //                     <label for="call_to_action_button_country">Pais</label>
            //                     <select class="custom-select form-control-border" name="call_to_action_button_country">
            //                         <option>+57</option>
            //                     </select>
            //                 </div>
            //             </div>
            //             <div class="col-lg-4">
            //                 <div class="form-group">
            //                     <label for="call_to_action_button_phone">Numero de telefono</label>
            //                     <input type="text" class="form-control" name="call_to_action_button_phone">
            //                 </div>
            //             </div>
            //         `;
            //     } else if (actionType === 'Copiar codigo de oferta') {
            //         actionFields = `
            //             <div class="col-lg-6">
            //                 <div class="form-group">
            //                     <label for="call_to_action_button_code">Codigo de oferta</label>
            //                     <input type="text" class="form-control" name="call_to_action_button_code">
            //                 </div>
            //             </div>
            //         `;
            //     }

            //     callToActionButtonGroup.innerHTML = `
            //         <div class="row">
            //             <div class="col-lg-2">
            //                 <div class="form-group">
            //                     <label for="call_to_action_button_type">Tipo de accion</label>
            //                     <select class="custom-select form-control-border" name="call_to_action_button_type">
            //                         <option value="URL" ${actionType === 'Ir a Web' ? 'selected' : ''}>Ir a Web</option>
            //                         <option value="PHONE_NUMBER" ${actionType === 'Llamar a numero de telefono' ? 'selected' : ''}>Llamar a numero de telefono</option>
            //                         <option value="COPY_CODE" ${actionType === 'Copiar codigo de oferta' ? 'selected' : ''}>Copiar codigo de oferta</option>
            //                     </select>
            //                 </div>
            //             </div>
            //             <div class="col-lg-4">
            //                 <div class="form-group">
            //                     <label for="call_to_action_button_text">Texto del Boton</label>
            //                     <input type="text" class="form-control" name="call_to_action_button_text">
            //                 </div>
            //             </div>
            //             ${actionFields}
            //             <div class="col-lg-2">
            //                 <button type="button" class="btn btn-danger btn-sm remove-button">Eliminar</button>
            //             </div>
            //         </div>
            //     `;

            //     buttonsContainer.appendChild(callToActionButtonGroup);
            // }

            createTemplateNameField.addEventListener('input', function () {
                // Convertir a minúsculas
                let value = this.value.toLowerCase();

                // Reemplazar espacios con guiones bajos
                value = value.replace(/\s+/g, '_');

                // Eliminar caracteres que no sean letras o números
                value = value.replace(/[^a-z0-9_]/g, '');

                // Asignar el valor modificado al campo
                this.value = value;
            });
            // Inicializar los campos de texto del encabezado
            headerTextFields.forEach((headerText) => {
                const validationMessage = document.createElement("small");
                validationMessage.classList.add("form-text", "text-danger");
                validationMessage.style.display = "none";
                validationMessage.innerText = "El encabezado solo puede contener un parámetro variable.";
                headerText.parentNode.appendChild(validationMessage);

                headerText.addEventListener("input", function () {
                    autoInsertVariable(headerText);
                    validateHeaderText(headerText, validationMessage);
                    updateExampleField(headerText); // Actualizar el campo de ejemplo en la entrada
                });
            });

            bodyTextFields.forEach((bodyText) => {
                const validationMessage = document.createElement("small");
                validationMessage.classList.add("form-text", "text-danger");
                validationMessage.style.display = "none";
                validationMessage.innerText = "Esta plantilla contiene demasiados parámetros variables en relación con la longitud del mensaje. Debes disminuir el número de parámetros o aumentar la longitud del mensaje.";
                bodyText.parentNode.appendChild(validationMessage);

                // Function to manage example fields
                function updateExampleFields() {
                    // Remove existing example fields
                    const existingExamples = bodyText.parentNode.querySelectorAll('.example-field');
                    existingExamples.forEach(field => field.remove());

                    // Count the number of variables in the body text
                    const variablesCount = (bodyText.value.match(/@{{\d+}}/g) || []).length;

                    // Create new example fields based on the count
                    for (let i = 1; i <= variablesCount; i++) {
                        createExampleField(i);
                    }
                }

                // Function to create an example field
                function createExampleField(variableNumber) {
                    const exampleField = document.createElement('input');
                    exampleField.type = 'text';
                    exampleField.placeholder = `Ejemplo para @{{${variableNumber}}}`;
                    exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Add classes for styling
                    bodyText.parentNode.appendChild(exampleField);
                }

                bodyText.addEventListener("input", function () {
                    autoInsertVariable(bodyText);
                    validateBodyText(bodyText, validationMessage);
                    updateExampleFields(); // Update example fields on input
                });

                function autoInsertVariable(field) {
                    const cursorPosition = field.selectionStart;
                    const textBeforeCursor = field.value.slice(0, cursorPosition);
                    const textAfterCursor = field.value.slice(cursorPosition);

                    // Detect opening of `@{{` without a consecutive number
                    if (textBeforeCursor.endsWith("@{{") && !textAfterCursor.startsWith("}}")) {
                        const variables = field.value.match(/@{{(\d+)}}/g) || [];
                        const existingNumbers = variables.map(v => parseInt(v.match(/\d+/)[0], 10));
                        const nextVariableNumber = existingNumbers.length > 0 ? Math.max(...existingNumbers) + 1 : 1;

                        // Determine the variable type based on the select value
                        const variableType = document.getElementById('editTemplateVariable').value;
                        const variableName = variableType === 'number' ? nextVariableNumber : `variable_${nextVariableNumber}`;

                        // Insert new variable `@{{variableName}}`
                        field.value = `${textBeforeCursor}@{{${variableName}}}${textAfterCursor}`;
                        field.selectionStart = field.selectionEnd = cursorPosition + `@{{${variableName}}}`.length;

                        // Update example fields
                        updateExampleFields();
                    }
                }

                function validateBodyText(bodyText, validationMessage) {
                    const text = bodyText.value;
                    const cleanText = text.replace(/@{{\d+}}/g, '').trim();
                    const wordsCount = cleanText.split(/\s+/).filter(Boolean).length;
                    const variablesCount = (text.match(/@{{\d+}}/g) || []).length;

                    let minWordsRequired;
                    switch (variablesCount) {
                        case 1: minWordsRequired = 2; break;
                        case 2: minWordsRequired = 5; break;
                        case 3: minWordsRequired = 7; break;
                        case 4: minWordsRequired = 9; break;
                        case 5: minWordsRequired = 11; break;
                        default: minWordsRequired = 0;
                    }

                    validationMessage.style.display = variablesCount > 0 && wordsCount < minWordsRequired ? "block" : "none";
                }
            });

            footerTextFields.forEach((footerText) => {
                const validationMessage = document.createElement("small");
                validationMessage.classList.add("form-text", "text-danger");
                validationMessage.style.display = "none";
                validationMessage.innerText = "El pie de página no debe contener variables y debe tener un máximo de 60 caracteres.";
                footerText.parentNode.appendChild(validationMessage);

                // Function to validate footer text
                function validateFooterText() {
                    const text = footerText.value;

                    // Check if the text contains any variable (like {{1}})
                    const hasVariable = /@{{\d+}}/.test(text);
                    const exceedsMaxLength = text.length > 60;

                    // Show validation message if either condition is violated
                    if (hasVariable || exceedsMaxLength) {
                        validationMessage.style.display = "block";
                    } else {
                        validationMessage.style.display = "none";
                    }
                }

                footerText.addEventListener("input", function () {
                    validateFooterText(); // Validate on input
                });
            });

            // Event listeners for dropdown items
            document.getElementById('quick_replay_button').addEventListener('click', function () {
                addQuickReplyButton('Respuesta preconfigurada');
            });

            document.getElementById('quick_replay_custon_button').addEventListener('click', function () {
                addQuickReplyButton('Personalizado');
            });

            document.getElementById('go_to_web_button').addEventListener('click', function () {
                addCallToActionButton('Ir a Web');
            });

            document.getElementById('call_button').addEventListener('click', function () {
                addCallToActionButton('Llamar a numero de telefono');
            });

            document.getElementById('copy_code_button').addEventListener('click', function () {
                addCallToActionButton('Copiar codigo de oferta');
            });







            document.getElementById('create_quick_replay_button').addEventListener('click', function () {
                addQuickReplyButtonCreate('Respuesta preconfigurada');
            });

            document.getElementById('create_quick_replay_custon_button').addEventListener('click', function () {
                addQuickReplyButtonCreate('Personalizado');
            });

            document.getElementById('create_go_to_web_button').addEventListener('click', function () {
                addCallToActionButtonCreate('Ir a Web');
            });

            document.getElementById('create_call_button').addEventListener('click', function () {
                addCallToActionButtonCreate('Llamar a numero de telefono');
            });

            document.getElementById('create_copy_code_button').addEventListener('click', function () {
                addCallToActionButtonCreate('Copiar codigo de oferta');
            });

            // Event delegation for remove buttons
            buttonsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-button')) {
                    e.target.closest('.row').remove();
                }
            });

            buttonsCreateContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-button')) {
                    e.target.closest('.row').remove();
                }
            });


            // Function to open edit modal and load data
            function openEditModal(button) {
                // Limpiar el formulario antes de cargar nuevos datos
                clearFormFields();

                const templateId = button.getAttribute("data-template-id");

                $.ajax({
                    url: '{{ route('template.json') }}', // Ruta de Laravel para obtener los detalles de la plantilla
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: templateId
                    },
                    success: function (data) {
                        // Mapea los datos del JSON a los campos del formulario
                        console.log(data);
                        document.getElementById('editTemplateName').value = data.name;
                        document.getElementById('editTemplateLanguage').value = data.language;
                        document.getElementById('editTemplateId').value = data.id;

                        // Buscar y asignar datos de header, body y footer
                        data.components.forEach(component => {
                            if (component.type === "HEADER") {
                                // Cargar imagen de la plantilla si existe
                                if (component.format === "IMAGE" && component.example.header_handle) {
                                    document.querySelector('#previewImage img').src = component.example.header_handle;
                                }

                                $('#editTemplateHeader').val(component.format).trigger('change');
                                document.getElementById('editHeaderText').value = component.text || '';
                                const headerText = document.getElementById('editHeaderText');

                                // Remove existing example fields
                                const existingExamples = headerText.parentNode.querySelectorAll('.example-field');
                                existingExamples.forEach(field => field.remove());

                                // Crear nuevos campos de ejemplo basados en los datos del JSON
                                const headerExamples = component.example?.header_text || [];
                                headerExamples.forEach((example, index) => {
                                    const exampleField = document.createElement('input');
                                    exampleField.type = 'text';
                                    exampleField.placeholder = `Ejemplo para @{{${index + 1}}}`;
                                    exampleField.value = example; // Llenar con el ejemplo correspondiente
                                    exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Add classes for styling
                                    headerText.parentNode.appendChild(exampleField);
                                });



                            } else if (component.type === "BODY") {
                                document.getElementById('editBodyText').value = component.text || '';
                                const bodyText = document.getElementById('editBodyText');

                                // Remove existing example fields
                                const existingExamples = bodyText.parentNode.querySelectorAll('.example-field');
                                existingExamples.forEach(field => field.remove());

                                // Crear nuevos campos de ejemplo basados en los datos del JSON
                                const bodyExamples = component.example?.body_text || [];
                                bodyExamples.forEach((exampleArray, index) => {
                                    exampleArray.forEach((example, exampleIndex) => {
                                        const exampleField = document.createElement('input');
                                        exampleField.type = 'text';
                                        exampleField.placeholder = `Ejemplo para @{{${index + 1}}}`;
                                        exampleField.value = example; // Llenar con el ejemplo correspondiente
                                        exampleField.classList.add('form-control', 'mb-2', 'example-field'); // Add classes for styling
                                        bodyText.parentNode.appendChild(exampleField);
                                    });
                                });

                            } else if (component.type === "FOOTER") {
                                document.getElementById('editFooterText').value = component.text || '';
                            } else if (component.type === "BUTTONS" && component.buttons) {
                                // Asigna los datos de los botones si existen
                                component.buttons.forEach(button => {
                                    if (button.type === "QUICK_REPLY") {
                                        addQuickReplyButton('Respuesta preconfigurada', button.text);
                                    } else if (button.type === "URL") {
                                        addCallToActionButton('Ir a Web', button.text, button.url);
                                    } else if (button.type === "PHONE_NUMBER") {
                                        addCallToActionButton('Llamar a numero de telefono', button.text, '', button.phone_number);
                                    } else if (button.type === "COPY_CODE") {
                                        addCallToActionButton('Copiar codigo de oferta', button.text, '', '', button.example[0]);
                                    }
                                });
                            }
                        });

                        // Mostrar el modal después de cargar los datos
                        $('#modal_edit_template').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud:', error);
                        alert("Hubo un error al cargar los datos de la plantilla. Por favor, intenta de nuevo.");
                    }
                });
            }

            // Function to submit the edit template form
            function submitEditTemplateForm(event) {
                event.preventDefault();

                // Obtener los valores del formulario
                const templateName = document.getElementById('editTemplateName').value;
                const templateLanguage = document.getElementById('editTemplateLanguage').value;
                const headerType = document.getElementById('editTemplateHeader').value;
                const headerText = document.getElementById('editHeaderText').value;
                const bodyText = document.getElementById('editBodyText').value;
                const footerText = document.getElementById('editFooterText').value;
                const category = document.getElementById('editCategory').value;
                const templateId = document.getElementById('editTemplateId').value;
                const apiVersion = 'v21.0';

                // Construir la estructura del JSON
                const jsonBody = {
                    name: templateName,
                    components: [],
                    language: templateLanguage,
                    category: category
                };

                // Agregar HEADER si está presente
                if (headerType !== 'ninguno') {
                    const headerComponent = {
                        type: "HEADER",
                        format: headerType
                    };

                    if (headerType === 'TEXT') {
                        headerComponent.text = headerText;

                        // Verificar si el HEADER contiene un único comodín
                        const matches = headerText.match(/\{\{\d+\}\}/g);
                        if (matches && matches.length === 1) {
                            headerComponent.example = {
                                header_text: ""
                            };
                            const headerExampleField = document.getElementById('createHeaderText').parentNode.querySelector('.example-field');
                            if (headerExampleField) {
                                headerComponent.example.header_text = headerExampleField.value.trim(); // Almacena como string
                            }
                        }
                    } else if (headerType === 'IMAGE' || headerType === 'VIDEO' || headerType === 'DOCUMENT') {
                        const headerFileInput = document.getElementById(`createHeader${headerType.charAt(0) + headerType.slice(1).toLowerCase()}`);
                        if (headerFileInput.files.length > 0) {
                            const file = headerFileInput.files[0];
                            headerComponent.file = file;
                        }
                    }

                    jsonBody.components.push(headerComponent);
                }

                // Agregar BODY con validación de variables
                if (bodyText) {
                    const bodyComponent = {
                        type: "BODY",
                        text: bodyText
                    };

                    // Verificar si el BODY contiene variables
                    if (/\{\{\d+\}\}/.test(bodyText)) {
                        bodyComponent.example = {
                            body_text: []
                        };
                        const bodyExamples = document.getElementById('editBodyText').parentNode.querySelectorAll('.example-field');
                        const bodyExampleValues = [];

                        bodyExamples.forEach((exampleField) => {
                            bodyExampleValues.push(exampleField.value.trim());
                        });

                        bodyComponent.example.body_text.push(bodyExampleValues);
                    }

                    jsonBody.components.push(bodyComponent);
                }

                // Agregar FOOTER si está presente
                if (footerText) {
                    jsonBody.components.push({
                        type: "FOOTER",
                        text: footerText
                    });
                }

                // Construcción dinámica del campo de botones
                const buttons = [];

                // Obtener todos los botones dinámicos
                document.querySelectorAll('.quick_replay_button_group, .call_to_action_button_group').forEach(buttonGroup => {
                    const buttonTypeElement = buttonGroup.querySelector('select[name="call_to_action_button_type"], select[name="quick_replay_button_type"]');
                    if (buttonTypeElement) {
                        const buttonType = buttonTypeElement.value;
                        const buttonText = buttonGroup.querySelector('input[name="call_to_action_button_text"], input[name="quick_replay_button_text"]').value;
                        let buttonData = { type: buttonType, text: buttonText };

                        if (buttonType === 'URL') {
                            buttonData.url = buttonGroup.querySelector('input[name="call_to_action_button_url"]').value;
                        } else if (buttonType === 'PHONE_NUMBER') {
                            buttonData.phone_number = buttonGroup.querySelector('input[name="call_to_action_button_phone"]').value;
                        } else if (buttonType === 'COPY_CODE') {
                            buttonData.example = [buttonGroup.querySelector('input[name="call_to_action_button_code"]').value];
                        }

                        buttons.push(buttonData);
                    }
                });

                // Agregar botones a los componentes si existen
                if (buttons.length > 0) {
                    jsonBody.components.push({
                        type: "BUTTONS",
                        buttons: buttons
                    });
                }

                // Enviar la solicitud al controlador de Laravel
                $.ajax({
                    url: '{{ route('template.update') }}', // Ruta de Laravel para actualizar la plantilla
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        action: 'update_template',
                        apiVersion: apiVersion,
                        templateId: templateId,
                        jsonBody: jsonBody,
                        _token: '{{ csrf_token() }}'
                    }),
                    success: function (data) {
                        console.log('Éxito:', data);
                        alert("Plantilla actualizada con éxito. Se debe esperar por la revisión de META.");
                        $('#modal_edit_template').modal('hide');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud:', error);

                        if (xhr.responseJSON && xhr.responseJSON.error && xhr.responseJSON.error.error_user_msg) {
                            alert(xhr.responseJSON.error.error_user_msg); // Muestra un mensaje específico si está disponible
                        } else {
                            alert("Hubo un error al actualizar la plantilla. Por favor, intenta de nuevo.");
                        }
                    }
                });
            }

            // Attach submit event to the form
            document.getElementById('editTemplateForm').addEventListener('submit', submitEditTemplateForm);


            // Function to submit the create template form
            function submitCreateTemplateForm(event) {
                event.preventDefault();

                // Obtener los valores del formulario
                const templateName = document.getElementById('createTemplateName').value;
                const templateLanguage = document.getElementById('createTemplateLanguage').value;
                const templateCategory = document.getElementById('createTemplateCategory').value;
                const headerType = document.getElementById('createTemplateHeader').value;
                const headerText = document.getElementById('createHeaderText').value;
                const bodyText = document.getElementById('createBodyText').value;
                const footerText = document.getElementById('createFooterText').value;
                const apiVersion = 'v21.0';

                // Construir la estructura del JSON
                const jsonBody = {
                    name: templateName,
                    components: [],
                    language: templateLanguage,
                    category: templateCategory
                };

                // Crear un FormData para manejar la subida de archivos
                const formData = new FormData();
                formData.append('name', templateName);
                formData.append('language', templateLanguage);
                formData.append('category', templateCategory);
                formData.append('_token', '{{ csrf_token() }}');

                // Agregar HEADER si está presente
                if (headerType !== 'ninguno') {
                    const headerComponent = {
                        type: "HEADER",
                        format: headerType
                    };

                    if (headerType === 'TEXT') {
                        headerComponent.text = headerText;

                        // Verificar si el HEADER contiene un único comodín
                        const matches = headerText.match(/\{\{\d+\}\}/g);
                        if (matches && matches.length === 1) {
                            headerComponent.example = {
                                header_text: ""
                            };
                            const headerExampleField = document.getElementById('createHeaderText').parentNode.querySelector('.example-field');
                            if (headerExampleField) {
                                headerComponent.example.header_text = headerExampleField.value.trim(); // Almacena como string
                            }
                        }
                    } else if (headerType === 'IMAGE' || headerType === 'VIDEO' || headerType === 'DOCUMENT') {
                        const headerFileInput = document.getElementById(`createHeader${headerType.charAt(0) + headerType.slice(1).toLowerCase()}`);
                        if (headerFileInput.files.length > 0) {
                            const file = headerFileInput.files[0];
                            formData.append('header_file', file);
                            // No agregues el nombre del archivo al JSON aquí
                        }
                    }

                    jsonBody.components.push(headerComponent);
                }

                // Agregar BODY con validación de variables
                if (bodyText) {
                    const bodyComponent = {
                        type: "BODY",
                        text: bodyText
                    };

                    // Verificar si el BODY contiene variables
                    if (/\{\{\d+\}\}/.test(bodyText)) {
                        bodyComponent.example = {
                            body_text: []
                        };
                        const bodyExamples = document.getElementById('createBodyText').parentNode.querySelectorAll('.example-field');
                        const bodyExampleValues = [];

                        bodyExamples.forEach((exampleField) => {
                            bodyExampleValues.push(exampleField.value.trim());
                        });

                        bodyComponent.example.body_text.push(bodyExampleValues);
                    }

                    jsonBody.components.push(bodyComponent);
                }

                // Agregar FOOTER si está presente
                if (footerText) {
                    jsonBody.components.push({
                        type: "FOOTER",
                        text: footerText
                    });
                }

                // Construcción dinámica del campo de botones
                const buttons = [];

                // Obtener todos los botones dinámicos
                document.querySelectorAll('.create_quick_replay_button_group, .create_call_to_action_button_group').forEach(buttonGroup => {
                    const buttonTypeElement = buttonGroup.querySelector('select[name="call_to_action_button_type"], select[name="quick_replay_button_type"]');
                    if (buttonTypeElement) {
                        const buttonType = buttonTypeElement.value;
                        const buttonText = buttonGroup.querySelector('input[name="call_to_action_button_text"], input[name="quick_replay_button_text"]').value;
                        let buttonData = { type: buttonType, text: buttonText };

                        if (buttonType === 'URL') {
                            buttonData.url = buttonGroup.querySelector('input[name="call_to_action_button_url"]').value;
                        } else if (buttonType === 'PHONE_NUMBER') {
                            buttonData.phone_number = buttonGroup.querySelector('input[name="call_to_action_button_phone"]').value;
                        } else if (buttonType === 'COPY_CODE') {
                            buttonData.example = [buttonGroup.querySelector('input[name="call_to_action_button_code"]').value];
                        }

                        buttons.push(buttonData);
                    }
                });

                // Agregar botones a los componentes si existen
                if (buttons.length > 0) {
                    jsonBody.components.push({
                        type: "BUTTONS",
                        buttons: buttons
                    });
                }

                // Agregar el JSON al FormData
                formData.append('jsonBody', JSON.stringify(jsonBody));
                console.log(jsonBody);

                // Enviar la solicitud al controlador de Laravel
                $.ajax({
                    url: '{{ route('template.create') }}', // Ruta de Laravel para crear la plantilla
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (data) {
                        console.log('Éxito:', data);
                        alert("Plantilla creada con éxito. Se debe esperar por la revisión de META.");
                        $('#modal_create_template').modal('hide');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud:', error);

                        if (xhr.responseJSON) {
                            const errorMsg = xhr.responseJSON.error_user_msg || xhr.responseJSON.message || "Hubo un error al crear la plantilla. Por favor, intenta de nuevo.";
                            alert(errorMsg); // Muestra un mensaje específico si está disponible
                        } else {
                            alert("Hubo un error al crear la plantilla. Por favor, intenta de nuevo.");
                        }
                    }
                });
            }

            // Attach submit event to the form
            document.getElementById('createTemplateForm').addEventListener('submit', submitCreateTemplateForm);

            // Función para limpiar los campos del formulario
            // function clearFormFields() {
            //     document.getElementById('editTemplateForm').reset();
            //     $('#variableFields').empty();
            // }

            // Delegación de eventos para abrir el modal de edición


            $(document).on('click', '.modal-editTemplate', function () {
                openEditModal(this);
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
                    url: '{{ route('template.detail') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        json: json,
                        template_id: template_Id,
                        wa_template_id: waTemplateId
                    },
                    success: function (response) {
                        // Manejar la respuesta
                        console.log(response);
                        $('#detail_template_body').html(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });


                $.ajax({
                    url: '{{ route('template.json') }}', // Ruta de Laravel para obtener los detalles de la plantilla
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: template_Id
                    },
                    success: function (data) {
                        // Mapea los datos del JSON a los campos del formulario
                        console.log(data);

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
                                const matches = component.text.match(/@{{\d+}}/g);
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
                                        const matches = button.url.match(/@{{\d+}}/g);
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
                    url: '{{ route('template.send') }}', // Usar la URL de acción del formulario
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


            // document.getElementById('voiceForm').addEventListener('submit', function(event) {
            //     event.preventDefault();
            //     const text = document.getElementById('textInput').value;

            //     fetch('/generate-voice', {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //         },
            //         body: JSON.stringify({ text: text })
            //     })
            //     .then(response => response.blob())
            //     .then(blob => {
            //         const audioUrl = URL.createObjectURL(blob);
            //         const audioPlayback = document.getElementById('audioPlayback');
            //         audioPlayback.src = audioUrl;
            //         audioPlayback.style.display = 'block';
            //         audioPlayback.play();
            //     })
            //     .catch(error => console.error('Error:', error));
            // });
        });

    </script>
@stop
