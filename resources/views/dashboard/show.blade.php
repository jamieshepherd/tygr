@extends('_layout.base')
@section('headlinks')
<script src="/js/chart.min.js"></script>
<script>
    Chart.defaults.global = {
        // Boolean - Whether to animate the chart
        animation: true,

        // Number - Number of animation steps
        animationSteps: 60,

        // String - Animation easing effect
        animationEasing: "easeOutQuart",

        // Boolean - If we should show the scale at all
        showScale: true,

        // Boolean - If we want to override with a hard coded scale
        scaleOverride: false,

        // ** Required if scaleOverride is true **
        // Number - The number of steps in a hard coded scale
        scaleSteps: null,
        // Number - The value jump in the hard coded scale
        scaleStepWidth: null,
        // Number - The scale starting value
        scaleStartValue: null,

        // String - Colour of the scale line
        scaleLineColor: "rgba(0,0,0,.1)",

        // Number - Pixel width of the scale line
        scaleLineWidth: 1,

        // Boolean - Whether to show labels on the scale
        scaleShowLabels: true,

        // Interpolated JS string - can access value
        scaleLabel: "<%=value%>",

        // Boolean - Whether the scale should stick to integers, not floats even if drawing space is there
        scaleIntegersOnly: true,

        // Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: false,

        // String - Scale label font declaration for the scale label
        scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

        // Number - Scale label font size in pixels
        scaleFontSize: 12,

        // String - Scale label font weight style
        scaleFontStyle: "normal",

        // String - Scale label font colour
        scaleFontColor: "#666",

        // Boolean - whether or not the chart should be responsive and resize when the browser does.
        responsive: true,

        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,

        // Boolean - Determines whether to draw tooltips on the canvas or not
        showTooltips: true,

        // Function - Determines whether to execute the customTooltips function instead of drawing the built in tooltips (See [Advanced - External Tooltips](#advanced-usage-custom-tooltips))
        customTooltips: false,

        // Array - Array of string names to attach tooltip events
        tooltipEvents: ["mousemove", "touchstart", "touchmove"],

        // String - Tooltip background colour
        tooltipFillColor: "rgba(0,0,0,0.8)",

        // String - Tooltip label font declaration for the scale label
        tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

        // Number - Tooltip label font size in pixels
        tooltipFontSize: 14,

        // String - Tooltip font weight style
        tooltipFontStyle: "normal",

        // String - Tooltip label font colour
        tooltipFontColor: "#fff",

        // String - Tooltip title font declaration for the scale label
        tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

        // Number - Tooltip title font size in pixels
        tooltipTitleFontSize: 14,

        // String - Tooltip title font weight style
        tooltipTitleFontStyle: "bold",

        // String - Tooltip title font colour
        tooltipTitleFontColor: "#fff",

        // Number - pixel width of padding around tooltip text
        tooltipYPadding: 6,

        // Number - pixel width of padding around tooltip text
        tooltipXPadding: 6,

        // Number - Size of the caret on the tooltip
        tooltipCaretSize: 8,

        // Number - Pixel radius of the tooltip border
        tooltipCornerRadius: 6,

        // Number - Pixel offset from point x to tooltip edge
        tooltipXOffset: 10,

        // String - Template string for single tooltips
        tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",

        // String - Template string for single tooltips
        multiTooltipTemplate: "<%= value %>",

        // Function - Will fire on animation progression.
        onAnimationProgress: function(){},

        // Function - Will fire on animation completion.
        onAnimationComplete: function(){}
    }
</script>
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Dashboard</li></a>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Dashboard</h1>
        <div class="dashboard">
            <div class="row">
                <div class="col col-1-3">
                    <div class="content stats">
                        <h2>{{ $data['project_count'] }}</h2>
                        <h3>Active projects</h3>
                    </div>
                </div>
                <div class="col col-1-3">
                    <div class="content stats">
                        <h2>{{ $data['issue_count'] }}</h2>
                        <h3>Open issues</h3>
                    </div>
                </div>
                <div class="col col-1-3">
                    <div class="content stats">
                        <h2>{{ $data['client_count'] }}</h2>
                        <h3>Total clients</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-1-2">
                    <div class="content">
                        <canvas id="chart" width="200" height="200"></canvas>
                        <script>

                            // pie chart data
                            var pieData = [
                                {
                                    value: 20,
                                    color:"#878BB6"
                                },
                                {
                                    value : 40,
                                    color : "#4ACAB4"
                                },
                                {
                                    value : 10,
                                    color : "#FF8153"
                                },
                                {
                                    value : 30,
                                    color : "#FFEA88"
                                }
                            ];

                            // pie chart options
                            var pieOptions = {
                                segmentShowStroke : true,
                                animateScale : true
                            }

                            // get pie chart canvas
                            var countries= document.getElementById("chart").getContext("2d");

                            // draw pie chart
                            new Chart(countries).Doughnut(pieData, pieOptions);

                        </script>
                    </div>
                </div>
                <div class="col col-1-2">
                    <div class="content">
                        <h3>Something</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, est eveniet illo maiores nisi sed veniam vitae voluptas. Aliquid asperiores consectetur deserunt est minima minus neque officia pariatur quas sit.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, est eveniet illo maiores nisi sed veniam vitae voluptas. Aliquid asperiores consectetur deserunt est minima minus neque officia pariatur quas sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
