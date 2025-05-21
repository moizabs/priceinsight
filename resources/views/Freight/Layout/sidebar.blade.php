<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('images/icon/logo-of-dispatch-rates.png') }}" alt="Cool Admin" width="55%"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('freight.dashboard') ? 'active' : '' }}" id="dashboard">
                    <a href="{{ route('freight.dashboard') }}">Freight Dashboard</a>
                </li>

                {{-- <li class="{{ request()->routeIs('pricing.options') ? 'active' : '' }}" id="basicPricing">
                    <a href="{{ route('pricing.options') }}">Pricing Options</a>
                </li>

                <li class="{{ request()->routeIs('price.per.mile') ? 'active' : '' }}" id="pricePerMile">
                    <a href="{{ route('price.per.mile') }}">Price Per Mile</a>
                </li>

                <li class="{{ request()->routeIs('state.exceptions') ? 'active' : '' }}" id="stateExceptions">
                    <a href="{{ route('state.exceptions') }}">State Exceptions</a>
                </li>

                <li class="{{ request()->routeIs('zipcode.exceptions') ? 'active' : '' }}" id="zipExceptions">
                    <a href="{{ route('zipcode.exceptions') }}">Zip Code Exceptions</a>
                </li> --}}



                {{-- <li class="{{ request()->routeIs('exceptions.list') ? 'active' : '' }}" id="viewException">
                    <a href="{{ route('exceptions.list') }}">View / Delete Exceptions</a>
                </li> --}}

                {{-- <li class="{{ request()->routeIs('vehicle.size.database') ? 'active' : '' }}" id="vehicleSize">
                    <a href="{{ route('vehicle.size.database') }}">Vehicle type Database</a>
                </li> --}}

                {{-- <li class="{{ request()->routeIs('vehicle.size.queue') ? 'active' : '' }}" id="sizeQueue">
                    <a href="{{ route('vehicle.size.queue') }}">Vehicle Type Queue</a>
                </li> --}}

                
                
                {{-- <li class="{{ request()->routeIs('vehicle.size.settings') ? 'active' : '' }}" id="vehicleSizeSetting">
                    <a href="{{ route('vehicle.size.settings') }}">Vehicle Type Settings</a>
                </li>
                
                <li class="{{ request()->routeIs('last.activity') ? 'active' : '' }}" id="lastActivity">
                    <a href="{{ route('last.activity') }}">Last Activity</a>
                </li>

                <li class="{{ request()->routeIs('price.insight') ? 'active' : '' }}" id="lastActivity">
                    <a href="{{ route('price.insight') }}">Price Insight</a>
                </li>

                <li class="{{ request()->routeIs('washington.index') ? 'active' : '' }}" id="lastActivity">
                    <a href="{{ route('washington.index') }}">Day Dispatch Data</a>
                </li> --}}

            </ul>
        </nav>
    </div>
</aside>