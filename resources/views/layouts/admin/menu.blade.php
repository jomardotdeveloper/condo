<div class="nk-sidebar-menu" data-simplebar>
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">MAIN</h6>
        </li>
        <x-menu name="Dashboard" logo="icon ni ni-growth-fill" url="{{ route('admin.dashboard') }}"/>
        <x-menu name="Announcement" logo="icon ni ni-blogger" url="{{ route('announcements.index') }}"/>
        <x-menu name="Tickets" logo="icon ni ni-ticket-fill" url="{{ route('tickets.index') }}"/>
        <x-menu name="Settings" logo="icon ni ni-setting-fill" url="#" :is-parent="true" :children="[
            array('name' => 'Setting', 'url' => route('settings.index')),
            array('name' => 'Departments', 'url' => route('departments.index')),
            array('name' => 'Positions', 'url' => route('positions.index')),
            array('name' => 'Clusters', 'url' => route('clusters.index')),
            array('name' => 'Units', 'url' => route('units.index')),
            array('name' => 'Roles', 'url' => '#'),
            array('name' => 'Employees', 'url' =>  route('employees.index')),
        ]"/>

        <x-menu name="Move In" logo="icon ni ni-home-fill" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('applications.index')  . '?status=1'),
            array('name' => 'For Payments', 'url' =>  route('applications.index')  . '?status=2'),
            array('name' => 'Finance Verification', 'url' =>  route('applications.index')  . '?status=5'),
            array('name' => 'Complex Manager Approval', 'url' =>  route('applications.index')  . '?status=6'),
            array('name' => 'Lobby Guard', 'url' =>  route('applications.index')  . '?status=3'),
        ]"/>

        <x-menu name="Move Out" logo="icon ni ni-delete-fill" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('move-outs.index')  . '?status=1'),
            array('name' => 'For Payments', 'url' =>  route('move-outs.index')  . '?status=2'),
            array('name' => 'Finance Verification', 'url' =>  route('move-outs.index')  . '?status=5'),
            array('name' => 'Complex Manager Approval', 'url' =>  route('move-outs.index')  . '?status=6'),
            array('name' => 'Lobby Guard', 'url' =>  route('move-outs.index')  . '?status=3'),
        ]"/>

        <x-menu name="Parking" logo="icon ni ni-truck" url="{{ route('parkings.index') }}"/>   

        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Visitors</h6>
        </li>

        <x-menu name="Guests" logo="icon ni ni-users-fill" url="{{ route('guests.index') }}"/>
        <x-menu name="Deliveries" logo="icon ni ni-box" url="{{ route('deliveries.index') }}"/>
        <x-menu name="Tablet View" logo="icon ni ni-tablet" url="{{ route('tablets.index') }}"/>


        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">List of Owners</h6>
        </li>

        <x-menu name="Owners" logo="icon ni ni-user-fill" url="{{ route('owners.index') }}"/>
        <x-menu name="Tenants" logo="icon ni ni-users-fill" url="{{ route('tenants.index') }}"/>

        {{-- <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Permits</h6>
        </li>

     
        <x-menu name="Gate Pass" logo="icon ni ni-file-plus" url="#" :is-parent="true" :children="[
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
        ]"/> --}}



        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Purchasing</h6>
        </li>
        <x-menu name="For Accreditation" logo="icon ni ni-user-list-fill" url="#" :is-parent="true" :children="[
            array('name' => 'New Application', 'url' =>  route('dealers.index')  . '?status=1' ),
            array('name' => 'Accredited Vendors', 'url' =>  route('dealers.index')  . '?status=2'  ),
            array('name' => 'For Renewal', 'url' =>  route('dealers.index')  . '?status=3'  ),
            array('name' => 'Bidding', 'url' =>  '#' ),
            array('name' => 'Purchase Orders', 'url' =>  '#' ),
            array('name' => 'Vendor Invoices', 'url' =>  '#' ),
        ]"/>
        {{-- <x-menu name="Vendors" logo="icon ni ni-user-list-fill" url="#" :is-parent="true" :children="[
            array('name' => 'Vendors', 'url' =>  route('vendors.index') ),
            array('name' => 'Supplier Items', 'url' =>  route('supplier-items.index') ),
        ]"/> --}}


        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Finance</h6>
        </li>

        <x-menu name="Accounting" logo="icon ni ni-money" url="#" :is-parent="true" :children="[
            array('name' => 'Accounts', 'url' =>  route('accounts.index') ),
            array('name' => 'Banks', 'url' =>  route('banks.index') ),
            array('name' => 'Cash Flow', 'url' =>  route('entries.index')),
        ]"/>

        <x-menu name="Reading" logo="icon ni ni-meter" url="#" :is-parent="true" :children="[
            array('name' => 'Water', 'url' =>  route('waters.index') ),
            array('name' => 'Electricity', 'url' =>  route('electrics.index') ),
        ]"/>

        <x-menu name="Invoices" logo="icon ni ni-file-docs" url="{{ route('debits.index') }}"/>
        <x-menu name="Payments" logo="icon ni ni-wallet-fill" url="{{ route('subscriptions.index') }}"/>

        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Human Resources</h6>
        </li>
        <x-menu name="Attendances" logo="icon ni ni-task" url="{{ route('attendances.index') }}"/>

        <x-menu name="Leaves" logo="icon ni ni-clock-fill" url="#" :is-parent="true" :children="[
            array('name' => 'Leaves', 'url' =>  route('leaves.index') ),
            array('name' => 'Types', 'url' =>  route('leave-types.index') ),
        ]"/>

        
    </ul>
</div>