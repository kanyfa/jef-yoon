@php
    $originCoords = [14.7157, -17.4677];
    $destinationCoords = [14.7142, -17.4456];
    if (isset($places[$origin])) {
        $originCoords = [$places[$origin]['lat'], $places[$origin]['lng']];
    }
    if (isset($places[$destination])) {
        $destinationCoords = [$places[$destination]['lat'], $places[$destination]['lng']];
    }
@endphp

<svg id="map-svg" viewBox="0 0 800 500" class="w-full h-auto" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="grad-water" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#7dd3f7"/>
            <stop offset="100%" stop-color="#3b82f6"/>
        </linearGradient>
        <linearGradient id="grad-land" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#f8f4e9"/>
            <stop offset="100%" stop-color="#e9e2cc"/>
        </linearGradient>
        <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
            <feGaussianBlur stdDeviation="2" result="coloredBlur"/>
            <feMerge>
                <feMergeNode in="coloredBlur"/>
                <feMergeNode in="SourceGraphic"/>
            </feMerge>
        </filter>
    </defs>

    <rect width="800" height="500" fill="url(#grad-land)"/>

    <path d="M0,320 C120,300 280,340 400,310 C520,290 680,330 800,300 L800,500 L0,500 Z"
          fill="url(#grad-water)" opacity="0.6"/>

    <g id="route-line" stroke="#FF6B6B" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"
       filter="url(#glow)" opacity="0.9">
        <path d="M80,380 C160,360 240,370 320,350 C400,330 480,340 560,325 C640,305 720,315 760,305"/>
    </g>

    <g id="route-dots" fill="#FF6B6B">
        <circle cx="80" cy="380" r="5"/>
        <circle cx="160" cy="360" r="5"/>
        <circle cx="240" cy="370" r="5"/>
        <circle cx="320" cy="350" r="5"/>
        <circle cx="400" cy="330" r="5"/>
        <circle cx="480" cy="340" r="5"/>
        <circle cx="560" cy="325" r="5"/>
        <circle cx="640" cy="305" r="5"/>
        <circle cx="720" cy="315" r="5"/>
        <circle cx="760" cy="305" r="5"/>
    </g>

    <g id="waypoint-0" class="waypoint" data-step="Départ: {{ $origin }}">
        <circle cx="80" cy="380" r="8" fill="#0A5D32"/>
        <text x="90" y="375" font-size="12" fill="#0A5D32" font-weight="bold">Départ</text>
        <text x="80" y="405" font-size="11" fill="#606060" text-anchor="middle">{{ $origin }}</text>
    </g>

    <g id="waypoint-1" class="waypoint hidden" data-step="Étape 1">
        <circle cx="320" cy="350" r="7" fill="#C99E44"/>
        <text x="332" y="346" font-size="11" fill="#0A5D32" font-weight="bold">1</text>
    </g>

    <g id="waypoint-2" class="waypoint hidden" data-step="Étape 2">
        <circle cx="520" cy="325" r="7" fill="#C99E44"/>
        <text x="532" y="321" font-size="11" fill="#0A5D32" font-weight="bold">2</text>
    </g>

    <g id="waypoint-3" class="waypoint" data-step="Arrivée: {{ $destination }}">
        <circle cx="760" cy="305" r="8" fill="#FF6B6B"/>
        <text x="772" y="301" font-size="11" fill="#FF6B6B" font-weight="bold">Arrivée</text>
        <text x="760" y="330" font-size="11" fill="#606060" text-anchor="middle">{{ $destination }}</text>
    </g>

    <g id="landmarks" fill="#0A5D32" font-size="11" font-weight="500">
        <rect x="60" y="180" width="20" height="8" rx="4" opacity="0.4"/>
        <text x="90" y="186" fill="#0A5D32" font-size="10">Hôpital Principal</text>

        <rect x="640" y="190" width="16" height="8" rx="4" opacity="0.4"/>
        <text x="665" y="196" fill="#0A5D32" font-size="10">Port Autonome</text>

        <rect x="340" y="100" width="18" height="8" rx="4" opacity="0.4"/>
        <text x="368" y="106" fill="#0A5D32" font-size="10">Grand Marché</text>

        <rect x="200" y="420" width="16" height="8" rx="4" opacity="0.4"/>
        <text x="222" y="426" fill="#0A5D32" font-size="10">Point E</text>

        <rect x="580" y="400" width="16" height="8" rx="4" opacity="0.4"/>
        <text x="602" y="406" fill="#0A5D32" font-size="10">Mermoz</text>
    </g>
</svg>

<div id="waypoint-details" class="mt-4 p-4 bg-cream rounded-md border border-slate-200 min-h-[60px]">
    <p class="text-sm text-slate-600">Cliquez sur un point de passage ci-dessus pour voir les détails du trajet.</p>
</div>
