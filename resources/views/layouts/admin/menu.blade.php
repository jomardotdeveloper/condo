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
            array('name' => 'Users', 'url' => '#'),
        ]"/>

        <x-menu name="Move In" logo="icon ni ni-home-fill" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' => '#'),
            array('name' => 'For Payments', 'url' => '#'),
            array('name' => 'Lobby Guard', 'url' => '#'),
        ]"/>

        <x-menu name="Move Out" logo="icon ni ni-delete-fill" url="#" :is-parent="true" :children="[
            array('name' => 'New Applications', 'url' => '#'),
            array('name' => 'For Payments', 'url' => '#'),
            array('name' => 'Lobby Guard', 'url' => '#'),
        ]"/>
    </ul>
</div>