<div class="nk-sidebar-menu" data-simplebar>
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">MAIN</h6>
        </li>
        <x-menu name="Dashboard" logo="icon ni ni-growth-fill" url="{{ route('admin.dashboard') }}"/>

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
            array('name' => 'Lobby Guard', 'url' =>  route('applications.index')  . '?status=3'),
        ]"/>

        <x-menu name="Move Out" logo="icon ni ni-delete-fill" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' =>  route('move-outs.index')  . '?status=1'),
            array('name' => 'For Payments', 'url' =>  route('move-outs.index')  . '?status=2'),
            array('name' => 'Lobby Guard', 'url' =>  route('move-outs.index')  . '?status=3'),
        ]"/>

        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">List of Owners</h6>
        </li>

        <x-menu name="Owners" logo="icon ni ni-user-fill" url="{{ route('owners.index') }}"/>
        <x-menu name="Tenants" logo="icon ni ni-users-fill" url="{{ route('tenants.index') }}"/>


        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Inventory</h6>
        </li>
        <x-menu name="Vendors" logo="icon ni ni-user-list-fill" url="#" :is-parent="true" :children="[
            array('name' => 'Vendors', 'url' =>  route('vendors.index') ),
            array('name' => 'Supplier Items', 'url' =>  route('supplier-items.index') ),
        ]"/>


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