@extends('layouts.main')
@section('title', 'Contact Us')
@section('custom-css')
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
@endsection
@section('custom-js')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="js/contact.js"></script>
<script src="plugins/easing/easing.js"></script>
@endsection
@section('content')
<div class="home">
    <div class="home_container">
        <div class="home_background" style="background-image:url(images/contact.jpg)"></div>
        <div class="home_content_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Contact</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact -->

<div class="contact">
    <div class="container">
        <div class="row">

            <!-- Get in touch -->
            <div class="col-lg-8 contact_col">
                <div class="get_in_touch">
                    <div class="section_title">Get in Touch</div>
                    <div class="section_subtitle">Say hello</div>
                    <div class="contact_form_container">
                        @if (Session::has('message'))
                            <div class="alert alert-success">{{ Session::get('message') }}</div>
                        @endif
                        <form action="{{ route('contact.post') }}" method="POST" id="contact_form" class="contact_form">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <!-- Name -->
                                    <label for="contact_name">First Name*</label>
                                    <input type="text" name="f_name" id="contact_name" class="contact_input" required>
                                </div>
                                <div class="col-xl-6 last_name_col">
                                    <!-- Last Name -->
                                    <label for="contact_last_name">Last Name*</label>
                                    <input type="text" name="l_name" id="contact_last_name" class="contact_input" required>
                                </div>
                            </div>
                            <div>
                                <!-- Subject -->
                                <label for="contact_company">Subject*</label>
                                <input required type="text" name="subject" id="contact_company" class="contact_input">
                            </div>
                            <div>
                                <!-- Subject -->
                                <label for="contact_company">E-Mail*</label>
                                <input required type="email" name="email" id="contact_email" class="contact_input">
                            </div>
                            <div>
                                <label for="contact_textarea">Message*</label>
                                <textarea name="mail" id="contact_textarea" class="contact_input contact_textarea" required></textarea>
                            </div>
                            <button type='submit' class="button contact_button"><span>Send Message</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 offset-xl-1 contact_col">
                <div class="contact_info">
                    <div class="contact_info_section">
                        <div class="contact_info_title">Marketing</div>
                        <ul>
                            <li>Phone: <span>+53 345 7953 3245</span></li>
                            <li>Email: <span>yourmail@gmail.com</span></li>
                        </ul>
                    </div>
                    <div class="contact_info_section">
                        <div class="contact_info_title">Shippiing & Returns</div>
                        <ul>
                            <li>Phone: <span>+53 345 7953 3245</span></li>
                            <li>Email: <span>yourmail@gmail.com</span></li>
                        </ul>
                    </div>
                    <div class="contact_info_section">
                        <div class="contact_info_title">Information</div>
                        <ul>
                            <li>Phone: <span>+53 345 7953 3245</span></li>
                            <li>Email: <span>yourmail@gmail.com</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row map_row">
            <div class="col">

                <!-- Google Map -->
                <div class="map">
                    <div id="google_map" class="google_map">
                        <div class="map_container">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection