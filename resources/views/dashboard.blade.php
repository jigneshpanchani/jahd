@extends('layouts.template')
@section('title', 'Dashboard')

@section('content')

    <!-- notifications -->
    @include('layouts.template.notifications')
    <!-- notifications end -->

    <!-- statistics (small charts) -->
    <div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show"
         data-uk-sortable data-uk-grid-margin>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_visitors peity_data">5,3,9,6,5,9,7</span>
                    </div>
                    <span class="uk-text-muted uk-text-small">Employees</span>
                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ isset($employee)?$employee:0 }}</noscript></span></h2>
                </div>
            </div>
        </div>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_sale peity_data">5,3,9,6,5,9,7,3,5,2</span>
                    </div>
                    <span class="uk-text-muted uk-text-small">Department</span>
                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ isset($department)?$department:0 }}</noscript></span>
                    </h2>
                </div>
            </div>
        </div>
        <div>
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-float-right uk-margin-top uk-margin-small-right">
                        <span class="peity_orders peity_data">64/100</span>
                    </div>
                    <span class="uk-text-muted uk-text-small">Zone</span>
                    <h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ isset($zone)?$zone:0 }}</noscript></span>
                </div>
            </div>
        </div>
    </div>

    <!-- tasks -->
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">
        <div class="uk-width-medium-1-2">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table">
                            <thead>
                            <tr>
                                <th class="uk-text-nowrap">Task</th>
                                <th class="uk-text-nowrap">Status</th>
                                <th class="uk-text-nowrap">Progress</th>
                                <th class="uk-text-nowrap uk-text-right">Due Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="uk-table-middle">
                                <td class="uk-width-3-10 uk-text-nowrap"><a
                                            href="{{ asset('page_scrum_board.html') }}">ALTR-231</a></td>
                                <td class="uk-width-2-10 uk-text-nowrap"><span
                                            class="uk-badge">In progress</span></td>
                                <td class="uk-width-3-10">
                                    <div class="uk-progress uk-progress-mini uk-progress-warning uk-margin-remove">
                                        <div class="uk-progress-bar" style="width: 40%;"></div>
                                    </div>
                                </td>
                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">24.11.2015
                                </td>
                            </tr>
                            <tr class="uk-table-middle">
                                <td class="uk-width-3-10 uk-text-nowrap"><a
                                            href="{{ asset('page_scrum_board.html') }}">ALTR-82</a></td>
                                <td class="uk-width-2-10 uk-text-nowrap"><span
                                            class="uk-badge uk-badge-warning">Open</span></td>
                                <td class="uk-width-3-10">
                                    <div class="uk-progress uk-progress-mini uk-progress-success uk-margin-remove">
                                        <div class="uk-progress-bar" style="width: 82%;"></div>
                                    </div>
                                </td>
                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">21.11.2015
                                </td>
                            </tr>
                            <tr class="uk-table-middle">
                                <td class="uk-width-3-10 uk-text-nowrap"><a
                                            href="{{ asset('page_scrum_board.html') }}">ALTR-123</a></td>
                                <td class="uk-width-2-10 uk-text-nowrap"><span
                                            class="uk-badge uk-badge-primary">New</span></td>
                                <td class="uk-width-3-10">
                                    <div class="uk-progress uk-progress-mini uk-margin-remove">
                                        <div class="uk-progress-bar" style="width: 0;"></div>
                                    </div>
                                </td>
                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">12.11.2015
                                </td>
                            </tr>
                            <tr class="uk-table-middle">
                                <td class="uk-width-3-10 uk-text-nowrap"><a
                                            href="{{ asset('page_scrum_board.html') }}">ALTR-164</a></td>
                                <td class="uk-width-2-10 uk-text-nowrap"><span
                                            class="uk-badge uk-badge-success">Resolved</span></td>
                                <td class="uk-width-3-10">
                                    <div class="uk-progress uk-progress-mini uk-progress-primary uk-margin-remove">
                                        <div class="uk-progress-bar" style="width: 61%;"></div>
                                    </div>
                                </td>
                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">17.11.2015
                                </td>
                            </tr>
                            <tr class="uk-table-middle">
                                <td class="uk-width-3-10 uk-text-nowrap"><a
                                            href="{{ asset('page_scrum_board.html') }}">ALTR-123</a></td>
                                <td class="uk-width-2-10 uk-text-nowrap"><span class="uk-badge uk-badge-danger">Overdue</span>
                                </td>
                                <td class="uk-width-3-10">
                                    <div class="uk-progress uk-progress-mini uk-progress-danger uk-margin-remove">
                                        <div class="uk-progress-bar" style="width: 10%;"></div>
                                    </div>
                                </td>
                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">12.11.2015
                                </td>
                            </tr>
                            <tr class="uk-table-middle">
                                <td class="uk-width-3-10"><a
                                            href="{{ asset('page_scrum_board.html') }}">ALTR-92</a></td>
                                <td class="uk-width-2-10"><span class="uk-badge uk-badge-success">Open</span>
                                </td>
                                <td class="uk-width-3-10">
                                    <div class="uk-progress uk-progress-mini uk-margin-remove">
                                        <div class="uk-progress-bar" style="width: 90%;"></div>
                                    </div>
                                </td>
                                <td class="uk-width-2-10 uk-text-right uk-text-muted uk-text-small">08.11.2015
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-medium-1-2">
            <div class="md-card">
                <div class="md-card-content">
                    <h3 class="heading_a uk-margin-bottom">Statistics</h3>
                    <div id="ct-chart" class="chartist"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <!-- page specific plugins -->
    <!-- d3 -->
    <script src="{{ asset('bower_components/d3/d3.min.js') }}"></script>
    <!-- metrics graphics (charts) -->
    <script src="{{ asset('bower_components/metrics-graphics/dist/metricsgraphics.min.js') }}"></script>
    <!-- chartist (charts) -->
    <script src="{{ asset('bower_components/chartist/dist/chartist.min.js') }}"></script>
    <!-- maplace (google maps) -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyC2FodI8g-iCz1KHRFE7_4r8MFLA7Zbyhk"></script>
    <script src="{{ asset('bower_components/maplace-js/dist/maplace.min.js') }}"></script>
    <!-- peity (small charts) -->
    <script src="{{ asset('bower_components/peity/jquery.peity.min.js') }}"></script>
    <!-- easy-pie-chart (circular statistics) -->
    <script src="{{ asset('bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
    <!-- countUp -->
    <script src="{{ asset('bower_components/countUp.js/dist/countUp.min.js') }}"></script>
    <!-- handlebars.js -->
    <script src="{{ asset('bower_components/handlebars/handlebars.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/handlebars_helpers.min.js') }}"></script>
    <!-- CLNDR -->
    <script src="{{ asset('bower_components/clndr/clndr.min.js') }}"></script>

    <!--  dashbord functions -->
    <script src="{{ asset('assets/js/pages/dashboard.min.js') }}"></script>

@endpush