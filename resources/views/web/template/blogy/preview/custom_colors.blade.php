@if(!empty($blogSettings->main_colors))
    <style>
        @if(!empty($blogSettings->main_colors['topbar-footer']))
            .site-nav,
        .site-footer {
            background-color: {{ $blogSettings->main_colors['topbar-footer'] }} !important;
        }
        @endif

        @if(!empty($blogSettings->main_colors['body']))
            body {
            background-color: {{ $blogSettings->main_colors['body'] }};

            @php
                $pattern = $blogSettings->main_colors['body_pattern'] ?? null;
                $patternColor = ($blogSettings->main_colors['body_pattern_color'] ?? '#ccc') . '80'; // 50% opacity
            @endphp

            @if($pattern)
                @switch($pattern)
                    @case('diagonal')
                            background-image: repeating-linear-gradient(
                            45deg,
                                            {{ $patternColor }} 0px,
                                            {{ $patternColor }} 2px,
                            transparent 2px,
                            transparent 10px
                        );
            @break

        @case('dots')
                    background-image: radial-gradient(
                    {{ $patternColor }} 1px,
                        transparent 1px
                    );
                background-size: 20px 20px;
            @break

        @case('grid')
            background-image:
                            linear-gradient({{ $patternColor }} 1px, transparent 1px),
                            linear-gradient(90deg, {{ $patternColor }} 1px, transparent 1px);
                        background-size: 20px 20px;
                    @break
            @endswitch
            @endif
            }
        @endif
    </style>
@endif
