<div class="dashboardSidebar" id="dashboardSidebar">
    <h3 class="dashboardLogo" id="dashboardLogo">IMS</h3>
    <div class="dashboardSidebarUser">
        <img src="Images/no-user-image.jpg" alt="User Image" id="userImage" />
        <span><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
    </div>
    <div class="dashboardSidebarMenu">
        <ul class="dashboardMenuList">
            <!-- class="menuActive" -->
            <li class="liMainMenu">
                <a href="./dashboard.php"><i class="fa-solid fa-gauge menuIcons"></i><span class="menuText"> Dashboard</span></a>
            </li>
            <li class="liMainMenu">
                <a href="./inbox.php"><i class="fa-solid fa-inbox"></i><span class="menuText"> Inbox</span></a>
            </li>
            <li class="liMainMenu">
                <a href="./inventory-management.php"><i class="fa-solid fa-boxes-stacked"></i><span class="menuText"> Inventory</span></a>
            </li>
            <li class="liMainMenu">
                <a href="./order-management.php"><i class="fa-solid fa-file-invoice"></i></i><span class="menuText"> Orders</span></a>
            </li>
            <li class="liMainMenu">
                <a href="./supplier-management.php"><i class="fa-solid fa-boxes-packing"></i><span class="menuText"> Suppliers</span></a>
            </li>
            <!-- <li class="liMainMenu" id="mainUserMenu">
                <a href="./user-add.php" id="subUserMenu"><i class="fa-solid fa-user-plus"></i><span class="menuText"> Users</span><i class="fa-solid fa-angle-down mainMenuIconArrow"></i></a>
                <ul class="subMenus">
                    <li class="liSubMenu"><a href="#"><i class="fa-solid fa-circle"></i> View Users</a></li>
                    <li class="liSubMenu"><a href="#"><i class="fa-solid fa-circle"></i> Add User</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</div>