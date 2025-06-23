<style>
  .nav-menu {
    display: flex;
    justify-content: space-around;
    /* background-color: blueviolet; */
    width: 350px;
  }

  .account-dropdown {
    display: none;
    position: absolute;
    right: 0;
    background: #fff;
    padding: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .account-dropdown.show {
    display: block;
  }



  /* From Uiverse.io by ErzenXz */
  .toggle-switch {
    position: relative;
    display: inline-block;
    width: 45px;
    height: 25px;
    cursor: pointer;
  }

  .toggle-switch input[type="checkbox"] {
    display: none;
  }

  .toggle-switch-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #ddd;
    border-radius: 20px;
    box-shadow: inset 0 0 0 2px #ccc;
    transition: background-color 0.3s ease-in-out;
  }

  .toggle-switch-handle {
    position: absolute;
    top: 5px;
    left: 5px;
    width: 15px;
    height: 15px;
    background-color: #fff;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out;
  }

  .toggle-switch::before {
    content: "";
    position: absolute;
    top: -20px;
    right: -25px;
    font-size: 12px;
    font-weight: bold;
    color: #aaa;
    text-shadow: 1px 1px #fff;
    transition: color 0.3s ease-in-out;
  }

  .toggle-switch input[type="checkbox"]:checked+.toggle-switch-handle {
    transform: translateX(40px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2), 0 0 0 3px #2c3e50;
  }

  .toggle-switch input[type="checkbox"]:checked+.toggle-switch-background {
    background-color: #2c3e50;
    box-shadow: inset 0 0 0 2px #2c3e50;
  }

  .toggle-switch input[type="checkbox"]:checked+.toggle-switch:before {
    content: "On";
    color: #2c3e50;
    right: -10px;
  }

  .toggle-switch input[type="checkbox"]:checked+.toggle-switch-background .toggle-switch-handle {
    transform: translateX(20px);
  }




  /* From Uiverse.io by JaydipPrajapati1910 */
  .menu-option {
    font-size: 16px;
    color: #222;
    font-family: inherit;
    font-weight: 500;
    cursor: pointer;
    position: relative;
    border: none;
    background: none;
    text-transform: uppercase;
    transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
    transition-duration: 400ms;
    transition-property: color;
  }

  .menu-option:focus,
  .menu-option:hover {
    color: #222;
  }

  .menu-option:focus:after,
  .menu-option:hover:after {
    width: 100%;
    left: 0%;
  }

  .menu-option:after {
    content: "";
    pointer-events: none;
    bottom: -2px;
    left: 50%;
    position: absolute;
    width: 0%;
    height: 2px;
    background-color: #001d4d;
    transition-timing-function: cubic-bezier(0.25, 0.8, 0.25, 1);
    transition-duration: 400ms;
    transition-property: width, left;
  }
</style>
<header class="header-desktop">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="header-wrap">
        <div class="form-header"></div>
        <div class="nav-menu">
          {{-- <span><a href="">Vehicle</a></span> --}}
          <a href="{{ route('dashboard') }}" class="menu-option">
            Vehicle
          </a>
          <a href="{{ route('heavy.dashboard') }}" class="menu-option">
            Heavy
          </a>
          <a href="{{ route('freight.dashboard') }}" class="menu-option">
            Freight
          </a>
          {{-- <span><a href="">Heavy</a></span>
          <span><a href="">Freight</a></span> --}}
        </div>

        <div class="nav-menu" style="width: 230px">
          <label class="toggle-switch">
            <input type="checkbox" id="washingtonToggle" {{ $setting?->washington_data ? 'checked' : '' }}>
            <div class="toggle-switch-background">
              <div class="toggle-switch-handle"></div>
            </div>
          </label>
          Day Dispatch Data
        </div>


        {{-- <div class="account-dropdown__footer">
          <a href="{{ route('logout') }}"><i class="zmdi zmdi-power"></i>Logout</a>
        </div> --}}
        <div class="header-button">
          <div class="account-wrap">
            <div class="account-item clearfix js-item-menu">
              <div class="image">
                <img src="{{ asset('images/icon/avatar-01.jpg') }}"
                  alt="{{ Auth::guard('authorized')->user()->name }}" />
              </div>
              <div class="content"><a class="js-acc-btn"
                  href="javascript:void(0)">{{ Auth::guard('authorized')->user()->name }}</a>
              </div>
              <div class="account-dropdown js-dropdown">
                {{-- <div class="info clearfix">
                  <div class="image">
                    <a href="#">
                      <img src="{{ asset('images/icon/avatar-01.jpg') }}"
                        alt="{{ Auth::guard('authorized')->user()->name }}" />
                    </a>
                  </div>
                  <div class="content">
                    <h5 class="name">
                      <a href="javascript:void(0)">{{ Auth::guard('authorized')->user()->name }}</a>
                    </h5>
                  </div>
                </div> --}}
                <div class="account-dropdown__footer">
                  <a href="{{ route('logout') }}"><i class="zmdi zmdi-power"></i>Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>


<div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
  data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center p-lg-4">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
          <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10" cx="65.1"
            cy="65.1" r="62.1" />
          <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
            stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
          <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
            stroke-miterlimit="10" x1="95.8" y1="38" X2="34.4" y2="92.2" />
        </svg>
        <h4 class="text-danger mt-3">Oops!</h4>
        <p class="mt-3">Error updating the setting.</p>
        <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
  data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center p-lg-4">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
          <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1"
            cy="65.1" r="62.1" />
          <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round"
            stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
        </svg>
        <h4 class="text-success mt-3">Success</h4>
        <p class="mt-3">You have successfully On Washington Data for Price Insights.</p>
        <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('.js-acc-btn').on('click', function () {
      $(this).closest('.js-item-menu').find('.js-dropdown').toggleClass('show');
    });

    $(document).on('click', function (e) {
      if (!$(e.target).closest('.js-item-menu').length) {
        $('.js-dropdown').removeClass('show');
      }
    });
  });
</script>


<script>
  $('#washingtonToggle').on('change', function () {
    let isChecked = $(this).is(':checked') ? 1 : 0;

    $.ajax({
      url: '{{ route("settings.toggleWashington") }}',
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        washington_data: isChecked
      },
      success: function (response) {
        var successModal = new bootstrap.Modal(document.getElementById('statusSuccessModal'));
        successModal.show();
      },
      error: function () {
        var errorModal = new bootstrap.Modal(document.getElementById('statusErrorsModal'));
        errorModal.show();
      }
    });
  });
</script>