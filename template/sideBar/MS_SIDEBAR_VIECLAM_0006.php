<link rel="stylesheet" href="/plugin/jquery-ui/jquery-ui.min.css">
<div class="gb-filterprices-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Lọc theo giá</h3>
        <div class="widget-content">
            <div class="uni-filter-price">
                <div id="slider-range"></div>
                <div class="label-filter-price"><input type="text" id="amount" readonly></div>
                <button class="btn-filter-prince">SEARCH</button>

                <div class="clearfix"></div>
            </div>
        </div>
    </aside>
</div>
<script src="/plugin/jquery-ui/jquery-ui.min.js"></script>

<script>
    $(document).ready(function () {
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 17000,
                values: [ 2000, 15000 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        } );
    });
</script>