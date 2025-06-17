<!-- Price Insert Modal -->
<div class="modal fade" id="priceModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Insert Price For this Listing Immediately!</h5>
        <button type="button" class="close" id="closemodal" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Origin Location</label>
          <input type="text" placeholder="Origin" class="form-control Origin_ZipCode typeahead" id="porigin" required>
        </div>
        <div class="form-group">
          <label>Destination Location</label>
          <input type="text" placeholder="Destination" class="form-control Dest_ZipCode typeahead" id="pdestination"
            required>
          {{-- <input type="number" id="edit_end_range" class="form-control"> --}}
        </div>
        <div class="form-group">
          <label>Vehicle Year</label>
          <input type="text" placeholder="Year" min="1900" max="2025" maxlength="4" required class="form-control"
            id="pyear_check" name="pyear">
        </div>
        <div class="form-group">
          <label>Vehicle Make</label>
          <input type="text" placeholder="Make" class="form-control makes typeahead" id="pmake" required name="pmake">
        </div>
        <div class="form-group">
          <label>Vehicle Model</label>
          <input type="text" placeholder="Model" class="form-control models typeahead" id="pmodel" name="pmodel" required>
        </div>

        <div class="form-group">
          <label>Vehicle Type</label>

          <select class="form-control" name="ptype" id="pvehicle_type">
            <option value="" selected disabled>Select Type</option>

            <option value="Car">Car</option>
            <option value="motorcycle">Motorcycle</option>
            <option value="3_wheel_sidecar">3 Wheel Sidecar</option>
            <option value="3_wheel_motorcycle">3 Wheel Motorcycle</option>
            <option value="atv">ATV</option>
            <option value="SUV">SUV</option>
            <option value="Mid SUV">Mid SUV</option>
            <option value="Large SUV">Large SUV</option>
            <option value="Van">Van</option>
            <option value="Mini Van">Mini Van</option>
            <option value="Cargo Van">Cargo Van</option>
            <option value="Passenger Van">Passenger Van</option>
            <option value="Pickup">Pickup</option>
            <option value="Pickup Dually">Pickup Dually</option>
            <option value="Box Truck Dually">Box Truck Dually</option>
            <option value="other_vehicle">Other Vehicle</option>
            <option value="other_motorcycle">Other Motorcycle</option>
            <option value="other">Other</option>
          </select>

        </div>

        <div class="form-group">
          <label>Vehicle Condition</label>

          <select class="form-control" name="pinoperable" id="pinoperable">
            <option value="" selected disabled>Select Condition</option>
            <option value="1">Operable</option>
            <option value="2">Inoperable</option>
          </select>

        </div>

        <div class="form-group">
          <label>Trailer Type</label><br />
          <label class="radio-option">
            <input type="radio" name="ptrailer-type" value="1" checked>
            Open
          </label>

          <label class="radio-option">
            <input type="radio" name="ptrailer-type" value="2">
            Enclosed
          </label>
        </div>

        <div class="form-group">
          <label>Listed  Price</label>
          <input type="number" id="plisted_price" class="form-control">
        </div>

        <div class="form-group">
          <label>Dispatch Price</label>
          <input type="number" id="pdispatch_price" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button id="insertPrice" class="btn btn-primary">Insert Price</button>
      </div>
    </div>
  </div>
</div>





<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js"></script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<!-- Main JS-->
<script src="js/main.js"></script>
<script src="js/custom.js"></script>
<script src="{{ asset('js/globalPriceCheck.js') }}"></script>

<script type="text/javascript">
  var onloadCallback = function () {
    grecaptcha.render('feedback-recaptcha', {
      'sitekey': '6LcmYJwkAAAAAM_tgGsRCuaGxVV0NY495sEuUnn0'
    });
  };
  $("button[name='submit']").click(function (e) {
    var response = grecaptcha.getResponse();
    $("#feedback-recaptcha").parent('.col-sm-12').siblings('.text-danger').remove();
    if (response.length == 0) {
      e.preventDefault();
      $("#feedback-recaptcha").parent('.col-sm-12').after('<div class="text-danger col-sm-12 p-0 mb-2">Please check recaptcha, if you are not a robot!</div>');
    }
  })

</script>