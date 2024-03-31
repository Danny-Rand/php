<div class="dashboardSidebar" id="dashboardSidebar">
    <h3 class="dashboardLogo" id="dashboardLogo">IGAN'S</h3>
    <div class="dashboardSidebarUser">
        <img src="Images/no-user-image.jpg" alt="User Image" id="userImage" />
        <span><?= $user['first_name'] . ' ' . $user['last_name']?></span>
    </div>
    <div class="dashboardSidebarMenu">
        <ul class="dashboardMenuList">
            <!-- class="menuActive" -->
            <li>
                <a href="./dashboard.php"><i class="fa-solid fa-gauge menuIcons"></i><span class="menuText"> Dashboard</span></a>
            </li>
            <li>
                <a href="./inventory-management.php"><i class="fa-solid fa-boxes-stacked"></i><span class="menuText"> Inventory Management</span></a>
            </li>
            <li>
                <a href="./order-management.php"><i class="fa-solid fa-file-invoice"></i></i><span class="menuText"> Order Management</span></a>
            </li>
            <li>
                <a href="./supplier-management.php"><i class="fa-solid fa-boxes-packing"></i><span class="menuText"> Supplier Management</span></a>
            </li>
            <li>
                <a href="./user-add.php"><i class="fa-solid fa-user-plus"></i><span class="menuText"> Add User</span></a>
            </li>
        </ul>
    </div>
</div>