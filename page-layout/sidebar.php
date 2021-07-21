<?php 


echo '<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
<div class="brand-sidebar">
    <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img class="hide-on-med-and-down " src="./app-assets/images/logo/materialize-logo.png" alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up" src="./app-assets/images/logo/materialize-logo-color.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
</div>
<ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="accordion">';

if ($_SESSION['user_data']['type'] === "Administrator") {
    echo '<li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="/bmis_v1/barangay-officials-profile-list.php"><i class="material-icons">mail_outline</i><span class="menu-title" data-i18n="Mail">Barangay Officials Profile</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-chat.html"><i class="material-icons">chat_bubble_outline</i><span class="menu-title" data-i18n="Chat">Staff</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-todo.html"><i class="material-icons">check</i><span class="menu-title" data-i18n="ToDo">Purok</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-kanban.html"><i class="material-icons">format_list_bulleted</i><span class="menu-title" data-i18n="Kanban">Household</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-file-manager.html"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="File Manager">Resident</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-contacts.html"><i class="material-icons">import_contacts</i><span class="menu-title" data-i18n="Contacts">Permit</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Blotter</span></a>
    </li>
    <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">receipt</i><span class="menu-title" data-i18n="Invoice">Invoice</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                <li><a href="app-invoice-list.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice List">Invoice List</span></a>
                </li>
                <li><a href="app-invoice-view.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice View">Invoice View</span></a>
                </li>
                <li><a href="app-invoice-edit.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Edit">Invoice Edit</span></a>
                </li>
                <li><a href="app-invoice-add.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Add">Invoice Add</span></a>
                </li>
            </ul>
        </div>
    </li>
    <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">add_shopping_cart</i><span class="menu-title" data-i18n="eCommerce">eCommerce</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                <li><a href="eCommerce-products-page.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Products Page">Products Page</span></a>
                </li>
                <li><a href="eCommerce-pricing.html"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Pricing">Pricing</span></a>
                </li>
            </ul>
        </div>
    </li>

    <!-- Settings -->
    <li class="navigation-header"><a class="navigation-header-text">Settings </a><i class="navigation-header-icon material-icons">more_horiz</i>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="/bmis_v1/import-settings.php"><i class="material-icons">import_export</i><span class="menu-title" data-i18n="Import"></span>Import CSV / Excel</a>
    </li>
</ul>
<div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>';
}



?>


