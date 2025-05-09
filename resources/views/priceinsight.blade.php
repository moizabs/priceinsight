<!DOCTYPE html>
<html lang="en">

@include('Layout.header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .swal2-cancel {
        margin-right: 20px;
    }
</style>
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
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
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
                
                    <!-- Route Information -->
                    <h3 class="form-subtitle">Route Information</h3>
                    <div class="input-group">
                      <input type="text" placeholder="Origin" class="form-control Origin_ZipCode typeahead" id="origin" required>
                      <input type="text" placeholder="Destination" class="form-control Dest_ZipCode typeahead" id="destination"
                      required>
                    </div>
                
                    <!-- Vehicle Information -->
                    <h3 class="form-subtitle">Vehicle Information</h3>
                    <div id="vehicle-forms-container" class="price-boxes-container">
                      <div class="vehicle-form">
                      <div class="vehicle-number">#1</div>
                      <div class="input-group">
                        <input type="text" placeholder="Year" min="1900" max="2025" maxlength="4" required class="form-control"
                        id="year_check" name="year">
                
                        <input type="text" placeholder="Make" class="form-control makes typeahead" id="make" required name="make">
                
                        <input type="text" placeholder="Model" class="form-control models typeahead" id="model" name="model" required>
                      </div>
                      <div class="input-group">
                        <select class="form-control" name="type" id="vehicle_type">
                        <option value="" selected disabled>Select Type</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Coupe">Coupe (2 doors)</option>
                        <option value="SUV">SUV</option>
                        <option value="Pickup-2doors)">Pickup (2 doors)</option>
                        <option value="Pickup-4doors)">Pickup (4 doors)</option>
                        <option value="Van">Van</option>
                        </select>
                        <select class="form-control" name="inoperable" id="inoperable">
                        <option value="" selected disabled>Inoperable</option>
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
                
                    <button class="btn" onclick="get_insight_value();"
                      style="width: 100%; padding: 0.75rem; background-color: #001d4d; color: white;">
                      Calculate Price
                    </button>
                    </div>
                
                    <!-- Pricing Results -->
                    <div class="second-parent">
                    <div class="card">
                      <h2 class="card-title">Pricing Recommendation</h2>
                      <h4>Estimated Carrier Price</h4>
                
                      <div class="price-display">
                      <div class="price-amount">$1,250</div>
                      <div class="price-metrics">
                        <div class="price-metric">
                        <span>$10.72/mi</span>
                        <span>$11.66/mi</span>
                        </div>
                        <div class="confidence-badge">72% Moderate Confidence</div>
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
                
                        <!-- Additional price boxes... -->
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
                
                        <!-- Additional super loadboard boxes... -->
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

    @include('Layout.footer')
</body>

</html>
