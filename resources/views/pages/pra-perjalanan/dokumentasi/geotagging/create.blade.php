@extends('pages.layouts.master')
@section('content')
@section('title', 'Geo Tagging')

<style>
    #video {
        width: 100%;
        max-width: 400px;
        margin-bottom: 10px;
    }
    #map {
        height: 400px;
    }
</style>

<!-- Load OpenLayers from CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@6.8.1/dist/ol.css" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/ol@6.8.1/dist/ol.js" type="text/javascript"></script>


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Geo Tagging</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Surat Pra Perjalanan</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Dokumentasi</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Geo Tagging</a>
                </li>
            </ul>
        </div>

        <form method="POST" action="{{ route('webcam.capture') }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-6">
                                <div id="my_camera"></div>
                                {{-- <video id="video" playsinline autoplay></video><br> --}}
                                <br/>
                                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" name="image" class="image-tag">
                            </div>
                            <div class="col-md-6">
                                <div id="results"></div>
                            </div>
                            <div class="col-md-12 text-center">
                                <br/>
                                <button class="btn btn-success">Submit</button>
                            </div>
                            <!-- Use hidden input fields for latitude and longitude -->
                            <input id="id" type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                            <input id="id" type="hidden" class="form-control" name="id_staff_perjalanan" value="{{ $dataStaff->id }}">
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <p id="location">Latitude: <span id="latitude-display"></span>, Longitude: <span id="longitude-display"></span></p>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('js')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script>
    // Ensure that Webcam.js is loaded before executing this script
    Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
<script>
    $(document).ready(function () {
        const video = document.getElementById('video');
        const latitudeElement = $('#latitude');
        const longitudeElement = $('#longitude');
        const latitudeDisplay = $('#latitude-display'); // Display span for latitude
        const longitudeDisplay = $('#longitude-display'); // Display span for longitude
        const mapElement = document.getElementById('map');
        let map;
        let marker;

        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((error) => {
                console.error('Error accessing camera: ', error);
            });

        getLocation(); // Call getLocation() when the document is ready

        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach( '#my_camera' );

        function take_snapshot() {
            console.log('Taking snapshot...');
            Webcam.snap( function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            } );
        }


        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Update the latitude and longitude elements
                    latitudeElement.val(latitude);
                    longitudeElement.val(longitude);
                    latitudeDisplay.text(latitude);
                    longitudeDisplay.text(longitude);

                    console.log('Latitude: ', latitude);
                    console.log('Longitude: ', longitude);

                    // Update the map with the new location
                    updateMap(latitude, longitude);
                }, (error) => {
                    console.error('Error getting location: ', error);
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }

        function updateMap(latitude, longitude) {
            // Check if the map is already initialized
            if (!map) {
                // Initialize the map
                map = new google.maps.Map(mapElement, {
                    center: { lat: latitude, lng: longitude },
                    zoom: 15
                });
            } else {
                // Move the map to the new location
                map.setCenter({ lat: latitude, lng: longitude });
            }

            // Remove previous marker
            if (marker) {
                marker.setMap(null);
            }

            // Add a new marker for the current location
            marker = new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: 'Current Location'
            });
        }
    });
</script>

<!-- Include the Google Maps API with your API key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6lX-qLPjxyR960WMyZUh_PSg5GtpB6Jo&libraries=places"></script>

@endpush
