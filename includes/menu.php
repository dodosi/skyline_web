  						<?php
					$role = $_SESSION['user_type']; 
					if($role == 0){
					 
                    echo '
					<li>
                        <a href="dashboard"><i class="menu-icon fa fa-tachometer"></i>Dashboard </a>
                    </li> 
                    <li class="menu-title">Users Management</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Customer</a>
                        <ul class="sub-menu children dropdown-menu">                            
						    <li><i class="fa fa-users"></i><a href="customers">View customers</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Partner-Garages</a>
                        <ul class="sub-menu children dropdown-menu"> 
                            <li><i class="fa fa-cogs"></i><a href="allgarages">View Garages</a></li>
							<li><i class="fa fa-user-o"></i><a href="partners">View Partners</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user-circle-o"></i>Driver</a>
                        <ul class="sub-menu children dropdown-menu">
						    <li><i class="fa fa-user-circle-o"></i><a href="drivers">View Drivers</a></li> 
                        </ul>
                    </li>
					
					
					<li class="menu-title">PRODUCTS</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-fort-awesome"></i>Categories</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="category">View Categories</a></li> 
                        </ul>
                    </li> 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Services</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-bar-chart"></i><a href="services"> View Services</a></li>
							<li><i class="menu-icon fa fa-map-o"></i><a href="servicesprovision"> View Services-Providers</a></li>
                        </ul>
                    </li>  
					

                    <li class="menu-title">ACTIONS</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cart-plus"></i>Bookings</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-cart-plus"></i><a href="bookings">View Bookings</a></li>							
                        </ul>
                    </li> 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Pickup Fee</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-money"></i><a href="pickups">Pickup Fee</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-comments"></i>Enquiries</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-comments"></i><a href="enquiries">Enquiries</a></li>
                        </ul>
                    </li>
					<li class="menu-title">&nbsp;</li><!-- /.menu-title -->
					<li class="menu-title">&nbsp;</li><!-- /.menu-title -->
					<li class="menu-title">&nbsp;</li><!-- /.menu-title -->
					'; 
					}else{ 
						echo '
					<li>
                        <a href="dashboard"><i class="menu-icon fa fa-tachometer"></i>Dashboard </a>
                    </li>
					
					<li class="menu-title">ACTIONS</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cart-plus"></i>Bookings</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-cart-plus"></i><a href="bookingPartner">View Bookings</a></li>

                            <li><i class="menu-icon fa fa-cart-plus"></i><a href="bookingAssigned">Booking assigned</a></li> 							
                        </ul>
                    </li> 
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bell-o"></i>Notifications</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-bell-o"></i><a href="notifications">Manage notifications</a></li> 
                        </ul>
                    </li>
					
					<li class="menu-title">MANAGEMENT</li><!-- /.menu-title -->
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Garage</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-car"></i><a href="garage">Garage Details</a></li>
                            <li><i class="menu-icon fa fa-bar-chart"></i><a href="servicesprovisionGarage"> View Services</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-credit-card"></i>Invoices</a>
                        <ul class="sub-menu children dropdown-menu">
                            <!--<li><i class="menu-icon fa fa-credit-card"></i><a href="invoices">View Invoices</a></li>-->
                            <li><i class="menu-icon fa fa-credit-card"></i><a href="invoice_list.php">View Invoices</a></li>
		                    <li><i class="menu-icon fa fa-credit-card"></i><a href="create_invoice.php">Create Invoice</a></li>							
                        </ul>
                    </li>
					'; 
					} 
					?>