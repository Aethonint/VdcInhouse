   <aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
            <div class="">
             <!-- <h4>Fleet</h4> -->
            </div>
            <div>
    <h4 class="logo-text">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('adminui/assets/images/avatars/fleetlogo.png') }}" 
                 class="logo-icon" 
                 alt="logo icon">
        </a>
    </h4>
</div>

            <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
            </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">
            <li>
              <a href="{{route('admin.dashboard')}}" class="">
                <div class="parent-icon"><i class="bi bi-grid"></i>
                </div>
                <div class="menu-title">Dashboard</div>
              </a>
              <!-- <ul>
                <li> <a href="index.html"><i class="bi bi-arrow-right-short"></i>eCommerce</a>
                </li>
               
              </ul> -->
            </li>
          
              
           
           
            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-wrench-adjustable-circle"></i>
                </div>
                <div class="menu-title">Vehicle Checks</div>
              </a>
              <ul>
                <li> <a href="#"><i class="bi bi-arrow-right-short"></i>Today's Checks</a>
                </li>
                 <li> <a href="#"><i class="bi bi-arrow-right-short"></i>Missed / Incomplete</a>
                </li>
               
               <li> <a href="#"><i class="bi bi-arrow-right-short"></i>Full Check History</a>
                </li>
               
                
               
               
              </ul>
            </li>
            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-car-front"></i>
                </div>
                <div class="menu-title">Vehicles</div>
              </a>
              <ul>
                <li> <a href="{{route('vehicle.index')}}"><i class="bi bi-arrow-right-short"></i>Vehicle List</a>
                </li>
                 <li> <a href="ecommerce-products-grid.html"><i class="bi bi-arrow-right-short"></i>Vehicle Documents</a>
                </li>
                 <li> <a href="ecommerce-products-grid.html"><i class="bi bi-arrow-right-short"></i>Wash Tracker </a>
                </li>
              
              </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-person"></i>
                </div>
                <div class="menu-title">Drivers</div>
              </a>
              <ul>
                <li> <a href="{{route('driver.index')}}"><i class="bi bi-arrow-right-short"></i>Driver List</a>
                </li>
                <li> <a href="{{route('assign_vehicle.index')}}"><i class="bi bi-arrow-right-short"></i>Assign Vehicle</a>
                </li>
                 <li> <a href="component-accordions.html"><i class="bi bi-arrow-right-short"></i>Driver Documents</a>
                </li>
               
              </ul>
            </li>
            <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-gear-wide-connected"></i>
                </div>
                <div class="menu-title">Defects</div>
              </a>
              <ul>
                <li> <a href="{{route('defect.index')}}"><i class="bi bi-arrow-right-short"></i>Active Defects</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bi bi-arrow-right-short"></i>Resolved Defects</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-arrow-right-short"></i>Report New Defect</a>
                </li>
                
              </ul>
            </li>


            <!-- <li class="sidebar-divider"></li> -->

             <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-house"></i>
                </div>
                <div class="menu-title">Sites</div>
              </a>
              <ul>
                <li> <a href="icons-line-icons.html"><i class="bi bi-arrow-right-short"></i>Site List</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bi bi-arrow-right-short"></i>Site Reports</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-arrow-right-short"></i>Site Inspections</a>
                </li>
              </ul>
            </li>
             <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="menu-title">Incidents</div>
              </a>
              <ul>
                <li> <a href="icons-line-icons.html"><i class="bi bi-arrow-right-short"></i>All Reports</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bi bi-arrow-right-short"></i>Escalated</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-arrow-right-short"></i>Add New Incident</a>
                </li>
              </ul>
            </li>
             <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-receipt"></i>
                </div>
                <div class="menu-title">Report</div>
              </a>
              <ul>
                <li> <a href="icons-line-icons.html"><i class="bi bi-arrow-right-short"></i>Generate PDF/Excel</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bi bi-arrow-right-short"></i>Monthly Summary</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-arrow-right-short"></i>Export Logs</a>
                </li>
              </ul>
            </li>


             <!-- <li class="sidebar-divider"></li> -->

             <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-gear"></i>
                </div>
                <div class="menu-title">Setting</div>
              </a>
              <ul>
                <li> <a href="icons-line-icons.html"><i class="bi bi-arrow-right-short"></i>Users & Roles</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bi bi-arrow-right-short"></i>Notifications</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-arrow-right-short"></i>Company Info</a>
                </li>
              </ul>
            </li>
             <li>
              <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bi bi-question-circle"></i>
                </div>
                <div class="menu-title">Help</div>
              </a>
              <ul>
                <li> <a href="icons-line-icons.html"><i class="bi bi-arrow-right-short"></i>Line Icons</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bi bi-arrow-right-short"></i>Boxicons</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bi bi-arrow-right-short"></i>Feather Icons</a>
                </li>
              </ul>
            </li>
           
          </ul>
          <!--end navigation-->
       </aside>