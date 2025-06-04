<div class="container-fluid">
    <form action="" id="booking-form">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <input type="hidden" name="cab_id" value="<?= isset($_GET['cid']) ? $_GET['cid'] : (isset($cab_id) ? $cab_id : "") ?>">
        <div class="form-group">
            <label for="pickup_zone" class="control-label">Pickup Location</label>
            <div class="input-group">
                <input type="text" name="pickup_zone" id="pickup_zone" class="form-control form-control-sm rounded-0" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="pickup_map_btn">
                        <i class="fas fa-map-marker-alt"></i> <!-- Location icon -->
                    </button>
                </div>
            </div>
            <div id="pickup_map_container" style="display: none; height: 300px; width: 100%; margin-top: 10px;"></div>
        </div>
        <div class="form-group">
            <label for="drop_zone" class="control-label">Drop-off Location</label>
            <div class="input-group">
                <input type="text" name="drop_zone" id="drop_zone" class="form-control form-control-sm rounded-0" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm btn-outline-primary" id="dropoff_map_btn">
                        <i class="fas fa-map-marker-alt"></i> <!-- Location icon -->
                    </button>
                </div>
            </div>
            <div id="dropoff_map_container" style="display: none; height: 300px; width: 100%; margin-top: 10px;"></div>
        </div>
        <!-- Use your existing "Save" button here -->
    </form>
</div>

<!-- Include Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<script>
$(document).ready(function() {
    // Function to fetch detailed location name using Nominatim
    function fetchLocationName(lat, lng, callback) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
            .then(response => response.json())
            .then(data => {
                if (data.display_name) {
                    callback(data.display_name); // Full address with details
                } else {
                    callback('Unknown Location');
                }
            })
            .catch(error => {
                console.error('Error fetching location name:', error);
                callback('Unknown Location');
            });
    }

    // Initialize the map for pickup location
    var pickupMap, pickupMarker;
    $('#pickup_map_btn').click(function() {
        $('#pickup_map_container').toggle(); // Show/hide map
        if (!pickupMap) {
            pickupMap = L.map('pickup_map_container').setView([8.7139, 77.7567], 13); // Center on Tirunelveli
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '' // Remove the watermark
            }).addTo(pickupMap);

            // Add click event to the map
            pickupMap.on('click', function(e) {
                if (pickupMarker) pickupMap.removeLayer(pickupMarker);
                pickupMarker = L.marker(e.latlng, { draggable: true }).addTo(pickupMap);

                // Fetch detailed location name
                fetchLocationName(e.latlng.lat, e.latlng.lng, function(name) {
                    $('#pickup_zone').val(name); // Set detailed location name in input field
                });
            });
        }
    });

    // Initialize the map for drop-off location
    var dropoffMap, dropoffMarker;
    $('#dropoff_map_btn').click(function() {
        $('#dropoff_map_container').toggle(); // Show/hide map
        if (!dropoffMap) {
            dropoffMap = L.map('dropoff_map_container').setView([8.7139, 77.7567], 13); // Center on Tirunelveli
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '' // Remove the watermark
            }).addTo(dropoffMap);

            // Add click event to the map
            dropoffMap.on('click', function(e) {
                if (dropoffMarker) dropoffMap.removeLayer(dropoffMarker);
                dropoffMarker = L.marker(e.latlng, { draggable: true }).addTo(dropoffMap);

                // Fetch detailed location name
                fetchLocationName(e.latlng.lat, e.latlng.lng, function(name) {
                    $('#drop_zone').val(name); // Set detailed location name in input field
                });
            });
        }
    });

    // Handle form submission (using your existing "Save" button)
    $('#booking-form').submit(function(e) {
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_booking",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: function(err) {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.href = './?p=booking_list';
                } else if (resp.status == 'failed' && !!resp.msg) {
                    var el = $('<div>');
                    el.addClass("alert alert-danger err-msg").text(resp.msg);
                    _this.prepend(el);
                    el.show('slow');
                    $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                    end_loader();
                } else {
                    alert_toast("An error occurred", 'error');
                    end_loader();
                    console.log(resp);
                }
            }
        });
    });
});
</script>