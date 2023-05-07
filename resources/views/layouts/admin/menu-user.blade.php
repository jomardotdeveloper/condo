<div class="nk-sidebar-menu" data-simplebar>
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">MAIN</h6>
        </li>
        <x-menu name="Dashboard" logo="icon ni ni-growth-fill" url="{{ route('admin.dashboard') }}"/>
        <x-menu name="Tickets" logo="icon ni ni-ticket-fill" url="{{ route('tickets.index') }}"/>
        <x-menu name="Invoices" logo="icon ni ni-file-docs" url="{{ route('user-debits.index') }}"/>
        {{-- <x-menu name="Payments" logo="icon ni ni-wallet-fill" url="{{ route('user-payments.index') }}"/> --}}

        <x-menu name="Guests" logo="icon ni ni-users-fill" url="#" :is-parent="true" :children="[
            array('name' => 'All', 'url' =>  route('guests.index')),
            array('name' => 'Incoming', 'url' =>  route('guests.index', ['today' => '1'])),
        ]"/>

        <x-menu name="Deliveries" logo="icon ni ni-box" url="#" :is-parent="true" :children="[
            array('name' => 'All', 'url' =>  route('deliveries.index')),
            array('name' => 'Incoming', 'url' =>  route('deliveries.index', ['today' => '1'])),
        ]"/>

        <x-menu name="Parking" logo="icon ni ni-truck" url="{{ route('user-parkings.index') }}"/>  

        {{-- <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Permits</h6>
        </li> --}}

     
        {{-- <x-menu name="Gate Pass" logo="icon ni ni-file-plus" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('error.forbidden')),
            array('name' => 'For Payments', 'url' =>  route('error.forbidden')),
            array('name' => 'Finance Verification', 'url' => route('error.forbidden')),
            array('name' => 'Complex Manager Approval', 'url' =>  route('error.forbidden')),
            array('name' => 'Lobby Guard', 'url' =>  route('error.forbidden')),
        ]"/>

        <x-menu name="Motor Parking Space" logo="icon ni ni-file-text" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('error.forbidden')),
            array('name' => 'For Payments', 'url' =>  route('error.forbidden')),
            array('name' => 'Finance Verification', 'url' => route('error.forbidden')),
            array('name' => 'Complex Manager Approval', 'url' =>  route('error.forbidden')),
            array('name' => 'Lobby Guard', 'url' =>  route('error.forbidden')),
        ]"/>

        <x-menu name="Renovation Clearance" logo="icon ni ni-file" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('renovations.index')  . '?status=1'),
            array('name' => 'For Payments', 'url' =>  route('renovations.index')  . '?status=2'),
            array('name' => 'Finance Verification', 'url' =>  route('renovations.index')  . '?status=5'),
            array('name' => 'Complex Manager Approval', 'url' =>  route('renovations.index')  . '?status=6'),
            array('name' => 'Lobby Guard', 'url' =>  route('renovations.index')  . '?status=3'),
        ]"/>


        <x-menu name="Bike Parking Space" logo="icon ni ni-files-fill" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('error.forbidden')),
            array('name' => 'For Payments', 'url' =>  route('error.forbidden')),
            array('name' => 'Finance Verification', 'url' => route('error.forbidden')),
            array('name' => 'Complex Manager Approval', 'url' =>  route('error.forbidden')),
            array('name' => 'Lobby Guard', 'url' =>  route('error.forbidden')),
        ]"/>

        <x-menu name="Refund Deposit" logo="icon ni ni-money" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('error.forbidden')),
            array('name' => 'For Payments', 'url' =>  route('error.forbidden')),
            array('name' => 'Finance Verification', 'url' => route('error.forbidden')),
            array('name' => 'Complex Manager Approval', 'url' =>  route('error.forbidden')),
            array('name' => 'Lobby Guard', 'url' =>  route('error.forbidden')),
        ]"/>

        <x-menu name="Cert. of Residency" logo="icon ni ni-map" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('error.forbidden')),
            array('name' => 'For Payments', 'url' =>  route('error.forbidden')),
            array('name' => 'Finance Verification', 'url' => route('error.forbidden')),
            array('name' => 'Complex Manager Approval', 'url' =>  route('error.forbidden')),
            array('name' => 'Lobby Guard', 'url' =>  route('error.forbidden')),
        ]"/>

        <x-menu name="Cert. of Management" logo="icon ni ni-mail" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('error.forbidden')),
            array('name' => 'For Payments', 'url' =>  route('error.forbidden')),
            array('name' => 'Finance Verification', 'url' => route('error.forbidden')),
            array('name' => 'Complex Manager Approval', 'url' =>  route('error.forbidden')),
            array('name' => 'Lobby Guard', 'url' =>  route('error.forbidden')),
        ]"/>

 --}}

        
    </ul>
</div>