<?php
/**
 * @var \App\View\AppView $this
 */

$controller = $this->getRequest()->getParam("controller");
$action = $this->getRequest()->getParam("action");
$sidebarItems = [
    [
        "label" => __("Dashboard"),
        "icon" => "home",
        "url" => $this->Url->build([
            "controller" => "Users",
            "action" => "dashboard"
        ]),
        "is_active" => $controller === "Users" && $action === "dashboard"
    ], [
        "label" => __("User"),
        "icon" => "user",
        "url" => $this->Url->build([
            "controller" => "Users",
            "action" => "index"
        ]),
        "is_active" => $controller === "Users" && $action === "index"
    ], [
        "label" => __("Employees"),
        "icon" => "users",
        "url" => $this->Url->build([
            "controller" => "Employees",
            "action" => "index"
        ]),
        "is_active" => $controller === "Employees" && $action === "index"
    ], [
        "label" => __("Department"),
        "icon" => "database",
        "url" => $this->Url->build([
            "controller" => "Departments",
            "action" => "index"
        ]),
        "is_active" => $controller === "Departments" && $action === "index"
    ], [
        "label" => __("Logout"),
        "icon" => "log-out",
        "url" => $this->Url->build([
            "controller" => "Users",
            "action" => "logout",
            "prefix" => false
        ]),
        "is_active" => false,
    ]
];
?>

<style>
    .nav-aside .nav-link {
        position: relative;
        display: flex;
        align-items: center;
        padding: 0 ;
        height: 40px;
        color: rgba(27, 46, 75, 0.9);
        transition: all 0.25s;
    }
    .aside-logo img{
        max-height: 40px;
        max-width: 125px;
    }
</style>
<aside class="aside aside-fixed">
    <div class="aside-header">
        <a href="<?php echo $this->Url->build([
            'controller' => 'Users',
            'action' => 'dashboard',
        ])?>" class="aside-logo tx-20 tx-spacing-2 text-success"><?php echo $this->Html->image('emp-logo.jpg', ['alt'=>'emp']) ?>
        </a>
        <a href="" class="aside-menu-link">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </a>
    </div>
    <div class="aside-body">
        <ul class="nav nav-aside">
            <?php foreach ( $sidebarItems as $item ) { ?>
                <li class="nav-item <?php echo $item["is_active"] ? "active" : ""; ?>">
                    <a href="<?php echo $item["url"]; ?>" class="nav-link tx-spacing-2 text-truncate"><i data-feather="<?php echo $item["icon"]; ?>"></i> <span><?php echo $item["label"]; ?></span></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>
