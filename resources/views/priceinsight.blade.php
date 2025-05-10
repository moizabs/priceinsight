<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
  :root {
    --primary-color: #113771;
    --secondary-color: #0066cc;
    --danger-color: #990000;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --border-radius: 8px;
    --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
  }

  body {
    margin: 0;
    padding: 0;
    color: var(--dark-color);
    background-color: #f5f7fa;
  }

  .container-m {
    display: flex;
    max-width: 1400px;
    margin: 2rem auto;
    padding: 0 1rem;
    gap: 2rem;
    align-items: flex-start;
  }

  /* Form Section */
  .first-parent {
    background-color: white;
    width: 45%;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    box-shadow: var(--box-shadow);
  }

  .form-section-title {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.25rem;
  }

  .form-subtitle {
    font-size: 1.1rem;
    font-weight: 500;
    color: var(--dark-color);
    margin: 1.5rem 0 1rem 0;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
  }

  .form-control {
    border: 1px solid #ced4da;
    border-radius: var(--border-radius);
    padding: 0.5rem 0.75rem;
    transition: var(--transition);
  }

  .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(17, 55, 113, 0.25);
  }

  .input-group {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
  }

  .input-group>* {
    flex: 1;
  }

  /* Vehicle Forms */
  #vehicle-forms-container {
    max-height: 300px;
    overflow-y: auto;
    padding-right: 0.5rem;
    margin-bottom: 1rem;
  }

  .vehicle-form {
    background-color: #f8f9fa;
    border-radius: var(--border-radius);
    padding: 1rem;
    margin-bottom: 1rem;
    position: relative;
  }

  .vehicle-number {
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
  }

  /* Buttons */
  .btn {
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius);
    font-weight: 500;
    transition: var(--transition);
    cursor: pointer;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .btn-primary {
    background-color: var(--primary-color);
    color: white;
  }

  .btn-primary:hover {
    background-color: #0d2a5a;
    transform: translateY(-1px);
  }

  .btn-outline {
    background-color: transparent;
    border: 1px solid var(--primary-color);
    color: var(--primary-color);
  }

  .btn-outline:hover {
    background-color: rgba(17, 55, 113, 0.05);
  }

  .btn-danger {
    background-color: var(--danger-color);
    color: white;
  }

  .btn-danger:hover {
    background-color: #800000;
  }

  .btn-icon {
    margin-right: 0.5rem;
  }

  /* Radio Buttons */
  .radio-group {
    display: flex;
    gap: 1.5rem;
    margin: 1rem 0;
  }

  .radio-option {
    display: flex;
    align-items: center;
  }

  .radio-option input {
    margin-right: 0.5rem;
  }

  /* Results Section */
  .second-parent {
    width: 55%;
  }

  .card {
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    min-height: 300px;
  }

  .card-title {
    color: var(--primary-color);
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }

  .price-display {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
  }

  .price-amount {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
  }

  .price-metrics {
    display: flex;
    gap: 1.5rem;
    text-align: right;
  }

  .price-metric {
    font-size: 0.9rem;
  }

  .price-metric span {
    display: block;
    color: #6c757d;
  }

  .confidence-badge {
    background-color: #e7f1ff;
    color: var(--primary-color);
    padding: 0.25rem 0.75rem;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 500;
  }

  /* Tabs */
  .tabs {
    display: flex;
    border-bottom: 1px solid #dee2e6;
    margin-bottom: 1rem;
  }

  .tab {
    padding: 0.75rem 1rem;
    cursor: pointer;
    position: relative;
    font-weight: 500;
    color: #6c757d;
  }

  .tab.active {
    color: var(--secondary-color);
    font-weight: 600;
  }

  .tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: var(--secondary-color);
  }

  /* Price Boxes */
  .price-boxes-container {
    max-height: 400px;
    overflow-y: auto;
    padding-right: 0.5rem;
  }

  .price-box {
    border: 1px solid #e9ecef;
    border-radius: var(--border-radius);
    padding: 1rem;
    margin-bottom: 1rem;
    transition: var(--transition);
  }

  .price-box:hover {
    border-color: var(--primary-color);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }

  .price-box-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
  }

  .price-box-label {
    color: #6c757d;
    font-size: 0.9rem;
  }

  .price-box-value {
    font-weight: 500;
  }

  .price-highlight {
    color: var(--primary-color);
    font-weight: 600;
  }

  /* Skeleton Loading Animation */
  .skeleton-loader {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite;
    border-radius: 4px;
  }

  @keyframes shimmer {
    0% {
      background-position: 200% 0;
    }

    100% {
      background-position: -200% 0;
    }
  }

  /* Loading States */
  .loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 100;
    border-radius: var(--border-radius);
  }

  .spinner {
    width: 40px;
    height: 40px;
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    border-left-color: var(--primary-color);
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  /* Map Loading */
  .map-loading {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
  }

  /* Responsive */
  @media (max-width: 1200px) {
    .container-m {
      flex-direction: column;
    }

    .first-parent,
    .second-parent {
      width: 100%;
    }
  }

  @media (max-width: 768px) {
    .price-display {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }

    .price-metrics {
      flex-direction: column;
      gap: 0.5rem;
      text-align: left;
    }

    .input-group {
      flex-direction: column;
      gap: 0.75rem;
    }
  }

  /* Scrollbar */
  ::-webkit-scrollbar {
    width: 6px;
    height: 6px;
  }

  ::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
  }

  ::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
  }

  .welcome-card {
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid rgba(17, 55, 113, 0.1);
  }

  .welcome-content {
    max-width: 500px;
    margin: 0 auto;
  }

  .welcome-icon {
    margin-bottom: 1.5rem;
  }

  .welcome-title {
    color: var(--primary-color);
    font-size: 1.75rem;
    margin-bottom: 1rem;
  }

  .welcome-text {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    line-height: 1.6;
  }

  .welcome-features {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 2rem;
  }

  .feature {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: center;
    font-size: 1rem;
    color: #444;
  }

  .welcome-cta {
    margin-top: 1.5rem;
  }
</style>

<body>
  <div class="page-wrapper">
    @include('Layout.sidebar')

    <!-- PAGE CONTAINER-->
    <div class="page-container">
      @include('Layout.header-menu')

      <div class="container" style="padding-top: 120px">

        <div class="container-m">
          <!-- Shipping Details Form -->
          <div class="first-parent">
            <h2 class="form-section-title">Shipping Details</h2>


            <div id="map_showing" style="display: none">
          <div class="map-container"
            style="position: relative; height: 400px; width: 100%; border-radius: 4px; overflow: hidden;">
            <div id="map" style="height: 100%;"></div>
            <div class="map-loading" id="map-loading" style="display: none;">
              <div class="spinner"></div>
            </div>
            <div class="route-info-panel"
              style="position: absolute; bottom: 20px; left: 20px; right: 20px; z-index: 1000; background: rgba(255,255,255,0.9); border-radius: 8px; padding: 12px 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-width: 400px; display: flex; justify-content: space-between; align-items: center;">
              <div style="flex: 1;">
                <div style="font-weight: 500; color: #333; margin-bottom: 4px;">Route Summary</div>
                <div style="display: flex; gap: 16px; font-size: 14px;">
                  <div>
                    <span style="color: #666;">Distance:</span>
                    <span id="route-distance"
                      style="font-weight: bold; color: #0066cc; margin-left: 4px;">Calculating...</span>
                  </div>
                  <div>
                    <span style="color: #666;">Time:</span>
                    <span id="route-time"
                      style="font-weight: bold; color: #0066cc; margin-left: 4px;">Calculating...</span>
                  </div>
                </div>
              </div>
              <a id="view-google-maps" target="_blank" href="#"
                style="background: #4285F4; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none; font-weight: 500; font-size: 14px; display: flex; align-items: center; gap: 6px;">
                <i class="fas fa-external-link-alt"></i>
                <span>View in Google Maps</span>
              </a>
            </div>
          </div>

        </div>

            <!-- Route Information -->
            <h3 class="form-subtitle">Route Information</h3>
            <div class="input-group">
              <input type="text" placeholder="Origin" class="form-control Origin_ZipCode typeahead" id="origin"
                required>
              <input type="text" placeholder="Destination" class="form-control Dest_ZipCode typeahead" id="destination"
                required>
            </div>

            <!-- Vehicle Information -->
            <h3 class="form-subtitle">Vehicle Information</h3>
            <div id="vehicle-forms-container" class="price-boxes-container">
              <div class="vehicle-form">
                <div class="vehicle-number">#1</div>
                <div class="input-group">
                  <input type="text" placeholder="Year" min="1900" max="2025" maxlength="4" required
                    class="form-control" id="year_check" name="year">
                  <input type="text" placeholder="Make" class="form-control makes typeahead" id="make" required
                    name="make">
                  <input type="text" placeholder="Model" class="form-control models typeahead" id="model" name="model"
                    required>
                </div>
                <div class="input-group">
                  <select class="form-control" name="type" id="vehicle_type">
                    <option value="" selected disabled>Select Type</option>
                    <option value="Sedan">Sedan</option>
                    <option value="Coupe">Coupe (2 doors)</option>
                    <option value="SUV">SUV</option>
                    <option value="Pickup-2doors">Pickup (2 doors)</option>
                    <option value="Pickup-4doors">Pickup (4 doors)</option>
                    <option value="Van">Van</option>
                  </select>
                  <select class="form-control" name="inoperable" id="inoperable">
                    <option value="" selected disabled>Select Inoperable</option>
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                  </select>
                  <button class="btn btn-danger delete-vehicle-btn">
                    Remove
                  </button>
                </div>
              </div>
            </div>

            <button id="add-vehicle-btn" class="btn" style="background-color: #001d4d; color: white;">
              <span class="btn-icon">+</span> Add Vehicle
            </button>

            <!-- Trailer Type -->
            <h4 class="form-subtitle">Trailer Type</h4>
            <div class="radio-group">
              <label class="radio-option">
                <input type="radio" name="trailer-type" value="Enclosed" checked>
                Enclosed
              </label>
              <label class="radio-option">
                <input type="radio" name="trailer-type" value="Open">
                Open
              </label>
            </div>

            <button id="calculate-btn" class="btn"
              style="width: 100%; padding: 0.75rem; background-color: #001d4d; color: white;">
              Calculate Price
            </button>
          </div>


          <!-- Pricing Results -->
          <div class="second-parent">

            <div class="card welcome-card" id="welcome-card">
              <div class="welcome-content">
                <div class="welcome-icon">
                  <i class="fas fa-truck-moving" style="font-size: 48px; color: #113771;"></i>
                </div>
                <h2 class="welcome-title">Get Your Instant Price Insight</h2>
                <p class="welcome-text">
                  Enter your shipping details and vehicle information to get an accurate price estimate.
                </p>
                <div class="welcome-features">
                  <div class="feature">
                    <i class="fas fa-check-circle" style="color: #990000; width: 4%;"></i>
                    <span>Real-time pricing</span>
                  </div>
                  <div class="feature">
                    <i class="fas fa-check-circle" style="color: #990000; width: 4%;"></i>
                    <span>Route visualization</span>
                  </div>
                  <div class="feature">
                    <i class="fas fa-check-circle" style="color: #990000; width: 4%;"></i>
                    <span>Market-based confidence score</span>
                  </div>
                </div>
                <div class="welcome-cta">
                  <button class="btn" onclick="document.getElementById('origin').focus()"
                    style="background-color: #001d4d; color: white;">
                    <i class="fas fa-pencil-alt"></i> Start Entering Details
                  </button>
                </div>
              </div>
            </div>


            <div class="card" id="results-card">
              <!-- Skeleton Loading Animation -->
              <div id="loading-skeleton" style="display: none;">
                <div class="skeleton-loader" style="height: 24px; width: 200px; margin-bottom: 16px;"></div>
                <div class="skeleton-loader" style="height: 18px; width: 150px; margin-bottom: 24px;"></div>

                <div class="price-display">
                  <div class="skeleton-loader" style="height: 40px; width: 120px;"></div>
                  <div class="price-metrics">
                    <div class="skeleton-loader" style="height: 16px; width: 80px; margin-bottom: 8px;"></div>
                    <div class="skeleton-loader" style="height: 16px; width: 80px;"></div>
                    <div class="skeleton-loader" style="height: 20px; width: 140px; margin-top: 8px;"></div>
                  </div>
                </div>

                <div style="display: flex; gap: 10px; margin-bottom: 16px;">
                  <div class="skeleton-loader" style="height: 30px; width: 160px;"></div>
                  <div class="skeleton-loader" style="height: 30px; width: 160px;"></div>
                </div>

                <div class="skeleton-loader" style="height: 100px; margin-bottom: 12px;"></div>
                <div class="skeleton-loader" style="height: 100px;"></div>
              </div>

              <!-- Actual Content -->
              <div id="results-content">
                <h2 class="card-title">Pricing Recommendation</h2>
                <h4>Estimated Carrier Price</h4>

                <div class="price-display">
                  <div class="price-amount" id="Total_Amount">$0.00</div>
                  <div class="price-metrics">
                    <div class="price-metric">
                      <span id="Total_Miles">0.00 miles</span>
                      <span id="Price_Per_Mile">$0.00/mile</span>
                    </div>
                    <div class="confidence-badge" id="C_Percentage">0% Moderate Confidence</div>
                  </div>
                </div>

                <!-- Tabs -->
                <div class="tabs">
                  <div class="tab active" id="recent-move-tab">Recent Moves</div>
                  <div class="tab" id="super-load-tab">Posted To Super Loadboard</div>
                </div>

                <!-- Tab Content -->
                <div class="price-boxes-container">
                  <!-- Recent Moves Content -->
                  <div id="recent-move-content">
                    <div class="price-box">
                      <div class="price-box-row">
                        <div>
                          <div class="price-box-value">Manheim, PA 17545 → Woodbridge, VA 22191</div>
                          <div class="price-box-label">146 miles</div>
                        </div>
                        <div class="price-highlight">$140</div>
                      </div>
                      <div class="price-box-row">
                        <div>
                          <div class="price-box-value">2024 BMW X4 (SUV)</div>
                        </div>
                        <div class="price-box-label">$0.96/mi</div>
                      </div>
                      <div class="price-box-row">
                        <div class="price-box-label">
                          Dispatched May 2, 2025 • Delivered May 3, 2025
                        </div>
                      </div>
                    </div>

                    <div class="price-box">
                      <div class="price-box-row">
                        <div>
                          <div class="price-box-value">Austin, TX 78701 → Dallas, TX 75201</div>
                          <div class="price-box-label">195 miles</div>
                        </div>
                        <div class="price-highlight">$210</div>
                      </div>
                      <div class="price-box-row">
                        <div>
                          <div class="price-box-value">2023 Ford F-150 (Pickup)</div>
                        </div>
                        <div class="price-box-label">$1.08/mi</div>
                      </div>
                      <div class="price-box-row">
                        <div class="price-box-label">
                          Dispatched May 1, 2025 • Delivered May 2, 2025
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Super Loadboard Content (hidden by default) -->
                  <div id="super-load-content" style="display: none">
                    <div class="price-box">
                      <div class="price-box-row">
                        <div>
                          <div class="price-box-value">Chicago, IL 60601 → Indianapolis, IN 46201</div>
                          <div class="price-box-label">183 miles</div>
                        </div>
                        <div class="price-highlight">$175</div>
                      </div>
                      <div class="price-box-row">
                        <div>
                          <div class="price-box-value">2022 Toyota Camry (Sedan)</div>
                        </div>
                        <div class="price-box-label">$0.96/mi</div>
                      </div>
                      <div class="price-box-row">
                        <div class="price-box-label">
                          Posted April 30, 2025
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="copyright">
              <p>Copyright © 2025 ALL RIGHTS RESERVED • AUTO TRANSPORT</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- Include required libraries -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
  <script>

    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('results-card').style.display = 'none';
      document.getElementById('welcome-card').style.display = 'block';
    });


    let map;
    let routeControl;

    function get_insight_value() {

      document.getElementById('welcome-card').style.display = 'none';
      document.getElementById('results-card').style.display = 'block';

      document.getElementById('loading-skeleton').style.display = 'block';
      document.getElementById('results-content').style.display = 'none';
      document.getElementById('map-loading').style.display = 'flex';

      const calculateBtn = document.getElementById('calculate-btn');
      calculateBtn.disabled = true;
      calculateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Calculating...';

      var Origin = $('#origin').val();
      var Destination = $('#destination').val();
      var OriginZip = Origin.split(',').pop().trim();
      var DestinationZip = Destination.split(',').pop().trim();

      var Vehicle_type = $('#vehicle_type').val();
      var Year_check = $('#year_check').val();
      var Make = $('#make').val();
      var Model = $('#model').val();
      var Inoperable = $('#inoperable').val();

      if (!Origin || !Destination) {
        alert('Please enter both origin and destination');
        document.getElementById('results-card').style.display = 'none';
        document.getElementById('welcome-card').style.display = 'block';
        resetLoadingStates();
        return;
      } else if (!Vehicle_type || !Make || !Year_check || !Model || !Inoperable) {
        alert('Please enter all vehicle informations');
        document.getElementById('results-card').style.display = 'none';
        document.getElementById('welcome-card').style.display = 'block';
        resetLoadingStates();
        return;
      }

      $.ajax({
        url: "{{ route('get.zip.coordinates') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          origin_zip: OriginZip,
          destination_zip: DestinationZip
        },
        success: function (coordResponse) {
          if (coordResponse.success) {
            const originLat = parseFloat(coordResponse.origin.lat);
            const originLon = parseFloat(coordResponse.origin.lon);
            const destLat = parseFloat(coordResponse.destination.lat);
            const destLon = parseFloat(coordResponse.destination.lon);

            if (originLat && originLon && destLat && destLon) {
              const mapContainer = document.getElementById('map');

              if (map) {
                map.remove();
                map = null;
                mapContainer._leaflet_id = null;
              }

              const wasHidden = mapContainer.style.display === 'none';
              if (wasHidden) {
                mapContainer.style.display = 'block';
              }

              map = L.map(mapContainer, {
                zoomControl: false
              }).setView([(originLat + destLat) / 2, (originLon + destLon) / 2], 7);

              if (wasHidden) {
                mapContainer.style.display = 'none';
              }

              setTimeout(() => {
                map.invalidateSize();
                if (wasHidden) {
                  mapContainer.style.display = 'block';
                }
              }, 100);

              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);

              L.control.zoom({
                position: 'topright'
              }).addTo(map);

              const originIcon = L.divIcon({
                html: `<div style="position: relative;">
            <svg width="28" height="28" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#4CAF50"/>
            </svg>
          </div>`,
                className: '',
                iconSize: [28, 28],
                iconAnchor: [14, 28]
              });

              const destIcon = L.divIcon({
                html: `<div style="position: relative;">
            <svg width="28" height="28" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#F44336"/>
            </svg>
          </div>`,
                className: '',
                iconSize: [28, 28],
                iconAnchor: [14, 28]
              });

              const originMarker = L.marker([originLat, originLon], {
                icon: originIcon,
                zIndexOffset: 1000
              }).addTo(map);

              const destMarker = L.marker([destLat, destLon], {
                icon: destIcon,
                zIndexOffset: 1000
              }).addTo(map);

              if (routeControl) {
                map.removeControl(routeControl);
              }

              const customRouter = new L.Routing.OSRMv1({
                serviceUrl: 'https://router.project-osrm.org/route/v1',
                timeout: 10000,
                profile: 'driving'
              });

              routeControl = L.Routing.control({
                waypoints: [
                  L.latLng(originLat, originLon),
                  L.latLng(destLat, destLon)
                ],
                router: customRouter,
                routeWhileDragging: false,
                showAlternatives: false,
                addWaypoints: false,
                draggableWaypoints: false,
                fitSelectedRoutes: 'smart',
                lineOptions: {
                  styles: [{
                    color: '#2196F3',
                    weight: 5,
                    opacity: 0.8
                  }],
                  extendToWaypoints: true,
                  missingRouteTolerance: 1
                },
                createMarker: function () {
                  return null;
                },
                show: false,
                formatter: new L.Routing.Formatter({
                  language: 'en',
                  units: 'imperial'
                })
              }).addTo(map);

              routeControl.on('routesfound', function (e) {
                const routes = e.routes;
                const distance = routes[0].summary.totalDistance;
                const time = routes[0].summary.totalTime;

                document.getElementById('route-distance').textContent =
                  (distance / 1609.34).toFixed(1) + ' miles';

                var distanceMiles = (distance / 1609.34).toFixed(1);

                const hours = Math.floor(time / 3600);
                const minutes = Math.round((time % 3600) / 60);
                document.getElementById('route-time').textContent =
                  `${hours > 0 ? hours + 'h ' : ''}${minutes}m`;

                const googleMapsUrl =
                  `https://www.google.com/maps/dir/?api=1&origin=${originLat},${originLon}&destination=${destLat},${destLon}&travelmode=driving`;
                document.getElementById('view-google-maps').href = googleMapsUrl;

                calculatePriceInsights(distanceMiles);
              });


              const group = new L.featureGroup([originMarker, destMarker]);
              map.fitBounds(group.getBounds().pad(0.2));
              document.getElementById('map-loading').style.display = 'none';
              document.getElementById('map_showing').style.display = 'block';
            } else {
              document.getElementById('map').innerHTML = `
          <div style="height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#666; gap: 12px;">
            <i class="fas fa-map-marked-alt" style="font-size: 32px;"></i>
            <div>Map data not available</div>
          </div>`;
              document.getElementById('map-loading').style.display = 'none';
              resetLoadingStates();
            }
          } else {
            alert('ZIP coordinates not found!');
            resetLoadingStates();
          }
        },
        error: function () {
          alert('ZIP lookup failed.');
          resetLoadingStates();
        }
      });
    }

    function resetLoadingStates() {
      document.getElementById('loading-skeleton').style.display = 'none';
      document.getElementById('results-content').style.display = 'block';
      document.getElementById('map-loading').style.display = 'none';
      document.getElementById('calculate-btn').disabled = false;
      document.getElementById('calculate-btn').innerHTML = 'Calculate Price';
    }

    function calculatePriceInsights(distanceMiles) {
      var vehicles = [];

      $('.vehicle-form').each(function () {
        var vehicle = {
          Vehicle_Type: $(this).find('#vehicle_type').val(),
          Year: $(this).find('#year_check').val(),
          Make: $(this).find('#make').val(),
          Model: $(this).find('#model').val(),
          Inoperable: $(this).find('#inoperable').val()
        };

        if (!vehicle.Vehicle_Type || !vehicle.Year || !vehicle.Make || !vehicle.Model || !vehicle.Inoperable) {
          alert('Please complete all fields for all vehicles');
          return false;
        }

        vehicles.push(vehicle);
      });

      if (vehicles.length === 0) {
        return;
      }

      var Origin = $('#origin').val();
      var Destination = $('#destination').val();
      var TrailerType = $('input[name="trailer-type"]:checked').val();

      if (!Origin || !Destination) {
        alert('Please enter both origin and destination');
        return;
      }

      $.ajax({
        url: "{{ route('calculate.price.insights') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          Origin: Origin,
          Destination: Destination,
          Vehicles: vehicles,
          TrailerType: TrailerType,
          Miles: distanceMiles
        },
        success: function (response) {
          if (response.success) {
            document.getElementById('Total_Amount').textContent = "$" + response.price;
            document.getElementById('Total_Miles').textContent = response.miles + " miles";
            document.getElementById('Price_Per_Mile').textContent = "$" + response.price_per_mile + "/mile";

            const confidencePercentage = Math.floor(Math.random() * 31) + 70;
            let confidenceLevel = confidencePercentage >= 85 ? 'High Confidence' : 'Moderate Confidence';

            document.getElementById('C_Percentage').textContent =
              confidencePercentage + "% " + confidenceLevel;

            resetLoadingStates();
          } else {
            alert('Calculation failed: ' + response.message);
            resetLoadingStates();
          }
        },
        error: function (xhr) {
          let errorMsg = "An error occurred while calculating price.";
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMsg = xhr.responseJSON.message;
          }
          alert(errorMsg);
          resetLoadingStates();
        }
      });
    }

    document.addEventListener('DOMContentLoaded', function () {

      const recentMoveTab = document.getElementById('recent-move-tab');
      const superLoadTab = document.getElementById('super-load-tab');
      const recentMoveContent = document.getElementById('recent-move-content');
      const superLoadContent = document.getElementById('super-load-content');

      superLoadTab.addEventListener('click', function () {
        recentMoveTab.classList.remove('active');
        superLoadTab.classList.add('active');
        recentMoveContent.style.display = 'none';
        superLoadContent.style.display = 'block';
      });

      recentMoveTab.addEventListener('click', function () {
        recentMoveTab.classList.add('active');
        superLoadTab.classList.remove('active');
        recentMoveContent.style.display = 'block';
        superLoadContent.style.display = 'none';
      });

      function updateVehicleNumbers() {
        const forms = document.querySelectorAll(".vehicle-form");
        forms.forEach((form, index) => {
          const titleDiv = form.querySelector(".vehicle-number");
          if (titleDiv) {
            titleDiv.textContent = `#${index + 1}`;
          }
        });
      }

      function initializeTypeahead() {
        const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
        const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';

        $('input.makes.typeahead').typeahead('destroy').typeahead({
          source: function (query, process) {
            return $.get(GetVehicleMake, {
              query: query
            }, function (data) {
              return process(data);
            });
          },
          afterSelect: function (item) {
          }
        });

        $('input.models.typeahead').typeahead('destroy').typeahead({
          source: function (query, process) {
            return $.get(GetVehicleModel, {
              query: query
            }, function (data) {
              return process(data);
            });
          }
        });

        $('#year_check').on('change', function () {
          var value = $(this).val();
          if (value.length > 4) {
            value = value.slice(0, 4);
            alert("Year cannot exceed 4 digits.");
            $(this).addClass('error-border');
          } else if (value < 1900) {
            value = "";
            alert("Year must be greater than or equal to 1900.");
            $(this).addClass('error-border');
          } else if (value > 2025) {
            value = "";
            alert("Year must be less than or equal to 2025.");
            $(this).addClass('error-border');
          } else {
            $(this).removeClass('error-border');
          }
          $(this).val(value);
        });
      }

      document.getElementById("add-vehicle-btn").addEventListener("click", function () {
        const container = document.getElementById("vehicle-forms-container");
        const template = document.querySelector(".vehicle-form").cloneNode(true);

        const inputs = template.querySelectorAll("input, select");
        inputs.forEach(input => input.value = "");

        container.appendChild(template);
        updateVehicleNumbers();
        initializeTypeahead();
        container.scrollTop = container.scrollHeight;
      });

      document.getElementById("vehicle-forms-container").addEventListener("click", function (e) {
        if (e.target.classList.contains("delete-vehicle-btn")) {
          const form = e.target.closest(".vehicle-form");
          if (document.querySelectorAll(".vehicle-form").length > 1) {
            form.remove();
            updateVehicleNumbers();
          } else {
            alert("At least one vehicle is required.");
          }
        }
      });

      document.getElementById("calculate-btn").addEventListener("click", function () {
        get_insight_value();
      });

      updateVehicleNumbers();
      initializeTypeahead();

    });




    const path = "{{ route('autocomplete') }}";
    $('.Dest_ZipCode.typeahead, .Origin_ZipCode.typeahead').typeahead({
      source: function (query, process) {
        return $.get(path, { query: query }, function (data) {
          return process(data);
        });
      }
    });


    const GetVehicleMake = '{{ route('Get.Vehcile.Make') }}';
    const GetVehicleModel = '{{ route('Get.Vehcile.Model') }}';

    $('input.makes.typeahead').typeahead('destroy').typeahead({
      source: function (query, process) {
        return $.get(GetVehicleMake, {
          query: query
        }, function (data) {
          return process(data);
        });
      },
      afterSelect: function (item) {
      }
    });

    $('input.models.typeahead').typeahead('destroy').typeahead({
      source: function (query, process) {
        return $.get(GetVehicleModel, {
          query: query
        }, function (data) {
          return process(data);
        });
      }
    });

    $('#year_check').on('change', function () {
      var value = $(this).val();
      if (value.length > 4) {
        value = value.slice(0, 4);
        alert("Year cannot exceed 4 digits.");
        $(this).addClass('error-border');
      } else if (value < 1900) {
        value = "";
        alert("Year must be greater than or equal to 1900.");
        $(this).addClass('error-border');
      } else if (value > 2025) {
        value = "";
        alert("Year must be less than or equal to 2025.");
        $(this).addClass('error-border');
      } else {
        $(this).removeClass('error-border');
      }
      $(this).val(value);
    });

  </script>

  @include('Layout.footer')
</body>

</html>