<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active" id="dashboard">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>

                <li id="basicPricing">
                    <a href="{{ route('pricing.options') }}">Pricing Options</a>
                </li>

                <li id="pricePerMile">
                    <a href="{{ route('price.per.mile') }}">Price Per Mile</a>
                </li>

                <li id="stateExceptions">
                    <a href="{{ route('state.exceptions') }}">State Exceptions</a>
                </li>

                <li id="zipExceptions">
                    <a href="{{ route('zipcode.exceptions') }}">Zip Code Exceptions</a>
                </li>

                <li id="viewException">
                    <a href="{{ route('exceptions.list') }}">View / Delete Exceptions</a>
                </li>

                <li id="vehicleSize">
                    <a href="{{ route('vehicle.size.database') }}">Vehicle Size Database</a>
                </li>

                <li id="sizeQueue">
                    <a href="{{ route('vehicle.size.queue') }}">Vehicle Size Queue</a>
                </li>

                <li id="vehicleSizeSetting">
                    <a href="{{ route('vehicle.size.settings') }}">Vehicle Size Settings</a>
                </li>
                
                <li id="lastActivity">
                    <a href="{{ route('last.activity') }}">Last Activity</a>
                </li>

            </ul>
        </nav>
    </div>
</aside>