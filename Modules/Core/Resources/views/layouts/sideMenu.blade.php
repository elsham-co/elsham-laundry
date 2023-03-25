<?php function cuurentroute($route, $action)
{
    if (\Request::route()->getName() == $route) echo $action;
} ?>
<div class="aside">
    <div class="aside-header">
        <h3 class="aside-title">
            <img src="{{asset('images/logo.png')}}" height="90" alt="" style="position: absolute;
            width: 45%;
            top: -2%;
            left: 38%;">
        </h3>
        <div class="aside-addon">
            <button class="btn btn-label-primary btn-icon btn-lg" data-toggle="aside">
                <i class="fa fa-times aside-icon-minimize"></i>
                <i class="fa fa-thumbtack aside-icon-maximize"></i>
            </button>
        </div>
    </div>
    <div class="aside-body" data-simplebar="data-simplebar">
        <!-- BEGIN Menu -->
        <div class="menu">
            @can('dashboard')
                <div class="menu-item">
                    <a href="{{route('dashboard')}}" class="menu-item-link {{cuurentroute('dashboard','active')}}">
                        <div class="menu-item-icon">
                            <i data-feather="home"></i>
                        </div>
                        <span class="menu-item-text">{{__('Dashboard')}}</span>

                    </a>
                </div>
            @endcan
            @canany(['roles', 'admins','permissions'])
                <div class="menu-item">
                    <button
                        class="menu-item-link menu-item-toggle  {{cuurentroute('admins.index','active')}} {{cuurentroute('roles.index','active')}}
                        {{cuurentroute('permissions.index','active')}}">
                        <div class="menu-item-icon">
                            <i class="fas fa-user-lock"></i>
                        </div>
                        <span class="menu-item-text">{{__('Admins')}}</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->

                    <div class="menu-submenu">
                        @can('admins')
                            <div class="menu-item">
                                <a href="{{route('admins.index')}}"
                                   class="menu-item-link {{cuurentroute('admins.index','active')}} ">
                                    <i class="fas fa-user-lock"></i>
                                    <span class="menu-item-text">{{__('Admins')}}</span>
                                </a>
                            </div>
                        @endcan
                        @can('roles')
                            <div class="menu-item">
                                <a href="{{route('roles.index')}}"
                                   class="menu-item-link {{cuurentroute('roles.index','active')}}">
                                    <i class="fa fa-ban"></i>
                                    <span class="menu-item-text">{{__('Roles')}}</span>
                                </a>
                            </div>
                        @endcan
                        @can('permissions')
                        <div class="menu-item ml-2 mr-2">
                            <a href="{{route('permissions.index')}}" class="menu-item-link {{cuurentroute('permissions.index','active')}}">
                                <i class="far fa-eye-slash"></i>
                                <span class="menu-item-text">{{__('Permissions')}}</span>
                            </a>
                        </div>
                    @endcan
                    </div>


                    <!-- END Menu Submenu -->
                </div>
            @endcan
        <!-- BEGIN Menu Section -->

            @can('customers')
            <div class="menu-item">
                <button
                    class="menu-item-link menu-item-toggle  {{cuurentroute('Customers.index','active')}} {{cuurentroute('Customers.create','active')}}">
                    <div class="menu-item-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <span class="menu-item-text">{{__('customers')}}</span>
                    <div class="menu-item-addon">
                        <i class="menu-item-caret caret"></i>
                    </div>
                </button>
                                                              <!-- ------------------------------------------------------------------- -->
                         <!-- BEGIN subMenu  customers -->

                         <div class="menu-submenu">
                            {{-- @can('admins') --}}
                                <div class="menu-item">
                                    <a href="{{route('Customers.create')}}"
                                       class="menu-item-link {{cuurentroute('Customers.create','active')}} ">
                                        <span class="menu-item-text">{{__('Add New Customer')}}</span>
                                    </a>
                                </div>
                            {{-- @endcan
                            @can('roles') --}}
                                <div class="menu-item">
                                    <a href="{{route('Customers.index')}}"
                                       class="menu-item-link {{cuurentroute('Customers.index','active')}}">
                                     
                                        <span class="menu-item-text">{{__('view All Customers')}}</span>
                                    </a>
                                </div>
                            {{-- @endcan --}}
                         </div>
            </div>
            @endcan

            @can('orders')

            <div class="menu-item">
                <button
                    class="menu-item-link menu-item-toggle  {{cuurentroute('orders.index','active')}} {{cuurentroute('orders.create','active')}}">
                    <div class="menu-item-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <span class="menu-item-text">{{__('Orders')}}</span>
                    <div class="menu-item-addon">
                        <i class="menu-item-caret caret"></i>
                    </div>
                </button>
                                                              <!-- ------------------------------------------------------------------- -->
                         <!-- BEGIN subMenu  colors -->

                         <div class="menu-submenu">
                            {{-- @can('create_orders') --}}
                                <div class="menu-item">
                                    <a href="{{route('orders.create')}}"
                                       class="menu-item-link {{cuurentroute('orders.create','active')}} ">
                                        <span class="menu-item-text">{{__('create production orders')}}</span>
                                    </a>
                                </div>
                            {{-- @endcan
                            @can('orders') --}}
                                <div class="menu-item">
                                    <a href="{{route('orders.index')}}"
                                       class="menu-item-link {{cuurentroute('orders.index','active')}}">
                                     
                                        <span class="menu-item-text">{{__('view all orders')}}</span>
                                    </a>
                                </div>
                            
                            {{-- @endcan --}}
                         </div>
            </div>
            @endcan
<!---------------------------------------------------------------->
            @canany(['samples', 'sampleorder'])
                <div class="menu-item">
                    <button
                        class="menu-item-link menu-item-toggle  {{cuurentroute('SamplesOrder.index','active')}} {{cuurentroute('SamplesOrder.create','active')}}
                        {{cuurentroute('SampleBank.index','active')}} {{cuurentroute('TestSample.index','active')}} {{cuurentroute('inlabSample.index','active')}}
                        {{cuurentroute('SamplesOrder.trashed.index','active')}}">
                        <div class="menu-item-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <span class="menu-item-text">{{__('Samples')}}</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                {{-- </div> --}}
               
                    <!-- BEGIN Menu Submenu -->
                    @can('sampleorder')
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <button
                                class="menu-item-link menu-item-toggle  {{cuurentroute('SamplesOrder.index','active')}} {{cuurentroute('SamplesOrder.create','active')}}
                                {{cuurentroute('SamplesOrder.trashed.index','active')}}">
                                <div class="menu-item-icon">
                                    <i class="fa fa-vial"></i>
                                </div>
                                <span class="menu-item-text">{{__('Samples order')}}</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                                                   <!-- BEGIN subMenu  Samples order -->

                         <div class="menu-submenu">
                            {{-- @can('admins') --}}
                                <div class="menu-item">
                                    <a href="{{route('SamplesOrder.create')}}"
                                       class="menu-item-link {{cuurentroute('SamplesOrder.create','active')}} ">
                                        <span class="menu-item-text">{{__('Create Samples Order')}}</span>
                                    </a>
                                </div>
                            {{-- @endcan --}}
                            {{-- @can('roles') --}}
                                <div class="menu-item">
                                    <a href="{{route('SamplesOrder.index')}}"
                                       class="menu-item-link {{cuurentroute('SamplesOrder.index','active')}}">
                                     
                                        <span class="menu-item-text">{{__('View All Samples Order')}}</span>
                                    </a>
                                </div>
                            {{-- @endcan --}}
                        </div>
                        </div>
                        
                        @endcan 
                                                                  <!-- ------------------------------------------------------------------- -->
  <!-- BEGIN Menu Submenu -->
  @can('samples')
  <div class="menu-submenu">
    <div class="menu-item">
        <button
            class="menu-item-link menu-item-toggle  {{cuurentroute('SampleBank.index','active')}} {{cuurentroute('TestSample.index','active')}}
            {{cuurentroute('inlabSample.index','active')}}">
            <div class="menu-item-icon">
                <i class='fas fa-eye-dropper'></i>
            </div>
            <span class="menu-item-text">{{__('lab Samples')}}</span>
            <div class="menu-item-addon">
                <i class="menu-item-caret caret"></i>
            </div>
        </button>
                               <!-- BEGIN subMenu  Samples Creation -->

     <div class="menu-submenu">
        @can('create-sample') 
            <div class="menu-item">
               <a href="{{route('TestSample.index')}}"
                   class="menu-item-link {{cuurentroute('TestSample.index','active')}} "> 
                    <span class="menu-item-text">{{__('Show Test Samples')}}</span>
                    
                 </a> 
            </div>
        @endcan
        {{-- @can('roles') --}}
            <div class="menu-item">
                <a href="{{route('SampleBank.index')}}"
                   class="menu-item-link {{cuurentroute('SampleBank.index','active')}}">
                 
                    <span class="menu-item-text">{{__('View Lab Samples')}}</span>
                </a>
            </div>
        {{-- @endcan --}}
    </div>
    </div>
                                              <!-- ------------------------------------------------------------------- -->
                                           
</div>

                    </div>
                    @endcan   
                </div>      
                                                                                       <!-- ------------------------------------------------------------------- -->
              @endcan

            @can('ores_receipt')
<div class="menu-item">
    <button
        class="menu-item-link menu-item-toggle  {{cuurentroute('oresreceipt.create','active')}} {{cuurentroute('oresreceipt.index','active')}}">
        <div class="menu-item-icon">
            <i class="fa fa-balance-scale-right"></i>
        </div>
        <span class="menu-item-text">{{__('Ores Receipt')}}</span>
        <div class="menu-item-addon">
            <i class="menu-item-caret caret"></i>
        </div>
    </button>
                                                  <!-- ------------------------------------------------------------------- -->
             <!-- BEGIN subMenu  customers -->

             <div class="menu-submenu">
                @can('create_ores')
                    <div class="menu-item">
                        <a href="{{route('oresreceipt.create')}}"
                           class="menu-item-link {{cuurentroute('oresreceipt.create','active')}} ">
                            <span class="menu-item-text">{{__('Add New Ores Receipt')}}</span>
                        </a>
                    </div>
                @endcan
                @can('ores_receipt')
                    <div class="menu-item">
                        <a href="{{route('oresreceipt.index')}}"
                           class="menu-item-link {{cuurentroute('oresreceipt.index','active')}}">
                         
                            <span class="menu-item-text">{{__('View All Materials Received')}}</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="{{route('oresreceipt.index')}}"
                           class="menu-item-link {{cuurentroute('oresreceipt.index','active')}}">
                         
                            <span class="menu-item-text">{{__('Activate Ores Receipt')}}</span>
                        </a>
                    </div>
                    
                    <div class="menu-item">
                        <a href="{{route('Customers.index')}}"
                           class="menu-item-link {{cuurentroute('Customers.index','active')}}">
                         
                            <span class="menu-item-text">{{__('View Active production orders')}}</span>
                        </a>
                    </div>
                @endcan
             </div>
</div>
            @endcan

{{-- بدايه المتابعه --}}

            @can('production_division')
            <div class="menu-item">
                <button
                    class="menu-item-link menu-item-toggle  {{cuurentroute('pro_follow_up.index','active')}} {{cuurentroute('pro_follow_up.create','active')}}
                    {{cuurentroute('transaction.index','active')}} {{cuurentroute('movements.index','active')}}">
                    <div class="menu-item-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <span class="menu-item-text">{{__('Production follow-up')}}</span>
                    <div class="menu-item-addon">
                        <i class="menu-item-caret caret"></i>
                    </div>
                </button>
                                                              <!-- ------------------------------------------------------------------- -->
                         <!-- BEGIN subMenu  colors -->
                        
                         <div class="menu-submenu">
                            @can('active_order')
                            <div class="menu-item">
                                <a href="{{route('pro_follow_up.create')}}"
                                   class="menu-item-link {{cuurentroute('pro_follow_up.create','active')}} ">
                                    <span class="menu-item-text"> {{__('Run Production Order')}}</span>
                                </a>
                            </div>
                            @endcan
                            @can('view_active_order')
                                <div class="menu-item">
                                    <a href="{{route('pro_follow_up.index')}}"
                                       class="menu-item-link {{cuurentroute('pro_follow_up.index','active')}} ">
                                        <span class="menu-item-text">{{__('Libra Store')}}</span>
                                    </a>
                                </div>
                                @endcan
                                {{-- /===================================================================== --}}
                                @can('all_follow_up')
                                <div class="menu-item">
                                    <a href="{{route('movements.index')}}"
                                       class="menu-item-link {{cuurentroute('movements.index','active')}} ">
                                        <span class="menu-item-text">{{__('Follow-up Movement')}}</span>
                                    </a>
                                </div>
                                {{-- <div class="menu-item">
                                    <a href="{{route('transaction.index')}}"
                                       class="menu-item-link {{cuurentroute('transaction.index','active')}}">
                                     
                                        <span class="menu-item-text">{{__('Follow-up stages')}}</span>
                                    </a>
                                </div> --}}
                                @endcan
                         </div>
            </div>
            @endcan
{{-- نهايه المتابعه --}}
{{-- نهايه المتابعه --}}






            @can('inventory')
                <div class="menu-item ml-2 mr-2">
                    <a href="{{route('colors.create')}}" class="menu-item-link {{cuurentroute('colors.create','disabled')}}">
                        <i class="fa fa-boxes"></i>
                        <span class="menu-item-text">{{__('Inventory')}}</span>
                    </a>
                </div>
            @endcan
            
            @canany(['components'])
                <div class="menu-item">
                    <button
                        class="menu-item-link menu-item-toggle  
                        {{cuurentroute('colors.index','active')}} {{cuurentroute('colors.create','active')}} {{cuurentroute('ccategory.index','active')}}
                        {{cuurentroute('Fabrics.index','active')}} {{cuurentroute('Fabrics.create','active')}} {{cuurentroute('Category.index','active')}}
                        {{cuurentroute('Threads.index','active')}} {{cuurentroute('Threads.create','active')}}
                        {{cuurentroute('Fashions.index','active')}} {{cuurentroute('Fashions.create','active')}}{{cuurentroute('fascategory.index','active')}}">
                        <div class="menu-item-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <span class="menu-item-text">{{__('Components')}}</span>
                        <div class="menu-item-addon">
                            <i class="menu-item-caret caret"></i>
                        </div>
                    </button>
                    <!-- BEGIN Menu Submenu -->
                   
                    <div class="menu-submenu">
                        <div class="menu-item">
                            <button
                                class="menu-item-link menu-item-toggle  {{cuurentroute('colors.index','active')}} {{cuurentroute('colors.create','active')}} {{cuurentroute('ccategory.index','active')}}">
                                <div class="menu-item-icon">
                                    <i class="fa fa-flask"></i>
                                </div>
                                <span class="menu-item-text">{{__('Colors')}}</span>
                                <div class="menu-item-addon">
                                    <i class="menu-item-caret caret"></i>
                                </div>
                            </button>
                           
                                                                                       <!-- ------------------------------------------------------------------- -->
                         <!-- BEGIN subMenu  colors -->

                         <div class="menu-submenu">
                            @can('create_colors')
                                <div class="menu-item">
                                    <a href="{{route('colors.create')}}"
                                       class="menu-item-link {{cuurentroute('colors.create','active')}} ">
                                        <span class="menu-item-text">{{__('Create Colors Stage')}}</span>
                                    </a>
                                </div>
                            @endcan
                            {{-- @can('roles') --}}
                                <div class="menu-item">
                                    <a href="{{route('colors.index')}}"
                                       class="menu-item-link {{cuurentroute('colors.index','active')}}">
                                     
                                        <span class="menu-item-text">{{__('View All Colors')}}</span>
                                    </a>
                                </div>
                            {{-- @endcan --}}
                </div>
                        <!-- END Submenu -->
                <!-- ------------------------------------------------------------------- -->
                  <div class="menu-item">
                  <button
                  class="menu-item-link menu-item-toggle  {{cuurentroute('Fabrics.index','active')}} {{cuurentroute('Fabrics.create','active')}} {{cuurentroute('Category.index','active')}}">
                  <div class="menu-item-icon">
                      <i class="fa fa-feather"></i>
                  </div>
                  <span class="menu-item-text">{{__('Fabrics')}}</span>
                  <div class="menu-item-addon">
                      <i class="menu-item-caret caret"></i>
                  </div>
              </button>
                                <!-- BEGIN subMenu  Fabrics -->

                                <div class="menu-submenu">
                                    @can('create-fabric')
                                        <div class="menu-item">
                                            <a href="{{route('Fabrics.create')}}"
                                               class="menu-item-link {{cuurentroute('Fabrics.create','active')}} ">
                                               
                                                <span class="menu-item-text">{{__('create new Fabrics')}}</span>
                                            </a>
                                        </div>
                                    @endcan
                                    {{-- @can('roles') --}}
                                        <div class="menu-item">
                                            <a href="{{route('Fabrics.index')}}"
                                               class="menu-item-link {{cuurentroute('Fabrics.index','active')}}">
                                               
                                                <span class="menu-item-text">{{__('view all Fabrics')}}</span>
                                            </a>
                                        </div>
                                    {{-- @endcan --}}
                                    
                                </div>
                               
                            </div>
                                  <!-- END Submenu Fabrics-->
                                  {{------------------------------------------------------------------  --}}
                        <div class="menu-item">
                            <button
                            class="menu-item-link menu-item-toggle  {{cuurentroute('Threads.index','active')}} {{cuurentroute('Threads.create','active')}}">
                            <div class="menu-item-icon">
                                <i class="fas fa-signature"></i>
                            </div>
                            <span class="menu-item-text">{{__('Threads')}}</span>
                            <div class="menu-item-addon">
                                <i class="menu-item-caret caret"></i>
                            </div>
                        </button>
                        {{-----------------------------------------------------------------------------}}
                                            <!-- BEGIN subMenu  Threads -->

                                            <div class="menu-submenu">
                                                @can('create-thread')
                                                    <div class="menu-item">
                                                        <a href="{{route('Threads.create')}}"
                                                           class="menu-item-link {{cuurentroute('Threads.create','active')}} ">
                                                            <span class="menu-item-text">{{__('Add New Thread')}}</span>
                                                        </a>
                                                    </div>
                                                @endcan
                                                {{-- @can('Threads.index') --}}
                                                    <div class="menu-item">
                                                        <a href="{{route('Threads.index')}}"
                                                           class="menu-item-link {{cuurentroute('Threads.index','active')}}">
                                                            <span class="menu-item-text">{{__('view all Thread')}}</span>
                                                        </a>
                                                    </div>
                                                {{-- @endcan --}}
                        
                                            </div>
                                                   <!-- END Submenu Threads-->
                                              {{-------------------------------------------------------------}}
                                        </div>

<div class="menu-item">
    <button
    class="menu-item-link menu-item-toggle  {{cuurentroute('Fashions.index','active')}} {{cuurentroute('Fashions.create','active')}}{{cuurentroute('fascategory.index','active')}}">
    <div class="menu-item-icon">
        <i class="fa fa-vest-patches"></i>
    </div>
    <span class="menu-item-text">{{__('Fashion')}}</span>
    <div class="menu-item-addon">
        <i class="menu-item-caret caret"></i>
    </div>
</button>
{{-----------------------------------------------------------------------------}}
                    <!-- BEGIN subMenu  Fashion -->

                    <div class="menu-submenu">
                        @can('create-fashion')
                            <div class="menu-item">
                                <a href="{{route('Fashions.create')}}"
                                   class="menu-item-link {{cuurentroute('Fashions.create','active')}} ">
                                    
                                    <span class="menu-item-text">{{__('Create Stage Fashion')}}</span>
                                </a>
                            </div>
                        @endcan
                        {{-- @can('roles') --}}
                            <div class="menu-item">
                                <a href="{{route('Fashions.index')}}"
                                   class="menu-item-link {{cuurentroute('Fashions.index','active')}}">
                                 
                                    <span class="menu-item-text">{{__('Fashion All Stage')}}</span>
                                </a>
                            </div>
                        {{-- @endcan --}}

                    </div>
                </div>
                      <!-- END Submenu Threads-->
                      {{-------------------------------------------------------------}}



                    </div>
                </div>
            @endcan

        </div>
    </div>
        <!-- END Menu -->
    </div>
</div>
