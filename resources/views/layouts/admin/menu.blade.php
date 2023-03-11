<div class="nk-sidebar-menu" data-simplebar>
    <ul class="nk-menu">
        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">MAIN</h6>
        </li>
        <x-menu name="Dashboard" logo="icon ni ni-growth-fill" url="#"/>

        <x-menu name="Settings" logo="icon ni ni-setting-fill" url="#" :is-parent="true" :children="[
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

        <x-menu name="Owners" logo="icon ni ni-user-fill" url="#"/>
        <x-menu name="Tenants" logo="icon ni ni-users-fill" url="#"/>

        <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Finance</h6>
        </li>

        <x-menu name="Invoices" logo="icon ni ni-file-docs" url="{{ route('invoices.index') }}"/>
        <x-menu name="Payments" logo="icon ni ni-wallet-fill" url="{{ route('payments.index') }}"/>
        
    </ul>
</div>