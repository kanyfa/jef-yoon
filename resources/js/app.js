import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    var mapSvg = document.getElementById('map-svg');
    if (mapSvg) {
        var waypoints = mapSvg.querySelectorAll('.waypoint');
        var detailsBox = document.getElementById('waypoint-details');

        waypoints.forEach(function(wp) {
            wp.style.cursor = 'pointer';
            wp.addEventListener('click', function() {
                var step = this.getAttribute('data-step');
                var rect = this.getBoundingClientRect();
                var svgRect = mapSvg.getBoundingClientRect();

                var x = rect.left - svgRect.left + rect.width / 2;
                var y = rect.top - svgRect.top + rect.height / 2;

                detailsBox.innerHTML = '<p class="text-sm text-slate-600"><strong class="text-deep-green">' + step + '</strong></p>';
            });
        });
    }
});
