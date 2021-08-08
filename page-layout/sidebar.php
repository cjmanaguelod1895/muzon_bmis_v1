<?php 
require_once('./database/db_config.php');


// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
$official_ID = $_SESSION['official_ID'];
$user_sql = mysqli_query($conn,"SELECT rp.position_Name,rd.*,rs.suffix,bod.commitee_assignID FROM `brgy_official_detail` bod 
INNER JOIN resident_detail rd ON rd.res_ID = bod.res_ID
LEFT JOIN ref_position rp ON rp.position_ID = bod.commitee_assignID
LEFT JOIN ref_suffixname rs ON rs.suffix_ID = rd.suffix_ID
WHERE 
bod.official_ID = '$official_ID'");
$user_data = mysqli_fetch_array($user_sql);
?>

<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
<div class="brand-sidebar">
    <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="index.html"><img class="hide-on-med-and-down " src="./app-assets/images/logo/materialize-logo.png" alt="materialize logo" /><img class="show-on-medium-and-down hide-on-med-and-up" src="./app-assets/images/logo/materialize-logo-color.png" alt="materialize logo" /><span class="logo-text hide-on-med-and-down">Materialize</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
</div>
<ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="accordion">
    
    <li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="/bmis_v1/barangay-officials-profile-list.php"><i class="material-icons">mail_outline</i><span class="menu-title" data-i18n="Mail">Dashboard</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="/bmis_v1/userAccount.php"><i class="material-icons">chat_bubble_outline</i><span class="menu-title" data-i18n="Chat">Account</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-todo.html"><i class="material-icons">check</i><span class="menu-title" data-i18n="ToDo">Purok</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-kanban.html"><i class="material-icons">format_list_bulleted</i><span class="menu-title" data-i18n="Kanban">Clearance and Forms</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-file-manager.html"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="File Manager">Health and Sanitation</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-contacts.html"><i class="material-icons">import_contacts</i><span class="menu-title" data-i18n="Contacts">Peace and Order</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Finance</span></a>
    </li>
    <!-- Settings -->

    <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Resident Profiling</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Announcements</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Barangay Officials</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Reports</span></a>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="app-calendar.html"><i class="material-icons">today</i><span class="menu-title" data-i18n="Calendar">Setup</span></a>
    </li>
    </li>
    <li class="navigation-header"><a class="navigation-header-text">Setup</a><i class="navigation-header-icon material-icons">more_horiz</i>
    </li>
    <li class="bold"><a class="waves-effect waves-cyan " href="/bmis_v1/import-settings.php"><i class="material-icons">import_export</i><span class="menu-title" data-i18n="Import"></span>Import CSV / Excel</a>
    </li>
</ul>
<div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>


